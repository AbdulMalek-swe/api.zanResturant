<?php

namespace App\Services\User;
use App\Helpers\HttpResponseHelper; 
use App\Models\Cook;
use App\Models\Popular;

class CookUserService
{
    /* get all Cook */
    public static function getAll()
    {
        try {
            $per_page = request('per_page');
           return Cook::where('status', 1)->latest()->paginate($per_page ?? 15);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    
    //    show single Cook 
    public static function show($id)
    {
        try {
            return Cook::with(['childs','variants'])->find($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    
    //    show single Cook 
    public static function popular()
    {
        try { 
            
            $popularCookIds = Popular::get()->first()->popular_cook_ids;
            $cookIds= json_decode($popularCookIds);
            if (empty($cookIds)) {
              return HttpResponseHelper::errorResponse( ["can not find popular food id"], 500);  
            }
           $popularCook =  Cook::with(['childs','variants'])->whereIn('cook_id',$cookIds)->get();
           return $popularCook ;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    
     
}
