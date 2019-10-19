@extends('fontend.layouts.master')


@section('search')
    @include('fontend.parsials.searchForm')
@endsection

@section('sidebar')
    @include('fontend.parsials.sidebar')
@endsection


@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Search Items</h2>
        @if(count($all_search_product) > 0 )
            @foreach ($all_search_product as $search_products)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img class="zoom" src="{{asset('images/product_image/'.$search_products->image)}}" alt="" />
                                <h2>{{$search_products->price}} TK</h2>
                                <p>{{$search_products->name}}</p>
                                <a  href="{{URL:: to('view-details/'.$search_products->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="{{URL::to('add-wishlist/'.$search_products->id)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="{{URL:: to('view-details/'.$search_products->id)}}"><i class="fa fa-plus-square"></i>View to Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p style="font-size: 28px" class="">Search for: "{{Session::get('search_text')}}"</p>
            <p class="text-center alert alert-danger">{{Session::get('search_error')}}</p>
        @endif
    </div><!--features_items-->

@endsection
