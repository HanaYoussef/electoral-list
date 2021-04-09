@extends('layouts.base')
@section('title','Show User')
@section('content')
<form>
<div class="mb-3">
    <label for="name" class="form-label">User Name</label>
    <input type="text" class="form-control" id="name" value='{{$item->name}}' name='name' aria-describedby="emailHelp">
    
  </div>


  <div class="mb-3">
    <label for="name" class="form-label">Email</label>
    <input type="email"  value='{{$item->email}}' class="form-control" id="email" name='email'>

  </div>
  <div class="mb-3 form-check">
    <input  {{$item->active?"checked":""}} type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1" >Active</label>
  </div>
  
  <a href="{{route('user.index')}}" class="btn btn-secondary">Cancel</a>
</form>

@endsection