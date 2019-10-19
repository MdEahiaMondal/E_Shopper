<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()){
            {
                $brands = Brand::latest()->get();
                return DataTables::of($brands)
                    ->addIndexColumn()
                    ->addColumn('status', function ($row) {
                        $status = ($row->status > 0) ? 'Active' : 'Unactive';
                        $addCss = ($row->status > 0) ? 'badge badge-success' : 'badge badge-danger';
                        $title = ($row->status > 0) ? "Press to unactive" : "Prase to active";
                        $btn = "<button class='$addCss' id='ActiveUnactive' statusNumber='$row->status' data-id='$row->id' title='$title'>$status</button>";
                        return $btn;
                    })
                    ->addColumn('action', function ($row) {
                        $btn = "<button type='button' class='btn btn-xs btn-info editBtn' data-id =" . $row->id . " title='Edit Item'> <i class='fa fa-edit'></i> </button>";
                        $btn .= "<button type='button' class='btn btn-xs btn-danger delBtn' data-id =" . $row->id . " title='Delete Item'> <i class='fa fa-trash' aria-hidden='true'></i></button>";
                        return $btn;
                    })
                    ->editColumn('description',  function ($row){
                        return Str::limit($row->description,'30','....');
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }}

        return view('backend.admin.brand.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $validate =  $request->validate([
            'name' => 'required|unique:brands,name',
            'description' => 'string|nullable',
            'status' => 'numeric|nullable',
        ]);

        if ($validate){
            Brand::insert($request->all());
            return ['success'=>true, 'message'=>'Successfully added Brand'];
        }else{
            return response()->json(['error'=>$validate->errors()->all()]);
        }
    }



    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        //
    }



    public function update(Request $request)
    {
        $id = $request->get('id');
        $validation = $request->validate([
            'name'  => 'required|unique:brands,name,'.$id. 'id',
            'description' => 'string|nullable',
        ]);

        if ($validation){
            $value = array();
            $value['name']          = $request->name;
            $value['description']   = $request->description;

            Brand::where('id', $id)->update($value);
            return ['success'=>true, 'message'=>'Brand Updated Successfully'];
        }else{
            return response()->json(['error'=>$validation->errors()->all()]);
        }

    }



    public function destroy($id)
    {
        Brand::where('id', $id)->delete();
        return response()->json(['success'=>true,'message'=>'Deleted Successfully Done !']);
    }


    public function ActiveUnactive(Request $request)
    {
        Brand::where('id',$request->id)->update(['status'=>$request->setStatusNumber]);
        return response()->json(['success'=>true,'message'=>'Publication status Successfully Updated !']);
    }

}
