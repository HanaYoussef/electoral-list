<?php

namespace App\Http\Controllers;
use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\EditRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

use App\Models\Post;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        if($request->ajax()){

            return $this->getPosts($request);
        }
        return view('post.index',compact('categories'));
    }


    public function getPosts(Request $request)
    {
        $data =Post::orderBy('created_at','desc')->get();
        // dd($data);
        $categories = Category::all();

        return \DataTables::of($data)
            ->addColumn('Category', function(Post $post) {
                return $post->category->name;
                })
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditPostData" data-id="'.$data->id.'">Edit</button>

                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeletePostModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }
    
   
    public function store(Request $request)
    {
         
        $data= $request->all();
    
       // $slug1 = Str::slug($request->title, '-');
        $slug1= Str::slug($request->title, '-');
        $slug = Str::limit($slug1, 20, ' ');
       // $slug=Str::substr($slug1,20);
       
        $data['slug'] = $slug ;
        // dd($slug);
        $validator = \Validator::make($request->all(), [
            'title'=>'required|max:250|unique:posts',
            'summary'=>'required|max:300',
            'slug'=>'max:90|unique:posts',
            'details'=>'required',
            // 'image'=>'image|mimes:jpg,gif,png|max:2048|dimensions:max_width=2000,max_height=1200',
            'image'=>'image|required',
            'category_id'=>'required', 
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
       
        if($request->image){
            // $image = $request->file('image');      
            $filename=$request->image->store('public/images');
            $imagename= $request->image->hashName();
            $data['image'] = $imagename;
        }
       
        Post::create($data);
        return response()->json(['success'=>'post added successfully']);
    }
     /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */ 
    public function edit($id)
    {
       $categories = Category::all();
        $data = Post::find($id);

        if(!$data){
            response()->json(['status'=>false , 'msg'=>'invalid id']);
        }

        $html=\View::make('post.editPost',[
            'title'=>$data->title , 
            // 'slug'=>$data->slug,
            'details'=>$data->details,
            'summary'=>$data->summary,
            'category_id'=>$data->category_id,
            'image'=>$data->image,
            'published'=>$data->published,
            'categories'=>$categories
            ])->render();
        return response()->json(['html'=>$html]);
    }
    
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $post = Post::find($id);
        
        if(!$post){
            response()->json(['status'=>false , 'msg'=>'invalid id']);
        }
        
       $validator = \Validator::make($request->all(), [
            'title'=>'required|max:250'.$id,
            // 'slug'=>'required|unique:posts,slug,'.$id,
            'details'=>'required',
            'summary'=>'required|max:300',
            // 'image'=>'image|mimes:jpg,gif,png|max:2048|dimensions:max_width=2000,max_height=1200',
            // 'image'=>'image',
            'category_id'=>'required', 
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data= $request->all();
        $slug1= Str::slug($request->title, '-');
        $slug = Str::limit($slug1, 15, ' ');
        $data['slug'] = $slug ;

        // dd( $request->image == 'undefined');
        if( $request->image !='undefined' ){
            // $image = $request->file('image');      
            $filename=$request->image->store('public/images');
            $imagename= $request->image->hashName();
            $data['image'] = $imagename;
        }else{
            $data['image']  =$post->image ; 
        }
    //   dd($data);
        $post->update($data);
       return response()->json(['success'=>'Post updated successfully']);
    }
    public function destroy($id)
    {
      
        $post = Post::find($id);
        if(!$post){
            return response()->json('msg','Invalid Post ID');
        }
        $post->delete($id);
 
        return response()->json(['success'=>'Post deleted successfully']);
    }
    


}
