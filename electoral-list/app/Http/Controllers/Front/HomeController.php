<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $items=Post::all();
        return view('frontEnd.index',compact('items','categories'));
    }
    
}
