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
                                <th>Image</th>
                                <th>Slug</th>
                                <th>Status</th>
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
                { data: 'slug', name: 'slug' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]

        });

        function Slider_formReset(){
            $("#output_image").attr('src','');
            $(".filename").text('No file selected');
            $("#status").parent().removeClass('checked');
            $("#sliderForm")[0].reset();
        }

        // first click the createNewSlider thene modal show
        $("#createNewSlider").click(function () {
            Slider_formReset();
            $("#status").parent().removeClass('checked');
            $("#sliderModal").modal('show');
            $("#actionSubmitSlider").val('create')
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
               var id = $("#s_id").val();
               let formData = new FormData(this);
               formData.append('_method', 'put');

              $.ajax({
                  url: "{{ route('sliders.update','') }}/"+id,
                  method: "POST",
                  data: formData,
                  dataType: "JSON",
                  contentType: false,
                  cache: false,
                  processData: false,
                  success: function (feedBackResult) {

                      console.log(feedBackResult);

                      if(feedBackResult.success){
                          toastr.success(feedBackResult.message);
                          $("#SliderTable").DataTable().ajax.reload();
                          Slider_formReset();
                          $("#sliderModal").modal('hide')
                      }

                      if (feedBackResult.errors){
                          toastr.error(feedBackResult.errors.s_image)
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
                        $("#status").attr('checked', true);// it's only get value
                        $("#status").attr('value', 1);// it's only get value
                        $("#status").parent().addClass('checked');
                    }else{
                        $("#status").parent().removeClass('checked');
                        $("#status").attr('checked', false);// it's only get value
                    }

                    $("#modelTitle").text('Edit Slider');
                    $("#actionSubmitSlider").text('Update');
                    $("#actionSubmitSlider").val('edit');
                    $("#sliderModal").modal('show');
                }
            });
        });
        // end click the edit button


        // start active unactive script
        $(document).on('click', '#ActiveUnactive',function () {
            var id = $(this).data('id');
            var statusNumber = $(this).attr('statusNumber');
           var getStatusNumber =  (statusNumber==1)? 0:1;

           $.ajax({
               url: "{{ route('slider.active.unactive') }}",
               method: "POST",
               dataType: "JSON",
               data: {
                   id: id,
                   getStatusNumber: getStatusNumber,
               },
               success: function (feedBackResult) {
                   toastr.success(feedBackResult.success);
                   $('#SliderTable').DataTable().ajax.reload();
               }
           })

        });
        // end active unactive script

        // now  delete per item
        $(document).on('click', '.delBtn', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('sliders.destroy','') }}/"+id,
                method: "DELETE",
                dataType: "JSON",
                data: {id:id},
                success: function (feed_back_result) {
                    toastr.success(feed_back_result.success);
                    $('#SliderTable').DataTable().ajax.reload();
                }
            })
        }); // close delete script





    </script>

@endsection
