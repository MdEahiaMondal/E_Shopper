@extends('backend.admin.layout.admin_layout')
@section('admin_content')

    <!-- start: Content -->
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Trash Products</a></li>
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
                <div class="row">
                    <div class="col-3">
                        <div class="pull-right">
                            <input type="text" placeholder="Search">
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered" id="productTable">
                    <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>slug</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Features</th>
                        <th width="100">Actions</th>
                    </tr>
                    </thead>

                    @foreach($TrashedProducts as $product)
                        <tbody>
                        <tr>
                            <td>{{$product->id}}</td>
                            <td class="center"><img width="75" src="{{ asset('images/product_image/'.$product->image) }}" alt=""></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->slug}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product->price}} TK</td>
                            @if($product->status == 1)
                                <td class="center">
                                    <a class="badge badge-success" href="{{URL::to('unactive-product/'.$product->id)}}">Active</a>
                                </td>
                            @else
                                <td class="center">
                                    <a class="badge badge-danger" href="{{URL::to('active-product/'.$product->id)}}">Unactive</a>
                                </td>
                            @endif

                            @if($product->features == 1)
                                <td class="center">
                                    <a class="badge badge-success" disabled="disabled" href="{{URL::to('unactive-product-feture/'.$product->id)}}">Active</a>
                                </td>
                            @else
                                <td class="center">
                                    <a class="badge badge-danger" href="#">Unactive</a>
                                </td>
                            @endif
                            <input type="hidden" value="{{$product->id}}">
                            <td>
                                <a title="undo" data-id="{{ $product->id }}" class="btn btn-primary undoTrash">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </a>
                                <a title="Permanent Delete" data-id="{{ $product->id }}" class="btn btn-danger dleTrashBtn">
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


    <script>

        $.ajaxSetup({
            headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
        });


        // start finaly delete the product
        $(document).on('click','.dleTrashBtn', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('products.destroy', '') }}/"+id,
                data:{id:id},
                method: "DELETE",
                dataType: "JSON",
                success: function (feedBackResult) {
                    if(feedBackResult.success){
                        toastr.success(feedBackResult.message);
                        $("#productTable").load(location.href + " #productTable");
                    }
                }
            })
        });
        // end delete the product


        // ,undo trsh delete
        $(document).on('click', '.undoTrash', function () {
            var id = $(this).data('id');

            $.ajax({
                url: "{{ route('undo.trash.product', '') }}/"+id,
                data:{id:id},
                method: "GET",
                dataType: "JSON",
                success: function (feedBackResult) {
                    if(feedBackResult.success){
                        toastr.success(feedBackResult.message);
                        $("#productTable").load(location.href + " #productTable");
                    }
                }
            })
        })


    </script>

@endsection




