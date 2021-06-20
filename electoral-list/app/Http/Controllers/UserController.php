<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Request\CreateRequest as RequestCreateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;


class UserController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("user.index");
        
        //$items = User::paginate(1);
        // $q = request()->q;

        // $items = User::whereRaw('true');

        // if($q)
        // $items->where('name','like',"%$q%");

        // $items=$items->paginate(5)->appends([
        //     'q'=>$q,
  
        // ]);
       // dd($item);
       //$items=$items->paginate(10);
    //    return view("user.index")->withItems($items);
    
    }

    public function getUsers(Request $request, User $user)
    {
        $data = $user->getData();
        // dd($data);
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditUserData" data-id="'.$data->id.'">Edit</button>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view("user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        // dd('hhhhhhh');
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password'=>'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->fails()->errors()->all()]);
        }
        // dd($request->all());

        // if($request->active){
        //         $request['active'] = '0';
        //     }
            $requestData= $request->all();
            $requestData['password'] = bcrypt($request->password);


        $user->storeData($requestData);

        return response()->json(['success'=>'User added successfully']);

        //dd('hana');
        // if(!$request->active){
        //     $request['active'] = '0';
        // }
        // $requestData = $request->all();
        // $requestData['password'] = bcrypt('123456789');
        // User::create($requestData);
        // return redirect(route('user.index'))->with('msg','User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $item = User::find($id);
        // if(!$item){
        //     return redirect(route('user.index'))->with("msg","Invalid User ID");
        // }
        // return view("user.show")->with('item',$item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //     $item = User::find($id);
    //     if(!$item){
    //         return redirect(route('user.index'))->with("msg","Invalid User ID");
    //     }
    //     return view("user.edit")->with('item',$item);
        $user = new User;
        $data = $user->findData($id);
        $isChecked = $data->active;

        $html = '<div class="form-group">
                    <label for="Name">Name:</label>
                    <input type="text" class="form-control" name="name" id="editName" value="'.$data->name.'">
                </div>
                <div class="form-group">
                    <label for="Email">Email:</label>
                    <input type="text" class="form-control" name="email" id="editEmail" value="'.$data->email.'">
                </div>
                <div class="form-group">
                <label for="Password">Password:</label>
                <input type="password" class="form-control" name="password" id="editPassword" value="'.$data->password.'">
            </div>
                <div class="form-check">
                    <input type="hidden"  name="active" value="0">
                    <input type="checkbox" class="form-check-input" name="active"  id="editActive" value="'.$data->active.'">
                    <label class="form-check-label" for="active">Active</label>
                </div>
                ';
        return response()->json(['html'=>$html , 'isChecked'=>$isChecked]);
    }
     

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, $id)
    {
        // ajax code
        // if ($request->fails()) {
        //     return response()->json(['errors' => $request->errors()->all()]);
        // }
        // if(!$request->active){
        //         $request['active'] = '0';
        //     }
        // dd($request->all());
        $user = new User;
        $request['password']= encrypt($request['password']);
        $user->updateData($id, $request->all());

        return response()->json(['success'=>'User updated successfully']);

        // if(!$request->active){
        //     $request['active'] = '0';
        // }
        // $item = User::find($id);
        // $item->update($request->all());

        // return redirect(route('user.index'))->with("msg","User Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $item = User::find($id);
        // if($item){
        //     $item->delete();
        //     session()->flash("msg","User Deleted successfully");
        // }
        // return redirect(route('user.index'));
        $user = new User;
        $user->deleteData($id);

        return response()->json(['success'=>'User deleted successfully']);
    }
}
