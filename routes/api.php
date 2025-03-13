<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\CookController;
use App\Http\Controllers\Admin\ReviewAdminController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\User\CategoryUserController;
use App\Http\Controllers\User\ChefUserController;
use App\Http\Controllers\User\CookUserController;
use App\Http\Controllers\User\ReviewController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
// cook food route 
Route::group(['middleware' =>  'adminPermission', 'prefix' => 'admin'], function () {

//   cook 
    Route::resource("cook", CookController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',  
    ]);
    Route::post('popular', [CookController::class, 'popular']);
    Route::get('popular', [CookUserController::class, 'popular']);
    // chef route 
    Route::resource("chef", ChefController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',
    ]);
    // category 
    Route::resource("category", CategoryController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',
    ]);
    // variant 
    Route::resource("variant", VariantController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',
    ]);
    // review controller
    Route::resource("review", ReviewAdminController::class)->only([
        'index',
        'destroy',
    ]);
});

// category 
Route::resource("category", CategoryUserController::class)->only([
    'index',
    'show',
]);
// chef route 
Route::resource("chef", ChefUserController::class)->only([
    'index',
    'show'
]);
// cook food route 
Route::resource("cook", CookUserController::class)->only([
    'index',
    'show', 
]);
// cook food route 
 
Route::get('popular', [CookUserController::class, 'popular']);
 
// review api 
Route::resource("review", ReviewController::class)->only([
    'index',
    'store',
]);
