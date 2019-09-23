@extends('backend.admin.layout.admin_layout')
@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Add Product</a></li>
    </ul>
    <div class="row-fluid">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
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

                    <form enctype="multipart/form-data" method="post" action="{{url('insert-product')}}">
                       <div class="span">@csrf</div>
                        <div class="span5">
                            <div class="form-group">
                                <label for="product_name"><h3>Product Name <sup class="text-danger">*</sup> </h3></label>
                                <input type="text" class="form-control" value="{{old('product_name')}}" id="product_name" placeholder="Enter Product Name" name="product_name">
                            </div>
                           {{-- <div class="form-group">
                                <label for="product_slug"><h3>Product Slug <sup class="text-danger">*</sup></h3></label>
                                <input type="text" class="form-control" value="{{old('product_slug')}}" id="product_slug" placeholder="Enter Product Name" name="product_slug">
                            </div>--}}

                            <div class="form-group">
                                <label for="product_price"><h3>Product Price <sup class="text-danger">*</sup></h3></label>
                                <input type="text" name="product_price" value="{{old('product_price')}}" id="product_price">
                            </div>

                            <div class="form-group">
                                <label for="product_quantity"><h3>Product Quantity <sup class="text-danger">*</sup></h3></label>
                                <input type="text" name="product_quantity" value="{{old('product_quantity')}}" id="product_quantity">
                            </div>

                            <div class="form-group">
                                <label for="product_size"><h3>Product Size</h3></label>
                                <input type="text" name="product_size" value="{{old('product_size')}}" id="product_size">
                            </div>

                            <div class="form-group">
                                <label for="product_color"><h3>Product Color</h3></label>
                                <input type="text" name="product_color" value="{{old('product_color')}}" id="product_color">
                            </div>


                            <div class="form-group form-check">
                                <div class="span3">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="features_product" value="1">Features Product
                                    </label>
                                </div>

                                <div class="span3">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="product_status" value="1"> Product Status
                                    </label>
                                </div>

                            </div>

                        </div>

                        <div class="span5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"> <h3>Select Category <sup class="text-danger">*</sup></h3></label>
                                </div>
                                <select class="custom-select" id="inputGroupSelect01" name="category_id">
                                    <option selected>Choose...</option>
                                    @php
                                        $categories = \Illuminate\Support\Facades\DB::table('categories')->get();
                                    @endphp
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"> <h3>Select Brand <sup class="text-danger">*</sup></h3></label>
                                </div>
                                <select class="custom-select" id="inputGroupSelect01" name="brand_id">
                                    <option selected>Choose...</option>
                                    @php
                                        $brands = \Illuminate\Support\Facades\DB::table('brands')->get();
                                    @endphp
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description"><h3>Description <sup class="text-danger">*</sup></h3></label>
                                <textarea name="product_description" id="description" cols="30" rows="10">{{old('product_description')}}</textarea>
                            </div>

                            <div class="form-group form-check">
                                <label for="product_image"><h3>Product Image</h3></label>
                                <input accept="image/*" onchange="preview_image(event)" type="file" name="product_image" id="product_image">
                            </div>

                            <div class="form-group form-check">
                                <h2 class="">Preview</h2>
                                <img src="" id="output_image" alt="">
                            </div>

                        </div>
                        <div class="span3" style="margin: 20px">
                            <button type="submit" class="btn btn-warning">Add Product</button>
                            <p class="btn">Cancel</p>
                        </div>
                    </form>

            </div>
        </div><!--/span-->
    </div><!--/row-->


@endsection
