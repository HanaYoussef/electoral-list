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
        if($request->ajax()){

            return $this->getUsers($request);
        }

        return view("user.index");
    
    }

    public function getUsers(Request $request)
    {
        $data = User::orderBy('created_at','desc')->get();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditUserData" data-id="'.$data->id.'">Edit</button>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

  
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password'=>'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
      
        $requestData= $request->all();
        $requestData['password'] = bcrypt($request->password);
        User::create($requestData);
        return response()->json(['success'=>'User added successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        if(!$data){
            response()->json(['status'=>false , 'msg'=>'invalid id']);
        }
        $isChecked = $data->active;
      
       $html=\View::make('user.editUser',[
           'name'=>$data->name , 
           'email'=>$data->email,
           'password'=>$data->password,
           'active'=>$data->active,
           ])->render(); 
        return response()->json(['html'=>$html , 'isChecked'=>$isChecked]);
    }
     

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = \Validator::make($request->all(), [
            'name'=>'required |max:255',
            'email'=>'required|max:30|unique:users,email,'.$id,
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = User::findorfail($id);
        $request['password']= bcrypt($request['password']);
        $user->update($request->all());
        return response()->json(['success'=>'User updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete($id);
        return response()->json(['success'=>'User deleted successfully']);
    }
}
