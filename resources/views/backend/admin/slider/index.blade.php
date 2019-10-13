@extends('backend.admin.layout.admin_layout')
@section('admin_content')

    <!-- start: Content -->
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('admin/dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">All Slider</a></li>
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
                    <button  id="createNewSlider" class="pull-right btn btn-success" style="margin: 17px; font-size: x-large;"><i class="fa fa-plus-circle"></i></button>
                    <table class="table table-bordered data-table" id="SliderTable">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Slider Image</th>
                                <th>Slider Status</th>
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

    @include('backend.admin.slider.modal')

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

        function Slider_formReset(){
            $("#output_image").attr('src','');
            $(".filename").text('');
            $("#s_status").parent().removeClass('checked');
        }

        // first click the createNewSlider thene modal show
        $("#createNewSlider").click(function () {
            Slider_formReset();
            $("#sliderModal").modal('show')
        });


        // create edit update
        $("#sliderForm").on('submit', function (e) {
            e.preventDefault();

            // create the slider
            if($("#actionSubmitSlider").val() == 'create'){
                $.ajax({
                    url: "{{ route('sliders.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (feedBackResult) {
                        if(feedBackResult.success){
                            toastr.success(feedBackResult.message);
                            $("#SliderTable").DataTable().ajax.reload();
                            Slider_formReset();
                            $("#sliderModal").modal('hide')
                        }

                        if (feedBackResult.errors){
                            toastr.error(feedBackResult.errors)
                        }

                    }

                });
            }//end create slider







        });




    </script>

@endsection
