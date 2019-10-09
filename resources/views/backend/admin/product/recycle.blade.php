@extends('backend.admin.layout.admin_layout')
@section('admin_content')

    <!-- start: Content -->
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">All Product</a></li>
    </ul>

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
    <!-- Modal -->
    <div class="modal fade" id="productModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="deleteFormId" action="">
                    <div class="modal-body">
                        @csrf
                        {{method_field('delete')}}
                        <input type="hidden" name="id" id="delete_id">
                        <p>Are you sure want to delete the data ??</p>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


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
                        <th>Product ID</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product slug</th>
                        <th>Product Category</th>
                        <th>Product Brand</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    @foreach($all_product as $product)
                        <tbody>
                        <tr>
                            <td>{{$product->id}}</td>
                            <td class="center"><img width="75" src="{{asset('images/product_image/'.$product->image)}}" alt=""></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->slug}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                            <input type="hidden" value="{{$product->id}}">
                            <td>
                                <a title="undo" onclick="deleteData({{$product->id}})" class="btn btn-primary deletebtnAjex " href="{{URL::to('undo-product/'.$product->id)}}">
                                    Undo
                                </a>
                                <a title="Permanent Delete" onclick="deleteData({{$product->id}})" class="btn btn-danger deletebtnAjex " href="{{URL::to('delete-product/'.$product->id)}}">
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
@endsection

@section('script')

@endsection