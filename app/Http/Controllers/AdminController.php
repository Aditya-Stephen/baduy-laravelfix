<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Carousel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $carouselCount = Carousel::count();
        
        return view('admin', compact('productCount', 'carouselCount'));
    }
}