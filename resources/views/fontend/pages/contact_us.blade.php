@extends('fontend.layouts.master')
@section('content')

    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Contact <strong>Us</strong></h2>
                   {{-- <div id="gmap" class="contact-map">
                    </div>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        @if(count($errors ) > 0)
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif

                        {{--@if($message = Session::get('success'))
                            <p class="alert alert-success">{{$message}}</p>
                         @endif--}}

                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{route('send.email')}}">
                            @csrf
                            <div class="form-group col-md-6">
                                <input type="text" name="name" value="{{old('name')}}" class="form-control"  placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control"  placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" value="{{old('subject')}}" class="form-control"  placeholder="Subject">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message"  class="form-control" rows="8" placeholder="Your Message Here">{{old('message')}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>E-Shopper Inc.</p>
                            <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                            <p>Newyork USA</p>
                            <p>Mobile: +2346 17 38 93</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: info@e-shopper.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/#contact-page-->
@endsection