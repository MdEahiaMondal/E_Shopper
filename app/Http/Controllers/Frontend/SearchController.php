<?php
namespace App\Http\Controllers\Frontend;

use App\Product;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SearchController extends Controller
{

    public function priceRangeSearch(Request $request)
    {
        $minimumPrice = $request->minimumPrice;
        $maximumPrice = $request->maximumPrice;

        $products =  Product::whereBetween('price', [$minimumPrice, $maximumPrice])->where('status', 1)->where('deleted_at', null)->get();

        Session::flash('priceRange','searchPrice');
        return view('fontend.pages.search',compact('products'));
    }



    public function ProductSearch(Request $request){

        if ($request->product_search){
            $request->validate([
                'product_search' =>'required',
            ]);
        }

        $category_id = $request->category_id;
        $search_text = $request->product_search;
        if ($category_id){
            $products = Product::where('name','LIKE','%'.$search_text.'%')->where(['category_id'=> $category_id])->where('status',1)->where('deleted_at', null)->get();

                if(count($products) > 0){
                    Session::flash('searchText','searchProduct');
                    return view('fontend.pages.search',compact('products'));
                }else{
                    Session::flash('search_text', $search_text);
                    Session::flash('search_error','No Details found. Try to search again !');
                    return view('fontend.pages.search',compact('products'));
                }


        }else{
            $products = Product::where('name','LIKE','%'.$search_text.'%')->where(['status'=> 1]) ->where('deleted_at', null)->get();

            if(count($products) > 0){
                Session::flash('searchText','searchProduct');
                return view('fontend.pages.search',compact('products'));
            }else{
                Session::put('search_text',$search_text);
                Session::put('search_error','No Details found. Try to search again !');
                return view('fontend.pages.search',compact('products'));
            }


        }

    }


}
