@extends('backend.admin.layout.admin_layout')
@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Edit Category</a></li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Category</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">

                <script>
                    $(function () {
                        setInterval(function () {
                            $("#category_status").fadeOut("slow");
                        },2000);
                    });
                </script>

                @if(Session('message'))
                    <li id="category_status" class="alert alert-success">{{Session::get('message')}} {{Session::put('message',null)}}</li>
                    <br>
                @endif

                @if($errors->all())
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">{{$error}}</p>
                    @endforeach
                @endif

                <form class="form-horizontal" method="post" action="{{ route('categories.update',$category_info->id) }}">
                    @csrf
                    @method('patch')

                    <fieldset>

                        <div class="form-group">
                            <label for="category_name"><h3>Category Name<sup class="star-danger">*</sup></h3></label>
                            <input type="text" class="form-control" id="category_name" value="{{$category_info->name}}" placeholder="Enter Category Name" name="category_name">
                        </div>
                        <div class="form-group">
                            <label for="category_description"><h3>Description:</h3></label>
                            <textarea name="category_description" id="category_description" cols="30" rows="10">{{$category_info->description}}</textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                            <button class="btn">Cancel</button>
                            <a class="btn btn-warning" href="{{route('categories.index')}}">Back</a>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection
