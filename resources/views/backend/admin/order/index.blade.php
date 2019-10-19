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
                <div class="container">
                    <table class="table table-bordered data-table" id="ordersTable">
                        <thead>
                            <tr>
                                <th>Si No</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Order Total</th>
                                <th>Payment Method</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div><!--/span-->

    </div><!--/row-->


    <!-- end: Content -->

@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
        });

        var ordersUrl = "{{ route('orders.index') }}";
        var ordersTable = $("#ordersTable").DataTable({
            processing: true,
            serverSide: true,
            ajax:ordersUrl,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'total', name: 'total' },
                { data: 'method', name: 'method' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]

        });

        // change status
        $(document).on('click', '#StatusChange', function () {
           var id = $(this).data('id');
           var getStatusNumber = $(this).attr('getStatusNumber');
           var setStatus;

           if(getStatusNumber > 0){
               setStatus = 0;
           }else{
               setStatus = 1;
           }

           $.ajax({
               url: "{{ route('order.changeStatus') }}",
               method: "POST",
               data: {
                 id: id,
                 setStatus: setStatus,
               },
               dataType: "JSON",
               success: function (feedBackResult) {
                   if (feedBackResult.success){
                       toastr.success(feedBackResult.message);
                       ordersTable.draw();
                   }
               }

           })


        });

        // click the view details
        $(document).on('click', '.ViewBtn', function () {
            var id = $(this).data('id');

            $.ajax({
                url: "{{ route('redirect.to.details.pages', '') }}/"+id,
                method: "GET",
                data: {id: id},
                dataType: "Json",
                success: function (feedBackResult) {
                    var id = feedBackResult.data.id;
                    window.location = "{{ route('orders.show','') }}/"+id; // send to others page
                }
            })
        })





    </script>
@endsection
