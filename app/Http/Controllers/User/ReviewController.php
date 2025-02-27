<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Services\User\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = ReviewService::getAll($request);
         return HttpResponseHelper::successResponse("successfully show review",$data,200);
    } 
    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    { 
            $data = ReviewService::store($request);
             return HttpResponseHelper::successResponse("successfully create review",$data,200);
      
    }
 
}
