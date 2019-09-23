@extends('fontend.layouts.master')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"> Wishlist</li>
                </ol>
            </div>
            <?php
            $all = count(Cart::instance('wishlist')->content());
            ?>
            @if($all != 0)
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Image</td>
                            <td class="description">Name</td>
                            <td class="price">Price</td>
                            <td class="quantity">Move</td>
                            <td class="total">Action</td>

                        </tr>
                        </thead>
                        <tbody>


                        @foreach(Cart::instance('wishlist')->content() as $wishlistItem)

                            <tr>
                                <td class="cart_product">
                                    <a href=""><img width="120" src="{{asset('images/product_image/'.$wishlistItem->options->image)}}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{$wishlistItem->name}}</a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>{{$wishlistItem->price}} TK</p>
                                </td>
                                <td class="cart_quantity">
                                    <a class="moveToCart" href="{{url('move-to-cart/'.$wishlistItem->rowId)}}">Move To Cart</a>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{url('remove-item/'.$wishlistItem->rowId)}}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>

        </div>
    </section> <!--/#cart_items-->
    @else
        <p class="alert alert-danger text-center">Wishlist Empty</p>
    @endif


@endsection