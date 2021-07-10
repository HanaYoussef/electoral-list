@if($errors->count())
    <div class='alert alert-danger mt-4'>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div> 
@endif
@if(session()->get('msg'))
    <div class='alert alert-info mt-4'>{{session()->get('msg')}}</div> 
@endif