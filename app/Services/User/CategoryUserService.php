<?php

namespace App\Services\User;
use App\Helpers\HttpResponseHelper;
use App\Models\Category;

class CategoryUserService
{
    // all category get from database 
    public static function getAll()
    {
        try {
            $query = Category::query();
            $categories = $query->get()->where("status", 1);
            return $categories;
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
    
    
}
