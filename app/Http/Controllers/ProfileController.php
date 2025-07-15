<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)->latest()->get();
        
        return view('profile.edit', compact('user', 'articles'));
    }

    public function update(Request $request)
    {
        // Debug input
        Log::info('=== PROFILE UPDATE START ===');
        Log::info('User ID: ' . Auth::id());
        Log::info('User Role: ' . Auth::user()->role);
        Log::info('Request Name: ' . $request->name);
        Log::info('Has cropped_photo: ' . ($request->filled('cropped_photo') ? 'YES' : 'NO'));
        
        if ($request->filled('cropped_photo')) {
            $croppedLength = strlen($request->cropped_photo);
            Log::info('Cropped photo length: ' . $croppedLength);
            Log::info('Cropped photo start: ' . substr($request->cropped_photo, 0, 50));
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'cropped_photo' => 'nullable|string',
        ]);

        $user = \App\Models\User::find(Auth::id());
        
        // Update nama user saja - JANGAN TOUCH ROLE!
        $originalRole = $user->role;
        $user->name = $request->name;
        // EXPLICITLY PRESERVE ROLE
        $user->role = $originalRole;
        $user->save();
        
        Log::info('Name updated. Role preserved: ' . $user->fresh()->role);

        // Handle profile photo upload
        if ($request->filled('cropped_photo')) {
            Log::info('Processing profile photo upload...');
            
            try {
                $imageData = $request->cropped_photo;
                
                // Validate and clean base64 data
                if (!$imageData || strlen($imageData) < 100) {
                    throw new \Exception('Invalid or empty image data received');
                }
                
                // Remove data:image/jpeg;base64, prefix if exists
                if (strpos($imageData, 'data:image') === 0) {
                    $commaPos = strpos($imageData, ',');
                    if ($commaPos === false) {
                        throw new \Exception('Invalid base64 format - no comma found');
                    }
                    $imageData = substr($imageData, $commaPos + 1);
                }
                
                Log::info('Cleaned base64 length: ' . strlen($imageData));
                
                // Decode base64
                $decodedImage = base64_decode($imageData, true);
                if ($decodedImage === false) {
                    throw new \Exception('Failed to decode base64 image data');
                }
                
                Log::info('Decoded image size: ' . strlen($decodedImage) . ' bytes');
                
                // Create temp file
                $tempDir = sys_get_temp_dir();
                $tempFile = tempnam($tempDir, 'profile_' . $user->id . '_');
                if (!$tempFile) {
                    throw new \Exception('Cannot create temporary file in: ' . $tempDir);
                }
                
                $bytesWritten = file_put_contents($tempFile, $decodedImage);
                if ($bytesWritten === false || $bytesWritten === 0) {
                    throw new \Exception('Cannot write decoded image to temp file');
                }
                
                Log::info('Temp file created: ' . $tempFile . ' (' . $bytesWritten . ' bytes)');
                
                // Verify it's a valid image
                $imageInfo = getimagesize($tempFile);
                if ($imageInfo === false) {
                    unlink($tempFile);
                    throw new \Exception('Uploaded file is not a valid image');
                }
                
                Log::info('Valid image detected: ' . $imageInfo['mime'] . ' (' . $imageInfo[0] . 'x' . $imageInfo[1] . ')');
                
                // Create UploadedFile instance
                $uploadedFile = new \Illuminate\Http\UploadedFile(
                    $tempFile,
                    'profile_photo_' . $user->id . '.jpg',
                    $imageInfo['mime'],
                    null,
                    true
                );
                
                // Delete existing profile image FIRST
                $existingProfileImage = $user->profileImage();
                if ($existingProfileImage) {
                    Log::info('Deleting existing profile image: ' . $existingProfileImage->id);
                    $existingProfileImage->delete();
                    Log::info('Existing profile image deleted');
                }
                
                // Upload new profile image
                Log::info('Uploading new profile image...');
                $newImage = ImageHelper::uploadImage($uploadedFile, $user, 'profile');
                Log::info('New profile image uploaded with ID: ' . $newImage->id);
                
                // Clean up temp file
                if (file_exists($tempFile)) {
                    unlink($tempFile);
                    Log::info('Temp file cleaned up');
                }
                
                // Verify the image was saved correctly
                $verifyImage = $user->fresh()->profileImage();
                if ($verifyImage) {
                    Log::info('Profile image verified in database: ' . $verifyImage->id);
                } else {
                    Log::error('Profile image NOT found after upload!');
                }
                
            } catch (\Exception $e) {
                Log::error('Profile photo upload FAILED: ' . $e->getMessage());
                Log::error('Stack trace: ' . $e->getTraceAsString());
                
                return back()->with('error', 'Gagal mengupload foto profil: ' . $e->getMessage());
            }
        }

        Log::info('=== PROFILE UPDATE COMPLETED ===');
        return back()->with('success', 'Profile berhasil diperbarui!');
    }
}
