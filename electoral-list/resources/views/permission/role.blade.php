@extends('layouts.base')
@section('title','Role')


@section('content')
<div class="table-responsive">
  <table class="table table-hover table-primary border-info">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Details</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
       <td>{{$user->id}}</td>
         <td>{{$user->name}}</td>
         <td>{{$user->email}}</td>
                        
        <td>
        <form method='post' action="">
         <!-- @csrf
          @method('delete') -->
        <a href='{{route("role.edit",$user->id)}}' class='btn btn-primary'>Edit</a>
        <input onclick='return confirm("   Are you sure ?")' type='submit' class='btn btn-danger' value='delete'>
          </form>
           </td>
      </tr>
      @endforeach
    </tbody>

  </table>
</div>
 @endsection