<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Chef;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ChefService
{

    public static function getAll($request)
    {
        try {
            return Chef::all();
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/Chef';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    /* store Chef */
    public static function storeDocument($request)
    {
        // 'meta_robots',
        return ([
            'chef_name'=>$request->chef_name,
            'title' => $request->title,
            'description' => $request->description,
            'chef_image' => $request->chef_image ? self::ImageUpload($request->chef_image) : '',
        ]);
    }
    // store Chef
    public static function store($request)
    {
        try {
            return  Chef::create(ChefService::storeDocument($request));
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
    // update single Chef
    public static function update($request, $id)
    {
        try {
            $chef = Chef::findOrFail($id); 
            $chefData =ChefService::storeDocument($request);
            if($request->chef_image){
                $chefData['chef_image'] = self::ImageUpload( $request->chef_image);
            }else{
                $chefData['chef_image'] = $chef->chef_image;
            }
            $chef->update($chefData);
            return $chef;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single Chef
    public static function destroy($id)
    {
        try {
            $Chef = Chef::findOrFail($id);
            if (File::exists($Chef->chef_image)) {
                File::delete($Chef->chef_image);
            }
            return   $Chef->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
