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
            $(".filename").text('No file selected');
            $("#s_status").parent().removeClass('checked');
            $("#sliderForm")[0].reset();
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

        // start slider  update
           if($("#actionSubmitSlider").val() == 'edit'){
               /*var id = $("#s_id").val();
               var oldImage = $("#sliderHiddenImageName").val();
               var new_image = $("#s_image").val();
               var Attr = $("#s_status").parent().attr('class');
              if(Attr == "checked"){
                  var status = '1'
              }else{
                  var status = '0'
              }*/
              $.ajax({
                  url: "{{ route('sliders.update') }}",
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
              })


           }






        });

        // start click the edit button
        $(document).on('click','.editBtn', function () {
            var id = $(this).data('id');
            $.ajax({
               url: "sliders/" + id + "/edit",
                data: {id:id},
                dataType: "JSON",
                success: function (result) {
                   $("#s_id").val(result.data.id);

                    $("#output_image").attr('src','{{ asset('images/slider_image') }}/' + result.data.image + '');
                    $("#sliderHiddenImageName").val(result.data.image);

                    if (result.data.status == 1){
                        $("#s_status").parent().addClass('checked')
                    }else{
                        $("#s_status").parent().removeClass('checked')
                    }

                    $("#modelTitle").text('Edit Slider');
                    $("#actionSubmitSlider").text('Update');
                    $("#actionSubmitSlider").val('edit');
                    $("#sliderModal").modal('show');
                }
            });
        });
        // end click the edit button






    </script>

@endsection
