<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Session;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
       return view('backend.admin.brand.add_brand');
    }


    public function store(Request $request)
    {
        $request->validate([
           'brand_name'         => 'unique:brands,name',
           'brand_description'  => 'string|nullable',
           'brand_status'       => 'numeric|nullable',
        ]);

        $value = array();
        $value['name']          = $request->brand_name;
        $value['description']   = $request->brand_description;
        if($request->brand_status == 1){
            $value['status'] = $request->brand_status;
        }
        Brand::insert($value);
        Session::put('message','Brand Added Successfully !!');
        return back();
    }


    public function show()
    {
        $all_brand = Brand::all();
        return view('backend.admin.brand.all_brands', compact('all_brand', $all_brand));
    }


    public function edit($id)
    {
        $single_brand = Brand::where('id',$id)->first();
        return view('backend.admin.brand.edit_brand', compact('single_brand',$single_brand));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name'        => 'required|unique:brands,name,'.$id.',id',
            'brand_description' => 'string|nullable',
            'brand_status'      => 'numeric|nullable',
        ]);

        $value = array();
        $value['name']          = $request->brand_name;
        $value['description']   = $request->brand_description;

        Brand::where('id',$id)->update($value);
        Session::put('message','Brand Update Successfully !!');
        return back();
    }


    public function destroy($id)
    {
        $checkProduct =Brand::where('brand_id',$id)->first();
        if($checkProduct){
            return back()->with('error','This Brand Could not allow to delete!!');
        }
        Brand::where('id',$id)->delete();
        return back()->with('success','Brand Delete Successfully !!');
    }


    public function unactive($id){
        Brand::where('id',$id)->update(['status'=>0]);
        return back()->with('success','Brand Status Unactive Successfully !!');
    }

    public function active($id){
        Brand::where('id',$id)->update(['status'=>1]);
        return back()->with('success','Brand Status Active Successfully !!');
    }

}
