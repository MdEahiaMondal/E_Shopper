<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){

        if ($request->ajax()){{
            $all_category = Category::latest()->get();
            return DataTables::of($all_category)
                ->addIndexColumn()
                ->addColumn('status', function ($row){
                    $status = ($row->status > 0) ? "Active":"Unactive";
                    $classCss = ($row->status > 0) ? "badge badge-success":"badge badge-danger";
                    $Title    =  ($row->status > 0) ? "Press to unactive":"Prase to active";
                    $btn ='<a class="'.$classCss.'" id="ActiveUnactive" title="'.$Title.'" data-id ="'.$row->id.'"  status="'.$row->status.'">'.$status.'</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row){
                    $btn = "<button type='button' class='btn btn-xs btn-info editBtn' data-id =".$row->id." title='Edit Item'> <i class='fa fa-edit'></i> </button>";
                    $btn .= "<button type='button' class='btn btn-xs btn-danger dlBtn' data-id =".$row->id." title='Delete Item'> <i class='fa fa-trash' aria-hidden='true'></i></button>";
                    return $btn;
                })
                ->rawColumns(['status','action',])
                ->make(true);
        }}
        return view('backend.admin.category.all_category');

    }

    public function create()
    {
        return view('backend.admin.category.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'string|nullable',
            'status' => 'numeric|nullable',
        ]);

        if ($validation){
            $value = array();
            $value['name']          = $request->name;
            $value['description']   = $request->description;

            if($request->status == 1){
                $value['status']    = $request->status;
            }

            Category::insert($value);
            return ['success'=>true, 'message'=>'Successfully added Category'];
        }else{
            return response()->json(['error'=>$validation->errors()->all()]);
        }

    }

    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        $category_info = Category::where('id',$id)->first();
        return view('backend.admin.category.edit_category', compact('category_info',$category_info));
    }

    public function update(Request $request, Category $category)
    {
        $id = $request->get('id');
        $validation = $request->validate([
            'name'  => 'required|unique:categories,name,'.$id.',id',
            'description' => 'string|nullable',
        ]);


        if ($validation){
            $value = array();
            $value['name']          = $request->name;
            $value['description']   = $request->description;

            Category::where('id', $id)->update($value);
            return ['success'=>true, 'message'=>'Category Updated Successfully'];
        }else{
            return response()->json(['error'=>$validation->errors()->all()]);
        }


    }

    public function destroy(Request $request)
    {
        $checkProduct = Product::where('category_id',$request->id)->first();

        if($checkProduct){
            return response()->json(['error'=>true,'message'=>'This Category Could not allow to delete!!']);
        }
        Category::where('id',$request->id)->delete();

        return response()->json(['success'=>true,'message'=>'Category Delete Successfully !!']);
    }

    public function activeUnactive(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $suc = Category::where('id',$id)->update(['status'=>$status]);

        if ($suc){
            return response()->json(['Publicstatus successfully Updated !']);
        }else{
            return response()->json(['error','Something  Problem']);
        }

    }




}
