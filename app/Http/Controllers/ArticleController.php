<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Article::query()->with('user');
        $genre = $request->input('genre');

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
        
        $articles = $query->latest()->get();
        
        $categories = Cache::remember('article_counts_by_category', now()->addHours(6), function() {
            return [
                'Budaya & Tradisi' => Article::where('genre', 'Budaya & Tradisi')->count(),
                'Kearifan Lokal' => Article::where('genre', 'Kearifan Lokal')->count(),
                'Mitos & Kepercayaan' => Article::where('genre', 'Mitos & Kepercayaan')->count(),
                'Lokasi' => Article::where('genre', 'Lokasi')->count()
            ];
        });

        return view('artikel', compact('articles', 'categories'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
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

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // buat gambar yang di upload
        $imagePath = null;
        if ($request->hasFile('header_image')) {
            $imagePath = $request->file('header_image')->store('article_images', 'public');
        }

        Article::create([
            'user_id' => auth()->id(),
            'title' => $validatedData['title'],
            'genre' => $validatedData['genre'],
            'content' => $validatedData['content'],
            'header_image' => $imagePath,            
            'created_at' => now()
        ]);

        Cache::forget('article_counts_by_category');

        return redirect()->route('artikel')
            ->with('success', 'Artikel berhasil dipublikasikan!');
    }
}