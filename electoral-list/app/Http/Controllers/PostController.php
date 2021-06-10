<?php

namespace App\Http\Controllers;
use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\EditRequest;

use Illuminate\Http\Request;
use DataTables;

use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        return view('post.index');
    }


    public function getPosts(Request $request, Post $post)
    {
        $data =$post->getData();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditPostData" data-id="'.$data->id.'">Edit</button>

                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeletePostModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }
    
    public function show(Post $post)
    {
        //
    }
   
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(CreateRequest $request,  Post $post)
    {
     //   $data = $request->all();
      //  $imagePath = $request->image->store('public/images');
       // $data['image'] = $request->image->hashName();
       // Post::create($data);
       
       $post->storeData($request->all());
    
      
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
        $post = Post::find($id);
        $data = $post->findData($id);
 
        $html = '<div class="form-group">
                    <label for="name">title:</label>
                    <input type="text" class="form-control" name="title" id="editTitle" value="'.$data->title.'">
                </div>
        
                <div class="form-group">
                <label for="name">details:</label>
                <input type="text" class="form-control" name="details" id="editDetails" value="'.$data->details.'">
            </div>
            <div class="form-group">
                    <label for="name">slug:</label>
                    <input type="text" class="form-control" name="slug" id="editSlug" value="'.$data->slug.'">
                </div>
                <div class="form-group">
                <label for="name">summary:</label>
                <input type="text" class="form-control" name="summary" id="editSummary" value="'.$data->summary.'">
            </div>
                ';
 
        return response()->json(['html'=>$html]);
    }
    
    public function update(Request $request, $id)
    {
 /*  if(!$post)
            return redirect(route('post.index'))->with("Invalid Post ID");
        $data = $request->all();
        if($request->image){
            $imagePath = $request->image->store('public/images');
            $data['image'] = $request->image->hashName();
        }
        $post->update($data);
        return response()->json(['success'=>'post updated successfully']);
       // return redirect(route('post.index'))->with("Updated Successfully");**/
      
       $post= new Post;
       $post->updateData($id, $request->all());

       return response()->json(['success'=>'Post updated successfully']);
    }
    public function destroy($id)
    {
       /* $post->delete();
        return response()->json(['success'=>'Post deleted successfully']);
        //return redirect(route('post.index'))->with("Post Deleted Successfully");*/
        $post= new Post;
        $post->deleteData($id);
 
        return response()->json(['success'=>'Post deleted successfully']);
    }
    


}
