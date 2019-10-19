@extends('backend.admin.layout.admin_layout')
@section('admin_content')

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('admin/dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">All Brands</a></li>
    </ul>

    <div class="container">
            <button  onclick="AddNew()" class="pull-right btn btn-success" style="margin: 17px;
    font-size: x-large;"><i class="fa fa-plus-circle"></i></button>
        <table class="table table-bordered data-table" id="BrandTable">
            <thead>
            <tr>
                <th>SI</th>
                <th>Brand Name</th>
                <th>Brand Description</th>
                <th>Brand Status</th>
                <th width="100">Actions</th>
            </tr>
            </thead>

            <tbody>
            </tbody>

        </table>
    </div>

   {{--  star model--}}
    @include('backend.admin.brand.modal')
   {{--  end model--}}

@endsection

@section('script')

    <script>

            $.ajaxSetup({
                headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
            });

            // start  data read
            var getDataUrl = "{{ route('brands.index') }}";
            var brandTable = $("#BrandTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: getDataUrl ,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},// t his line only for indexin
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
            // end data read

            // start  create new brand
            function reset() {
                $("#brandModal").find('input').each(function () {
                    $(this).val(null);
                });
                $("#description").val('');
                $("#status").parent().attr('class', '');

            }

            // click new add button then it will run
            function AddNew() {
                $("#modelTitle").text('New Brand');
                    reset();
                $("#brandModal").modal('show');
                $("#createtButton").show();
                $("#updatButton").hide();
                $(".brand_checkbox").show();
            }

            // get input fields value
            function getInputRecods() {
                var id = $('input[name="row_id"]').val();
                var name = $('input[name="name"]').val();
                var  description = $('textarea[name="description"]').val();
                var status =$('#status').parent().attr('class') == 'checked'? 1: 0;

                return{id: id, name: name, description: description, status: status}
            }


            // whene click create submit button then it will run
        function create() {

            $.ajax({ // call the ajax
               url: "{{ route('brands.store') }}",
                method: "POST",
                data: getInputRecods(),
                success: function (data) {
                    if(data.success){
                        brandTable.draw();// it will autometic table reload without refresh only for DataTable
                        toastr.success(data.message);
                    }
                    reset();
                    $("#brandModal").modal('hide');
                },
                error: function (error) {
                   var allErrors = JSON.parse(error.responseText);// to understand call json parse
                   var objArray = allErrors.errors;// it is make array boject
                    for (let elemete in objArray) {// it convert frome object array
                        var itemError =  objArray[elemete][0];// array index
                        toastr.error(itemError);// per single error
                    }
                }
            });
        }
 // end  create new brand

        //start edit and update
            $('table').on('click','.editBtn', function () {
                $("#modelTitle").text('Edit Brand');
                reset();
                $("#brandModal").modal('show');
                $("#createtButton").hide();
                $("#updatButton").show();
                $(".brand_checkbox").hide();


                // get text every row
                var id =$(this).data('id');
                var name =$(this).parent().parent().find('td').eq(1).text();
                var description =$(this).parent().parent().find('td').eq(2).text();

                // now insert into the modal form input field
                $('input[name="row_id"]').val(id);
                $('input[name="name"]').val(name);
                $('textarea[name="description"]').val(description);

            });


            // whene click the submit button
            function update() {
                var id =$("#row_id").val();
                $.ajax({
                    url: "{{ route('brands.update','') }}/"+id,
                    method: "PUT",
                    data: getInputRecods(),
                    success: function (data) {
                       if(data.success){
                           brandTable.draw();
                           toastr.success(data.message)
                       }
                        reset();
                        $("#brandModal").modal('hide');
                    },
                    error: function (error) {
                        var allErrors = JSON.parse(error.responseText);// to understand call json parse
                        var objArray = allErrors.errors;// it is make array boject
                        for (let elemete in objArray) {// it convert frome object array
                            var itemError =  objArray[elemete][0];// array index
                            toastr.error(itemError);// per single error
                        }
                    }
                })
            }
        //end edit and update


        // start delete
            $('table').on('click','.delBtn', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('brands.destroy','') }}/"+id,
                    method: "DELETE",
                    success: function (result) {
                        if(result.success){
                            brandTable.draw();
                            toastr.success(result.message)
                        }

                    }
                })
            })
        // end delete


        // start active unactive
            $('table').on('click','#ActiveUnactive', function () {
                var id = $(this).data('id');
                var statusNumber = $(this).attr('statusNumber');
                var setStatusNumber;


                if(statusNumber > 0){
                    setStatusNumber = 0
                }else{
                    setStatusNumber = 1
                }

                $.ajax({
                    url: "{{ route('brand.active.unactive') }}",
                    method: "POST",
                    data:{
                        id: id,
                        setStatusNumber: setStatusNumber,
                    },
                    success: function (result) {

                        if(result.success){
                            brandTable.draw();
                            toastr.success(result.message)
                        }
                    }

                })


            })
        // end active unactive


    </script>
@endsection
