<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Cook;
use App\Models\Popular;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class CookService
{
    /* get all Cook */
    public static function getAll()
    {
        try {
            return Cook::latest()->paginate(15);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/Cook';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    /* store Cook */
    public static function storeDocument($request)
    {
        return ([
            'cook_name' => $request->cook_name,
            'price' => $request->price,
            'rating' => $request->rating,
            'about_cook' => $request->about_cook,
            'cook_image' => $request->cook_image ? self::ImageUpload($request->cook_image) : '',
            'status' => $request->status,
            'discount_price' => $request->discount_price,
            'category_id' => $request->category_id,
            'cook_time'=>$request->cook_time
        ]);
    }
    // store Cook
    public static function store($request)
    {
        try {
            $cook = CookService::storeDocument($request);
            if ($request->hasFile('gallary_images')) {
                $galleryImages  = $request->file('gallary_images'); 
                if (!is_array($galleryImages)) {
                    $galleryImages = [$galleryImages]; // If not, wrap it in an array
                }
                // return $galleryImages;
                $uploadedImages = ImageHelpers::ImageUploadMultiple($galleryImages, 'images/Cook');
               
                $cook['gallary_images'] = json_encode($uploadedImages);
            }
            // return $cook;
            return  Cook::create($cook);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    show single Cook 
    public static function show($id)
    {
        try {
            return Cook::with("category_name")->findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // update single Cook
    public static function update($request, $id)
    {
        try {
            $Cook = Cook::findOrFail($id);
            $Cook->update(CookService::storeDocument($request));
            return $Cook;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single Cook
    public static function destroy($id)
    {
        try {
            $Cook = Cook::findOrFail($id);
            // $image_path = $Cook->image; 
            if (File::exists($Cook->image)) {
                File::delete($Cook->image);
            }
            return   $Cook->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    create popular cook
    public static function popular($request)
    {
        try {  
            if($request->type=='delete'){
                $dltId = $request->id;
                $popularCookIds = Popular::get()->first()->popular_cook_ids;
                $cookIds= json_decode($popularCookIds);
                $updatedCookIds = array_values(array_diff($cookIds, [$dltId]));
                Popular::create(['popular_cook_ids'=>  $updatedCookIds]);
                return "Delete successfully popular cook";
            }
            return Popular::create(['popular_cook_ids'=>$request->popular_cook_ids]);
           
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
