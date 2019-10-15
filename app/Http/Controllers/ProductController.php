<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

        // now need to  validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'price' => 'required|string',
            'quantity' => 'required|string',
            'size' => 'string|nullable',
            'color' => 'string|nullable',
            'features' => 'numeric|nullable',
            'status' => 'numeric|nullable',
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'image|max:2048|nullable',
        ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

        /*test for unique slug in the database*/
        $slug = Str::slug($request->name, '-');
        if ($slug){
            $unique_product_slug = Product::where('slug', $slug)->first();
            if($unique_product_slug){
                return response()->json(['errorsSlag' => 'Product Slug is alredy Exist !!']);
            }
        }


        $value = array();
        $value['name'] = $request->name;
        $value['slug'] = $slug;
        $value['category_id'] = $request->category_id;
        $value['brand_id'] = $request->brand_id;
        $value['description'] = $request->description;
        $value['price'] = $request->price;
        $value['size'] = $request->size;
        $value['quantity'] = $request->quantity;
        $value['color'] = $request->color;
        if($request->status == 1 ){
            $value['status'] = $request->status;

        }
        if($request->features == 1){
            $value['features'] = $request->features;
        }


            $CheckImage = $request->file('image');
            if ($CheckImage){
                $setImageName = rand(). '.' .$CheckImage->getClientOriginalExtension();
                Image::make($CheckImage)->resize(207,183)->save(public_path('images/product_image/'.$setImageName),'100');
                $value['image'] = $setImageName;
                Product::create($value);
                return response()->json(['success'=>true, 'message'=>'Product Created Successfully !']);
            }

        $value['image'] = '';
        Product::create($value);
        return response()->json(['success'=>true, 'message'=>'Product Created Successfully !']);



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

        if ($categoryName == "category_id"){
            $data = Category::all();

            $output = '<option value="">Choose '. ucfirst('Category') .'</option>';
            foreach ($data as $row){
                $output .= '<option value="' .$row->id. '">'.$row->name.'</option>';
            }
            return response()->json(['data'=>$output]);
        }

        if ($brandName == "brand_id"){
            $data = Brand::all();

            $output = '<option value="">Choose '. ucfirst('Brand') .'</option>';
            foreach ($data as $row){
                $output .= '<option value="' .$row->id. '">'.$row->name.'</option>';
            }
            return response()->json(['data'=>$output]);
        }


    }

}
