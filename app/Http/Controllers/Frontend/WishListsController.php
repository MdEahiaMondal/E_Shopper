<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Controller;

class WishListsController extends Controller
{

    public function index()
    {
        return view('fontend.pages.wishlist_index');
    }

    public function store($slug)
    {


        $product = Product::where('slug',$slug)->first();

        // check if this product already has in wishlist so make error
        $checkDuplicates = Cart::instance('wishlist')->search(function ($wishItem) use ($product){
            return $wishItem->id == $product->id;
        });


        // if there is a value in $checkDuplicates make error
        if ($checkDuplicates->isNotEmpty()){
             session()->flash('error','Product already has in you Wishlist !!');
             return back();
        }else{


        $data = array();
        $data['id']                 = $product->id;
        $data['name']               = $product->name;
        $data['qty']                = '1'; // it is  default value for wishlist
        $data['price']              = $product->price;
        $data['weight']             = '0';
        $data['options']['image']   = $product->image;

        // now add to the wishlist
        $add_to_wishlist = Cart::instance('wishlist')->add($data);
            if ($add_to_wishlist){

                return back()->with('success','Product Added in your wishlist Successfully ');

            }else{

                return back()->with('error','Something problem please try again !!');

            }

       }
    }



    public function removeItem($rowId)
    {
        $check = Cart::instance('wishlist')->get($rowId);
        if($check){

            Cart::instance('wishlist')->remove($rowId);
            return back()->with('success','Product Remove From in Your Wishlist');

        }else{

            return back()->with('error','It is elegale !!');
        }

    }



    public function MoveToCart($rowId){
        $item = Cart::instance('wishlist')->get($rowId);
        $checkDuplicates = Cart::instance('cart')->search(function ($cartItem) use ($item){
            return $cartItem->id == $item->id;
        });


        if ($checkDuplicates->isNotEmpty()){
            return back()->with('error','Product Already has in your cart');
        }

        Cart::instance('wishlist')->remove($rowId);

        $data = array();
        $data['id']                 = $item->id;
        $data['name']               = $item->name;
        $data['qty']                = $item->qty;
        $data['price']              = $item->price;
        $data['weight']             = '0';
        $data['options']['image']   = $item->options->image;

        $to_cart = Cart::instance('cart')->add($data);

        if($to_cart){

            return back()->with('success','Product Added in you Cart successfully');

        }else{

            return back()->with('error','Somenthing Problem to add to cart !!');
        }
    }



}
