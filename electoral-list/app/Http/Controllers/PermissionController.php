<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Link;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at','desc')->get();
        // $links = Link::all();
        return view("permission.role",compact('users'));
        
    }
    public function edit($id)
    {
        //  dd($id);    
        $links = Link::all();
        $user = User::find($id);
        return view("permission.editRole",compact('user','links'));
        
    }
    
    public function postPermission($id, Request $request)
    {
        //  dd($id);
        //  dd($request->links);
      \DB::table('user_links')->where('user_id',$id)->delete();
       if($request->links){    
         foreach($request->links as $link){       
            \DB::table('user_links')->insert([
                'link_id'=>$link,
                'user_id'=>$id,
                'created_at'=>new \DateTime(),
                'updated_at'=>new \DateTime(),
            ]);
          }
       } 
      return redirect(route('role.index'))->with('msg','Permission add successfuly ');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
       

            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
