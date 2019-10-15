<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        if (request()->ajax()){

        }

        return view('backend.admin.product.index');

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }


    public function getCategoryBrand(Request $request){
        $categoryName = $request->categoryName;
        $brandName = $request->brandName;

        if ($categoryName == "category"){
            $data = Category::all();

            $output = '<option value="">Choose '. ucfirst('Category') .'</option>';
            foreach ($data as $row){
                $output .= '<option value="' .$row->id. '">'.$row->name.'</option>';
            }
            return response()->json(['data'=>$output]);
        }

        if ($brandName == "brand"){
            $data = Brand::all();

            $output = '<option value="">Choose '. ucfirst('Brand') .'</option>';
            foreach ($data as $row){
                $output .= '<option value="' .$row->id. '">'.$row->name.'</option>';
            }
            return response()->json(['data'=>$output]);
        }


    }

}
