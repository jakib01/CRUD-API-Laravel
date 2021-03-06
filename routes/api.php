<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=> 'admin'],function (){
    Route::post('/store',[ProductsController::class,'store']);
    Route::get('/show',[ProductsController::class,'show']);
    Route::get('/edit/{id}',[ProductsController::class,'edit']);
    Route::get('/show/{id}',[ProductsController::class,'show_product']);
    Route::patch('/update/{id}',[ProductsController::class,'update']);
    Route::delete('/delete/{id}',[ProductsController::class,'delete']);
});
