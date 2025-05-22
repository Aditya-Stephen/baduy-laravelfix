<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Carousel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua data, bukan hanya count
        $products = Product::all();
        $carousels = Carousel::all();
        
        // Hitung jumlahnya (jika diperlukan)
        $productCount = $products->count();
        $carouselCount = $carousels->count();
        
        // Pass semua data ke view
        return view('admin', compact('products', 'carousels', 'productCount', 'carouselCount'));
    }
}