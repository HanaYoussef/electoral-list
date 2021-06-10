<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('hanaaaa');
        return view('categories.index');
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
    public function getCategories(Request $request, Category $category)
    {
        $data = $category->getData();
        // dd($data);
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditCategoryData" data-id="'.$data->id.'">Edit</button>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteCategoryModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            
        ]);
        if(!$request->active){
            $request['active'] = '0';
        }
       
         
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $requestData= $request->all();
        $category->storeData($requestData);
 
        return response()->json(['success'=>'Category added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     * * @return \Illuminate\Http\Response
     */
  
    public function edit($id)
    {
        $category = new Category;
        $data = $category->findData($id);
        $isChecked = $data->active;
        $html = '<div class="form-group">
                    <label for="name">name:</label>
                    <input type="text" class="form-control" name="name" id="editName" value="'.$data->name.'">
                </div>
              
                <div class="mb-3 form-check">
   
                <input type="checkbox" class="form-check-input"  value="'.$data->active.'" name="active" id="editActive">
    <label class="form-check-label" for="active">Active</label>
  </div>';
 
        // return response()->json(['html'=>$html]);
       return response()->json(['html'=>$html , 'isChecked'=>$isChecked]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$request->active){
            $request['active'] = '0';
        }
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);
         
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
 
        $category= new Category;
        $category->updateData($id, $request->all());
 
        return response()->json(['success'=>'Category updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $category= new Category;
        $category->deleteData($id);
 
        return response()->json(['success'=>'Category deleted successfully']);
    }
}
