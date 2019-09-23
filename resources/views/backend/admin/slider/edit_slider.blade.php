@extends('backend.admin.layout.admin_layout')
@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Edit Slider</a></li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Slider</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                @if(Session('success'))
                    <li id="category_status" class="alert alert-success">{{Session::get('success')}} {{Session::put('success',null)}}</li>
                    <br>
                @endif

                @if(Session('error'))
                    <li id="category_status" class="alert alert-warning">{{Session::get('error')}} {{Session::put('error',null)}}</li>
                    <br>
                @endif


                @if($errors->all())
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">{{$error}}</p>
                    @endforeach
                @endif
                <form class="form-horizontal" enctype="multipart/form-data"  method="post" action="{{url('update-slider',$single_slider->id)}}">
                    @csrf
                   {{-- <input type="hidden" name="old_image" value="{{$single_slider->slider_image}}">--}}
                        <div class="form-group">
                            <input type="file" name="slider_image" accept="image/*" onchange="preview_image(event)">
                        </div>

                        <div class="form-group">
                                <img id="output_image" style="width: 350px; height: 150px" src="{{asset('images/slider_image/'.$single_slider->image)}}" alt="">
                        </div>

                        <div class="form-actions">
                            <button type="submit" name='submit_image' class="btn btn-primary">Update Slider</button>
                            <button class="btn">Cancel</button>
                            <a class="btn btn-warning" href="{{url('all-slider')}}">Back</a>
                        </div>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection
