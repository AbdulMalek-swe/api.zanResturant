<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

class ImageHelpers
{
    public static function resizeImage($file, $width = 800, $height = null)
    {
        $image = Image::make($file);
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        return $image;
    }

    public static function saveImage($image, $storagePath, $fileName)
    {
        // Construct the full path
        $fullPath = public_path($storagePath . '/' . $fileName);
        // Ensure directory exists
        $directory = dirname($fullPath);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        // Save the image
        $image->save($fullPath);
        // Return the relative path
        return $storagePath . '/' . $fileName;
    }

    // ImageUpload to handle multiple images with dynamic path
    public static function ImageUploadMultiple(array $files, $path)
    {
        $storagePath = $path;
        $uploadedPaths = []; 
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $fileName = time() . uniqid() . '.' . $file->getClientOriginalExtension();
                $image = self::resizeImage($file); 
                $filePath = self::saveImage($image, $storagePath, $fileName); 
                $uploadedPaths[] = $filePath; 
            }
        }

        return $uploadedPaths;
    }


}