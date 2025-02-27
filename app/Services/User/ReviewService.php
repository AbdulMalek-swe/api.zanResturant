<?php

namespace App\Services\User;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Review;
use Illuminate\Http\UploadedFile; 

class ReviewService
{
    /* get all review */
    public static function getAll($request)
    {
        try {
            $per_page = request('per_page'); 
            return Review::orderBy('rating', 'desc')->paginate($per_page ?? 10); 
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/Review';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    /* store Review */
    public static function storeDocument($request)
    {
        return ([
            'name' => $request->name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'thumbnail' => $request->thumbnail ? self::ImageUpload($request->thumbnail) : '',
        ]);
    }
    // store Review
    public static function store($request)
    {
        try {
            $review = Review::create(self::storeDocument($request));
            return $review;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
