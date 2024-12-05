<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerServiceController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');



Route::group(["prefix"=>"admin"],function(){
    Route::post("register",[AuthController::class,'register']);
    Route::post("login",[AuthController::class,'login']);


});





   //with repository pattern



Route::middleware('auth:api')->group(function () {
    Route::post("customers",[CustomerController::class,'index']);
    Route::get("show/{customerId}",[CustomerController::class,'show']);
    Route::post("store",[CustomerController::class,'store']);
    Route::post("destroy/{customerId}",[CustomerController::class,'destroy']);
    Route::post("update/{customerId}",[CustomerController::class,'update']);
    // Route::post('customer/{id}/photo', [CustomerController::class, 'uploadPhoto']);

    Route::post('customer/{customerId}/addPhone', [CustomerController::class, 'addPhone']);  //not working
    Route::post('customer/{customerId}/addAddress', [CustomerController::class, 'addAddress']);
    Route::post('customer/{customerId}/addGroup', [CustomerController::class, 'addGroup']);
});


Route::post('customer/{id}/photo', [CustomerController::class, 'uploadPhoto']);

Route::post('customer/{id}/imageBase64', [CustomerController::class, 'storeImageBase64']);

 


// with simple controller


Route::middleware('auth:api')->group(function () {
   Route::apiResource('customer', CustomerServiceController::class);
   Route::post('customer/{customerId}/phone', [CustomerServiceController::class, 'storePhone']);
   Route::post('customer/{customerId}/address', [CustomerServiceController::class, 'storeAddress']);
   Route::post('customer/{customerId}/group', [CustomerServiceController::class, 'storeGroup']);
});






// Route::middleware(['auth:api', 'role:super_admin'])->group( function () {

//     // Route::get('create', function () {
//     //     return 'roles and premmission';
//     // });
//     Route::get('test', [RolePermissionController::class,'test']);
//     Route::get('check', [RolePermissionController::class,'checkEmailRole']);
// });























