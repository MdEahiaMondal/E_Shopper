<?php

namespace App\Http\Controllers\Frontend;

use App\Order;
use App\Order_details;
use App\Payment;
use App\Shipping;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Cart;
use App\Http\Controllers\Controller;


class CheckoutController extends Controller
{

   public function checkout(){
       return view('fontend.pages.checkout');
   }

   public function insert_shipping(Request $request){
       $request->validate([
           'first_name'    => 'required|alpha',
           'last_name'     => 'required|alpha',
           'email'         => 'required|email',
           'address'       => 'required',
           'phone'         => 'required|numeric',
           'city'          => 'required',

       ]);

       Session::put('shipping_first_name',  $request->first_name);
       Session::put('shipping_last_name',   $request->last_name);
       Session::put('shipping_email',       $request->email);
       Session::put('shipping_address',     $request->address);
       Session::put('shipping_phone',       $request->phone);
       Session::put('shipping_city',        $request->city);
       return redirect()->route('payment.giveData');

   }

   public function payment(){
      return view('fontend.pages.payment');
   }

   public function paymentStore(Request $request){

       $pay_method = $request->pament_method;
       if ($pay_method){

           // second insert data to payment table
           $p_data = array();
           $p_data['method'] = $pay_method;
           $pament_id =Payment::insertGetId($p_data);

           // thard insert data to order table
           $with_comma_value = Cart::instance('cart')->total();
           $remove_comma = str_replace(',','',$with_comma_value);

           $order_data = array();
           $order_data['user_id'] = \Auth::user()->id;
           $order_data['payment_id'] = $pament_id;
           $order_data['total'] = $remove_comma;
           $order_data['created_at']        = Carbon::now();
           $order_id = Order::insertGetId($order_data);

            // first insert data to shipping table
            $shipping_first_name      =   Session::get('shipping_first_name');
            $shipping_last_name       =   Session::get('shipping_last_name');
            $shipping_email           =   Session::get('shipping_email');
            $shipping_address         =   Session::get('shipping_address');
            $shipping_phone           =   Session::get('shipping_phone');
            $shipping_city            =   Session::get('shipping_city');
            $sp_data = array();
            $sp_data['order_id']    = $order_id;
            $sp_data['first_name']  = $shipping_first_name;
            $sp_data['last_name']   = $shipping_last_name   ;
            $sp_data['email']       = $shipping_email;
            $sp_data['address']     = $shipping_address;
            $sp_data['phone']       = $shipping_phone;
            $sp_data['city']        = $shipping_city;
            $sp_data['created_at']        = Carbon::now();
            Shipping::insertGetId($sp_data);

           // four insert data to order_details table
           $contents = Cart::instance('cart')->content();

           $od_data = array();

           foreach ($contents as $content){
               $od_data['order_id'] =$order_id;
               $od_data['product_id'] =$content->id;
               $od_data['product_name'] =$content->name;
               $od_data['product_price'] =$content->price;
               $od_data['product_sales_quantity'] =$content->qty;
               $od_data['created_at']        = Carbon::now();
              Order_details::insertGetId($od_data);
           }

       }else{
         Session::put('success','Please select  your payment method !!');
         return back();
       }

       if($pay_method == 'handCash'){
           Cart::destroy();
           return view('fontend.pages.thanks_confir_order');
       }elseif ($pay_method == 'Bkash'){
           Cart::destroy();
           return view('fontend.pages.thanks_confir_order');
       }elseif($pay_method == 'amex'){
           Cart::destroy();
           return view('fontend.pages.thanks_confir_order');
       }
   }

}
