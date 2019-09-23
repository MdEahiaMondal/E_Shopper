@extends('fontend.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked nav-email shadow mb-20">
                    <li>
                        <div class="text-center">
                            <figure>
                                <img style="border-radius: 78px; margin-bottom: 20px" alt="" src="{{asset('images/profile_pic/'.$user_info->avatar)}}">
                            </figure>
                        </div>
                    </li>
                    <li class="active">
                        <a href="#mail-inbox.html">
                            <i class="fa fa-user"></i>My Profile
                        </a>
                    </li>
                    <li id="cart">
                        <a href="{{url('show-cart')}}"><i class="fa fa-shopping-cart"></i>My Cart  <span class="label label-info pull-right">{{count(Cart::instance('cart')->content())}}</span></a>
                    </li>
                    <li id="wishlist">
                        <a href="{{url('wishlist.index')}}"><i class="fa fa-cart-plus" aria-hidden="true"></i>My Wishlist  <span class="label label-info pull-right">{{count(Cart::instance('wishlist')->content())}}</span></a>
                    </li>

                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a  href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                            </a>
                        </form>
                    </li>
                </ul><!-- /.nav -->
            </div>
            <div class="col-sm-9">

                <!-- for start profile -->
                <div id="personal_info" class="panel panel-default">
                    <div class="panel-heading resume-heading">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 style="padding: 20px;">Personal Information <sub id="Profile_edit" style="font-size: 18px; color: #0e90d2; cursor: pointer">Edit</sub></h2>
                                    <table class="table table-striped">

                                       {{-- @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif--}}

                                        <tbody>
                                        <form id="profile" action="{{route('update.profile')}}" method="Post" enctype="multipart/form-data">
                                            @csrf
                                            <tr>
                                                <td colspan="1">
                                                    <div class="well form-horizontal">
                                                        <div class="form-group">
                                                            <label for="firstName">First Name</label>
                                                            <input type="text" name="name" value="{{$user_info->name}}"  id="firstName" class="form-control {{ $errors->has('name') ? 'has-error' : ''}} ">
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_adress">Email Address</label>
                                                            <input type="text" name="email" value="{{$user_info->email}}"  id="email_adress" class="form-control">
                                                                @error('email')
                                                                <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="birth_day">Your Date of Birth </label>
                                                            <input type="text" name="birthday" value="{{$user_info->birthday}}"   id="birth_day" class="form-control">
                                                                @error('birthday')
                                                                <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="address">Your Address</label>
                                                            <input type="text" name="address" value="{{$user_info->address}}"  id="address" class="form-control">
                                                                @error('address')
                                                                <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                </td>
                                                <td  colspan="1">
                                                    <div class="well form-horizontal">

                                                        <div class="form-group">
                                                            <label for="lasttName">Last Name</label>
                                                            <input type="text" name="lastname" value="{{$user_info->lastname}}"  id="lasttName"  class="form-control @error('lastname') is-invalid @enderror">
                                                                @error('lastname')
                                                                <span class="text-danger invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="phoneNumber">Phone Number</label>
                                                            <input  type="text" name="phone" value="{{$user_info->phone}}"  id="demo"  class="form-control">
                                                                @error('phone')
                                                                <span class="text-danger invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Gender : </label>
                                                            Male <input type="radio" name="gender" value="male" <?php if($user_info->gender == 'male'){echo 'checked';} ?> >
                                                            Female <input type="radio" name="gender" value="female" <?php if($user_info->gender == 'female'){echo 'checked';} ?> >
                                                                @error('gender')
                                                                <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="avatar">Profile Image</label>
                                                            <input onchange="preview_image(event)" type="file" name="avatar" value=""  id="avatar">
                                                                @error('avatar')
                                                                <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                @enderror
                                                             <img width="150" src="{{asset('images/profile_pic/'.$user_info->avatar)}}" id="output_image" alt="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input id="ProfilesubmitHide" class="btn btn-warning"  type="submit" value="Save">
                                                    </div>
                                                </td>
                                            </tr>
                                        </form>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="passwordChange" class="panel panel-default">
                    <div class="panel-heading resume-heading">
                        <h2 style="padding: 20px;">Your password <sub id="Profile_pass_edit" style="font-size: 18px; color: #0e90d2; cursor: pointer"> Change Password </sub> </h2>

                        <form action="">
                            <div class="form-group">
                                <label for="address">Your Current Password</label>
                                <input type="password" name="address" value="{{$user_info->password}}"  id="address" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="address">New Password</label>
                                <input type="password" name="address" value=""  id="address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address">Confirm Password</label>
                                <input type="password" name="address" value=""  id="address" class="form-control">
                            </div>

                            <div class="form-group">
                                <input id="pass_submit" type="submit"  value="Change Password"  id="address" class="form-control btn btn-warning">
                            </div>

                        </form>

                    </div>
                </div>
               {{-- end profile--}}


            </div>


        </div>
    </div>

@endsection
