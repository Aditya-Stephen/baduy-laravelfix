<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Article::query()->with('user')->where('status', 'approved');
        $genre = $request->input('genre', 'all'); 

        if ($genre && $genre !== 'all') {
            $query->where('genre', $genre);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                  ->orWhere('content', 'like', '%'.$search.'%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%'.$search.'%');
                  });
            });
        }
        
        $articles = $query->latest()->paginate(10)->appends($request->query());
        
        $categories = Cache::remember('article_counts_by_category', now()->addHours(6), function() {
            return [
                'all' => Article::where('status', 'approved')->count(),
                'Budaya & Tradisi' => Article::where('genre', 'Budaya & Tradisi')->where('status', 'approved')->count(),
                'Kearifan Lokal' => Article::where('genre', 'Kearifan Lokal')->where('status', 'approved')->count(),
                'Mitos & Kepercayaan' => Article::where('genre', 'Mitos & Kepercayaan')->where('status', 'approved')->count(),
                'Lokasi' => Article::where('genre', 'Lokasi')->where('status', 'approved')->count()
            ];
        });

        return view('artikel', compact('articles', 'categories', 'genre'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
    
        if (Auth::check() && request()->is('admin/*')) {
            return view('artikel.show', compact('article'));
        }
        
        if ($article->status !== 'approved') {
            abort(404);
        }

        return view('artikel.show', compact('article'));
    }

    // buat nampilin form buat artikel
    public function create()
    {
        return view('artikel.create');
    }

    // buat simpen artikel baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'genre' => 'required|in:Budaya & Tradisi,Kearifan Lokal,Mitos & Kepercayaan,Lokasi',
            'content' => 'required',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4048'       
        ]);

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $article = new Article([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'genre' => $validatedData['genre'],
            'content' => $validatedData['content'],
            'status' => 'pending',
            'created_at' => now()
        ]);

        // Handle image upload - store both path and binary data
        if ($request->hasFile('header_image')) {
            $file = $request->file('header_image');
            
            // Store path for compatibility
            $imagePath = $file->store('article_images', 'public');
            $article->header_image = $imagePath;
            
            // Store binary data
            $article->image_data = base64_encode(file_get_contents($file->getRealPath()));
        }

        $article->save();
        
        Cache::forget('article_counts_by_category');

        return redirect()->route('artikel')
            ->with('success', 'Artikel berhasil diajukan! Menunggu persetujuan admin.');
    }
    
    // Edit artikel
    public function edit($id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        
        // Only allow editing by author or admin
        if ((Auth::user() && Auth::user()->id !== $article->user_id) && !(Auth::user() && Auth::user()->isAdmin)) {
            abort(403);
        }
        
        // Don't allow editing approved articles (except by admin)
        if ($article->status === 'approved' && !(Auth::user() && Auth::user()->isAdmin)) {
            return redirect()->route('artikel.show', $article->id)
                ->with('error', 'Artikel yang sudah disetujui tidak dapat diedit.');
        }
        
        return view('artikel.edit', compact('article'));
    }
    
    // Update artikel
    public function update(Request $request, $id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        
        // Only allow updates by author or admin
        if (Auth::id() !== $article->user_id && !(Auth::user() && Auth::user()->isAdmin)) {
            abort(403);
        }
        
        // Don't allow editing approved articles (except by admin)
        if ($article->status === 'approved' && !(Auth::user() && Auth::user()->isAdmin)) {
            return redirect()->route('artikel.show', $article->id)
                ->with('error', 'Artikel yang sudah disetujui tidak dapat diedit.');
        }
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'genre' => 'required|in:Budaya & Tradisi,Kearifan Lokal,Mitos & Kepercayaan,Lokasi',
            'content' => 'required',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4048'
        ]);
        
        $article->title = $validatedData['title'];
        $article->genre = $validatedData['genre'];
        $article->content = $validatedData['content'];
        
        // If article was rejected and now being resubmitted
        if ($article->status === 'rejected') {
            $article->status = 'pending';
            $article->rejection_reason = null;
        }
        
        // Handle image upload - update both path and binary data
        if ($request->hasFile('header_image')) {
            // Delete old image if exists
            if ($article->header_image) {
                Storage::disk('public')->delete($article->header_image);
            }
            
            $file = $request->file('header_image');
            
            // Store path for compatibility
            $imagePath = $file->store('article_images', 'public');
            $article->header_image = $imagePath;
            
            // Store binary data
            $article->image_data = base64_encode(file_get_contents($file->getRealPath()));
        }
        
        $article->save();
        
        Cache::forget('article_counts_by_category');
        
        return redirect()->route('profile.edit')
            ->with('success', 'Artikel berhasil diperbarui dan sedang menunggu persetujuan.');
    }
    
    // Delete artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
        // Only allow deletion by author or admin
        if (Auth::id() !== $article->user_id && !(Auth::user() && Auth::user()->isAdmin)) {
            abort(403);
        }
        
        // Delete image file if exists
        if ($article->header_image) {
            Storage::disk('public')->delete($article->header_image);
        }
        
        $article->delete();
        
        Cache::forget('article_counts_by_category');
        
        return redirect()->route('profile.edit')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    public function adminPreview($id)
    {
        $article = Article::findOrFail($id);
        return view('artikel.show', [
            'article' => $article,
            'is_admin_preview' => true
        ]);
    }
}