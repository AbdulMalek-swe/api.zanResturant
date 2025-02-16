<?php
  
  namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Admin\CookService;

use Illuminate\Http\Request;

  class CookController extends Controller{
    public function index(){
        $Cook = CookService::getAll();
      return  HttpResponseHelper::successResponse("successfully show Cook information",$Cook,200);
    }
//    store 
    public function store(Request $request){
        $Cook = CookService::store($request);
      return   HttpResponseHelper::successResponse("Create Cook successfully",$Cook,200);
    }
    // single Cook 
    public function show($id){ 
        $Cook = CookService::show($id);
      return   HttpResponseHelper::successResponse("successfully fetch single Cook",$Cook,200);
    }
    // update Cook
    public function update(Request $request,$id){
        $Cook = CookService::update($request,$id);
      return   HttpResponseHelper::successResponse("Update Cook successfully",$Cook,200);
    }
    // delete Cook
    public function destroy($id){
        CookService::destroy($id);
      return   HttpResponseHelper::successResponse("Delete Cook successfully",null,200);
    }
  }