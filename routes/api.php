<?php

use App\Http\Controllers\api\EbooksController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ebooks',[EbooksController::class,'index']);
Route::post('/ebooks/store',[EbooksController::class,'store']);
Route::get('/ebooks/{id}',[EbooksController::class,'show']);
Route::put('/ebooks/{id}',[EbooksController::class,'update']);
Route::get('/ebooks/{id}',[EbooksController::class,'destroy']);
