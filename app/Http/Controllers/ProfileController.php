<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Article;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Get user articles for the articles section
        $articles = Article::where('user_id', Auth::id())->latest()->get();
        
        return view('profile.edit', [
            'user' => $request->user(),
            'articles' => $articles
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user->name = $request->name;
        
        // Handle profile photo from cropper
        if ($request->filled('cropped_photo_data')) {
            // Extract base64 image data (remove prefix like data:image/jpeg;base64,)
            $imageData = $request->input('cropped_photo_data');
            if (strpos($imageData, ';base64,') !== false) {
                $imageData = explode(';base64,', $imageData)[1];
            }
            
            // Store binary data directly in the database
            $user->profile_photo_data = $imageData;
            
            // For backward compatibility, also store as a file
            // (can be removed later when all views are updated)
            try {
                // Delete old image if exists
                if ($user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }
                
                // Store new image
                $decodedImage = base64_decode($imageData);
                $filename = 'profile-photos/' . time() . '_' . $user->id . '.jpg';
                Storage::disk('public')->put($filename, $decodedImage);
                $user->profile_photo_path = $filename;
            } catch (\Exception $e) {
                // Log the error but continue - we'll still have the database version
                Log::error('Failed to store profile photo: ' . $e->getMessage());
            }
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}