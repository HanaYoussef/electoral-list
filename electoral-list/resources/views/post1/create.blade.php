@extends('layouts.base')
@section('title','Create Post')
@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
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
        <h4> Add New Post</h4>
        <form  method="POST" enctype="multipart/form-data" id="sampleForm" > 
            @csrf 
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
                            <input type="text" class="form-control" value=""  name="title" id="title" placeholder="Enter title here">
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            {{-- <input type="text" class="form-control" name="category_id" id="category_id"> --}}
                            @if(isset($categories))
                                <select  class="ddlStatus  form-control" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option  {{old('category_id')== $category->id ?'selected':''}} value="{{ $category->id }}">{{$category->name}}</option>
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
                            <div id="summaryEditor" ></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="title">Details</label>
                            {{-- <input type="text" class="form-control" {{old("details")}} name="details" id="details"> --}}
                            <div id="detailsEditor"></div>
                        </div> 

                       
                        {{-- <div class="form-group">
                            <label for="image">Image</label>
                            <p id="disp_tmp_path"></p>
                            <img src="" width="300px" height="300px" style="display: none;">
                            <input type="file" class="form-control" name="image" id="image">
                        </div> --}}
                        <div class="form-check">
                            <input type='hidden' name="published" value='0'/>
                            <input type="checkbox" class="form-check-input" name="published" id="published"
                            value="1" {{old('published')==1 ?'checked': ''}}>
                            <label class="form-check-label" for="published">Published</label>
                        </div> 
                        <br>
                        <button type="button" class="btn btn-success" id="SubmitCreatePostForm">Create</button>
                        <a href="{{route('posts1.index')}}" class="btn btn-secondary" id="cancel">Cancel</a> 
                    
               </div>
            </div>
            <div class="col-md-4">
                {{--  *** First Section --}}
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12" style="background-color: #fff; padding:15px; border-radius:7px">
                        <h5>Publish Date</h5>
                        <hr>
                        <input class="form-control" type="date" width="100%" name="published_at" id="published_at" value="{{old('published_at')}}">
                        {{-- <hr> --}}
                        <br>
                       <a class="btn btn-light"  id="draft" name="draft">Save Draft</a>
                        <button class="btn btn-primary btn-publish"  id="publishState" name="publishState" >Publish</button> 
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
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label style="font-size: 15px;" class="form-check-label" for="flexRadioDefault2">
                                {{$category->name}}  
                            </label>
                          </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                {{--  *** third section  *** --}}
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12" style="background-color: #fff; padding:15px; border-radius:7px">
                        <h5>Tags</h5>
                        <hr>
                        <select class="form-control select2 select-tags" name="tag[]" id="tags" multiple>
                            @if ($tags->count())
                                @foreach ($tags as $tag)
                                <option value="{{$tag->name}}">{{$tag->name}}</option>
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
                                <img  src="{{asset('blog-frontend/img/default-avatar.jpg')}}" class="center">
                            </div>
                            <input type="file" class="form-control" name="image" id="image">    
                            
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
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" ></script> --}}

{{--  *** From Select2 Website  *** --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        $(document).ready(function(){
            // *** Display Image  ***  //
            var tmppath ;
            $('#image').change( function(event) {
             tmppath = URL.createObjectURL(event.target.files[0]);
             var file = document.getElementById("image").files[0];
            $("img").fadeIn("slow").attr('src',URL.createObjectURL(event.target.files[0]));
            });
        });
        // *** End Display Image  ***  //

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
         var published_at = $('#published_at').val();
         var publishState= 0 ;
         $('#published_at').change(function(){
             published_at = $('#published_at').val();
             var today = new Date();
             if(new Date(today) <= new Date(published_at))
            {   //compare end <=, not >=
                $('#publishState').prop('disabled','true');
              
            }else{
                $('#publishState').removeAttr('disabled');
            }
         });
         // *** Create Save Draft  & publish Button  ***
         $('#draft').add('#publishState').on('click',function(e){
                e.preventDefault();
                
                if (this.id == 'draft') {
                    publishState= 0 ;
                }
                else if (this.id == 'publishState') {
                    publishState= 1 ;
                } 
       }); // draft click
           /// ****  End Create Save Draft  & publish Button   ****

        // *** create post ajax  ***
        $('#SubmitCreatePostForm').click(function(e){
                e.preventDefault();
                $("#SubmitCreatePostForm").html('Loading').prepend('<span id="loadingCreate" class="spinner-border spinner-border-sm"></span>');
                var title = $('#title').val();
                var summary= summaryEditor.getData(); 
                // var summary = CKEDITOR.instances.summaryEditor.document.getBody().getText();
                var details= detailsEditor.getData(); ;
                var category_id = $('#category_id').val();
                var published = $('#published').is(':checked')?1:0;
                var published_at =$('#published_at').val();
                // var file = $('#image').val(); // return name of image
                // alert(publishState);
                //  This is 2 code is working and return (Object file)
                //1) document.getElementById("image").files[0]; / 2) $("#image").get(0).files[0];
                var image = $("#image").get(0).files[0];
                var tags = $('#tags').val();
                // alert(tags);

                var myformData  = new FormData();
                myformData.append("title", title);
                // myformData.append("slug", slug);
                myformData.append("details", details);
                myformData.append("summary", summary);
                myformData.append("category_id", category_id);
                myformData.append("image", image);
                // myformData.append("published", published);
                myformData.append("published", publishState);
                myformData.append("published_at", published_at);
                myformData.append("tag", tags);
                

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('posts1.store') }}",
                method: 'POST',
                dataType: 'json',
                // contentType: "multipart/form-data",// it used when data send to server
                processData: false,
                contentType: false,
                cache: false,
                data: myformData , // it send form data to server
                enctype: 'multipart/form-data',
                success: function(result) {
                    $("#SubmitCreatePostForm").html('Create');
                    $('#loadingCreate').css('display','none');
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                            $('.scroll-top').click();
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        // $('#CreatePostModal')[0].reset();
                        $('.scroll-top').click();
                        
                    }
                }
            });
           });

          // *** Select  Multiple Tags  ***  //
          $(function () {
            $(".select-tags").select2({
            placeholder: "Enter tags",
            tags: true,
            tokenSeparators: [',']
            });
        });

    
    </script>
@endsection