@extends('fontend.layouts.master')

@section('search')
    @include('fontend.parsials.searchForm')
@endsection

@section('sidebar')
    @include('fontend.parsials.sidebar')
@endsection

@section('content')
    <div class="col-sm-12 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img style="height: 345px; width: 300px" class="xzoom" id="xzoom-default" src="{{asset('images/product_image/'.$details->image)}}" xoriginal="{{ asset('images/product_image/'.$details->image) }}" />
                </div>
                {{--<div id="similar-product" class="carousel slide" data-ride="carousel">

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
                </div>--}}

            </div>
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





                <div class="tab-pane fade active in" id="reviews" >{{--(reviews button) ase in main.css tha has with comment--}}

                    <div class="col-sm-12">
                        @if(count($details->comment))
                              <div class="per_single_comment" id="ajaxLoad">
                                    {{--data come here from database vai ajax--}}
                              </div>
                            @else
                            <p class="alert alert-warning">There is no Comment !</p>
                        @endif
                        <hr>

                        @if(Auth::user())
                            <p><b>Write Your Review</b></p>
                            <form id="mainCommentForm"  method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$details->id}}">
                                <p id="CommentError"></p>
                                <textarea name="comment_body"> {{old('comment_body')}} </textarea>
                                <b>Rating: </b> <x-star-rating {{--value="3"--}} number="5"></x-star-rating>
                                <input id="rate" type="hidden" name="star_rating" value=""/>
                                <script src="{{asset('frontend/starRating/StarRating.js')}}"></script>
                                <button type="submit" class="btn btn-default pull-right">Submit</button>
                            </form>
                        @endif
                    </div>

                    @if(!Auth::user())
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="comment_login_link">
                                        <form id="commentForm"  action="{{ route('login') }}" method="post">
                                            @csrf
										<span style="margin-bottom: 18px">
											<input type="email" name="email" placeholder="Email Address"/>
										</span>
                                            <span style="margin-bottom: 18px"><input type="password" name="password" placeholder="Enter Password"/></span>
                                            <button type="submit" class="btn btn-default">Login</button>
                                        </form>

                                        <b class="hideMe">Please log in to write review <a  id="commentFormButton" class="comment_login" >Login</a></b>
                                </div>
                            </div>
                        </div>
                        @endif

                </div>

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



            </div>
        </div><!--/category-tab-->

  {{--  </div>--}}


@endsection


@section('script')
    {{--// its ony for comment login form section--}}

    <script src="{{asset('frontend/js/moment.js')}}"></script>{{--// this moment.js use only for js time format--}}

    <script src="{{asset('frontend/js/likeDislike.js')}}"></script>
    <script>
        var token = "{{Session::token()}}";
        var commentUrl = "{{route('insert.comment')}}"
    </script>
    <script>


        $.ajaxSetup({
            headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
        });


        $(document).ready(function() {
            $("#commentFormButton").click(function() {
                $("#commentForm").show();
                $(".hideMe").hide();
            });
        });


        // get all comment from database
        var GetCommentUrl = "{{ route('get.comment.data') }}";
        function getCommentRecords(){
            $.get(GetCommentUrl)
            .success(function (data) {
                var html = "";
                data.forEach(function (row) {
                   var  iddd =row.id;
                    <?php
                        $likes = \App\LikeUnlike::all();
                            $comment = \App\Comment::all();

                        $like = \App\LikeUnlike::where(["comment_id"=>$likes->comment_id, 'like'=>1])->get();
                        $count = count($like);
                        $like_count = 0;
                        $dislike_count = 0;
                        $likeButton = "btn-secondary";
                        $dislikeButton = "btn-secondary";
                        foreach ($likes as $like) {

                            if ($like->like == 1) {
                                $like_count++;
                            }
                            if ($like->like == 0) {
                                $dislike_count++;
                            }

                            if(Auth::check()){
                                if($like->like == 1 && $like->user_id == Auth::id())
                                    $likeButton = "btn-warning";

                                if($like->like == 0 && $like->user_id == Auth::id())
                                    $dislikeButton = "btn-danger";
                            }

                        }
                        ?>
                     html += "<ul>";

                    html += "<input type='hidden' id='comment_id' value='"+row.id+"'>";
                     html += "<li>";
                         html += "<a href=''><i class='fa fa-user'></i>"+row.name+"</a>";
                     html += "</li>";

                     html += "<li>";
                        html += "<a href=''><i class='fa fa-clock-o'></i>"+ row.created_at  +"</a>";
                     html += "</li>";

                     html += "<li>";
                        html += "<a href=''><i class='fa fa-calendar-o'></i>"+row.created_at+"</a>";
                     html += "</li>";


                     html += "<p>";
                        for (var i =1; i<=row.star_rating; i++) {
                            html += "<i style='color: gold' class='fa fa-star'></i>";
                        }
                    html += "</p>";


                     html += "<li id='sas' class='comment more' style='color: initial; margin-bottom:20px;'>"  + row.body + "</li>";

                    html += "<li>";
                        html += "<p>Was this review helpful to you?</p>";
                    html += "</li>";


                    html += "<p>";
                        html +="<span>";
                            html += "<button class='like btn <?php echo $likeButton?>' onclick='likeComment("+row.id+")'>" +"<i class='fa fa-thumbs-up'></i> <span id='likeCount'> <?php echo $count;?> </span>"+ "</button>";
                            html += "<button class='dislike btn <?php echo $dislikeButton ?>'>" +"<i class='fa fa-thumbs-down'></i>"+ "</button>";
                        html +="</span>";
                    html += "</p>";

                     html += "</ul>";
                     html += "<hr>";
                });
                $(".per_single_comment").html(html);
            });


        }
        getCommentRecords();



        $(document).ready(function() {
            $(".nav a").on("click", function(){
                $(".nav").find(".active").removeClass("active");
                $(this).parent().addClass("active");
            });
        });


        // comment insert section
        $(document).ready(function () {
            $("#mainCommentForm").on('submit', function (event) {
                event.preventDefault();

                $.ajax({
                    url: commentUrl,
                    type: "POST",
                    dataType: "json",
                    data:  $("#mainCommentForm").serialize(),
                    success: function (data) {
                        if(data.success){
                            Swal.fire(
                                'Good job!',
                                'Thanks For Your Comment !',
                                'success'
                            );
                            $("#mainCommentForm")[0].reset();
                            getCommentRecords();
                        }
                    },
                    error:function (data) {
                        if (data.error){
                            var Error =data.responseJSON.errors.comment_body[0];
                            $("#CommentError").html('<div class="alert alert-danger">'+Error+'</div>')
                        }
                    },

                }); // end of  $.ajax({

            })// end of $("#mainCommentForm").on('submit', function (event) {

        });// end of main $(document).ready(function () {



        // like unlike system
        function likeComment(id) {
            var comment_id = id;
            var likeCount = $("#likeCount").text();

            $.ajax({
                url: "{{ route('like.comment') }}",
                method: "POST",
                data: {
                    comment_id: comment_id,
                    likeCount: likeCount,
                },
                dataType: "JSON",
                success: function (feedBackResult) {
                    if (feedBackResult.success == 1){
                        var count = Number(likeCount) + Number(1);
                        $("#likeCount").html(count);
                    }


                }

            })
        }


    </script>

@endsection
