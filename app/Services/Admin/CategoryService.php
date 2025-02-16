<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Category;
use Illuminate\Http\UploadedFile;

class CategoryService
{
    // all category get from database 
    public static function getAll()
    {
        try {
            $query = Category::query();
            $categories = $query->get();
            return $categories;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/category';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    public static function storeDocument($request)
    {
        return ([
            'category_name' => $request->category_name,
            'parent_id' => $request->parent_id,
            'category_image' => $request->category_image ? self::ImageUpload($request->category_image) : '',
            'status' => $request->status,
        ]);
    }
    // category create in database
    public static function createCategory($request)
    {
        try {
            return Category::create(CategoryService::storeDocument($request));
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // show single category 
    public static function showCategory($id)
    {
        try {
            return Category::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // update category 
    public static function updateCategory($request, $id)
    {
        try {
            $data = Category::findOrFail($id);
            $categoryData = CategoryService::storeDocument($request);
            if($request->category_image){
                $categoryData['category_image'] = self::ImageUpload($request->category_image);
            }else{
                $categoryData['category_image'] = $data->category_image;
            }
            $data->update($categoryData);
            return $data;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // category delete in database
    public static function destroyCategory($id)
    {
        try {
            $data = Category::findOrFail($id);
            return $data->delete();
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
