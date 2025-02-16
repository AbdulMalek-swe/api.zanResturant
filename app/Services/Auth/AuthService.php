<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Traits\Auth\LoginTraits;
use Illuminate\Support\Facades\Hash;
// use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService{
   use LoginTraits ;
    /* login */

    public static function login($request)
    {
        /* check exist email */
        $credentials = $request->only('email', 'password');
        $existCredintial = User::where('email', $request->email)->first();

        $instance = new self();
        $instance->EmailPasswordCheck($request, $existCredintial);

        $token = auth()->claims([
            'id' => $existCredintial->id,
            'name' => $existCredintial->name,
            'role' => $existCredintial->role,
        ])->attempt($credentials);

        AuthService::createNewToken($token);

        // Return user data an token
        return [
            'token' => $token,
            'user' => $existCredintial
        ];
    }

   /* store resoruce documents */
   public static function storeDocument($request)
   {
       return array(
           "name" => $request->name,
           'email' => $request->email, 
           "phone" => $request->phone,
           "password" => $request->password
           
       );
   }
//    register 
    public static function register($request){
        /** Create the user */
        $userData = self::storeDocument($request);
        // password  hash 
        $userData['password'] = Hash::make($request->password);
        $user =  User::create($userData); 
        return $user;
    }

    
    /* create token generate exp date */
    public static function createNewToken($token)
    {
        $response_data = [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 3660,
        ];
        return $response_data;
    }
}