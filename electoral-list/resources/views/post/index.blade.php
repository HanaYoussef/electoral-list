@extends('layouts.base')
@section('title','View Post')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                       
                        <div class='col-sm-2 m-0 p-0'>
                            <button class='btn btn-success'data-toggle="modal" data-target="#CreatePostModal"  >  Create new Post </button>
                            <!-- {{-- <a class="btn btn-success" href="javascript:void(0)" id="createNewUser"> Create New User</a> --}} -->
                        </div>
                        
                        <div class="alert alert-warning alert-dismissible fade show invalid-id" role="alert" style="display: none ; padding:7px ;">
                            <br>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        
                        </div>
                    
                    {{-- <br> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th style="width :20% !important">Title</th>
                                    <th style="width :20% !important">Slug</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th style="width :40% !important;box-sizing: border-box !important;" class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Category Modal -->

<div class="modal fade" id="CreatePostModal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            {{-- <form class="form-control" method="POST" enctype="multipart/form-data"> --}}
            <div class="modal-header">
                <h4 class="modal-title"> Create Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none; padding:7px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong>Post was added successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form  method="POST" enctype="multipart/form-data" id="sampleForm" > --}}
                    {{-- @csrf  --}}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" {{old("title")}}  name="title" id="title" >
                    </div>
                    {{-- <div class="form-group">
                        <label for="title">Slug</label>
                        <input type="text" class="form-control" {{old("slug")}} name="slug" id="slug">
                    </div> --}}
                    <div class="form-group">
                        <label for="title">Details</label>
                        <input type="text" class="form-control" {{old("details")}} name="details" id="details">
                    </div>                
                    <div class="form-group">
                        <label for="title">Summary</label>
                        <textarea placeholder="Enter Summary here..."  class="form-control" {{old("summary")}} name="summary" id="summary"></textarea>
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
                    <div class="form-group">
                        <label for="image">Image</label>
                        <p id="disp_tmp_path"></p>
                        <img src="" width="300px" height="300px" style="display: none;">
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <div class="form-check">
                        <input type='hidden' name="published" value='0'/>
                        <input type="checkbox" class="form-check-input" name="published" id="published"
                        value="1" {{old('published')==1 ?'checked': ''}}>
                        <label class="form-check-label" for="published">Published</label>
                    </div> 
                {{-- </form> --}}
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitCreatePostForm">Create</button> 
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        
        </div>
     
    </div>
</div>
{{-- </form> --}}

<!-- Edit Post Modal -->
<div class="modal fade show" id="EditPostModal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> Edit Post </h4>
                <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none; padding:7px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="scrollTop" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;padding:7px;">
                    <strong>Success!</strong>Post was updated successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="EditPostModalBody">
                
               
                    
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                
                <button type="button" class="btn btn-success" id="SubmitEditPostForm">
                    
                    Update
                </button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Post Modal -->
