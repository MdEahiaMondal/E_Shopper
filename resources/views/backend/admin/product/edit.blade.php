@extends('backend.admin.layout.admin_layout')
@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Update Product</a></li>
    </ul>
    <div class="row-fluid">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>
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

                <form enctype="multipart/form-data" method="post" action="{{url('update-product',$single_product->id)}}">
                    @csrf
                    <div class="span5">
                        <div class="form-group">
                            <label for="product_name"><h3>Product Name <sup class="text-danger">*</sup> </h3></label>
                            <input type="text" class="form-control" value="{{old('product_name')}} {{$single_product->name}}" id="product_name" placeholder="Enter Product Name" name="product_name">
                        </div>
                        {{-- <div class="form-group">
                             <label for="product_slug"><h3>Product Slug <sup class="text-danger">*</sup></h3></label>
                             <input type="text" class="form-control" value="{{old('product_slug')}}" id="product_slug" placeholder="Enter Product Name" name="product_slug">
                         </div>--}}

                        <div class="form-group">
                            <label for="product_price"><h3>Product Price <sup class="text-danger">*</sup></h3></label>
                            <input type="text" name="product_price" value="{{old('product_price')}} {{$single_product->price}}" id="product_price">
                        </div>

                        <div class="form-group">
                            <label for="product_quantity"><h3>Product Quantity <sup class="text-danger">*</sup></h3></label>
                            <input type="text" name="product_quantity" value="{{old('product_quantity')}} {{$single_product->quantity}}" id="product_quantity">
                        </div>

                        <div class="form-group">
                            <label for="product_size"><h3>Product Size</h3></label>
                            <input type="text" name="product_size" value="{{old('product_size')}} {{$single_product->size}}" id="product_size">
                        </div>

                        <div class="form-group">
                            <label for="product_color"><h3>Product Color</h3></label>
                            <input type="text" name="product_color" value="{{old('product_color')}} {{$single_product->color}}" id="product_color">
                        </div>

                        <div class="form-group form-check">
                            <label for="product_image"><h3>Product Image</h3></label>
                            <input accept="image/*" onchange="preview_image(event)" type="file" name="product_image" id="product_image">

                        </div>

                        <div class="form-group form-check">
                            <h2 class="">Preview</h2>
                            <img src="{{asset('images/product_image/'.$single_product->image)}}" id="output_image" alt="no photo">
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
                                    <option <?php if ($single_product->category_id == $category->id){echo 'selected';} ?>  value="{{$category->id}}">{{$category->name}}</option>
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
                                    <option <?php if ($single_product->brand_id == $brand->id){echo 'selected';} ?> value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description"><h3>Description <sup class="text-danger">*</sup></h3></label>
                            <textarea name="product_description" id="description" cols="30" rows="10">{{old('product_description')}} {{$single_product->description}}</textarea>
                        </div>


                    </div>
                    <div class="span3" style="margin: 20px">
                        <button type="submit" class="btn btn-warning">Update Product</button>
                        <p class="btn">Cancel</p>
                    </div>
                </form>

            </div>
        </div><!--/span-->
    </div><!--/row-->


@endsection
