
<table class="table table-success table-striped">
        <thead>
        <tr>
            <th width='10%'>#</th>
            <th>الاسم </th>
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
                        <a href='{{route("user.show",$item->id)}}' class='btn btn-info'>عرض</a>
                        <a href='{{route("user.edit",$item->id)}}' class='btn btn-primary'>تعديل</a>

                        <input onclick='return confirm("Are you sure?")' type='submit' class='btn btn-danger' value='حذف'>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


