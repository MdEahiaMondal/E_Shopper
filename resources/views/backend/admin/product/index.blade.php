@extends('backend.admin.layout.admin_layout')
@section('admin_content')

    <!-- start: Content -->
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('admin/dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">All Product</a></li>
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
                <div class="container">
                    <button  id="createNewProduct" class="pull-right btn btn-success" style="margin: 17px; font-size: x-large;"><i class="fa fa-plus-circle"></i></button>
                    <table class="table table-bordered data-table" id="productTable">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>slug</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Feture</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- end: Content -->

    @include('backend.admin.product.modal')

@endsection

@section('script')

    <script>

        $.ajaxSetup({
            headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
        });



        // first whene click to create button thene we need to reset the form
        function productFormReset(){
            $("#productForm")[0].reset();
            $("#features").parent().attr('class', '');
            $("#status").parent().attr('class', '');
            $("#output_image").attr('src', '');
            $(".filename").text('No file selected');
        }

        // modal show for create the product
        $("#createNewProduct").click(function () {
            productFormReset();
            $("#modelTitle").text('Create New Product');
            $("#actionButton").val('create');
            $("#productModal").modal('show');
        });


        //  show all category into the select field
       $(document).ready(function () {
               var categoryName = $("#category_id").attr('name');
                   $.ajax({
                       url: "{{ route('get.categoryBrand.data') }}",
                       method: "POST",
                       data:{categoryName:categoryName},
                       dataType: "JSON",
                       success: function (feedBackResult) {
                           $("#category_id").html(feedBackResult.data)
                       }
                   });
           });

        //  show all brand into the select field
       $(document).ready(function () {
               var brandName = $("#brand_id").attr('name');
                   $.ajax({
                       url: "{{ route('get.categoryBrand.data') }}",
                       method: "POST",
                       data:{brandName:brandName},
                       dataType: "JSON",
                       success: function (feedBackResult) {
                           $("#brand_id").html(feedBackResult.data)
                       }
                   });
           });

    </script>

@endsection
