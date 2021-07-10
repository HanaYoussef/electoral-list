@extends('layouts.base')
@section('title','View Category')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class='col-sm-3 m-0 p-0'>
    <button class='btn btn-success'data-toggle="modal" data-target="#CreateCategoryModal"  >Add new Category </button>
</div>
<!-- {{-- </form> --}} -->
<br>
<table class="table table-bordered datatable">
<thead>
<tr>
    <th>No</th>
    <th>Name</th>
    <th>active</th>
    <th width="280px" class="text-center">Action</th>
</tr>
</thead>

</table>
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
                    <label for="name">name:</label>
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

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

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
            dataSrc:"",
            ajax: '{{ route('categories.index') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'active', name: 'active', render:function(data,type,row,meta){return data?"Active":"Inactive"}},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });

 
        // Create Category Ajax request.

        $('#SubmitCreateCategoryForm').click(function(e) {
            e.preventDefault();
            $("#SubmitCreateCategoryForm").html('create').prepend('<span id="spinners"  class="spinner-border spinner-border-sm"></span>');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('categories.store') }}",                
                method: 'post',
                dataType: 'JSON',
                data: {
                    name: $('#name').val(),
                    active:$('#active').is(":checked")?1:0
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
                        $('#spinners').css('display','none');
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#CreateCategoryModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                },
                error:function(xhr,status,error){
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
                    // console.log(result);
                    $('#EditCategoryModalBody').html(result.html);
                    if(result.isChecked){
                            $("#editActive").prop("checked",true);
                        }
                    $('#EditCategoryModal').show();
                },
                error:function(xhr,status,error){
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
                    active: $('#editActive').is(":checked")?1:0,
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
                        setTimeout(function(){ 
                            $('.alert-success').hide();
                            $('#EditCategoryModal').hide();
                        }, 2000);
                    }
                },
                error:function(xhr,status,error){
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
                    if(!result.errors) {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setTimeout(function(){ 
                            $('.alert-success').hide();
                            $('#DeleteCategoryModal').hide();
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

