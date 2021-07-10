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
                       
                        <div class='col-sm-3 m-0 p-0'>
                            {{-- <button class='btn btn-success'data-toggle="modal" data-target="#CreatePostModal"  >  Create new Post </button> --}}
                             <a class="btn btn-success" href="{{route('posts1.create')}}" id="createNewUser"> Create New Post</a> 
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
<!-- Delete Category Modal -->
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
            ajax: '{{ route('posts1.index') }}',
            columns: [
                {data: 'id', name: 'id' },
                {data: 'title', name: 'title',"width": "100px"},
            
                {data: 'Category', name: 'Category',orderable:false,serachable:true,sClass:'text-center'},
                {data: 'published', name: 'published',serachable:true, render:function(data,type,row,meta){return data?"Published":"Inpublished"}},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center',"width": "35%"},
            ]
        });

        // *** Delete Post  *** //
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
                });
        $('#SubmitDeletePostForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "posts1/"+id,
                method: 'DELETE',
                success: function(result) {
                    console.log(result);
                    if(!result.errors) {
                        $('.alert-danger').hide();
                        // $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setTimeout(function(){ 
                            $('.alert-success').hide();
                            $('#DeletePostModal').hide();
                            swal("Success !", result.success , "success");
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
