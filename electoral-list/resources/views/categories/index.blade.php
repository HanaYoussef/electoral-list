@extends('layouts.base')
@section('css')
<title>Laravel 8 Ajax CRUD Application - laravelcode.com</title>
    <!-- CSRF Token -->
    
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.js">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        {{ __('Category Listing') }}
                        <button style="float: right; font-weight: 900;" class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#CreateCategoryModal">
                            Create Category
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th width="150" class="text-center">Action</th>
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
<div class="modal" id="CreateCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> Create Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong>Category was added successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group">
                    <label for="title">name:</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
               <div class="mb-3 form-check">
                <input type='hidden' name='active' value='0'/>
                <input  type="checkbox" name='active' value='1' class="form-check-input" id="active">
                <label class="form-check-label" for="active">Active</label>
            </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitCreateCategoryForm">Create</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal" id="EditCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> Edit Category </h4>
                <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong>Category was updated successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="EditCategoryModalBody">
                
               
                    
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitEditCategoryForm">Update</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Category Modal -->
<div class="modal" id="DeleteCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Category Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Are you sure want to delete this Category?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeleteCategoryForm">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
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
            ajax: '{{ route('get-categories') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'active', name: 'active'},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });
 
        // Create Category Ajax request.

        $('#SubmitCreateCategoryForm').click(function(e) {
            alert('hello');
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('categories.store') }}",
                method: 'post',
                data: {
                    name: $('#name').val(),
                    active: $('#active').val(),
                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#CreateCategoryModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
 
        // Get single Catgory in EditModel
        $('.modelClose').on('click', function(){
            $('#EditCategoryModal').hide();
        });
        var id;
        $('body').on('click', '#getEditCategoryData', function(e) {
            // e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "categories/"+id+"/edit",
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                    console.log(result);
                    $('#EditCategoryModalBody').html(result.html);
                    $('#EditCategoryModal').show();
                }
            });
        });
 
        // Update Category Ajax request.
        $('#SubmitEditCategoryForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "categories/"+id,
                method: 'PUT',
                data: {
                    name: $('#editName').val(),
                    active: $('#editActive').val(),
                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#EditCategoryModal').hide();
                        }, 2000);
                    }
                }
            });
        });
 
        // Delete Category Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
        })
        $('#SubmitDeleteCategoryForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "categories/"+id,
                method: 'DELETE',
                success: function(result) {
                    setInterval(function(){ 
                        $('.datatable').DataTable().ajax.reload();
                        $('#DeleteCategoryModal').hide();
                    }, 1000);
                }
            });
        });
    });
</script>
@endsection

