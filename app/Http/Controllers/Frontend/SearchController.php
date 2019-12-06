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

        session()->flash('priceRange','searchPrice');
        return view('fontend.pages.search',compact('products'));
    }



    public function ProductSearch(Request $request) // this is normal search
    {
            $validate = $request->validate([
                'liveSearch' =>'required',
            ]);


        $category_id = $request->category_id;
        $search_text = $request->liveSearch;
        session()->flash('search_text', $search_text);
        if ($category_id != ''){
            $products = Product::where('name','LIKE','%'.$search_text.'%')->where(['category_id'=> $category_id])->where('status',1)->where('deleted_at', null)->get();

                if(count($products) > 0){
                    return view('fontend.pages.search',compact('products'));
                }else{
                    session()->flash('search_error', 'No Details found new. Try to search again !');
                    return view('fontend.pages.search',compact('products'));
                }


        }else{
            $products = Product::where('name', 'LIKE', '%'.$search_text.'%')->where(['status' => 1]) ->where('deleted_at', null)->get();

            if(count($products) > 0){
                return view('fontend.pages.search',compact('products'));
            }else{
                session()->flash('search_error', 'No Details found new. Try to search again !');
                return view('fontend.pages.search',compact('products'));
            }


        }

    }


    public function searchAction(Request $request){

        if (request()->ajax()){
            $outputResult = '';
            $serchText = $request->serchText;

            if ($serchText != ''){
               $searchData =  Product::where('name', 'like', '%'. $serchText .'%')->where('deleted_at', null)->get();

                $totalResultRow = count($searchData);

                if ($totalResultRow > 0){

                    foreach ($searchData as $rowData){
                        $outputResult .='<div class="border-bottom" style=" background-color: #ccccc5; border-bottom: inset; ">
                                            <a href="'.route('product.details','')."/". $rowData->slug .' ">
                                                <div>
                                                    <img width="80" height="80" src="'.asset('images/product_image/'.$rowData->image) .'">
                                                     <span class="pl-4 pr-4">' . $rowData->name .  '</span>
                                                    <span style="color: #FE980F">Price '. $rowData->price .' Tk</span>
                                                </div>
                                            </a>
                                        </div>';
                    }
                    return response()->json(['success'=>$outputResult]);
                }else{
                    $outputResult ='<div class="text-center" style=" background-color: #ccccc5; border-bottom: inset; padding: 5px;color: red;"> No product found </div>';
                    return response()->json(['error'=>$outputResult]);
                }
            }


        }

    }



}
