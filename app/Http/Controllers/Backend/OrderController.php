<?php

namespace App\Http\Controllers\Backend;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $all_orders = Order::all();
        dd($all_orders->user_id);
        foreach ($all_orders as $oreder){
            dd($oreder->hasMany);
        }
        return view('backend.admin.order.all_orders',compact('all_orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param $order_id
     * @return Response
     */
    public function show($order_id)
    {
        $order_info = Order::where('id', $order_id)->first();
       return view('backend.admin.order.view_order', compact('order_info'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
         $order = Order::find($id);
         $order->delete();

        return back()->with('success', 'Order delete successfully');
    }
}
