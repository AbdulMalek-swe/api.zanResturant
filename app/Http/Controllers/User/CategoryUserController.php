<?php

namespace App\Http\Controllers\User;
use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller; 
use App\Services\User\CategoryUserService; 

class CategoryUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CategoryUserService::getAll();
        return HttpResponseHelper::successResponse("Categories retrieved successfully",$data,200);
    }  
    // show single category 
    public function show(string $id)
    {
        $data = CategoryUserService::showCategory($id);
        return HttpResponseHelper::successResponse("Categories retrieved successfully",$data,200);
    }
     
 
}
