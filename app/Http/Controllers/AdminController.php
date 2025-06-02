<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Models\Article;


class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua data, bukan hanya count
        $products = Product::all();
        $carousels = Carousel::all();
        $pendingArticles = Article::where('status', 'pending')->with('user')->get();
        $approvedArticles = Article::where('status', 'approved')->with('user')->get();
        
        // Hitung jumlahnya (jika diperlukan)
        $productCount = $products->count();
        $carouselCount = $carousels->count();
        
        // Pass semua data ke view
        return view('admin', compact('products', 'carousels', 'productCount', 'carouselCount', 'pendingArticles', 'approvedArticles'));    
    }

    public function approveArticle($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return back()->with('error', 'Artikel tidak ditemukan');
        }

        $article->status = 'approved';
        $article->save();

        return redirect('/admin?tab=articles&article_tab=pending')
            ->with('article_success', 'Artikel berhasil disetujui');
    }


    public function rejectArticle(Request $request, $id)
    {
        $request->validate(['reason' => 'required|string|max:255']);

        $article = Article::find($id);
        if (!$article) {
            return back()->with('error', 'Artikel tidak ditemukan');
        }

        $article->status = 'rejected';
        $article->rejection_reason = $request->reason;
        $article->save();

        return redirect('/admin?tab=articles&article_tab=pending')
            ->with('article_success', 'Artikel berhasil ditolak');
    }
}