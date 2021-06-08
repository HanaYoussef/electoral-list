

@extends('layouts.base')
@section('title','Create User')
@section('content')

<div class="modal modal-slide-in new-user-modal fade show" id="modals-slide-in" style="display: block; padding-right: 17px; padding-top: 17px;" aria-modal="true" role="dialog">
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
  </div>
 @endsection