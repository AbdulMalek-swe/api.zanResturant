<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller; 
use App\Services\User\ChefUserService;
use Illuminate\Http\Request;

class ChefUserController extends Controller
{
    // all chefs  list  with pagination and filter options  - search, sort, pagination
    public function index(Request $request)
    {
        $chefs = ChefUserService::getAll($request);
        return  HttpResponseHelper::successResponse("successfully show Chef information", $chefs, 200);
    }
    
    // single Chef 
    public function show($id)
    {
        $chef = ChefUserService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single Chef", $chef, 200);
    }
 
}
