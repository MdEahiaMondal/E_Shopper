<?php

namespace App\Http\Controllers;


use App\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{

    public function index()
    {
        if (request()->ajax()){
            $orders = Order::with('user')->with('payment')->latest()->get();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('status', function ($row){
                    $status = ($row->status > 0)? 'Complete':'Pending...';
                    $addCss = ($row->status > 0) ? 'badge badge-success' : 'badge badge-danger';
                    $title = ($row->status > 0) ? "Press to Pending" : "Prase to Complete";

                    $btn = "<a type='button' id='StatusChange' title='$title' class='$addCss' statusNumber='$row->status' data-id='$row->id'>$status</a>";
                    return $btn;
                })
                ->addColumn('action', function ($row){
                    $btn = "<button type='button' class='btn btn-xs btn-info ViewBtn' data-id =" . $row->id . " title='View Details'> <i class=\"fa fa-eye\"></i> </button>";
                    $btn .= "<button type='button' class='btn btn-xs btn-danger delBtn' data-id =" . $row->id . " title='Delete Item'> <i class='fa fa-trash' aria-hidden='true'></i></button>";
                    return $btn;
                })
                ->editColumn('name',  function ($row){// for relationship
                    return $row->user->name;
                })
                ->editColumn('email',  function ($row){// for relationship
                    return $row->user->email;
                })
                ->editColumn('total',  function ($row){// for relationship
                    return $row->total ." TK";
                })
                ->editColumn('method',  function ($row){// for relationship
                    return $row->payment->method;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('backend.admin.order.index');
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
        $orders = Order::findOrFail($id);
        return view('backend.admin.order.details', compact('orders'));
    }

    public function feedBackResult($id)
    {
        $orders = Order::findOrFail($id);
        return response()->json(['data'=>$orders]);

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
