<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
 use Illuminate\Support\Carbon;
class HomeController extends Controller
{

    public function index()
    {
        
        
        $items = Post::orderBy('created_at','desc')->paginate(3);
         return view('frontEnd.index',compact('items'));
       
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

 public function showPost($slug , Request $request ){
  $item = Post::where("slug",$slug)->first();
   $key = 'post-' . $item->id;
   if (!\Session::has($key)) {
        $item->timestamps = false;
              // $item->increment('count', 20);
            $item->count++;
            $item->save();
          \Session::put($key,1);
          
      }
       
    if(!$item){
    return redirect(view('frontEnd.index'))->with("msg","Invalid post ID");
      }
 
   return view('frontEnd.post',compact('item'));
   

  }
     public function getPost($title)
       {
        $item = Post::where("title",$title)->first();
         return view('frontEnd.post',compact('item'));
        
       }

       // Get all Posts for this Category
       public function category($id){
        $category=Category::findorFail($id);
        $posts=Post::where('category_id',$id)->paginate(6);
        return view('frontEnd.category',compact('posts','category'));


       }
}
