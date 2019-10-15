<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()){
            $sliders = Slider::latest()->get();
            return DataTables::of($sliders)
                ->addIndexColumn()
                ->addColumn('status', function ($row){
                    $status = ($row->status > 0)? 'Active':'Unactive';
                    $addCss = ($row->status > 0) ? 'badge badge-success' : 'badge badge-danger';
                    $title = ($row->status > 0) ? "Press to unactive" : "Prase to active";

                    $btn = "<button type='button' id='ActiveUnactive' title='$title' class='$addCss' statusNumber='$row->status' data-id='$row->id'>$status</button>";
                    return $btn;
                })
                ->addColumn('action', function ($row){
                    $btn = "<button type='button' class='btn btn-xs btn-info editBtn' data-id =" . $row->id . " title='Edit Item'> <i class='fa fa-edit'></i> </button>";
                    $btn .= "<button type='button' class='btn btn-xs btn-danger delBtn' data-id =" . $row->id . " title='Delete Item'> <i class='fa fa-trash' aria-hidden='true'></i></button>";
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('backend.admin.slider.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
      $rules = array(
            's_status' => 'numeric|nullable',
            's_image' => 'required|image|max:2048'
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()){
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $imageName = $request->file('s_image');
        $setName = rand(). '.' . $imageName->getClientOriginalExtension();
        Image:: make($imageName)->resize(1140,450)->save(base_path('public/images/slider_image/'.$setName),100);

        $value = array();
        $value['image'] = $setName;
        if ($request->s_status == 1){
            $value['status']    = $request->s_status;
        }

        Slider::create($value);
        return response()->json(['success'=>true, 'message'=>'Slider Image Created Successfully!']);

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if (request()->ajax()){
            $data = Slider::findOrFail($id);
            return response()->json(['data'=>$data]);
        }
    }


    public function update(Request $request, Slider $slider)
    {


        // if have a new image
        $newImage = $request->file('s_image');
        if ($newImage){

            // now we can delete old image in my dir
            $oldImage = $request->sliderHiddenImageName;
            if ($oldImage){
                file_exists('images/slider_image/'.$oldImage);
                unlink('images/slider_image/'.$oldImage);
            }

            // now need to  validation
            $validator = Validator::make($request->all(), [
                's_status' => 'numeric|nullable',
                's_image' => 'required|image|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            // now set image name
            $setImageName = rand(). '.' .$newImage->getClientOriginalExtension();
            Image::make($newImage)->resize('1140','400')->save(base_path('public/images/slider_image/'.$setImageName),100);

            // now update all
            $request['status'] = $request->s_status == 1 ? 1 : 0;
            $slider->update($request->all());
            return response()->json(['success'=>true, 'message'=>'Slider Image Updated Successfully!']);

        }

        $request['status'] = $request->s_status == 1 ? 1 : 0;
        $slider->update($request->all());
        return response()->json(['success'=>true, 'message'=>'Slider Image Updated Successfully!']);
    }



    public function destroy($id)
    {
        $check = Slider::findOrFail($id);
        if ($check->image){
            file_exists('images/slider_image/'.$check->image);
            unlink('images/slider_image/'.$check->image);
            Slider::whereId($id)->delete();
            return response()->json(['success'=>'Deleted Successfully Done !']);
        }else{
            Slider::whereId($id)->delete();
            return response()->json(['success'=>'Deleted Successfully Done !']);
        }

    }


    public function ActiveUnactive(Request $request){
          $id = $request->id;
          $getStatusNumber = $request->getStatusNumber;

          $check = Slider::findOrFail($id); // you can you ( Slider::where('id',$id)->update(['status'=>$status]); )
          if ($check){
              $check->update(['status'=>$getStatusNumber]);
              return response()->json(['success' => "Publication Status Updated Successfully !"]);
          }

    }


}
