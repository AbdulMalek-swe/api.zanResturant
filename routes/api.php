<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\CookController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\User\CategoryUserController;
use App\Http\Controllers\User\ChefUserController;
use App\Http\Controllers\User\CookUserController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
// cook food route 
Route::resource("admin/cook", CookController::class)->only([
    'index',
    'show',
    'store',
    'update',
    'destroy',

]);
// chef route 
Route::resource("admin/chef", ChefController::class)->only([
    'index',
    'show',
    'store',
    'update',
    'destroy',
]);
// category 
Route::resource("admin/category", CategoryController::class)->only([
    'index',
    'show',
    'store',
    'update',
    'destroy',
]);
// variant 
Route::resource("admin/variant", VariantController::class)->only([
    'index',
    'show',
    'store',
    'update',
    'destroy',
]);
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
    'show'
]);
