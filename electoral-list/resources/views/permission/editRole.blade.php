@extends('layouts.base')
@section('title','Edit Role')


@section('content')
<form class="form" action="{{route('role.postPermission',$user->id)}}" method="post" >
@csrf
<!-- @csrf
    <ul class='list-unstyled'>
        @foreach($links->where('parent_id',0) as $topLink)
        <?php 
            $userHasLink = $user->links()->where('links.id',$topLink->id)->count();
        ?>
        <li>
            <label><input {{$userHasLink?"checked":""}} type='checkbox' name='links[]' value='{{$topLink->id}}'> <b>{{$topLink->title}}</b></label>
            <ul style='margin-right:10px' class='list-unstyled'>
            @foreach($links->where('parent_id',$topLink->id) as $subLink)
                <?php 
                    $userHasLink = $user->links()->where('links.id',$subLink->id)->count();
                ?>
                <li><label><input {{$userHasLink?"checked":""}}  type='checkbox' name='links[]' value='{{$subLink->id}}'> {{$subLink->title}}</label></li>
            @endforeach
            </ul>
        </li>
        @endforeach
    </ul> -->
    <div class="table-responsive">
        <table class="table table-hover table-borderless table-light border-light">
            <thead>
        <tr>
                <th scope="col">#Name</th>
                <th scope="col">Add</th>
                <th scope="col">Edit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($links->where('parent_id',0) as $topLink)
              <?php 
                 $userHasLink = $user->links()->where('links.id',$topLink->id)->count();
              ?>
            <tr>
                <th >  <label><input {{$userHasLink?"checked":""}} type='checkbox' name='links[]' value='{{$topLink->id}}'> <b>{{$topLink->title}}</b></label></th>
                @foreach($links->where('parent_id',$topLink->id) as $subLink)
                <?php 
                    $link = $user->links()->where('links.id',$subLink->id)->count();
                ?>
                <td><div class="mb-3 form-check"><input {{ $link?"checked":"" }}  type='checkbox' name='links[]' value='{{$subLink->id}}'>
                </div></td>
            @endforeach 
            </tr>
            @endforeach 
            </tbody>

        </table>
    </div>
        <div class="modal-footer">
        <a href='{{route("role.index")}}' class="btn btn-primary mr-auto" type="reset"><i class="glyphicon glyphicon-repeat"></i>Cancel </a>
        <button  class="btn btn-warning " >Save</button>
</div>
     
</form>
@endsection