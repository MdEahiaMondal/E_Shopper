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

        var sliderUrl = "{{ route('sliders.index') }}";
        var sliderTable = $("#SliderTable").DataTable({
            processing: true,
            serverSide: true,
            ajax:sliderUrl,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'image',
                    name: 'image',
                    render: function (data,type, full, meta) {
                        return '<img class="img-thumbnail" style="width: 250px; height: 119px;" src="{{ asset('images/slider_image/') }}/'+data+'"/>';
                    },
                    orderable: false,
                },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]

        });
    </script>
@endsection
