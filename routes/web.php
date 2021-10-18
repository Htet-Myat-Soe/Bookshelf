<?php

use App\Http\Controllers\admin\AdminBlogController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EBookController;
use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('/about',[HomeController::class,'about'])->name('about');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
Route::post('/mail-sent',[ContactController::class,'send_mail'])->name('contact.mail');

// Blog

Route::get('/blog',[BlogController::class,'index'])->name('blog');
Route::get('/blog/{id}',[BlogController::class,'get_by_id'])->name('blog.show');
Route::post('/blog/search',[BlogController::class,'search'])->name('blog.search');


// Login with Facebook

Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);


// Login With Facebook

Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

// Ebooks Route

Route::get('/ebooks',[EBookController::class,'index'])->name('ebooks');
Route::post('/ebooks/search',[EBookController::class,'search'])->name('search');
Route::get('/detail/{slug}',[EBookController::class,'details'])->name('details');
Route::get('/ebooks/category/{id}',[EBookController::class,'get_by_caegory'])->name('category');
Route::get('/ebooks/author/{name}',[EBookController::class,'get_by_author'])->name('author');
// User Route

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::get('/user/profile',[UserController::class,'index'])->name('user.profile');
    Route::post('/user/upload_image',[UserController::class,'profile_upload'])->name('user.upload_image');
    Route::post('/user/change_profile_detail',[UserController::class,'change_profile_detail'])->name('user.details');
    Route::get('/user/ebooks/download/{id}',[UserController::class,'download'])->name('user.download');
    Route::post('/user/add-comment',[UserController::class,'add_comment'])->name('user.comment');
    Route::get('/comment/edit/{id}',[UserController::class,'edit_comment'])->name('user.edit_comment');
    Route::post('/user/update-comment',[UserController::class,'update_comment'])->name('user.update_comment');
    Route::get('/comment/delete/{id}',[UserController::class,'delete_comment'])->name('user.dlete_comment');

});


// Admin Route

Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function(){

    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');

    Route::get('/admin/books',[BookController::class,'index'])->name('admin_books.index');
    Route::get('/admin/books/create',[BookController::class,'create'])->name('admin_books.create');
    Route::post('/admin/books/store',[BookController::class,'store'])->name('admin_books.store');
    Route::get('/admin/books/{slug}',[BookController::class,'show'])->name('admin_books.show');
    Route::get('/admin/books/edit/{slug}',[BookController::class,'edit'])->name('admin_books.edit');
    Route::post('/admin/books/update/{slug}',[BookController::class,'update'])->name('admin_books.update');
    Route::get('/admin/books/delete/{slug}',[BookController::class,'delete'])->name('admin_books.delete');
    Route::post('/admin/books/search',[BookController::class,'search'])->name('admin_books.search');

    Route::get('/admin/categories',[CategoryController::class,'index'])->name('admin_categories.index');
    Route::get('/admin/categories/create',[CategoryController::class,'create'])->name('admin_categories.create');
    Route::post('/admin/categories/store',[CategoryController::class,'store'])->name('admin_categories.store');
    Route::get('/admin/categories/edit/{slug}',[CategoryController::class,'edit'])->name('admin_categories.edit');
    Route::post('/admin/categories/update/{slug}',[CategoryController::class,'update'])->name('admin_categories.update');
    Route::get('/admin/categories/delete/{slug}',[CategoryController::class,'delete'])->name('admin_categories.delete');

    Route::get('/admin/users/index',[AdminUserController::class,'index'])->name('admin_users.index');
    Route::get('/admin/users/delete/{id}',[AdminUserController::class,'delete'])->name('admin_users.delete');
    Route::get('/admin/users/edit/{id}',[AdminUserController::class,'edit'])->name('admin_users.edit');
    Route::post('/admin/users/update',[AdminUserController::class,'update'])->name('admin_users.update');

    Route::get('/admin/profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::post('/admin/upload_image',[AdminController::class,'profile_upload'])->name('admin.upload_image');
    Route::post('/admin/change_profile_detail',[AdminController::class,'change_profile_detail'])->name('admin.details');

    Route::get('admin/blog/index',[AdminBlogController::class,'index'])->name('admin_blogs.index');
    Route::get('/admin/blogs/create',[AdminBlogController::class,'create'])->name('admin_blogs.create');
    Route::post('/admin/blogs/store',[AdminBlogController::class,'store'])->name('admin_blogs.store');
    Route::get('/admin/blogs/{id}',[AdminBlogController::class,'show'])->name('admin_blogs.show');
    Route::get('/admin/blogs/edit/{id}',[AdminBlogController::class,'edit'])->name('admin_blogs.edit');
    Route::post('/admin/blogs/update/{id}',[AdminBlogController::class,'update'])->name('admin_blogs.update');
    Route::get('/admin/blogs/delete/{id}',[AdminBlogController::class,'delete'])->name('admin_blogs.delete');
    Route::post('/admin/blogs/search',[AdminBlogController::class,'search'])->name('admin_blogs.search');

});

