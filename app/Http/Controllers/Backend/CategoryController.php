<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Product;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Session;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
       return view('backend.admin.category.add_category');
    }


    public function UnActived($id){
        Category::where('id', $id)->update(['status'=>0]);
        return 'success';
    }

    public function Actived($id){
        Category::where('id',$id)->update(['status'=>1]);
        return 'success';
    }





    public function all_category(){
       $all_category = Category::get()->sortBy('id');
        return view('backend.admin.category.all_category',compact('all_category',$all_category));
    }


    public function insert(Request $request){
        $request->validate([
            'category_name' => 'unique:categories,name',
            'category_description' => 'string|nullable',
            'category_status' => 'numeric|nullable',
        ]);
        $value = array();
        $value['name']          = $request->category_name;
        $value['description']   = $request->category_description;
        if($request->category_status==1){
            $value['status']    = $request->category_status;
        }
        Category::insert($value);
        return back()->with('success','Category Added Successfully !!');
    }


    public function edit($id)
    {
        $category_info = Category::where('id',$id)->first();
        return view('backend.admin.category.edit_category', compact('category_info',$category_info));
    }

    public function update(Request $request, $id){
       $request->validate([
           'category_name'  => 'required|unique:categories,name,'.$id.',id',
           'category_description' => 'string|nullable',
        ]);

        $value = array();
        $value['name']          = $request->category_name;
        $value['description']   = $request->category_description;
        Category::where('id', $id)->update($value);
        Session::put('success','Category Update Successfully !!');
        return back();
    }

    public function delete($id){
        $checkProduct = Product::where('category_id',$id)->first();
        if($checkProduct){
            return back()->with('error','This Category Could not allow to delete!!');
        }
        Category::where('id',$id)->delete();
            return back()->with('success','Category Delete Successfully !!');
    }



}
