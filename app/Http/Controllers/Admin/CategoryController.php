<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CategoryService::getAll();
        return HttpResponseHelper::successResponse("Categories retrieved successfully",$data,200);
    } 
    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
         $data = CategoryService::createCategory($request);
         return HttpResponseHelper::successResponse("Category created successfully", $data, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = CategoryService::showCategory($id);
        return HttpResponseHelper::successResponse("Categories retrieved successfully",$data,200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = CategoryService::updateCategory($request, $id);
        return HttpResponseHelper::successResponse("Category updated successfully", $data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data  = CategoryService::destroyCategory($id);
        return HttpResponseHelper::successResponse("Category deleted successfully", $data, 200);
    }
}
