<?php

namespace App\Helpers;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class ImageHelper
{
    public static function uploadImage(
        UploadedFile $file, 
        $model, 
        string $imageType = 'main', 
        int $order = 0
    ) {
        // Validasi ukuran file - sangat ketat
        if ($file->getSize() > 300 * 1024) { // Max 300KB
            throw new \Exception('File terlalu besar. Maksimal 300KB.');
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