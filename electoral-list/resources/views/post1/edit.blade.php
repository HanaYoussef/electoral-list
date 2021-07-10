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
        <h4> Edit  Post</h4>
        <form  method="POST" enctype="multipart/form-data" id="sampleForm" > 
            @csrf 
        <div class="row" id="scrollTop">
            <div class="col-md-9" >
               <div style="background-color: #fff; padding:15px; border-radius:7px">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none; padding:7px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none; padding:7px;">
                        <strong>Success!</strong> Post was Updated Successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control"  name="title" id="editTitle" value="{{old("title",$post->title)}}">
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            {{-- <input type="text" class="form-control" name="category_id" id="category_id"> --}}
                            @if(isset($categories))
                                <select  class="ddlStatus  form-control" name="category_id" id="editCategoryId">
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
                        

                        <div class="form-group">
                            <label for="title">Summary</label>
                            {{-- <input type="text" class="form-control" {{old("details")}} name="details" id="details"> --}}
                            <textarea  name="summaryEditor" id="summaryEditor" >{{ old('summaryEditor',$post->summary) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="title">Details</label>
                            // {{-- <input type="text" class="form-control" {{old("details")}} name="details" id="details"> --}}
                            <textarea  name="detailsEditor" id="detailsEditor" >{{ old('detailsEditor',$post->details) }}</textarea>
                            
                        </div> 

                       
                        {{-- <div class="form-group">
                            <label for="image">Image</label>
                            <p id="disp_tmp_path"></p>
                            <img src="" width="300px" height="300px" style="display: none;">
                            <input type="file" class="form-control" name="image" id="image">
                        </div> --}}
                        <div class="form-check">
                            <input type='hidden' name="published" value='0'/>
                            <input type="checkbox" class="form-check-input" name="published" id="editPublished"
                            value="1" {{old('published',$post->published)==1 ?'checked': ''}}>
                            <label class="form-check-label" for="published">Published</label>
                        </div> 
                        <br>
                        <button type="button" class="btn btn-success" id="SubmitEditPostForm">Update</button>
                        <a href="{{route('posts1.index')}}" class="btn btn-secondary" id="cancel">Cancel</a> 
                    
               </div>
            </div>
            <div class="col-md-3">
                {{--  *** First Section --}}
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12" style="background-color: #fff; padding:15px; border-radius:7px">
                        <h5>Publish Date</h5>
                        <hr>
                        <input class="form-control" type="date" width="100%" name="published_at" id="editPublished_at" value="{{$post->published_at}}">
                        {{-- <hr> --}}
                        <br>
                        <a class="btn btn-light"  id="editDraft" name="draft">Save Draft</a>
                        <button class="btn btn-primary btn-publish"  id="editPublishState" name="publishState" >Publish</button>
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
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" {{old('category_id',$post->category_id)== $category->id ?'checked':''}}>
                            <label style="font-size: 15px;" class="form-check-label" for="flexRadioDefault2">
                                {{$category->name}}  
                            </label>
                          </div>
                        @endforeach
                        @endif
                        
                    </div>
                </div>
                {{--  *** Third section  *** --}}
                 
                 <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12" style="background-color: #fff; padding:15px; border-radius:7px">
                        <h5>Tags</h5>
                        <hr>
                        <select class="form-control select2 select-tags" name="tag[]" id="tags" multiple>
                            @if (sizeof($tags) >0)
                                {{-- @foreach ($tags as $tag)
                                <option {{old('tag[]',$post->tags())== $tag->name ?'selected':''}} value="{{$tag->name}}">{{$tag->name}}</option>
                                @endforeach --}}
                                
                                @foreach ($tags as $key => $item)
                                     {{-- @foreach($post->tags()->get() as $item1) --}}
                 
                                    {{-- <option {{$item == $item1->name ? 'selected' : null }} value="{{ $item }}">{{ $item }}</option>  --}}
                                    <option {{array_key_exists($key, $specificTags) ? 'selected' : null }} value="{{ $item }}">{{ $item }}</option> 
                                    {{-- if(array_key_exists($key, $array_1)){
                                        echo "Match found.";
                                    } --}}
                                    {{-- <option {{$item == array_get($post->tags()->get()) ? 'selected' : null }} value="{{ $item }}">{{ $item }}</option> --}}
                                    {{-- @endforeach  --}}
                                   {{-- {!! Form::select("tag[]",array_get($allTags,'allTags'),$tags,["class"=>"form-control select2","multiple"=>'multiple']) !!} --}}
                                   {{-- <option {{$key == $tags ? 'selected' : null }} value="{{ $item }}">{{ $item }}</option>  --}}
                                   @endforeach
                            @endif
                        </select>
           
                    </div>
                </div>
                {{--  *** Forth section  *** --}}
                <div class="row">
                    <div class="col-md-12" style="background-color: #fff; padding:15px;border-radius:7px">
                        <h5>Featured Image</h5>
                        <hr>
                        <div class="form-group" >
                            <p id="disp_tmp_path"></p>
                            <div style="width:100%">
                                {{-- <img  src="{{asset('blog-frontend/img/default-avatar.jpg')}}" class="center"> --}}
                                {{-- <img  src="{{asset('storage/images/'.$post->image)}}" class="center"> --}}
                                <img  src="{{$post->image}}" class="center">
                            </div>
                            <input type="file" class="form-control" name="image" id="editImage">    
                            
                        </div>
                        <br>
                        
                        {{-- <button class="btn btn-primary">Publish</button> --}}
                    </div>
                </div>

            </div>
        
        </div>
    </form>
    </div>

@endsection
@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function(){
            var tmppath ;
            $('#editImage').change( function(event) {
             tmppath = URL.createObjectURL(event.target.files[0]);
             var file = document.getElementById("editImage").files[0];
            $("img").fadeIn("slow").attr('src',URL.createObjectURL(event.target.files[0]));
            });
        });

         //   ***  enable & disabled publish button once display page  ***  //
        var today = new Date();
        var oldPublished_at ="{{$post->published_at}}";
        if(new Date(today) <= new Date(oldPublished_at))
        {   //compare end <=, not >=
            $('#editPublishState').prop('disabled','true');
            
        }else{
            $('#editPublishState').removeAttr('disabled');
        }
        //   ***  End enable & disabled publish button once display page  ***  //
        
        ClassicEditor
        .create( document.querySelector( '#summaryEditor' ) )
        .then( newEditor => {
            summaryEditor = newEditor;
        } )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#detailsEditor' ) )
        .then( newEditor => {
            detailsEditor = newEditor;
        } )
        .catch( error => {
            console.error( error );
        } );
       

         // *** Change on date picker  ***
         var published_at = $('#editPublished_at').val();
         var publishState= 0 ;
         $('#editPublished_at').change(function(){
             published_at = $('#editPublished_at').val();
             var today = new Date();
             if(new Date(today) <= new Date(published_at))
            {   //compare end <=, not >=
                $('#editPublishState').prop('disabled','true');
              
            }else{
                $('#editPublishState').removeAttr('disabled');
            }
         });
         // *** Create Save Draft  & publish Button  ***
         $('#editDraft').add('#editPublishState').on('click',function(e){
                e.preventDefault();
                
                if (this.id == 'editDraft') {
                    publishState= 0 ;
                }
                else if (this.id == 'editPublishState') {
                    publishState= 1 ;
                } 
       }); // draft click
           /// ****  End Create Save Draft  & publish Button   ****

           // *** Update Post Ajax  ***   //
        $('#SubmitEditPostForm').click(function(e) {
            e.preventDefault();
            $("#SubmitEditPostForm").html('Loading').prepend('<span id="loadingUpdate" class="spinner-border spinner-border-sm"></span>');
            var title = $('#editTitle').val();
            // var slug = $('#editSlug').val();
            var details= detailsEditor.getData();  
            var summary= summaryEditor.getData(); 
            var category_id = $('#editCategoryId').val();
            var published = $('#editPublished').is(':checked')?1:0;
            // var file = $('#editImage').val(); // return name of image
            //  This is 2 code is working and return (Object file)
            //1) document.getElementById("image").files[0]; / 2) $("#image").get(0).files[0];
            var image = $("#editImage").get(0).files[0];
            var published_at = $('#editPublished_at').val();
            var tag = $('#tags').val();

            var myformData  = new FormData();
                myformData.append("_method", 'put');
                myformData.append("title", title);
                // myformData.append("slug", slug);
                myformData.append("details", details);
                myformData.append("summary", summary);
                myformData.append("category_id", category_id);
                myformData.append("image", image);
                // myformData.append("published", published);
                myformData.append("published", publishState);
                myformData.append("published_at", published_at);
                myformData.append("tag", tag);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   
                }
            });
            $.ajax({
                url: "{{ route('posts1.update',"$post->id") }}",
                method: 'POST',
                dataType: 'json',
                // *** contentType: "multipart/form-data",// it used when data send to server
                processData: false,
                contentType: false,
                cache: false,
                data: myformData , // it send form data to server
                enctype: 'multipart/form-data',
                success: function(result) {
                    
                    $("#SubmitEditPostForm").html('Update');
                    $('#loadingUpdate').css('display','none');
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $("#SubmitEditPostForm").html('Update');
                        $('#loadingUpdate').css('display','none');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                        $('.scroll-top').click();
                    } else {
                        
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.scroll-top').click();
                        // .scrollTop(0);
                        // $('#scrollTop').animate({ scrollTop: 0 }, 'slow');
                        // $('.datatable').DataTable().ajax.reload();
                        setTimeout(function(){ 
                            $('.alert-success').hide();
                            window.location.reload();
                        }, 2000);
                    }
                },
                error:function(xhr,status,error){
                        $("#SubmitEditPostForm").html('Update');
                        $('#loadingUpdate').css('display','none');
                        // console.log(xhr.responseJSON,status,error);

                        $('.alert-danger').html('');
                            $.each(error, function(key, value) {
                                $('.alert-danger').show();
                                // $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                                $('.alert-danger').append('<strong><li>'+xhr.responseJSON.responseText+'</li></strong>');
                            });
                    }
            });
        });

        // *** Select  Multiple Tags  ***  //
        $(function () {
            // $('.select-tags').select2('data');
            $(".select-tags").select2({
            placeholder: "Enter tags",
            tags: true,
            tokenSeparators: [',']
            });
        });
       
       
    </script>
@endsection