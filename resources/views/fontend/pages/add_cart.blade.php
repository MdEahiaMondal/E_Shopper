@extends('fontend.layouts.master')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>

            <?php
                $all = count(Cart::instance('cart')->content());
            ?>
            @if($all != 0)
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($cart_products as $product)

                        <tr>
                            <td class="cart_product">
                                <a href=""><img width="120" src="{{asset('images/product_image/'.$product->options->image)}}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$product->name}}</a></h4>
                                <p>Web ID: 1089772</p>
                            </td>
                            <td class="cart_price">
                                <p>{{$product->price}} TK</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    {{--<a class="cart_quantity_down  btn btn-sm"> - </a>--}}{{-- // js in laout pages--}}{{--
                                    <input class="cart_quantity_input" id="quantity" type="text" name="qty" value="{{$product->qty}}" autocomplete="off" size="2">
                                    <a class="cart_quantity_up btn btn-sm"> + </a>--}}
                                    <form action="{{URL::to('update-cart')}}" method="post">
                                       @csrf
                                       <input class="cart_quantity_input" type="text" name="qty" value="{{$product->qty}}" autocomplete="off" size="2">
                                       <input type="hidden" name="rowId" value="{{$product->rowId}}">
                                       <input type="submit" class="btn btn-sm btn-warning" value="update">
                                   </form>

                                </div>
                            </td>



                            <td class="cart_total">
                                <p class="cart_total_price">{{$product->price * $product->qty}} TK</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{url('delete-item/'.$product->rowId)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                    @endforeach



                    </tbody>
                </table>
            </div>

        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>Checkout Summary</h3>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>{{Cart::subtotal()}} TK</span></li>
                            <li>Eco Tax <span>{{Cart::tax()}} TK</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>{{Cart::total()}} TK</span></li>
                        </ul>
                        <a class="btn btn-default update" href="{{url('/')}}">Continue Shopping</a>
                            @if (Auth::user())
                                <a class="btn btn-default check_out" href="{{URL::to('checkout')}}">Check Out</a>
                            @else
                                <a class="btn btn-default check_out" href="{{URL::to('login')}}">Check Out</a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
    @else
        <p class="alert alert-danger text-center">Cart Empty</p>
    @endif


@endsection