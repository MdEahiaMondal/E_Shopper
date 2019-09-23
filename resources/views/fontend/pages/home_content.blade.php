@extends('fontend.layouts.master')
@section('content')
    <div class="recommended_items">
        <h2 class="title text-center">Features PRODUCTS</h2>
<?php
        $all = \App\Product::where('features',1)->get();
?>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="{{ (count($all) > 4)?'carousel':'' }}">
            <div class="carousel-inner">
                <div class="item active">
                        @php($i=0)

                    @foreach($all as $features_product)
                        @if($i!=0 and $i%3==0)
                </div>
                <div class="item">
                        @endif
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a  href="{{URL:: to('view-details/'.$features_product->slug)}}"> <img class="zoom" src="{{asset('images/product_image/'.$features_product->image)}}" alt="" /></a>
                                    <h2>{{$features_product->price}} TK</h2>
                                    <p>{{$features_product->name}}</p>
                                    <a  href="{{URL:: to('view-details/'.$features_product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="{{url('add-wishlist/'.$features_product->slug)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="{{URL:: to('view-details/'.$features_product->slug)}}"><i class="fa fa-plus-square"></i>View to Details</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                        @php($i++)
                    @endforeach
                </div>
            </div>

            @if(count($all) > 3)
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
            @endif
        </div>
    </div><!--/recommended_items-->

    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">ALL PRODUCTS</h2>

            @foreach ($all_products as $products)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{URL:: to('view-details/'.$products->slug)}}"> <img class="zoom" src="{{asset('images/product_image/'.$products->image)}}" alt="" /></a>
                            <h2>{{$products->price}} TK</h2>
                            <p>{{$products->name}}</p>
                            <a href="{{URL:: to('view-details/'.$products->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="{{url('add-wishlist/'.$products->slug)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="{{URL:: to('view-details/'.$products->slug)}}"><i class="fa fa-plus-square"></i>View to Details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
    </div><!--features_items-->
@endsection
