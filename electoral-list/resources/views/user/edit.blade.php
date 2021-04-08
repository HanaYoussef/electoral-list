@extends('layouts.base')
@section('title','Edit User')
@section('content')

<form method='post' action='{{route("user.update",$item->id)}}'>
@csrf
@method('put')
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" value='{{old('name',$item->name)}}' class="form-control" id="name" name='name'>

  </div>
  <div class="mb-3 form-check">
    <input type='hidden' name='active' value='0'/>
    <input {{old('active',$item->active)?"checked":""}} type="checkbox" class="form-check-input" value='1' name='active' id="active">
    <label class="form-check-label" for="active">Active</label>
  </div>
  <button type="submit" class="btn btn-primary">update</button>
  <a href="{{route('user.index')}}" class="btn btn-secondary">Cancel </a>
</form>

@endsection