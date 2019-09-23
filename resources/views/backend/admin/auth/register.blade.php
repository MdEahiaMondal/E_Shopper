@extends('fontend.layouts.master')
@section('content')
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" value="{{old('name')}}" name="name" class=" @error('name') is-invalid @enderror" placeholder="Full Name"/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input  type="email" value="{{old('email')}}" name="email" class=" @error('email') is-invalid @enderror" placeholder="Email Address"/>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <input type="tel" value="{{old('phone')}}" name="phone" class="@error('phone') is-invalid @enderror" placeholder="Phone"/>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Password"/>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection