<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    //
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

        return view('artikel', compact('articles'));
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
            'header_image' => 'nullable|url'
        ]);

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        Article::create([
            'user_id' => auth()->id(),
            'title' => $validatedData['title'],
            'genre' => $validatedData['genre'],
            'content' => $validatedData['content'],
            'header_image' => $validatedData['header_image'] ?? null,
            'created_at' => now()
        ]);

        return redirect()->route('artikel')
            ->with('success', 'Artikel berhasil dipublikasikan!');
    }
}
