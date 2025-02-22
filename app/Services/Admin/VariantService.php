<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper; 
use App\Models\Variation; 
use Illuminate\Support\Facades\File;

class VariantService
{
    /* get all Variation */
    public static function getAll()
    {
        try {
            return Variation::latest()->get() ;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
  
    /* store Variation */
    public static function storeDocument($request)
    {
        return ([
             
            'cook_id' => $request->cook_id,
            'variant_name' => $request->variant_name,
            'variant_price' => $request->variant_price,
            
        ]);
    }
    // store Variation
    public static function store($request)
    {
        try {
            $variants = $request->all();
            $dataToInsert = [];
            foreach ($variants as $variant) {
                $dataToInsert[] = VariantService::storeDocument((object)$variant); 
            }   
            return  Variation::insert($dataToInsert);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    show single Variation 
    public static function show($id)
    {
        try {
            return Variation::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // update single Variation
    public static function update($request, $id)
    {
        try {
            $Variation = Variation::findOrFail($id);
            $Variation->update(VariantService::storeDocument($request));
            return $Variation;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single Variation
    public static function destroy($id)
    {
        try {
            $Variation = Variation::findOrFail($id);
            // $image_path = $Variation->image; 
            if (File::exists($Variation->image)) {
                File::delete($Variation->image);
            }
            return   $Variation->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
