@extends('fontend.layouts.master')

@section('sidebar')
    @include('fontend.parsials.sidebar')
@endsection

@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Category Items</h2>

        @if(count($all_category_products) > 0 )
            @foreach ($all_category_products as $product)
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
            <p class="text-center alert alert-danger">Not Available</p>
        @endif
    </div><!--features_items-->

@endsection
