<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Post1Controller;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\PermissionController;

use App\Http\Controllers\ChartController;
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

//  *** Routes for Frontend   ***  //
Route::get('/index', [HomeController::class, 'index']);
Route::get('/get-post/{title}', [HomeController::class, 'getPost'])->name('getPost');
// Route::get('/get-post/{slug}', [HomeController::class, 'getPost'])->name('getPost');
// Route::get('/show-post/{slug}/{id}', [HomeController::class, 'showPost'])->name('show-post');
 Route::get('/show-post/{slug}', [HomeController::class, 'showPost'])->name('show-post');
 Route::get('/category/{id}', [HomeController::class, 'category'])->name('category');
Route::get('/autocomplete-search-query', [HomeController::class, 'query'])->name('autocomplete-search-query');
Route::get('autocomplete', [HomeController::class, 'autocomplete'])->name('autocomplete');


//  *** Routes for Backend   ***  //
// Resource Route for Category.
Route::group(['middleware'=>['auth','permission']],function(){
    Route::resource('role', PermissionController::class);
    Route::post("role/{id}/postPermission",[PermissionController::class,"postPermission"])->name('role.postPermission');
  Route::get('/home', function () {
    return view('home');
    })->name('home');
    

    Route::resource('users', UserController::class);
    // Route for get user for yajra datatable post request.
    Route::get('get-users', [UserController::class, 'getUsers'])->name('get-users');
    
    Route::resource('categories', CategoryController::class);
    // Route for get categories for yajra post request.
    Route::get('get-categories', [CategoryController::class, 'getCategories'])->name('get-categories');
    
    Route::resource('posts',PostController::class);
    Route::get('get-posts', [PostController::class, 'getPosts'])->name('getPosts');

    Route::resource('/posts1',Post1Controller::class);
    Route::post('save-draft', [Post1Controller::class, 'saveDraft'])->name('saveDraft');
   
    Route::get('/numUser', [ChartController::class, 'numUser'])->name('numUser');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



// // Resource Route for Cateory.
// Route::group(['middleware'=>'auth'],function(){
// Route::resource('categories', CategoryController::class);
// // Route for get categories for yajra post request.
// Route::get('get-categories', [CategoryController::class, 'getCategories'])->name('get-categories');
// });