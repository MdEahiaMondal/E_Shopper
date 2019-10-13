<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Session;
use File;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.slider.add_slider');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $request->validate([
           'slider_image' => 'required|mimes:jpeg,png,jpg,PNG,JPG,JPEG',
       ]);
        $value = array();
        if($request->slider_status == 1){
            $value['status'] = $request->slider_status;
        }
        if($request->hasFile('slider_image')){
            $original_file_name = $request->slider_image;
            $AutoRandomName =str_random(20);
            $get_file_extension = $original_file_name->getClientOriginalExtension();
            $make_file_name = $AutoRandomName.'.'.$get_file_extension;
            Image:: make($original_file_name)->resize(400,450)->save(base_path('public/images/slider_image/'.$make_file_name),100);
            $value['image'] =$make_file_name;
            DB::table('sliders')->insert($value);
            Session::put('success','Slider Image Uploaded Successfully !!');
            return back();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $all_sliders =  DB::table('sliders')->get();
        return view('backend.admin.slider.all_slider',compact('all_sliders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $single_slider = DB::table('sliders')->where('id',$id)->first();
       return view('backend.admin.slider.edit_slider',compact('single_slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->slider_image){
            // first delete the old image:
            $old_get_value = DB::table('sliders')->where('id',$id)->first();
           $old_image_name = $old_get_value->image;
            unlink(base_path('public/images/slider_image/'.$old_image_name));


           // now new image update
            if($request->hasFile('slider_image')) {
                $original_file_name = $request->slider_image;
                $AutoRandomName = str_random(20);
                $get_file_extension = $original_file_name->getClientOriginalExtension();
                $make_file_name = $AutoRandomName . '.' . $get_file_extension;
                Image:: make($original_file_name)->resize(400, 450)->save(base_path('public/images/slider_image/' . $make_file_name), 100);
                DB::table('sliders')->where('id', $id)->update(['image' => $make_file_name]);
                Session::put('success', 'Slider Image Updated Successfully !!');
                return back();
            }

        }else{
            Session::put('error','This image already has !!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // first delete the old image:
        $old_get_value = DB::table('sliders')->where('id',$id)->first();
        $old_image_name = $old_get_value->image;
        unlink(base_path('public/images/slider_image/'.$old_image_name));
        DB::table('sliders')->where('id',$id)->delete();
        Session::put('success','Slider Deleted Successfully !!');
        return back();
    }


    public function unactive($id){
        DB::table('sliders')->where('id',$id)->update(['status'=>0]);
        Session::put('success','Slider Image is Unctive now !!');
        return back();
    }

    public function active($id){
        DB::table('sliders')->where('id',$id)->update(['status'=>1]);
        Session::put('success','Slider Image is Active now !!');
        return back();
    }


}
