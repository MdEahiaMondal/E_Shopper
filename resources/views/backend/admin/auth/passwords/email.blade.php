@extends('fontend.layouts.master')
@section('content')

    <section id="form"><!--form-->

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-3">
                    <div class="login-form"><!--login form-->
                        <h2>Reset Password</h2>
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <input type="email"  name="email" class=" @error('email') is-invalid @enderror" placeholder="Email Address" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>

                        </form>
                    </div><!--/login form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
