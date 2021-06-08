<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

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
    return view('welcome');
});


Route::group(['middleware'=>'auth'],function(){
    Route::get("user/{id}/delete",[UserController::class,"destroy"])->name('user.delete');
    Route::resource("user",UserController::class);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('posts',PostController::class);
Route::get('get-posts', [PostController::class, 'getPosts'])->name('getPosts');

// Resource Route for Cateory.
Route::group(['middleware'=>'auth'],function(){
Route::resource('categories', CategoryController::class);
// Route for get categories for yajra post request.
Route::get('get-categories', [CategoryController::class, 'getCategories'])->name('get-categories');
});