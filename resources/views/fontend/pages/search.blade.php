@extends('fontend.layouts.master')


@section('search')
    @include('fontend.parsials.searchForm')
@endsection

@section('sidebar')
    @include('fontend.parsials.sidebar')
@endsection


@section('content')

  @if( (Session::has('priceRange')) )
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Search Items with Price</h2>
            @if(count($products) > 0 )
                @foreach ($products as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">

                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{URL:: to('view-details/'.$product->slug)}}" data-slug="{{ $product->slug }}" class="quickImage">
                                        <img class="zoom cus_size" src="{{asset('images/product_image/'.$product->image)}}" alt="" />
                                    </a>
                                    <h2 class="price" data-price="{{ $product->price }}"> {{ $product->price }} TK </h2>
                                    <p class="brand" data-brand="{{ $product->brand->name }}"></p>
                                    <p class="category" data-category="{{ $product->category->name }}"></p>
                                    <p class="description" data-description="{{ $product->description }}"></p>
                                    <p class="name" data-name="{{ $product->name }}"> {{ $product->name }} </p>
                                    <a href="{{URL:: to('view-details/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>

                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li>
                                        <a href="{{url('add-wishlist/'.$product->slug)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a>
                                    </li>
                                    <li>
                                        <a data-id="{{ $product->id }}" class="quickTrigger"> Quick View </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center alert alert-danger"> No Details found with price. Try to search again ! </p>
            @endif
        </div><!--features_items-->
    @endif



   @if( (Session::has('search_text')) )
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Search  Items  with ( <span style="color: #f27474">{{ Session::get('search_text') }}</span> ) </h2>
            @if(count($products) > 0 )
                @foreach ($products as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">

                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{URL:: to('view-details/'.$product->slug)}}" data-slug="{{ $product->slug }}" class="quickImage">
                                        <img class="zoom cus_size" src="{{asset('images/product_image/'.$product->image)}}" alt="" />
                                    </a>
                                    <h2 class="price" data-price="{{ $product->price }}"> {{ $product->price }} TK </h2>
                                    <p class="brand" data-brand="{{ $product->brand->name }}"></p>
                                    <p class="category" data-category="{{ $product->category->name }}"></p>
                                    <p class="description" data-description="{{ $product->description }}"></p>
                                    <p class="name" data-name="{{ $product->name }}"> {{ $product->name }} </p>
                                    <a href="{{URL:: to('view-details/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>

                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li>
                                        <a href="{{ route('add.wishlist',$product->slug)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a>
                                    </li>
                                    <li>
                                        <a data-id="{{ $product->id }}" class="quickTrigger"> Quick View </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <p style="font-size: 28px" class="">Search for: "{{ Session::get('search_text') }}"</p>
                <p class="text-center alert alert-danger">{{  Session::get('search_error')  }} </p>
            @endif
        </div><!--features_items-->
    @endif


  @include('fontend.parsials.quick_view')

@endsection
