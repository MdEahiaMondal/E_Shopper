<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (request()->ajax()){
            $products = Product::with('category')->with('brand')->latest()->get();// relation with get data
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('status', function ($row){
                    $status = ($row->status > 0) ? "Active":"Unactive";
                    $classCss = ($row->status > 0) ? "badge badge-success":"badge badge-danger";
                    $Title    =  ($row->status > 0) ? "Press to unactive":"Prase to active";
                    $btn ='<a class="'.$classCss.'" id="statusActiveUnactive" title="'.$Title.'" data-id ="'.$row->id.'"  statusNumber="'.$row->status.'">'.$status.'</a>';
                    return $btn;
                })
                ->addColumn('features', function ($row){
                    $features = ($row->features > 0) ? "Active":"Unactive";
                    $classCss = ($row->features > 0) ? "badge badge-success":"badge badge-danger";
                    $Title    =  ($row->features > 0) ? "Press to unactive":"Prase to active";
                    $btn ='<a class="'.$classCss.'" id="featuresActiveUnactive" title="'.$Title.'" data-id ="'.$row->id.'"  featuresNumber="'.$row->features.'">'.$features.'</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row){
                    $btn = "<button type='button' class='btn btn-xs btn-info editBtn' data-id =".$row->id." title='Edit Item'> <i class='fa fa-edit'></i> </button>";
                    $btn .= "<button type='button' class='btn btn-xs btn-danger dlBtn' data-id =".$row->id." title='Normal Delete'> <i class='fa fa-recycle' aria-hidden='true'></i></button>";
                    return $btn;
                })
                /*->editColumn('description',  function ($row){
                    return Str::limit($row->description,'30','....');
                })*/
                ->editColumn('category',  function ($row){// for relationship
                    return $row->category->name;
                })
                ->editColumn('brand',  function ($row){// for relationship
                    return $row->brand->name;
                })
                ->rawColumns(['status', 'features', 'action',])
                ->make(true);

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
            'quantity' => 'required|numeric',
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

        $value['status'] = ($request->status == 1)? '1' : '0';
        $value['features'] = ($request->features == 1)? '1' : '0';


        $CheckImage = $request->file('image');
        if ($CheckImage){
            $setImageName = rand(). '.' .$CheckImage->getClientOriginalExtension();
            Image::make($CheckImage)->resize(400,450)->save(public_path('images/product_image/'.$setImageName),'100');
            $value['image'] = $setImageName;
            Product::insert($value);
            return response()->json(['success'=>true, 'message'=>'Product Created Successfully !']);
        }

        $value['image'] = '';
        Product::insert($value);
        return response()->json(['success'=>true, 'message'=>'Product Created Successfully !']);



    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if (request()->ajax()){
            $data =  Product::with('category')->with('brand')->findOrFail($id);
            return response()->json(['data'=>$data]);
        }

    }


    public function update(Request $request, Product $product)
    {

        $id = $request->row_id;
        // now need to  validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,'.$id.',id',
            'price' => 'required|string',
            'quantity' => 'required|numeric',
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

        $value['status'] = ($request->status == 1)? 1: 0;
        $value['features'] = ($request->features == 1)? 1: 0;


        $newImage = $request->file('image');
        if ($newImage){

            // first delete old image
            $oldImage = $request->file('productHiddenImageName');
            if ($oldImage != ''){
                file_exists('images/product_image/'.$oldImage);
                unlink('images/product_image/'.$oldImage);
            }

            $setNewImageName = rand(). '.' .$newImage->getClientOriginalExtension();
            Image::make($newImage)->resize(400,450)->save(public_path('images/product_image/'.$setNewImageName),'100');
            $value['image'] = $setNewImageName;
            $product->update($value);
            return response()->json(['success'=>true, 'message'=>'Product Updated Successfully !']);
        }

        $value['image'] = $request->productHiddenImageName;
        $product->update($value);
        return response()->json(['success'=>true, 'message'=>'Product Updated Successfully !']);

    }



    public function softdelete($id) // only normal delete
    {
        Product::find($id)->delete();
        return response()->json(['success'=>true, 'message'=>'Product Soft-Deleted Successfully Done!']);
    }


    public function destroy($id)// permanent delete
    {
        $check = Product::onlyTrashed()->where('id',$id)->first();
        $checkImage = $check->image;
        if ($checkImage != ''){
            if (file_exists('images/product_image/'.$checkImage)){
                unlink('images/product_image/'.$checkImage);
                Product::onlyTrashed()->where('id',$id)->forceDelete();
                return response()->json(['success'=>true, 'message'=>'Product Deleted Successfully Done!']);
            }

            Product::onlyTrashed()->where('id',$id)->forceDelete();
            return response()->json(['success'=>true, 'message'=>'Product Deleted Successfully Done!']);
        }
        // if there in a no image you can delete
        Product::onlyTrashed()->where('id',$id)->forceDelete();
        return response()->json(['success'=>true, 'message'=>'Product Deleted Successfully Done!']);

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


    public function statusActiveUnactive(Request $request){
        Product::whereId($request->id)->update(['status'=>$request->setStatusNumber]);
        return response()->json(['success'=>true, 'message'=>'Publication Status updated Successfully !']);
    }

    public function featuresActiveUnactive(Request $request){
        Product::whereId($request->id)->update(['features'=>$request->setFeaturesNumber]);
        return response()->json(['success'=>true, 'message'=>'Publication Features updated Successfully !']);
    }


    public function recycle(){
        $TrashedProducts = Product::onlyTrashed()->get();
        return view('backend.admin.product.recycle',compact('TrashedProducts'));
    }


    public function undoTrash($id){
        Product::onlyTrashed()->where('id',$id)->restore();
        return response()->json(['success'=>true, 'message'=>'Product undo Successfully !']);
    }


}
