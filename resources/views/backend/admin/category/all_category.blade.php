@extends('backend.admin.layout.admin_layout')
@section('admin_content')

    <!-- start: Content -->
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{url('dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">All Category</a></li>
        </ul>


    @if(Session('success'))
        <li id="category_status" class="alert alert-success">{{Session::get('success')}} {{Session::put('success',null)}}</li>
        <br>
    @endif
    @if(Session('error'))
        <p class="alert alert-danger">{{Session::get('error')}} {{Session::put('error',null)}}</p>
    @endif

    <div class="row-fluid sortable">
        <div class="box span12">

            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
                <div class="box-icon">
                    <a href="#" onclick="showCategoryForm()" class="btn-sm "><i class="fa fa-plus" aria-hidden="true"></i>Add New</a>
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>

                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable" id="reloadAjax">
                    <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Category Description</th>
                        <th>Category Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_category as $categories)
                    <tr>
                        <td>{{$categories->id}}</td>
                        <td class="center">{{$categories->name}}</td>
                        <td class="center">{{$categories->description}}</td>

                        @if($categories->status == 1)
                            <td class="center">
                                <span class="label label-success">Active</span>
                            </td>
                        @else
                            <td class="center">
                                <span class="label label-info">Unactive</span>
                            </td>
                        @endif
                        <td class="center">
                            @if($categories->status == 1)
                                <a class="btn btn-danger" onclick="Student({{ $categories->id }},'active')">
                                    <i class="halflings-icon white thumbs-down"></i>
                                </a>
                            @else
                                <a class="btn btn-success" onclick="Student({{ $categories->id }},'unactive')">
                                    <i class="halflings-icon white thumbs-up"></i>
                                </a>
                            @endif
                            <a class="btn btn-info" {{--href="{{URL:: to('edit-category/'.$categories->id)}}"--}} onclick="showCategoryForm({{$categories->id}})">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a id="delete" class="btn btn-danger" href="{{URL::to('delete-category/'.$categories->id)}}">
                                <i class="halflings-icon white trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div><!--/row-->
    <!-- end: Content -->

 {{--   <div class="modal fade" id="categoryModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitle"></h4>
                </div>
                <div class="modal-body">

                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Category</h2>
                            </div>
                            <div class="box-content">

                                <script>
                                    $(function () {
                                        setInterval(function () {
                                            $("#category_status").fadeOut("slow");
                                        },2000);
                                    });
                                </script>
                                @if(Session('success'))
                                    <li id="category_status" class="alert alert-success">{{Session::get('success')}}{{Session::put('success',null)}}</li>
                                    <br>
                                @endif
                                @if($errors->all())
                                    @foreach($errors->all() as $error)
                                        <p class="alert alert-danger">{{$error}}</p>
                                    @endforeach
                                @endif
                                <form class="form-horizontal" method="post" action="{{url('insert-category')}}">
                                    @csrf  {{method_field('POST')}}
                                    <fieldset>

                                        <div class="form-group">
                                            <label for="category_name"><h3>Category Name<sup class="star-danger">*</sup></h3></label>
                                            <input type="text" class="form-control" value="{{old('category_name')}}" id="category_name" placeholder="Enter Category Name" name="category_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="category_description"><h3>Description:</h3></label>
                                            <textarea name="category_description" id="category_description" cols="30" rows="10">{{old('category_description')}}</textarea>
                                        </div>
                                        <div class="form-group form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="category_status" value="1"> Categoat Status
                                            </label>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <button class="btn">Cancel</button>
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div><!--/span-->

                    </div><!--/row-->
                </div>
            </div>
        </div>
    </div>--}}




@endsection
