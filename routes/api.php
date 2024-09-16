<?php

use App\Http\Controllers\UploadFileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix("v1")->group(function(){
    Route::post("publicPhoto",[UploadFileController::class,"publicStore"]);
    Route::post("privatePhoto",[UploadFileController::class,"prviateStore"]);
    Route::get("downloadPhoto/{file}",[UploadFileController::class,"downloadPhoto"]);
    Route::get("getPhoto/{file}",[UploadFileController::class,"getPhoto"]);

});
