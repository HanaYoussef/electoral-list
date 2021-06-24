@extends('layouts.base')
@section('title','View Users')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')

    <div class='col-sm-2 m-0 p-0'>
        <button class='btn btn-success'data-toggle="modal" data-target="#CreateUserModal"  >  Add new user </button>
        <!-- {{-- <a class="btn btn-success" href="javascript:void(0)" id="createNewUser"> Create New User</a> --}} -->
    </div>

<br>

    <table class="table table-bordered datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>email</th>
                <th>active</th>
                <th width="280px" class="text-center">Action</th>
            </tr>
        </thead>
       
    </table>
    {{-- {{ $items->links() }} --}}

    {{-- <div class="modal modal-slide-in new-user-modal fade show" id="modals-slide-in" style="display: block; padding-right: 17px; padding-top: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <form method='post' action='{{route("user.store")}}' class="add-new-user modal-content pt-0">
      
            @csrf
      
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New User</h5>
            </div>
            <div class="modal-body flex-grow-1">             
            <div class="form-group">
            <label class="form-label" for="basic-icon-default-uname">Username</label>
            <input type="text" id="name" name="name" class="form-control dt-uname" placeholder="Web Developer" aria-label="jdoe1" aria-describedby="basic-icon-default-uname2" name="user-name">
            </div>
            <div class="form-group">
            <label class="form-label" for="basic-icon-default-email">Email</label>
            <input type="text" id="email" name="email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" aria-describedby="basic-icon-default-email2" name="user-email">
            <small class="form-text text-muted"> You can use letters, numbers &amp; periods </small>
            </div>
            <div class="mb-3 form-check">
            <input type='hidden' name='active' value='0'/>
            <input {{old("active")?"checked":""}} type="checkbox" name='active' value='1' class="form-check-input" id="active">
            <label class="form-check-label" for="active">Active</label>
            </div>              
            <button type="submit" class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Create</button>
            <a href="{{route('user.index')}}" class="btn btn-secondary">Cancel</a>
            </div>
            </form>
          </div>
        </div> --}}

     <!-- Modal to add new user starts-->
     {{-- <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
        <div class="modal-dialog">
            <form class="add-new-user modal-content pt-0" method='post' action="{{route('user.store')}}" role="form" >
                @csrf
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">  Add new user </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname"> Name</label>
                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Enter your name" name="orderName" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <input type="text" id="email" name="email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" aria-describedby="basic-icon-default-email2" name="user-email">
                        <small class="form-text text-muted"> You can use letters, numbers &amp; periods </small>
                    </div>

                    <div class="mb-3 form-check">
                        <input type='hidden' name='active' value='0'/>
                        <input {{old("active")?"checked":""}} type="checkbox" name='active' value='1' class="form-check-input" id="active">
                        <label class="form-check-label" for="active">Active</label>
                    </div>  
                   
                    <button  
                    type="submit" class="btn btn-primary mr-1  waves-effect waves-float waves-light">
                        Create
                    </button>
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">cancel</button>
                </div>
            </form>
        </div>
    </div> --}}

   {{--  *********************    For Ajax Crud Modal Code ************** --}}

   <!-- Start Create User Modal -->
    <div class="modal" id="CreateUserModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">User Create</h4>
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
                        User was added successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="form-group">
                        <label for="Name">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" >
                    </div>
                    <div class="form-group">
                        <label for="Email">Email:</label>
                        <input type="text" class="form-control" name="email" id="email" >
                    </div>
                    <div class="form-group">
                        <label for="Password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" >
                    </div>
                    <div class="form-check">
                        <input type='hidden' name="active" value='0'/>
                        <input type="checkbox" class="form-check-input" name="active" id="active"
                        value="1">
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="SubmitCreateUserForm">Create</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
{{--   ***   End Create User Modal   ***  --}}

<!--    ***   Start Edit User Modal    ****  -->
<div class="modal" id="EditUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">User Edit</h4>
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
                    User Updated  successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="EditUserModalBody">
                    
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitEditUserForm">Update</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{--      ***     End Edit User Modal    ***     --}}

{{--      ***     Start Delete User Modal    ***     --}}
<div class="modal" id="DeleteUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">User Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h5>Are you sure want to delete this User?</h5>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeleteUserForm">Ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
 
{{--       ***    Start Code Crud ajax   ***  --}}

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
                ajax: '{{ route('users.index') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                   
                    {data: 'active', name: 'active', render:function(data,type,row,meta){return data?"Active":"Inactive"}},
                    {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });
            

            // Create User Ajax request.
        $('#SubmitCreateUserForm').click(function(e) {
            e.preventDefault();
            $("#SubmitCreateUserForm").html('Loading').prepend('<span id="loadingCreate" class="spinner-border spinner-border-sm"></span>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('users.store') }}",                
                method: 'post',
                dataType: 'JSON',
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    active:$('#active').is(":checked")?1:0
                },
                success: function(result) {
                    $("#SubmitCreateUserForm").html('Update');
                    $('#loadingCreate').css('display','none');
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.modal').animate({ scrollTop: 0 }, 'slow');
                        $('.alert-success').show();
                        // console.log(data);
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#CreateUserModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
            

            // Get single user in EditModel
            $('.modelClose').on('click', function(){
                $('#EditUserModal').hide();
            });
            var id;
            $('body').on('click', '#getEditUserData', function(e) {
                // e.preventDefault();
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                id = $(this).data('id');
                $.ajax({
                    url: "users/"+id+"/edit",
                    method: 'GET',
                    // data: {
                    //     id: id,
                    // },
                    success: function(result) {
                        $('#EditUserModalBody').html(result.html);

                        if(result.isChecked){
                            $("#editActive").prop("checked",true);
                        }
                        $('#EditUserModal').show();
                    }
                });
            });

            // Update user Ajax request.
            $('#SubmitEditUserForm').click(function(e) {
                e.preventDefault();
                $("#SubmitEditUserForm").html('Loading').prepend('<span id="loadingUpdate" class="spinner-border spinner-border-sm"></span>');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "users/"+id,
                    method: 'PUT',
                    data: {
                        name: $('#editName').val(),
                        email: $('#editEmail').val(),
                        password: $('#editPassword').val(),
                        active: $('#editActive').is(":checked")?1:0,
                    },
                    success: function(result) {
                        console.log(result);
                        $("#SubmitEditUserForm").html('Update');
                        $('#loadingUpdate').css('display','none');
                        $('#EditUserModal').animate({ scrollTop: 0 }, 'slow');
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
                                $('#EditUserModal').hide();
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

            // Delete user Ajax request.
            var deleteID;
            $('body').on('click', '#getDeleteId', function(){
                deleteID = $(this).data('id');
            })
            $('#SubmitDeleteUserForm').click(function(e) {
                e.preventDefault();
                var id = deleteID;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "users/"+id,
                    method: 'DELETE',
                    success: function(result) {
                        // setInterval(function(){ 
                        //     $('.datatable').DataTable().ajax.reload();
                        //     $('#DeleteUserModal').hide();
                        // }, 1000);
                        if(!result.errors) {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#DeleteUserModal').hide();
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
{{--       ***    End Code Crud ajax   ***  --}}

@endsection
    










