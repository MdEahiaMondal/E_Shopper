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
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if(session('errors'))
                        <p class="alert alert-danger">{{session('errors')}}</p>
                        @endif
                    @if(session('success'))
                            <p class="alert alert-success">{{session('success')}}</p>
                        @endif


                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Category Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        @foreach($all_category as $categories)
                        <tbody>
                        <tr>
                            <td>{{$categories->id}}</td>
                            <td>{{$categories->name}}</td>
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
                                    <a class="btn btn-danger" href="{{URL::to('unactive_category/'.$categories->id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>
                                    </a>
                            @else
                                    <a class="btn btn-success" href="{{URL::to('active_category/'.$categories->id)}}">
                                        <i class="halflings-icon white thumbs-up"></i>
                                    </a>
                            @endif
                                <a class="btn btn-info" href="{{URL:: to('edit-category/'.$categories->id)}}">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a id="delete" class="btn btn-danger" href="{{URL::to('delete-category/'.$categories->id)}}">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                            @endforeach
                    </table>
                </div>
            </div><!--/span-->

        </div><!--/row-->


    <!-- end: Content -->

@endsection
