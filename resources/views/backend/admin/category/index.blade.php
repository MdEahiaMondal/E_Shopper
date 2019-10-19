@extends('backend.admin.layout.admin_layout')
@section('admin_content')

    <button onclick="AddNew()" id="showForm" title="New Category"><i class="fa fa-plus" aria-hidden="true"></i></button>
    <style>

        #showForm {
            right: -2px;
            z-index: 99;
            font-size: 17px;
            border: none;
            outline: none;
            background-color: #0d8e35;
            color: white;
            cursor: pointer;
            padding: 13px;
            border-radius: 7px;
            position: fixed;
        }

        #showForm:hover {
            background-color: #555;
        }
    </style>


    <!-- start: Content -->
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{url('dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">All Category</a></li>
        </ul>

    <div class="container">
    <table class="table table-bordered data-table" id="categoryTable">
        <thead>
        <tr>
            <th>SI</th>
            <th>Category Name</th>
            <th>Category Description</th>
            <th>Category Status</th>
            <th width="100">Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>



  {{--  // modal here--}}
    @include('backend.admin.category.modal')
    {{-- // modal here--}}

@endsection

@section('script')
    <script>

        $.ajaxSetup({
            headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
        });

        // start data read
        var getDataUrl = "{{ route('categories.index') }}";
        var categoryTable = $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: getDataUrl,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
        });

        // end data read


        // start unactive active
        $('table').on('click', "#ActiveUnactive", function () {
            var getStatus = $(this).attr('status');
            var id = $(this).data('id');

            var setStatus = (getStatus > 0)? 0: 1;

            $.ajax({
               url: "{{ route('categories.activeUnctive') }}",
                method: "POST",
                data:{
                   status: setStatus,
                   id: id,
                },
                success: function (data) {
                    categoryTable.draw();
                    toastr.success(data);
                },
                error: function (data) {
                    toastr.error(data);
                }

            });


        });
        // end unactive active






        // start for create new
        function reset() {
            $("#categoryModal").find('input').each(function () {
                $(this).val(null);
            });
            $("#description").val('');
            $("#status").parent().attr('class', '');
        }

        function getInputs() {
            var id = $('input[id="row_id"]').val();
            var name = $('input[name="name"]').val();
            var description = $('textarea[name="description"]').val();
            var status = $("#status").parent().attr('class')=='checked'? 1 : 0;

            return {id: id, name: name, description: description, status: status};
        }

        function AddNew() {
            $("#modelTitle").text('New Category');
            reset();
            $("#categoryModal").modal('show');
            $("#createtButton").show();
            $("#updatButton").hide();
            $(".hideStatus").show();


        }

        function store() {
            /*if (!confirm('Are you sure?')) return;*/
           $.ajax({
               url: "{{ route('categories.store') }}",
               method: "POST",
               dataType: "JSON",
               data: getInputs(),
               success: function (data) {
                   if(data.success){
                       categoryTable.draw();// it will autometic table reload without refresh only for DataTable
                       toastr.success(data.message);
                   }
                   reset();// our created
                   $("#categoryModal").modal('hide');
                   categoryTable.draw();
               },
               error: function (error) {
                  var allerror = JSON.parse(error.responseText);// to understand call json parse
                  var error_object = allerror.errors; // it is make array boject

                   for (let elemete in error_object) { // it convert frome object array
                       var itemError =  error_object[elemete][0];
                       toastr.error(itemError);// per single error
                   }
               }
           });

        }
        // end of create new



        // start for edit and update
        $('table').on('click','.editBtn', function () {
            $("#modelTitle").text('Edit Category');
            reset();
            $("#categoryModal").modal('show');
            $("#createtButton").hide();
            $("#updatButton").show();
            $(".hideStatus").hide();


            // take value each line
            var id = $(this).data('id');
            var name = $(this).parent().parent().find('td').eq(1).text();
            var description = $(this).parent().parent().find('td').eq(2).text();

            $('input[name="row_id"]').val(id);
            $('input[name="name"]').val(name);
            $('textarea[name="description"]').val(description);
        });

      // whene click the update button
        function update() {
            var id = $("#row_id").val();
            $.ajax({
                url: "{{ route('categories.update',"") }}/"+id,
                method: "PUT",
                dataType: "JSON",
                data: getInputs(),
                success: function (data) {
                    if(data.success){
                        toastr.success(data.message);
                        categoryTable.draw();
                    }
                    reset();
                    $("#categoryModal").modal('hide');
                    categoryTable.draw();
                },
                error:  function (error) {
                    var allerror = JSON.parse(error.responseText);
                    var error_object = allerror.errors;

                    for (let elemete in error_object) {
                        var itemError =  error_object[elemete][0];
                        toastr.error(itemError);
                    }
                }
            });
        }

        // end of edit and update



        // start of delete
        $('table').on('click', '.dlBtn', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('categories.destroy','id') }}",
                method: "DELETE",
                dataType: "JSON",
                data: {
                   id:id,
                },
                success: function (feedBackResult) {

                    if(feedBackResult.error){
                        toastr.error(feedBackResult.message);
                    }
                    if(feedBackResult.success){
                        toastr.success(feedBackResult.message);
                        categoryTable.draw();
                    }
                },

            });
        })

        // end of delete

    </script>
@endsection

