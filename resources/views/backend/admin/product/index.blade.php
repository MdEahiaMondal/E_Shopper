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
                            <th>Features</th>
                            <th width="100">Actions</th>
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


        // start  data read
        var productUrl = "{{ route('products.index') }}";
        var productTable = $("#productTable").DataTable({
            processing: true,
            serverSide: true,
            ajax:productUrl,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'image',
                    name: 'image',
                    render: function (data,type, full, meta) {
                        return '<img class="img-thumbnail" style="width: 80px; height: 80px;" src="{{ asset('images/product_image/') }}/'+data+'"/>';
                    },
                    orderable: false,
                },
                { data: 'name',     name: 'name' },
                { data: 'slug',     name: 'slug' },
                { data: 'category', name: 'category' },
                { data: 'brand',    name: 'brand' },
                { data: 'price',    name: 'price' },
                { data: 'quantity', name: 'quantity' },
                { data: 'status',   name: 'status' },
                { data: 'features', name: 'features' },
                { data: 'action',   name: 'action', orderable: false, searchable: false },
            ]

        });
        // end data read



        // first whene click to create button thene we need to reset the form
        function productFormReset(){
            $("#productForm")[0].reset();
            $("#features").parent().attr('class', '');
            $("#status").parent().attr('class', '');
            $("#output_image").attr('src', '');
            $('#category_id').val('selectedCategoryValue');
            $('#brand_id').val('selectedBrandValue');
            $(".filename").text('No file selected');
            $("#features").parent().addClass('');
            $("#status").parent().addClass('');
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

        // finaly we create a product
        $("#productForm").on('submit', function (e) {
            e.preventDefault();

            // whene click the action button then create
            if ($("#actionButton").val() == "create"){
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('products.store') }}",
                    method: "POST",
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (feedBackResult) {

                        if (feedBackResult.errorsSlag){
                            toastr.error(feedBackResult.errorsSlag)
                        }

                        if(feedBackResult.errors){
                            var allErrors = feedBackResult.errors;

                            $("#error_Name").html('<div class="errorsProduct">'+allErrors.name[0]+'</div>');
                            $("#error_price").html('<div class="errorsProduct">'+allErrors.price[0]+'</div>');
                            $("#error_quantity").html('<div class="errorsProduct">'+allErrors.quantity[0]+'</div>');
                            $("#error_category_id").html('<div class="errorsProduct">'+allErrors.category_id[0]+'</div>');
                            $("#error_brand_id").html('<div class="errorsProduct">'+allErrors.brand_id[0]+'</div>');
                            $("#error_description").html('<div class="errorsProduct">'+allErrors.description[0]+'</div>');
                        }

                        if(feedBackResult.success){
                            toastr.success(feedBackResult.message);
                            $("#productModal").modal('hide');
                            $("#productTable").DataTable().ajax.reload();
                        }
                    }

                })
            } // end create


            // start edit and update
                if ($("#actionButton").val() == 'update'){
                    var id = $("#row_id").val();
                    let formData = new FormData(this);
                     formData.append('_method', 'put');
                    $.ajax({
                        url: "{{ route('products.update', '') }}/"+id,
                        method: "POST",
                        data: formData,
                        dataType: "JSON",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (feedBackResult) {
                           /* console.log(feedBackResult);*/

                            if (feedBackResult.errorsSlag){
                                toastr.error(feedBackResult.errorsSlag)
                            }

                            if(feedBackResult.errors){
                                var allErrors = feedBackResult.errors;

                                $("#error_Name").html('<div class="errorsProduct">'+allErrors.name[0]+'</div>');
                                $("#error_price").html('<div class="errorsProduct">'+allErrors.price[0]+'</div>');
                                $("#error_quantity").html('<div class="errorsProduct">'+allErrors.quantity[0]+'</div>');
                                $("#error_category_id").html('<div class="errorsProduct">'+allErrors.category_id[0]+'</div>');
                                $("#error_brand_id").html('<div class="errorsProduct">'+allErrors.brand_id[0]+'</div>');
                                $("#error_description").html('<div class="errorsProduct">'+allErrors.description[0]+'</div>');
                            }

                            if(feedBackResult.success){
                                toastr.success(feedBackResult.message);
                                $("#productModal").modal('hide');
                                $("#productTable").DataTable().ajax.reload();
                            }


                        }
                    })
                }
            // close edit and update



        }); // main form submit


        // start edit form and modal show
        $(document).on('click', '.editBtn', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "products/"+id+"/edit",
                method: "GET",
                data: {
                    id: id,
                },
                dataType: "JSON",
                success: function (feedBackResult) {
                    productFormReset();
                     $("#row_id").val(feedBackResult.data.id); // for hidden field
                     $("#productHiddenImageName").val(feedBackResult.data.image); // for hidden field


                     $("#name").val(feedBackResult.data.name);
                     $("#price").val(feedBackResult.data.price);
                     $("#quantity").val(feedBackResult.data.quantity);
                     $("#size").val(feedBackResult.data.size);
                     $("#color").val(feedBackResult.data.color);
                     $("#description").val(feedBackResult.data.description);
                     $("#category_id").append('<option selected value="'+feedBackResult.data.category.id+'">' + feedBackResult.data.category.name + '</option>');
                     $("#brand_id").append('<option selected value="'+feedBackResult.data.brand.id+'">' + feedBackResult.data.brand.name + '</option>');

                     if(feedBackResult.data.status == 1){
                         $("#status").attr('checked', true);// it's only get value
                         $("#status").parent().addClass('checked')// it's only show right singe
                     }

                     if(feedBackResult.data.features == 1){
                         $("#features").attr('checked', true);// it's only get value
                         $("#features").parent().addClass('checked')// it's only show right singe
                     }

                     $("#output_image").attr('src', '{{ asset('images/product_image') }}/' + feedBackResult.data.image + '');

                    $("#modelTitle").text('Edit Product');
                    $("#actionButton").text('Update');
                    $("#actionButton").val('update');
                    $("#productModal").modal('show');
                }

            })

        });
        // end edit form and modal show



        // start active unactive status
            $(document).on('click', '#statusActiveUnactive', function () {
                var id = $(this).data('id');
                var getStatusNumber = $(this).attr('statusNumber');
                var setStatusNumber;
                setStatusNumber = (getStatusNumber == 1)? 0: 1;
                $.ajax({
                    url: "{{ route('status.active.unactive') }}",
                    method: "POST",
                    data: {
                        id: id,
                        setStatusNumber: setStatusNumber,
                    },
                    dataType: "JSON",
                    success: function (feedBackResult) {
                        if(feedBackResult.success){
                            toastr.success(feedBackResult.message);
                            $("#productTable").DataTable().ajax.reload();
                        }
                    }
                });
            });
        // end active unactive status

        // start active unactive Features
            $(document).on('click', '#featuresActiveUnactive', function () {
                var id = $(this).data('id');
                var getFeaturesNumber = $(this).attr('featuresNumber');
                var setFeaturesNumber;
                setFeaturesNumber = (getFeaturesNumber == 1)? 0: 1;
                $.ajax({
                    url: "{{ route('features.active.unactive') }}",
                    method: "POST",
                    data: {
                        id: id,
                        setFeaturesNumber: setFeaturesNumber,
                    },
                    dataType: "JSON",
                    success: function (feedBackResult) {
                        if(feedBackResult.success){
                            toastr.success(feedBackResult.message);
                            $("#productTable").DataTable().ajax.reload();
                        }
                    }
                });
            });
        // end active unactive Features


        // start finaly delete the product
            $(document).on('click','.dlBtn', function () {
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('products.destroy', '') }}/"+id,
                    data:{id:id},
                    method: "DELETE",
                    dataType: "JSON",
                    success: function (feedBackResult) {
                        if(feedBackResult.success){
                            toastr.success(feedBackResult.message);
                            $("#productTable").DataTable().ajax.reload();
                        }

                    }
                })
            })
        // end delete the product


    </script>

@endsection
