<?php

namespace App\Services\User;

use App\Helpers\HttpResponseHelper; 
use App\Models\Chef; 

class ChefUserService
{

    public static function getAll($request)
    {
        try {
            return Chef::all();
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
     
 
    //    show single Chef 
    public static function show($id)
    {
        try {
            return Chef::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    
    
}
