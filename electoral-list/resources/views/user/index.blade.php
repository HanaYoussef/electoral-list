@extends('layouts.base')
@section('title','View Users')
@section('content')

<form class='row dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1' >

    <div class='col-sm-3'>
        <input class='form-control' autofocus value='{{request()->q??''}}' name='q' type='text' placeholder='Enter your search' />
    </div>
    
    <div class='col-sm-1'>
        <input type='submit' Value='Search' class='btn btn-primary' />
    </div>
    <div class='col-sm-3'>
        <a class='btn btn-primary' href='{{route("user.create")}}'><span>Add New User</span></a>
    </div>
</form>

<br>


<table  class="user-list-table table dataTable no-footer dtr-column" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">

            <thead>
            <tr>
                <th width='10%'>#</th>
                <th>Nmae </th>
                <th width='10%'>Active</th>
                <th width='30%'>Options </th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->active?'Active':'In Active'}}</td>
                    <td>
                        <form method='post' action="{{route('user.destroy',$item->id)}}">
                            @csrf
                            @method('delete')
                            <a href='{{route("user.show",$item->id)}}' class='btn btn-info'>show</a>
                            <a href='{{route("user.edit",$item->id)}}' class='btn btn-success'>update</a>

                            <input onclick='return confirm("Are you sure?")' type='submit' class='btn btn-danger' value='Delete'>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
    </table>

@endsection





