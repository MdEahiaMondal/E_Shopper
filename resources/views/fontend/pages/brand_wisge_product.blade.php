@extends('fontend.layouts.master')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Brand Items</h2>
        @if(count($all_brand_products) > 0 )
        @foreach ($all_brand_products as $brand_products)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{URL:: to('view-details/'.$brand_products->slug)}}"> <img class="zoom" src="{{asset('images/product_image/'.$brand_products->image)}}" alt="" /></a>
                            <h2>{{$brand_products->price}} TK</h2>
                            <p>{{$brand_products->name}}</p>
                            <a href="{{URL:: to('view-details/'.$brand_products->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="{{url('add-wishlist/'.$brand_products->slug)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="{{URL:: to('view-details/'.$brand_products->slug)}}"><i class="fa fa-plus-square"></i>View to Details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        @else
            <p class="text-center alert alert-danger">Not Available</p>
        @endif
    </div><!--features_items-->

@endsection