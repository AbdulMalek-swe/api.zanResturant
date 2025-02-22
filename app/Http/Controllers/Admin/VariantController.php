<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Admin\VariantService;
use Illuminate\Http\Request;

class VariantController extends Controller
{
  public function index()
  { 
    $Cook = VariantService::getAll();
    return  HttpResponseHelper::successResponse("successfully show Variant information", $Cook, 200);
  }
  //    store 
  public function store(Request $request)
  {
    $Cook = VariantService::store($request);
    return   HttpResponseHelper::successResponse("Create Cook successfully", $Cook, 200);
  }
  // single Cook 
  public function show($id)
  {
    $Cook = VariantService::show($id);
    return   HttpResponseHelper::successResponse("successfully fetch single Cook", $Cook, 200);
  }
  // update Cook
  public function update(Request $request, $id)
  {
    $Cook = VariantService::update($request, $id);
    return   HttpResponseHelper::successResponse("Update Cook successfully", $Cook, 200);
  }
  // delete Cook
  public function destroy($id)
  {
    VariantService::destroy($id);
    return   HttpResponseHelper::successResponse("Delete Cook successfully", null, 200);
  }
}
