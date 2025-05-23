<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $articles = Article::where('author_name', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%')
                ->latest()
                ->get();
        } else {
            $articles = Article::latest()->get();
        }

        return view('artikel', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('artikel.show', compact('article'));
    }
}