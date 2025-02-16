<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller{

       // login
       public function login(Request $request){
         $result = AuthService::login($request);
        return  HttpResponseHelper::successResponse("Login successfully complete", $result,200);
       }
       // register 
       public function register(Request $request){
         $result = AuthService::register($request);
        return  HttpResponseHelper::successResponse("Registrtion successfully complete", $result,200);
       }
}