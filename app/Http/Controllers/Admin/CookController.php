<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CookRequest;
use App\Services\Admin\CookService;
use Illuminate\Http\Request;

class CookController extends Controller
{
  public function index()
  {
    $Cook = CookService::getAll();
    return  HttpResponseHelper::successResponse("successfully show Cook information", $Cook, 200);
  }
  //    store 
  public function store(CookRequest $request)
  {
    $Cook = CookService::store($request);
    return   HttpResponseHelper::successResponse("Create Cook successfully", $Cook, 200);
  }
  // single Cook 
  public function show($id)
  {
    $Cook = CookService::show($id);
    return   HttpResponseHelper::successResponse("successfully fetch single Cook", $Cook, 200);
  }
  // update Cook
  public function update(CookRequest $request, $id)
  {
    $Cook = CookService::update($request, $id);
    return   HttpResponseHelper::successResponse("Update Cook successfully", $Cook, 200);
  }
  // delete Cook
  public function destroy($id)
  {
    CookService::destroy($id);
    return  HttpResponseHelper::successResponse("Delete Cook successfully", null, 200);
  }
  // popular cook set
  public function popular(Request $request)
  {
    CookService::popular($request);
    return  HttpResponseHelper::successResponse("popular  Cook  list show successfully", null, 200);
  }  
}
