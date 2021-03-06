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
                                    <a href="{{ route('product.details',$features_product->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
            <div class="col-sm-4 ProductLoadContent">
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

    <a href="#" class="btn btn-primary btn-block" id="loadMore">Load More</a>
    @include('fontend.parsials.quick_view')

@endsection



<style>

    .ProductLoadContent{
        display: none;
        margin-bottom: inherit;
    }

    .noContent {
        pointer-events: none;
    }



</style>



@section('script')
    <script>
        // load more for item
        $(document).ready(function(){
            $(".ProductLoadContent").slice(0, 6).show();
            $("#loadMore").on("click", function(e){
                e.preventDefault();
                $(".ProductLoadContent:hidden").slice(0, 6).slideDown();
                if($(".ProductLoadContent:hidden").length == 0) {
                    $("#loadMore").text("No Content").addClass("noContent");
                }
            });

        });
    </script>
@endsection


