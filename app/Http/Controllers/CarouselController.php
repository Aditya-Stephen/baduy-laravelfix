<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('order')->get();
        return view('admin', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/carousels'), $imageName);

        Carousel::create([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
            'image' => 'images/carousels/'.$imageName,
        ]);

        return redirect()->route('admin')->with('success', 'Slide carousel berhasil ditambahkan');
    }

    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
        ];

        if ($request->hasFile('image')) {
            if ($carousel->image && file_exists(public_path($carousel->image))) {
                unlink(public_path($carousel->image));
            }
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/carousels'), $imageName);
            $data['image'] = 'images/carousels/'.$imageName;
        }

        $carousel->update($data);

        return redirect()->route('admin')->with('success', 'Slide carousel berhasil diperbarui');
    }

    public function destroy(Carousel $carousel)
    {
        // Hapus gambar jika ada
        if ($carousel->image && file_exists(public_path($carousel->image))) {
            unlink(public_path($carousel->image));
        }
        
        $carousel->delete();

        return redirect()->route('admin')->with('success', 'Slide carousel berhasil dihapus');
    }
}