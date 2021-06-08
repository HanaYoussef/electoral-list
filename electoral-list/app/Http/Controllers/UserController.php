<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Request\CreateRequest;
use App\Http\Requests\Request\EditRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$items = User::paginate(1);
        $q = request()->q;

        $items = User::whereRaw('true');

        if($q)
        $items->where('name','like',"%$q%");

        $items=$items->paginate(2)->appends([
            'q'=>$q,
  
        ]);
       // dd($item);
       //$items=$items->paginate(10);
       return view("user.index")->withItems($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {


        if(!$request->active){
            $request['active'] = false;
        }
        $requestData = $request->all();
        $requestData['password'] = bcrypt('123456789');
        User::create($requestData);
        return redirect(route('user.index'))->with('msg','User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::find($id);
        if(!$item){
            return redirect(route('user.index'))->with("msg","Invalid User ID");
        }
        return view("user.show")->with('item',$item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::find($id);
        if(!$item){
            return redirect(route('user.index'))->with("msg","Invalid User ID");
        }
        return view("user.edit")->with('item',$item);
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

        if(!$request->active){
            $request['active'] = '0';
        }
        $item = User::find($id);
        $item->update($request->all());

        return redirect(route('user.index'))->with("msg","User Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::find($id);
        if($item){
            $item->delete();
            session()->flash("msg","User Deleted successfully");
        }
        return redirect(route('user.index'));
    }
}
