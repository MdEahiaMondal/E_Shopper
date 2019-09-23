@extends('fontend.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="paymentCont">
                <form action="{{url('insert-payment')}}" method="post">
                    @csrf
                        <div class="headingWrap">
                            @if(Session('success'))
                                <p class="alert alert-danger">{{Session::get('success')}} {{Session::put('success',null)}}</p>
                            @endif
                            <h3 class="headingTop text-center">Select Your Payment Method</h3>
                        </div>
                        <div class="paymentWrap">
                            <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
                                <label class="btn paymentMethod active">
                                    <div class="method visa"></div>
                                    <input type="radio" name="pament_method" value="handCash" checked>
                                </label>
                                <label class="btn paymentMethod">
                                    <div class="method master-card"></div>
                                    <input type="radio" name="pament_method" value="Bkash">
                                </label>
                                <label class="btn paymentMethod">
                                    <div class="method amex"></div>
                                    <input type="radio" name="pament_method" value="amex">
                                </label>
                                <label class="btn paymentMethod">
                                    <div class="method vishwa"></div>
                                    <input type="radio" name="pament_method" value="vishwa">
                                </label>
                                <label class="btn paymentMethod">
                                    <div class="method ez-cash"></div>
                                    <input type="radio" name="pament_method" value="ez_cash">
                                </label>

                            </div>
                        </div>
                        <div class="footerNavWrap clearfix">
                            <div class="row">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-2 align-content-center">
                                    <div ><input class="btn btn-success btn-fyi" type="submit" value="done"></div>
                                </div>
                                <div class="col-sm-4">

                                </div>
                            </div>

                        </div>
                </form>
            </div>

        </div>
    </div>
@endsection