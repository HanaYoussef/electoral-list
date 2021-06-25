<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Front\HomeController;


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
/*
Route::get('/index', function () {
    return view('frontEnd.index');
});*/
Route::get('/index', [HomeController::class, 'index']);
Route::get('/get-post/{title}', [HomeController::class, 'getPost'])->name('getPost');
Route::get('/search', [HomeController::class, 'search']);

Route::get('/autocomplete-search-query', [HomeController::class, 'query'])->name('autocomplete-search-query');
Route::get('autocomplete', [HomeController::class, 'autocomplete'])->name('autocomplete');

//  *** Routes for Backend   ***  //
// Resource Route for Cateory.
Route::group(['middleware'=>'auth'],function(){

    Route::resource('users', UserController::class);
    // Route for get user for yajra post request.
    Route::get('get-users', [UserController::class, 'getUsers'])->name('get-users');
    
    Route::resource('categories', CategoryController::class);
    // Route for get categories for yajra post request.
    Route::get('get-categories', [CategoryController::class, 'getCategories'])->name('get-categories');
    
    Route::resource('posts',PostController::class);
    Route::get('get-posts', [PostController::class, 'getPosts'])->name('getPosts');
});


    
Route::group(['middleware'=>'auth'],function(){
    // Route::get("user/{id}/delete",[UserController::class,"destroy"])->name('user.delete');
    // Route::resource("user",UserController::class);

    // Resource Route for article.
    Route::resource('users', UserController::class);
    // Route for get articles for yajra post request.
    Route::get('get-users', [UserController::class, 'getUsers'])->name('get-users');
    
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



// Resource Route for Cateory.
Route::group(['middleware'=>'auth'],function(){
Route::resource('categories', CategoryController::class);
// Route for get categories for yajra post request.
Route::get('get-categories', [CategoryController::class, 'getCategories'])->name('get-categories');
});