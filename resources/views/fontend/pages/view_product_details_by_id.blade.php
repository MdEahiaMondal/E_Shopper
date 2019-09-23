@extends('fontend.layouts.master')

@section('content')
    <div class="col-sm-12 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{asset('images/product_image/'.$details->image)}}" alt="" />
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href=""><img src="{{asset('frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                            <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                        </div>

                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2>{{$details->name}}</h2>
                    {{--<p>Web ID: 1089772</p>--}}
                    <img src="images/product-details/rating.png" alt="" />
                    <span>
									<span>BD {{$details->price}} TK</span>
                                        <form action="{{url('add-cart')}}" method="post">
                                            @csrf
                                           <label>Quantity:</label>
                                           <input type="text" name="qty" value="1" />
                                            <input type="hidden" name="product_id" value="{{$details->id}}">
                                             @if($details->quantity > 0)
                                                <button type="submit" class="btn btn-fefault cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            @endif
                                        </form>

								</span>
                    <p><b>Availability:</b>
                        @if($details->quantity > 0)
                            <span class="text-success">In Stock</span>
                            @else
                           <span class="text-danger"> Not available</span>
                        @endif
                    </p>
                    <p><b>Condition:</b> New</p>
                    <p><b>Brand:</b>{{$details->brand->name}}</p>
                    <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li><a href="#details" data-toggle="tab">Details</a></li>
                    <li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{count($details->comment)}})</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade" id="details" >
                    <div class="col-sm-12">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <p>{{$details->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="tab-pane fade active in" id="reviews" >

                    <div class="col-sm-12">
                        @if(count($details->comment))
                        @foreach($details->comment as $com)
                            <div class="per_single_comment">
                            <ul class="">
                                <li><a href=""><i class="fa fa-user"></i>{{$com->name}}</a></li>
                                <li><a href=""><i class="fa fa-clock-o"></i>{{$com->created_at->diffForHumans()}}</a></li>
                                <li><a href=""><i class="fa fa-calendar-o"></i>{{$com->created_at->setTimezone('Asia/Dhaka')->isoFormat(' Do-MMM-Y')}}</a></li>
                                 <p>
                                    @for($i=1; $i<=$com->star_rating; $i++)
                                         <i style="color: gold" class="fa fa-star"></i>
                                   @endfor
                                 </p>
                            </ul>
                            <p id="sas" class="comment more">{{$com->body}}</p>
                                <p>Was this review helpful to you?</p>
                                <span> <a href=""><i s class="like_dislike_button fa fa-thumbs-up"></i></a> <a href=""><i class="like_dislike_button fa fa-thumbs-down"></i></a> </span>
                            </div>
                        @endforeach

                       {{-- for show and less text star--}}
                            <style>

                                a:visited {
                                    color: #0254EB
                                }
                                a.morelink {
                                    text-decoration:none;
                                    outline: none;
                                }
                                .morecontent span {
                                    display: none;
                                }
                                .comment {
                                    width: 100%;
                                }
                            </style>
                            {{-- for show and less text end--}}
                        @else
                            <p class="alert alert-warning">There is a no comments !!</p>
                        @endif
                            @if(Auth::user())
                                @if(count($errors ) > 0)
                                    @foreach($errors->all() as $error)
                                        <p class="alert alert-danger">{{$error}}</p>
                                    @endforeach
                                @endif
                        <p><b>Write Your Review</b></p>
                        <form action="{{url('insert-comment')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$details->id}}">
                            <textarea name="comment_body"> {{old('comment_body')}} </textarea>
                            <b>Rating: </b> <x-star-rating {{--value="3"--}} number="5"></x-star-rating>
                            <input id="rate" type="hidden" name="star_rating" value=""/>
                            <script src="{{asset('frontend/starRating/StarRating.js')}}"></script>
                            <button type="submit" class="btn btn-default pull-right">Submit</button>
                        </form>
                    </div>
                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="comment_login_link">
                                    @if(Session('comment_login'))
                                        <form  action="{{url('comment-login-check')}}" method="post">
                                            @csrf
										<span style="margin-bottom: 18px">
											<input type="text" name="customer_name" placeholder="Your Name"/>
											<input type="email" name="customer_email" placeholder="Email Address"/>
										</span>
                                            <span style="margin-bottom: 18px"><input type="password" name="customer_password" placeholder="Enter Password"/></span>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </form>
                                        @else
                                        <b>Please log in to write review <a  class="comment_login" href="{{--{{route('login')}}--}}">Login</a></b>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>


            </div>
        </div><!--/category-tab-->

        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Requested items</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/recommend1.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/recommend2.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/recommend3.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/recommend1.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/recommend2.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/recommend3.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div><!--/recommended_items-->

    </div>
@endsection