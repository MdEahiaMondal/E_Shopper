@extends('backend.admin.layout.admin_layout')
@section('admin_content')

    <!-- start: Content -->
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">All Order</a></li>
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
                @if(session('errors'))
                    <p class="alert alert-danger">{{session('errors')}}</p>
                @endif
                @if(session('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                @endif

                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Order Total</th>
                        <th>Order Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    @foreach($all_orders as $orders)
                        <tbody>
                        <tr>
                            <td>{{$orders->id}}</td>
                            <td>{{$orders}}</td>
                            <td class="center">{{$orders->total}} TK</td>
                            @if($orders->status == 1)
                                <td class="center">
                                    <span class="label label-success">Active</span>
                                </td>
                            @else
                                <td class="center">
                                    <span class="label label-info">Unactive</span>
                                </td>
                            @endif
                            <td class="center">
                                @if($orders->status == 1)
                                    <a class="btn btn-danger" href="{{URL::to('unactive-order/'.$orders->id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success" href="{{URL::to('active-order/'.$orders->id)}}">
                                        <i class="halflings-icon white thumbs-up"></i>
                                    </a>
                                @endif
                                <a class="btn btn-info" href="{{URL:: to('view-order/'.$orders->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a id="delete" class="btn btn-danger" href="{{ route('orders.delete', $orders->id) }}">
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
