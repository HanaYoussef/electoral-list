<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
class HomeController extends Controller
{

      // public function layout()
      // {
      //     $categories = Category::all();
      //     //$items=Post::all();
      //     // $items = Post::orderBy('id')->take(3)->get();
      //     // $url = Storage::url('file.jpg');
      //     $items = Post::orderBy('id')->paginate(3);
      //     $posts = \DB::table('posts')
      //             ->orderByRaw('count DESC')->take(3)->get();
        
      //     return view('layouts.asideFront',compact('items','categories','posts'));
      // }
    public function index()
    {
        $categories = Category::all();
        //$items=Post::all();
        // $items = Post::orderBy('id')->take(3)->get();
        // $url = Storage::url('file.jpg');
        $items = Post::orderBy('id')->paginate(3);
        $posts = \DB::table('posts')
                ->orderByRaw('count DESC')->take(3)->get();
        // return view('frontEnd.index',compact('items'));
         return view('frontEnd.index',compact('items','categories','posts'));
    }

    public function autocomplete(Request $request){

    $post = Post::where("title","LIKE","%{$request->input('query')}%")
        ->get();

// $post = Post::where("slug","=","%{$request->input('query')}%")
//        ->get();
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

 public function showPost($slug , Request $request ){
  $item = Post::where("slug",$slug)->first();

 
  //     dd($data);   
  //  $request->session()->put('key', 5);
  //  $data = $request->session()->all();
  //  $data=$request->session()->exists('key');
  //  if ($request->session()->exists('key')) {
  
  //    $item->timestamps = false;
  //       // $item->increment('count', 20);
  //     $item->count++;
  //     $item->savcounte();
   

  //   }
      $key = 'post-' . $item->id;
      // Check if blog session key exists
      // If not, update view_count and create session key
      if (!\Session::has($key)) {
        $item->timestamps = false;
              // $item->increment('count', 20);
            $item->count++;
            $item->save();
          \Session::put($key,1);
      }
       
    if(!$item){
    return redirect(view('frontEnd.index'))->with("msg","Invalid Category ID");
      }
    //$item->timestamps = false;
    // $item->increment('count', 20);
   // $item->count++;
   //$item->save();
  //  $data = $request->session()->all();
  //  dd($data); 
  // $request->session()->forget('key');
   //return view("frontEnd.post")->with('item',$item);
   $categories= Category::all();
   $posts = \DB::table('posts')
           ->orderByRaw('count DESC')->take(3)->get();
   return view('frontEnd.post',compact('item','posts','categories'));
   

  }
     public function getPost($title)
       {
        // $item = Post::where("slug",$slug)->first();
         $item = Post::where("title",$title)->first();
          $categories= Category::all();
          $posts = \DB::table('posts')
                  ->orderByRaw('count DESC')->take(3)->get();
         return view('frontEnd.post',compact('item','posts','categories'));
        //return view('layouts.asideFront',compact('item','posts','categories'));
       }

}
