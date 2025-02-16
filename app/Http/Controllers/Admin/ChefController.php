<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller; 
use App\Services\Admin\ChefService;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    public function index(Request $request)
    {
        $chefs = ChefService::getAll($request);
        return  HttpResponseHelper::successResponse("successfully show Chef information", $chefs, 200);
    }
    //    store  Chef
    public function store(Request $request)
    {

        $chef = ChefService::store($request);
        return   HttpResponseHelper::successResponse("Create Chef successfully", $chef, 200);
    }
    // single Chef 
    public function show($id)
    {
        $chef = ChefService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single Chef", $chef, 200);
    }
    // update Chef
    public function update(Request $request, $id)
    {
        $chef = ChefService::update($request, $id);
        return   HttpResponseHelper::successResponse("Update Chef successfully", $chef, 200);
    }
    // delete Chef
    public function destroy($id)
    {
          ChefService::destroy($id);
        return   HttpResponseHelper::successResponse("Delete Chef successfully", null, 200);
    }
}
