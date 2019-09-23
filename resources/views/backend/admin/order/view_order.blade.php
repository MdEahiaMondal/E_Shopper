@extends('backend.admin.layout.admin_layout')
@section('admin_content')
    <div class="row-fluid sortable">
        <div class="box span5">
            <div class="box-header">
                <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Customer Details</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order_info->user->name}}</td>
                        <td class="center">{{$order_info->user->email}}</td>
                        <td class="center">{{$order_info->user->phone}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->

        <div class="box span7">
            <div class="box-header">
                <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Shipping Details</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Shipping Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order_info->shipping->first_name}} {{$order_info->shipping->last_name}}</td>
                        <td class="center">{{$order_info->shipping->email}}</td>
                        <td class="center">{{$order_info->shipping->address}}</td>
                        <td class="center">{{$order_info->shipping->city}}</td>
                        <td class="center">{{$order_info->shipping->phone}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header">
                <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Order Products</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th> Image</th>
                        <th> price</th>
                        <th> quantity</th>
                        <th> Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_info->order_details as $info)
                        <tr>
                            <td>{{$info->product_name}}</td>
                            <td><img width="100" src="{{asset('images/product_image/'.$info->product->image)}}" alt=""></td>
                            <td>{{$info->product_price}}</td>
                            <td>{{$info->product_sales_quantity}}</td>
                            <td>{{ $info->product_price * $info->product_sales_quantity}} </td>
                        </tr>
                    @endforeach

                        <tr>
                            <td colspan="4"></td>
                            <td>{{ $order_info->first()->total }} Tk <sup>with tax</sup></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div><!--/row-->

@endsection
