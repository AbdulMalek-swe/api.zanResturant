<?php

namespace App\Traits\Auth;

use App\Helpers\HttpResponseHelper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait LoginTraits
{
    /** Check email and password */
    public function EmailPasswordCheck($request, $existCredential)
    {
        // Check if the user exists
        if (!$existCredential) {
            $errorArray = ['No user found with this email.'];
            return HttpResponseHelper::errorResponse($errorArray, 404); // Not Found
        }

        // Check if the password is correct
        if (!Hash::check($request->password, $existCredential->password)) {
            $errorArray = ['Invalid credentials. Please check your email and password.'];
            return HttpResponseHelper::errorResponse($errorArray, 401); // Unauthorized
        }
        
        return true; // Return true if the password is correct
    }
}