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

                    $btn = "<button type='button' title='$title' class='$addCss' status='$row->status' data-id='$row->id'>$status</button>";
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
        Image:: make($imageName)->resize(400,450)->save(base_path('public/images/slider_image/'.$setName),100);

        $value = array();
        $value['image'] = $setName;
        if ($request->s_status == 1){
            $value['status']    = $request->s_status;
        }

        Slider::create($value);
        return response()->json(['success'=>true, 'message'=>'Slider Image Upload Successfully!']);

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
}