<div class="modal" id="DeletePostModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Post Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Are you sure want to delete this Post?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeletePostForm">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // init datatable.
        var dataTable = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            // scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: '{{ route('posts.index') }}',
            columns: [
                {data: 'id', name: 'id' },
                {data: 'title', name: 'title',"width": "100px"},
                {data: 'slug', name: 'slug',"width": "20%"},
                {data: 'Category', name: 'Category',orderable:false,serachable:true,sClass:'text-center'},
                {data: 'published', name: 'published', render:function(data,type,row,meta){return data?"Published":"Inpublished"}},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center',"width": "25%"},
            ]
        });
 
        // Create Category Ajax request.
        // display image in create post
        var tmppath ;
        $('#image').change( function(event) {
             tmppath = URL.createObjectURL(event.target.files[0]);
             var file = document.getElementById("image").files[0];
            $("img").fadeIn("slow").attr('src',URL.createObjectURL(event.target.files[0]));
            
            // $("#disp_tmp_path").html(" <strong>["+tmppath+"**"+file.value +"]</strong>");
        });
        
        var tmppath1 ;
        $(document).on("change", "#editImage", function() {
            // alert("Files changed.");
            tmppath1 = URL.createObjectURL(event.target.files[0]);
             var file = document.getElementById("editImage").files[0];
            $("img").fadeIn("slow").attr('src',URL.createObjectURL(event.target.files[0]));
        });

         
           $('#SubmitCreatePostForm').click(function(e){
                e.preventDefault();

                $("#SubmitCreatePostForm").html('Loading').prepend('<span id="loadingCreate" class="spinner-border spinner-border-sm"></span>');
                var title = $('#title').val();
                // var slug = $('#slug').val();
                var details= $('#details').val();  
                var summary= $('#summary').val();
                var category_id = $('#category_id').val();
                var published = $('#published').is(':checked')?1:0;
                // var file = document.getElementById("image").files[0];
                var file = $('#image').val(); // return name of image
                // alert(file);
                //  This is 2 code is working and return (Object file)
                //1) document.getElementById("image").files[0]; / 2) $("#image").get(0).files[0];
                var image = $("#image").get(0).files[0];
                // alert(image);

            var myformData  = new FormData();
            // if (file.length > 0) {
                myformData.append("title", title);
                // myformData.append("slug", slug);
                myformData.append("details", details);
                myformData.append("summary", summary);
                myformData.append("category_id", category_id);
                myformData.append("image", image);
                // myformData.append("image", file);
                myformData.append("published", published);
            // };
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('posts.store') }}",
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
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        // $('#CreatePostModal')[0].reset();
                        $('.modal-body').scrollTop(0);
                        // $('#CreatePostModal').animate({ scrollTop: 0 }, 'slow');
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#CreatePostModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                }
            });
           });
                
        // Get single Catgory in EditModel
        $('.modelClose').on('click', function(){
            $('#EditPostModalBody').html("");
            $('#CreatePostModalBody').html("");
            $('#EditPostModal').hide();
        });
        var id;
        $('body').on('click', '#getEditPostData', function(e) {
            // e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "posts/"+id+"/edit",
                method: 'GET',
                success: function(result) {
                    //console.log(result);
                    if(result.error) {
                        $('.invalid-id').html('');
                        $('.invalid-id').show();
                        $('.invalid-id').append('<strong><li>'+result.error+'</li></strong>');
                        swal("Error!", result.error , "error");
                    }else{
                        $('#EditPostModalBody').html(result.html);
                        $('#EditPostModal').show();
                    }
                   
                },
                error:function(xhr,status,error){
                        console.log(xhr.responseJSON,status,error);
                        $('.invalid-id').html('');
                        $('.invalid-id').show();
                        $('.invalid-id').append('<strong><li>'+xhr.responseJSON.responseText+'</li></strong>');
                        swal("Error!", xhr.responseJSON.responseText , "error");
                    }
            });
        });
 
        // Update Category Ajax request.
        $('#SubmitEditPostForm').click(function(e) {
            e.preventDefault();

                $("#SubmitEditPostForm").html('Loading').prepend('<span id="loadingUpdate" class="spinner-border spinner-border-sm"></span>');
                var title = $('#editTitle').val();
                // var slug = $('#editSlug').val();
                var details= $('#editDetails').val();  
                var summary= $('#editSummary').val();
                var category_id = $('#editCategoryId').val();
                var published = $('#editPublished').is(':checked')?1:0;
                // var file = document.getElementById("image").files[0];
                var file = $('#editImage').val(); // return name of image
                // alert(file);
                //  This is 2 code is working and return (Object file)
                //1) document.getElementById("image").files[0]; / 2) $("#image").get(0).files[0];
                var image = $("#editImage").get(0).files[0];
                // alert(published);

            var myformData  = new FormData();
            // if (file.length > 0) {
                myformData.append("_method", 'put');
                myformData.append("title", title);
                // myformData.append("slug", slug);
                myformData.append("details", details);
                myformData.append("summary", summary);
                myformData.append("category_id", category_id);
                myformData.append("image", image);
                myformData.append("published", published);
            // };
        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   
                }
            });
            $.ajax({
                url: "posts/"+id,
                method: 'POST',
                // dataType: 'json',
                // *** contentType: "multipart/form-data",// it used when data send to server
                processData: false,
                contentType: false,
                cache: false,
                data: myformData , // it send form data to server
                enctype: 'multipart/form-data',
                // data:{
                       
                //         name: $('#editName').val(),
                //         title: $('#editTitle').val(),
                //         slug: $('#editSlug').val(),
                //         details: $('#editDetails').val(),  
                //         summary: $('#editSummary').val(),
                //         category_id : $('#editCategoryId').val(),
                //         image : $("#editImage").get(0).files[0],
                //         published : $('#editPublished').is(':checked')?1:0,
                //         // _token: @json(csrf_token()),
                  
                //     //  This is 2 code is working and return (Object file)
                //     //1) document.getElementById("image").files[0]; / 2) $("#image").get(0).files[0];
                        
                //     },
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
                    } else {
                        
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.modal-body').scrollTop(0);
                        // $('#scrollTop').animate({ scrollTop: 0 }, 'slow');
                        $('.datatable').DataTable().ajax.reload();
                        setTimeout(function(){ 
                            $('.alert-success').hide();
                            $('#EditPostModal').hide();
                        }, 2000);
                    }
                },
                error:function(xhr,status,error){
                        $("#SubmitEditPostForm").html('Update');
                        $('#loadingUpdate').css('display','none');
                        console.log(xhr.responseJSON,status,error);

                        $('.alert-danger').html('');
                            $.each(error, function(key, value) {
                                $('.alert-danger').show();
                                // $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                                $('.alert-danger').append('<strong><li>'+xhr.responseJSON.responseText+'</li></strong>');
                            });
                    }
            });
        });
   // Delete Category Ajax request.
   var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
        })
        $('#SubmitDeletePostForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "posts/"+id,
                method: 'DELETE',
                success: function(result) {
                    if(!result.errors) {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#DeletePostModal').hide();
                            $('.modal-backdrop').hide();
                        }, 1000);
                }else{
                        console.log('error');
                    }
                    }
            });
        });
    });
</script>
@endsection

