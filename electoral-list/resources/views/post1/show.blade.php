@extends('layouts.base')
@section('title','Create Post')
@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"> --}}
    <style>
        .center{
        
        border-radius: 5px;
        margin-bottom:10px;
        margin-left: auto;
        margin-right: auto;
        width: 170px;
        height: 170px;
        display: block;
        border-style: groove ;
    }

    .ck-editor__editable_inline {
        min-height: 200px;
    }
    .btn-publish{
        float: right;
    }
    </style>
    
@endsection

@section('content')

    <div class="container">
        <h4> Show  Post</h4>
        <div class="row" id="scrollTop">
            <div class="col-md-8" >
               <div style="background-color: #fff; padding:15px; border-radius:7px">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none; padding:7px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none; padding:7px;">
                        <strong>Success!</strong>Post was added successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input disabled type="text" class="form-control"  name="title" id="title" value="{{old("title",$post->title)}}">
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            {{-- <input type="text" class="form-control" name="category_id" id="category_id"> --}}
                            @if(isset($categories))
                                <select  disabled class="ddlStatus  form-control" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option  {{old('category_id',$post->category_id)== $category->id ?'selected':''}} value="{{ $category->id }}">{{$category->name}}</option>
                                    @endforeach
                                    
                                </select>    
                            @endif
                        
                        </div>
                        {{-- <div class="form-group">
                            <label for="title">Slug</label>
                            <input type="text" class="form-control" {{old("slug")}} name="slug" id="slug">
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="title">Details</label>
                            <input type="text" class="form-control" {{old("details")}} name="details" id="details">
                        </div>                
                        <div class="form-group">
                            <label for="title">Summary</label>
                            <textarea placeholder="Enter Summary here..."  class="form-control" {{old("summary")}} name="summary" id="summary"></textarea>
                        </div> --}}

                        <div class="form-group">
                            <label for="title">Summary</label>
                            {{-- <input type="text" class="form-control" {{old("details")}} name="details" id="details"> --}}
                            <textarea disabled name="summaryEditor" id="summaryEditor" >{{ old('summaryEditor',$post->summary) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="title">Details</label>
                            {{-- <input type="text" class="form-control" {{old("details")}} name="details" id="details"> --}}
                            <textarea disabled name="detailsEditor" id="detailsEditor" >{{ old('detailsEditor',$post->details) }}</textarea>
                            
                        </div> 

                       
                        {{-- <div class="form-group">
                            <label for="image">Image</label>
                            <p id="disp_tmp_path"></p>
                            <img src="" width="300px" height="300px" style="display: none;">
                            <input type="file" class="form-control" name="image" id="image">
                        </div> --}}
                        <div class="form-check">
                            <input type='hidden' name="published" value='0'/>
                            <input disabled type="checkbox" class="form-check-input" name="published" id="published"
                            value="1" {{old('published',$post->published)==1 ?'checked': ''}}>
                            <label class="form-check-label" for="published">Published</label>
                        </div> 
                        <br>
                       
                        <a href="{{route('posts1.index')}}" class="btn btn-primary" id="cancel">Cancel</a> 
                    
               </div>
            </div>
            <div class="col-md-4">
                {{--  *** First Section --}}
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12" style="background-color: #fff; padding:15px; border-radius:7px">
                        <h5>Publish Date</h5>
                        <hr>
                        <input disabled class="form-control" type="date" width="100%" name="published_at" id="editPublished_at" value="{{$post->published_at}}">
                       
                        {{-- <a class="btn btn-light"  id="editDraft" name="draft">Save Draft</a> --}}
                        {{-- <button class="btn btn-primary btn-publish"  id="editPublishState" name="publishState" >Publish</button> --}}
                    </div>
                </div>
                {{--  *** Second Section  *** --}}
                <div class="row"  style="margin-bottom: 15px;">
                    <div class="col-md-12" style="background-color: #fff; padding:15px;border-radius:7px">
                        <h5>Category</h5>
                        <hr>
                        @if(isset($categories))
                        @foreach ($categories as $category)
                        <div class="form-check">
                            <input disabled class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" {{old('category_id',$post->category_id)== $category->id ?'checked':''}}>
                            <label style="font-size: 15px;" class="form-check-label" for="flexRadioDefault2">
                                {{$category->name}}  
                            </label>
                          </div>
                        @endforeach
                        @endif
                        {{-- <hr> --}}
                        {{-- <button class="btn btn-primary">Publish</button> --}}
                    </div>
                </div>
                {{--  *** third section  *** --}}
                <div class="row">
                    <div class="col-md-12" style="background-color: #fff; padding:15px;border-radius:7px">
                        <h5>Featured Image</h5>
                        <hr>
                        <div class="form-group" >
                            <p id="disp_tmp_path"></p>
                            <div style="width:100%">
                                {{-- <img  src="{{asset('blog-frontend/img/default-avatar.jpg')}}" class="center"> --}}
                                <img  src="{{asset('storage/images/'.$post->image)}}" class="center">
                            </div>
                            
                            
                        </div>
                        <br>
                        
                        {{-- <button class="btn btn-primary">Publish</button> --}}
                    </div>
                </div>

            </div>
        
        </div>
   
    </div>

@endsection
@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '#summaryEditor' ) )
        .then( newEditor => {
            summaryEditor = newEditor;
            summaryEditor.isReadOnly = true;
        } )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#detailsEditor' ) )
        .then( newEditor => {
            detailsEditor = newEditor;
            detailsEditor.isReadOnly = true;
           
        } )
        .catch( error => {
            console.error( error );
        } );  

          
       
    </script>
@endsection