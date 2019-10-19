<?php

namespace App\Http\Controllers\Backend;

use App\Slider;
use Illuminate\Http\Request;
use Image;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


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

                    $btn = "<a type='button' id='ActiveUnactive' title='$title' class='$addCss' statusNumber='$row->status' data-id='$row->id'>$status</a>";
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
        $newImage = $request->file('s_image');
        if ($newImage){

            $oldimage = $request->sliderHiddenImageName;
            if (file_exists('images/slider_image/'.$oldimage)){
                unlink('images/slider_image/'.$oldimage);
            }


            // now need to  validation
            $validator = Validator::make($request->all(), [
                's_status' => 'numeric|nullable',
                's_image' => 'required|image|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }



            $setName = rand(). '.' . $newImage->getClientOriginalExtension();
            Image:: make($newImage)->resize(1140,450)->save(base_path('public/images/slider_image/'.$setName),100);

            $status = $request->s_status == 1 ? 1 : 0;
            $value['image'] = $setName;
            $value['status'] = $status;

            $slider->update($value);
            return response()->json(['success'=>true, 'message'=>'Slider Image Updated Successfully!']);

        }

        $status = $request->s_status == 1 ? 1 : 0;

        $value['image'] = $request->sliderHiddenImageName;
        $value['status'] = $status;

        $slider->update($value);
        return response()->json(['success'=>true, 'message'=>'Slider Image Updated Successfully!']);

    }



    public function destroy($id)
    {
        $check = Slider::findOrFail($id);
        if ($check->image){
            if (file_exists('images/slider_image/'.$check->image)){
                unlink('images/slider_image/'.$check->image);

                Slider::whereId($id)->delete();
                return response()->json(['success'=>'Deleted Successfully Done !']);
            }
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
