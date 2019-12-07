@extends('backend.admin.layout.admin_layout')

@section('title', 'Dashboard')

@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Dashboard</a></li>
    </ul>

    <div class="row-fluid">

        <a class="quick-button metro yellow span2">
            <i class="icon-group"></i>
            <p>Users</p>
            <span class="badge">{{ $users }}</span>
        </a>


        <a class="quick-button metro green span2">
            <i class="icon-barcode"></i>
            <p>Categories</p>
            <span class="badge">{{ $categorys }}</span>
        </a>

        <a class="quick-button metro green span2">
            <i class="icon-barcode"></i>
            <p>Brands</p>
            <span class="badge">{{ $brands }}</span>
        </a>

        <a class="quick-button metro green span2">
            <i class="icon-barcode"></i>
            <p>Sliders</p>
            <span class="badge">{{ $sliders }}</span>
        </a>


        <a class="quick-button metro green span2">
            <i class="icon-barcode"></i>
            <p>Products</p>
            <span class="badge">{{ $products }}</span>
        </a>

        <a class="quick-button metro red span2">
            <i class="icon-comments-alt"></i>
            <p>Comments</p>
            <span class="badge">{{ $comments }}</span>
        </a>

        <div class="clearfix"></div>

    </div><!--/row-->

    <br>
    <br>
    <br>

    <div class="row-fluid">
        <a class="quick-button metro blue span2">
            <i class="icon-shopping-cart"></i>
            <p>Orders</p>
            <span class="badge">{{ $orders }}</span>
        </a>

        <a class="quick-button metro pink span2">
            <i class="icon-envelope"></i>
            <p>Messages</p>
            <span class="badge">88</span>
        </a>


        <div class="clearfix"></div>

    </div><!--/row-->

@endsection
