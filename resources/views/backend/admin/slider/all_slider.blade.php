@extends('backend.admin.layout.admin_layout')
@section('admin_content')

    <!-- start: Content -->
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">All Slider</a></li>
    </ul>

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
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Slider ID</th>
                        <th>Slider Image</th>
                        <th>Slider Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    @foreach($all_sliders as $slider)
                        <tbody>
                        <tr>
                            <td>{{$slider->id}}</td>
                            <td class="center"><img style="width: 350px;height: 150px" src="{{asset('images/slider_image/'.$slider->image)}}" alt=""></td>
                            @if($slider->status == 1)
                                <td class="center">
                                    <span class="label label-success">Active</span>
                                </td>
                            @else
                                <td class="center">
                                    <span class="label label-info">Unactive</span>
                                </td>
                            @endif
                            <td class="center">
                                @if($slider->status == 1)
                                    <a class="btn btn-danger" title="want to Unactive" href="{{URL::to('unactive-slider/'.$slider->id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success" title="want to Active" href="{{URL::to('active-slider/'.$slider->id)}}">
                                        <i class="halflings-icon white thumbs-up"></i>
                                    </a>
                                @endif
                                <a class="btn btn-info" href="{{URL:: to('edit-slider/'.$slider->id)}}">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a id="delete" class="btn btn-danger" href="{{URL::to('delete-slider/'.$slider->id)}}">
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
