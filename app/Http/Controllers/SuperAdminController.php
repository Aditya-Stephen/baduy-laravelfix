<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Product;
use App\Models\Carousel;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $pendingArticles = Article::where('status', 'pending')->with('user')->get();
        $approvedArticles = Article::where('status', 'approved')->with('user')->get();
        $products = Product::all();
        $carousels = Carousel::orderBy('order')->get();

        return view('superadmin', compact('users', 'pendingArticles', 'approvedArticles', 'products', 'carousels'));
    }

    public function promoteToAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);
        $user->role = 'admin';
        $user->save();

        return back()->with('success', 'User berhasil dipromosikan menjadi admin');
    }

    public function demoteAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);
        $user->role = 'user';
        $user->save();

        return back()->with('success', 'Admin berhasil diturunkan menjadi user');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        if ($user->role === 'superadmin') {
            return back()->with('error', 'Tidak dapat menghapus Super Admin');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}
