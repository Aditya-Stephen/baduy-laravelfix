<?php

namespace App\Helpers;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class ImageHelper
{
    // CONSTANTS untuk optimization
    const MAX_WIDTH = 1920;
    const MAX_HEIGHT = 1080;
    const PROFILE_MAX_WIDTH = 400;
    const PROFILE_MAX_HEIGHT = 400;
    const JPEG_QUALITY = 85;
    const WEBP_QUALITY = 80;
    const MAX_FILE_SIZE = 25 * 1024 * 1024; 
    const PROFILE_MAX_SIZE = 10 * 1024 * 1024; 

    public static function uploadImage(
        UploadedFile $file, 
        $model, 
        string $imageType = 'main', 
        int $order = 0
    ) {
        if ($file->getSize() > 25 * 1024 * 1024) { // Max 25MB
            throw new \Exception('File terlalu besar. Maksimal 25MB.');
        }
        
        // Convert ke base64
        $imageData = base64_encode(file_get_contents($file->getRealPath()));
        
        return $model->images()->create([
            'filename' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'image_data' => $imageData,
            'uploaded_by' => Auth::id(),
            'image_type' => $imageType,
            'order' => $order
        ]);
    }

    public static function replaceImage(
        UploadedFile $file, 
        $model, 
        string $imageType = 'main'
    ) {
        $model->images()->where('image_type', $imageType)->delete();
        return self::uploadImage($file, $model, $imageType);
    }

    public static function uploadMultipleImages(
        array $files, 
        $model, 
        string $imageType = 'gallery'
    ) {
        $images = [];
        foreach ($files as $index => $file) {
            try {
                $images[] = self::uploadImage($file, $model, $imageType, $index);
            } catch (\Exception $e) {
                continue;
            }
        }
        return $images;
    }
}