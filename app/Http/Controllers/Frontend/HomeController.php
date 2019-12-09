<?php

namespace App\Http\Controllers\Frontend;


use App\Brand;
use App\Category;
use App\Product;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Session;
use App\Http\Controllers\Controller;
use Str;


class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      /*  $this->middleware('auth',['except'=>'index']);*/

    }




    public function index()
   {
       $products = Product::where('status', 1)->get();
       $features_Products = Product::where('features', 1)->get();
       return view('fontend.pages.home_content',compact('products','features_Products'));
   }


   public function category_widgs_product($slug){

        $category = Category::where('slug', $slug)->first();

       $all_category_products = Product::
           where('category_id', $category->id)
           ->where('products.status', 1)
           ->get();


    return view('fontend.pages.category_wised_product',compact('all_category_products'));
   }


   public function product_brand($slug){

       $brand = Brand::where('slug', $slug)->first();

       $all_brand_products = Product::
       where('brand_id', $brand->id)
           ->where('products.status', 1)
           ->get();

       return view('fontend.pages.brand_wisge_product',compact('all_brand_products',$all_brand_products));
   }

   public function productDetails($slug){
       $singleProduct = Product::where(['slug'=>$slug, 'status'=>1])->first();
       return view('fontend.pages.product_details',compact('singleProduct'));
   }




   public function UserProfile(){
       $user_info = auth()->user();
       return view('fontend.pages.profile', compact('user_info'));
   }

   public function updateProfile(Request $request){

       $validate =  $request->validate([
            'name' => 'required|string|max:60',
            'lastname' => 'string|max:60|nullable',
            'email' => 'required|unique:users,email,'.Auth::user()->id.',id',
            'phone' => 'required|unique:users,phone,'.Auth::user()->id.',id',
            'birthday' => 'string|nullable',
            'gender' => 'string|nullable',
            'address' => 'string|nullable',

        ]);

       $originalFileName = $request->file('avatar');
       if($originalFileName){

          $image_name = Auth::user()->avatar;
           // first check the old image in stor folder
           if(File::exists('images/profile_pic/'.$image_name)){

               // delete the file
               File::delete('images/profile_pic/'.$image_name);
           }

           $getfile_extension = $originalFileName->getClientOriginalExtension();

           $make_randomName = Str::random(20);

           $makeFileName =$make_randomName.'.'.$getfile_extension;

           $goToRightLocation =public_path('images/profile_pic/'.$makeFileName);

           Image::make($originalFileName)->resize(150,150)->save($goToRightLocation);

           $validate['avatar'] =$makeFileName;

           User::where('id', Auth::user()->id)->update($validate);

           Session::put('success','Update Your Info with Image Successfully !!');

           return back();

       }
     User::where('id',Auth::user()->id)->update($validate);

       Session::put('success','Update Your Info  Successfully !!');

    return back();

   }


    public function PasswordUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $MakeHashNewPassword = Hash::make($request->password);
        $user = User::findOrFail($id);


        if (Hash::check($request->current_password, $user->password)){

            $user->password = $MakeHashNewPassword;

            $user->save();

            Session::put('success', 'Updated your Old password !');

            return redirect()->back();

        }else{
            Session::put('error', 'Current Password Does not match to old Password');

            return redirect()->back();
        }



    }



}
