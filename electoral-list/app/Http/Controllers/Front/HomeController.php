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

    public function autocomplete(Request $request){

    $post = Post::where("title","LIKE","%{$request->input('query')}%")
        ->get();

    $dataModified = array();
     foreach ($post as $data)
     {
       $dataModified[] = $data->title;
     }

    return response()->json([
        'dataModified'=> $dataModified ,
        'post'=>$post,
    ]);

 }

     public function getPost($title)
       {

         $post = Post::where("title",$title)->get();
            
         return view('frontEnd.post',compact('post'));

       }

}
