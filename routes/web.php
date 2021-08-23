<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// Login with Facebook

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);

Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);


// User Route

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::get('/user/profile',[UserController::class,'index'])->name('user.profile');

});


// Admin Route

Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function(){

    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');

});

