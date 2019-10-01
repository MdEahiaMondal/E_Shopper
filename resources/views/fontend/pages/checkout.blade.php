@extends('fontend.layouts.master')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->


            <div class="register-req">
                <h4 class="text-danger">Please Fileup this form</h4>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-8 clearfix">
                        <div class="bill-to">
                            <p>Bill To</p>
                            <div class="form-one">

                                <form action="{{url('insert-shipping')}}" method="post">
                                    @csrf
                                    <input type="text" name="shipping_first_name"  placeholder="First Name">
                                    @error('shipping_first_name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input type="text" name="shipping_last_name" placeholder="Last Name">
                                    @error('shipping_last_name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input type="email" name="shipping_email" placeholder="Email*">
                                    @error('shipping_email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input type="text" name="shipping_address" placeholder="Address*">
                                    @error('shipping_address')
                                    <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input type="text" name="shipping_phone" placeholder="Phone">
                                    @error('shipping_phone')
                                    <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <select name="shipping_city">
                                        <option>-- City --</option>
                                        <option value="pangsha">pangsha</option>
                                        <option value="rajbary">rajbary</option>
                                        <option value="khulna">khulna</option>
                                        <option value="dhaka">dhaka</option>

                                    </select>
                                    <input type="submit" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="review-payment">
                            <h2>Review & Payment</h2>
                        </div>

                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                <tbody>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">
                                            <tr>
                                                <td>Cart Sub Total</td>
                                                <td>{{Cart::instance('cart')->subtotal()}} TK</td>
                                            </tr>
                                            <tr>
                                                <td>Exo Tax</td>
                                                <td>{{Cart::tax()}} TK</td>
                                            </tr>
                                            <tr class="shipping-cost">
                                                <td>Shipping Cost</td>
                                                <td>Free</td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td><span>{{Cart::total()}} TK</span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection