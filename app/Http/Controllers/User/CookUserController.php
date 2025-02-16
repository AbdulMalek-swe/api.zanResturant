<?php
  
  namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\User\CookUserService;
 
  class CookUserController extends Controller{
    public function index(){
        $Cook = CookUserService::getAll();
      return  HttpResponseHelper::successResponse("successfully show Cook information",$Cook,200);
    }
 
    // single Cook 
    public function show($id){ 
        $Cook = CookUserService::show($id);
      return   HttpResponseHelper::successResponse("successfully fetch single Cook",$Cook,200);
    }
     
  }