<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Review;

class ReviewService
{
    /* get all review */
    public static function getAll( )
    {
        try { 
            return Review::orderBy('rating', 'asc')->get();
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    delete revew 
    public static function destroy($id)
    {
        try {
            return Review::destroy($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
