<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str ;
use Illuminate\Support\Arr;


class Post1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        if($request->ajax()){
            return $this->getPosts($request);
        }
        return view('post1.index',compact('categories'));
    }

    public function getPosts(Request $request)
    {
        $data =Post::orderBy('created_at','desc')->get();
        $categories = Category::all();
        return \DataTables::of($data)
            ->addColumn('Category', function(Post $post) {
                return $post->category->name;
                })
            ->addColumn('Actions', function($data) {
                return '<a  href="'.route("posts1.edit",$data->id) .'" class="btn btn-success btn-sm" id="getEditPostData" >Edit</a>
                <a  href="'.route("posts1.show",$data->id) .'" class="btn btn-primary btn-sm" id="getShowPostData" >Show</a>
                    <button type="button"   data-id="'.$data->id.'" data-toggle="modal" data-target="#DeletePostModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::orderBy('name','asc')->get();
        return view('post1.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'title'=>'required|min:10|max:25|unique:posts',
            'summary'=>'required|max:300',
            // 'slug'=>'required|unique:posts',
            'details'=>'required',
            // 'image'=>'image|mimes:jpg,gif,png|max:2048|dimensions:max_width=2000,max_height=1200',
            'image'=>'image|required',
            'category_id'=>'required',
            'published_at'=>'required|date',
            'tag'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $data= $request->all();
        if( $request->image !='undefined' ){
            // $image = $request->file('image');      
            $filename=$request->image->store('public/images');
            $imagename= $request->image->hashName();
            $data['image'] = $imagename;
        }
        $slug1 = Str::slug($request->title,'-');
        $slug = Str::limit($slug1,15,' ');
        $data['slug']=$slug;
        $post =Post::create($data);
        // dd($post);// return object from model App\Model\Post
        // *** Save Tags *** //
        $tags = $request->tag;
        $tagsArray = explode(",",$tags);
        $tagNames = [];
        if (!empty($tagsArray)) {
            foreach ($tagsArray as $tagName){
                $tag = Tag::firstOrCreate(['name'=>$tagName]);
               
                if($tag){
                    // dd($tag->id);
                    $tagNames[] = $tag->id;
                }
            }
            $post->tags()->syncWithoutDetaching($tagNames);
        }
        // *** End Save Tags *** //
        return response()->json(['success'=>'post added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::all();
        $tags = Tag::orderBy('name','asc')->get();
        try {
            $post = Post::findOrFail($id);
        }catch (ModelNotFoundException $exception) {
            return  response()->json(['error'=>$exception->getMessage()]);
        }
        return view('post1.show')->with(['post'=>$post ,'categories'=>$categories,'tags'=>$tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::orderBy('id','asc')->get()->pluck('name','id')->toArray();
        // $tags = Tag::orderBy('name','asc')->get() ;
        // dd($tags);
        try {
            $post = Post::findOrFail($id);
            $allTags=['tags'=>Tag::get()->pluck('name','id')];
            // dd($allTags);
            // [3,7]
            $specificTags = $post->tags()->where('post_id',$id)->get()->pluck('name','id')->toArray();
            // dd($tags);
            
        }catch (ModelNotFoundException $exception) {
            return  response()->json(['error'=>$exception->getMessage()]);
        }
        return view('post1.edit')->with(['post'=>$post ,'categories'=>$categories, 'tags'=>$tags,'specificTags'=>$specificTags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        try {
            $post = Post::findOrFail($id);
        }catch (ModelNotFoundException $exception) {
            return  response()->json(['error'=>$exception->getMessage()]);
        }

       $validator = \Validator::make($request->all(), [
            'title'=>'required|min:10|max:30|unique:posts,title,'.$id,
            // 'slug'=>'required|unique:posts,slug,'.$id,
            'details'=>'required',
            'summary'=>'required|max:300',
            // 'image'=>'image|mimes:jpg,gif,png|max:2048|dimensions:max_width=2000,max_height=1200',
            // 'image'=>'image',
            'category_id'=>'required', 
            'published_at'=>'date', 
            'tag'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $data= $request->all();
        // dd( $request->image == 'undefined');
        if( $request->image !='undefined' ){
            // $image = $request->file('image');      
            $filename=$request->image->store('public/images');
            $imagename= $request->image->hashName();
            $data['image'] = $imagename;
        }else{
            $data['image']  =$post->image ; 
        }
        $slug1 = Str::slug($request->title,'-');
        $slug = Str::limit($slug1,15,' ');
        $data['slug']=$slug;

         $post->update($data);
        // *** Save Tags *** //
        $tags = $request->tag;
        
        $tagsArray = explode(",",$tags);
        // dd($tagsArray);
        $tagNames = [];
        if (!empty($tagsArray)) {
            foreach ($tagsArray as $tagName){
                $tag = Tag::updateOrCreate(['name'=>$tagName]);
               
                if($tag){
                    // dd($tag->id);
                    $tagNames[] = $tag->id;
                }
            }
            // dd($tagNames);
            $post->tags()->sync($tagNames);
        }
        // *** End Save Tags *** //
       return response()->json(['success'=>'Post updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
        }catch (ModelNotFoundException $exception) {
            return  response()->json(['error'=>$exception->getMessage()]);
        }
        $post->tags()->detach();
        $post->delete($id);
 
        return response()->json(['success'=>'Post deleted successfully']);
    }

    
}
