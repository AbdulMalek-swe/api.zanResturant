<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Admin\ReviewService;

class ReviewAdminController extends Controller
{
    // show all review 
    public function index()
    {
        $reviews = ReviewService::getAll();
        return HttpResponseHelper::successResponse("Successfully show Review information", $reviews, 200);
    }

    // delete Cook
    public function destroy($id)
    {
        $data = ReviewService::destroy($id);
        return HttpResponseHelper::successResponse("Delete Review successfully", $data, 200);
    }
}
