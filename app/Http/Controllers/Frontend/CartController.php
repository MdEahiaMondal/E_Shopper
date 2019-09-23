<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;



class CartController extends Controller
{

    public function add_to_cart(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1',

        ]);

        $qty                = $request->qty;
        $product_id         = $request->product_id;

        $single_product = Product::where('id', $product_id)->first();

        $data  = array();
        $data['qty']                = $qty;
        $data['id']                 = $single_product->id;
        $data['name']               = $single_product->name;
        $data['price']              = $single_product->price;
        $data['weight']             = '0';
        $data['options']['image']   = $single_product->image;
        Cart::instance('cart')->add($data);
        return redirect(route('cart.index'));
    }

    public function showCart(){
        $cart_products = Cart::instance('cart')->content();
        return view('fontend.pages.add_cart', compact('cart_products'));
    }

    public function deleteItem($rowId){
        Cart::instance('cart')->update($rowId,0);
        return redirect(route('cart.index'));
    }

    public function updateItem(Request $request){
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);

        $qty    = $request->qty;
        $rowId  = $request->rowId;
        Cart::instance('cart')->update($rowId,$qty);
        return redirect(route('cart.index'));
    }


}
