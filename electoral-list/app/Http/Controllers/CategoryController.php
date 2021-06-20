<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $category = new Category;
        $data = $category->all();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditCategoryData" data-id="'.$data->id.'">Edit</button>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteCategoryModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
        }
        return view('categories.index');
    }
    public function create()
    {
        //
    }
    public function getCategories(Request $request)
    {
        $category = new Category;
        $data = $category->all();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditCategoryData" data-id="'.$data->id.'">Edit</button>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteCategoryModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }
   
    public function store(Request $request)
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
        Category::create($requestData);
        return response()->json(['success'=>'Category added successfully']);
    }
    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
           // $category = new Category;
            //$data = Category::findOrFail(10);
            try
            {
                $data = Category::findorfail(10)->toArray();
            }
            catch(ModelNotFoundException $e)
            {
                return response()->json(['status' => 'failed', 'data' => null, 'message' => 'User not found']);
            }
         // $data = Category::findorfail($id);   
          $isChecked = $data->active;
          $html = view('categories.edit', compact('data'))->render();
          // $html = \View::make('categories.edit',compact('data'));
         return response()->json(['html'=>$html , 'isChecked'=>$isChecked]); 
   
        }
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

        $category  = Category::findOrFail($id);
        $category->update($request->all());
 
        return response()->json(['success'=>'Category updated successfully']);
    }
    public function destroy($id)
    { 
        $category  = Category::findOrFail($id);
        $category->delete($id);
 
        return response()->json(['success'=>'Category deleted successfully']);
    }
}
