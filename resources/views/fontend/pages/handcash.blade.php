@extends('fontend.layouts.master')
@section('content')
    <section id="form"><!--form-->

        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h1>Thanks for order....</h1>
                        <h2>We will contact with you as soon as prosible...</h2>

                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or"></h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->

                        @if($errors->all())
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif

                        <h2></h2>

                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection