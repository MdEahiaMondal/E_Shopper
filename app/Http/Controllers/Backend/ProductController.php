<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Product;
use File;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;
use Image;
use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;



class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('backend.admin.product.add_product');
    }



    public function store(Request $request)
    {

        //  validation test
        $request->validate([
           'product_name' => 'unique:products,name',
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',

        ]);

        /*test for unique slug in the database*/
        $slug = Str::slug($request->product_name, '-');
       if ($slug){
           $unique_product_slug = DB::table('products')->where('slug',$request->product_slug)->first();
           if($unique_product_slug){
               return back()->with('error','Product Slug is alredy Exist in your database');
           }
       }

        $value = array();
        $value['name'] = $request->product_name;
        $value['slug'] = $slug;
        $value['category_id'] = $request->category_id;
        $value['brand_id'] = $request->brand_id;
        $value['description'] = $request->product_description;
        $value['price'] = $request->product_price;
        $value['size'] = $request->product_size;
        $value['quantity'] = $request->product_quantity;
        $value['color'] = $request->product_color;
        if($request->product_status == 1 ){
            $value['status'] = $request->product_status;

        }
        if($request->features_product == 1){
            $value['features'] = $request->features_product;
        }


        // image  upload without any extra file
        $originalFileName = $request->file('product_image');
        if($originalFileName){
            $AutoRandomName =Str::random(20);
            $getFileExtension =$originalFileName->getClientOriginalExtension();
            $make_file_name =$AutoRandomName.'.'.$getFileExtension;
            $uploadLocation = 'images/product_image/';
            $image_url = $uploadLocation.$make_file_name;
            $success = $originalFileName->move($uploadLocation,$make_file_name);
            if($success){
                $value['image'] =$make_file_name;
                Product::insert($value);
                Session::put('success','Product Uploaded Successfully !!');
                return back();
            }

        }
        $value['image'] = '';
        DB::table('products')->insert($value);
        return back()->with('success', 'Product Uploaded Successfully without Image!');
    }


    // show for admin
    public function show()
    {

        $all_product = Product::all();
        return view('backend.admin.product.all_product',compact('all_product',$all_product));
    }


    public function edit($id)
    {

        $single_product = DB::table('products')->where('id',$id)->first();// this line not use a model
        return view('backend.admin.product.edit',compact('single_product'));
    }



    public function update(Request $request, $id)
    {
         $request->validate([
            'product_name'  => 'required|unique:products,name,'.$id.',id',// here in this colum statment is :: when you update this column its will be compear to others column without this column if your table column id is id
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required|numeric',

        ]);


        /*test for unique slug in the database*/
        $slug = Str::slug($request->product_name, '-');
        $value = array();
        $value['name'] = $request->product_name;
        $value['slug'] = $slug;
        $value['category_id'] = $request->category_id;
        $value['brand_id'] = $request->brand_id;
        $value['description'] = $request->product_description;
        $value['price'] = $request->product_price;
        $value['size'] = $request->product_size;
        $value['quantity'] = $request->product_quantity;
        $value['color'] = $request->product_color;

        // first delete the old image
        $old_image_name = DB::table('products')->where('id',$id)->first();
        $image_name = $old_image_name->image;

        if($request->product_image){
           // first check the old image in stor folder
            if(File::exists('images/product_image/'.$image_name)){

                // delete the file
                File::delete('images/product_image/'.$image_name);
            }

            // after delete the old image  so now new image upload
            $new_image_name = $request->product_image;
            $getfile_extension = $new_image_name->getClientOriginalExtension();
            $make_randomName = Str::random(20);
            $makeFileName =$make_randomName.'.'.$getfile_extension;
            $goToRightLocation =public_path('images/product_image/'.$makeFileName);
            Image::make($new_image_name)->resize(207,183)->save($goToRightLocation);
            $value['image'] = $makeFileName;
            DB::table('products')->where('id',$id)->update($value);
            Session::put('success','Product Updated with Image Successfully !!');
            return back();

        }

        DB::table('products')->where('id',$id)->update($value);
        Session::put('success','Product Updated without image Successfully done !!');
        return back();


    }


    public function softdelete($id)
    {

        Product::find($id)->delete();
        Session::put('success','Product SoftDelete Successfully !!');
        return back();
    }

    public function delete($id)
    {
        $image_name  = DB::table('products')->where('id',$id)->first();
        $get_image_name =$image_name->image;
        if(File::exists('images/product_image/',$get_image_name)){
            File::delete('images/product_image/'.$get_image_name);
        }
        Product::onlyTrashed()->where('id',$id)->forceDelete();
        Session::put('success','Product Parmanently Deleted Successfully !!');
        return back();
    }

    public function recycle(){
        $all_product = Product::onlyTrashed()->get();
        return view('backend.admin.product.recycle',compact('all_product'));
    }


    public function undo($id){
        Product::onlyTrashed()->where('id',$id)->restore();
        return back()->with('success','Product Undo Successfully !!');
    }


    public function unactive($id){
        DB::table('products')->where('id', $id)->update(['status'=>0]);
        Session::put('success','Product Unactive Successfully !!');
        return back();
    }


    public function active($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        Session::put('success','Product Active Successfully !!');
        return back();
    }


    public function unactive_product_feture($id){
        DB::table('products')->where('id', $id)->update(['features'=>0]);
        Session::put('success','Product Features Unactive  Successfully !!');
        return back();
    }

    public function active_product_features($id){
        DB::table('products')->where('id',$id)->update(['features'=>1]);
        Session::put('success','Product Features Active Successfully !!');
        return back();
    }



}
