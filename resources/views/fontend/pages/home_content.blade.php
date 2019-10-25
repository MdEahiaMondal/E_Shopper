@extends('fontend.layouts.master')

@section('search')
    @include('fontend.parsials.searchForm')
@endsection


@section('sidebar')
    @include('fontend.parsials.sidebar')
@endsection

@section('content')
    <div class="recommended_items">
        <h2 class="title text-center">Features PRODUCTS</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="{{ (count($features_Products) > 4)?'carousel':'' }}">
            <div class="carousel-inner">
                <div class="item active">
                        @php($i=0)

                    @foreach($features_Products as $features_product)
                        @if($i!=0 and $i%3==0)
                </div>
                <div class="item">
                        @endif

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">

                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{URL:: to('view-details/'.$features_product->slug)}}" data-slug="{{ $features_product->slug }}" class="quickImage">
                                        <img class="zoom cus_size" src="{{asset('images/product_image/'.$features_product->image)}}" alt="" />
                                    </a>
                                    <h2 class="price" data-price="{{ $features_product->price }}"> {{ $features_product->price }} TK </h2>
                                    <p class="brand" data-brand="{{ $features_product->brand->name }}"></p>
                                    <p class="category" data-category="{{ $features_product->category->name }}"></p>
                                    <p class="description" data-description="{{ $features_product->description }}"></p>
                                    <p class="name" data-name="{{ $features_product->name }}"> {{ $features_product->name }} </p>
                                    <a href="{{URL:: to('view-details/'.$features_product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>

                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li>
                                        <a href="{{url('add-wishlist/'.$features_product->slug)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a>
                                    </li>
                                    <li>
                                        <a data-id="{{ $features_product->id }}" class="quickTrigger"> Quick View </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>




                        @php($i++)
                    @endforeach
                </div>
            </div>

            @if(count($features_Products) > 3)
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
            @endif
        </div>
    </div><!--/recommended_items-->

  {{--  <div class="features_items"><!--features_items-->
        <h2 class="title text-center">ALL PRODUCTS</h2>

            @foreach ($products as $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{URL:: to('view-details/'.$product->slug)}}"> <img class="zoom cus_size" src="{{asset('images/product_image/'.$product->image)}}" alt="" /></a>
                            <h2>{{$product->price}} TK</h2>
                            <p>{{$product->name}}</p>
                            <a href="{{URL:: to('view-details/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="{{url('add-wishlist/'.$product->slug)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a  class="cd-trigger" href="{{ URL:: to('view-details/'.$product->slug) }}"><i class="fa fa-plus-square"></i> View Details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
    </div><!--features_items-->--}}


    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">ALL PRODUCTS</h2>

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
    </div>


    <div class="cd-quick-view">
        <div class="cd-slider-wrapper">
            <ul class="cd-slider">
                <li class="selected">
                    <img src="" alt="Product 1">
                </li>
            </ul>
        </div>

        <div class="cd-item-info">
            <h2>Produt Name</h2>
            <p>Price: <span class="name"></span> tk</p>
            <p>Brand : <span class="brand"></span> </p>
            <p>Category : <span class="category"></span></p>
            <p class="description">Lorem ipsum dolor sit amet, consectetur
                adipisicing elit. Officia, omnis illo iste ratione.
                Numquam eveniet quo, ullam itaque expedita impedit.
                Eveniet, asperiores amet iste repellendus similique
                reiciendis, maxime laborum praesentium.
            </p>

            <ul class="cd-item-action">

                <span>
                    <form action="{{url('add-cart')}}" method="post">
                        @csrf
                       <label>Quantity:</label>
                       <input type="text" style=" width: 37px; height: 24px; display: inline-block;" class="productQuantity" name="qty" value="1" />
                        <input type="hidden" class="product_id" name="product_id" value="">
                        <button type="submit" class="btn btn-default cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        <a class="btn btn-default cart" href="{{url('add-wishlist/'.$product->slug)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a>
                    </form>
                </span>
            </ul> <!-- cd-item-action -->
        </div> <!-- cd-item-info -->
        <a href="#0" class="cd-close">Close</a>
    </div> <!-- cd-quick-view -->



@endsection
