@extends('fontend.layouts.master')
@section('content')
<section id="form"><!--form-->

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-offset-3">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <input type="email" value="{{old('email')}}" name="email" class="@error('email') is-invalid @enderror" placeholder="Email Address" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        <input type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Enter Password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                @if (Route::has('password.request'))
                                  <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
	@endsection