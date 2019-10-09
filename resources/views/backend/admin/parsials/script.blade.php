
<!-- start: JavaScript-->
<script src="{{asset('backend/js/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/jquery-migrate-1.0.0.min.js')}}"></script>
<script src="{{asset('backend/js/jquery-ui-1.10.0.custom.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.ui.touch-punch.js')}}"></script>
<script src="{{asset('backend/js/modernizr.js')}}"></script>
<script src="{{asset('backend/js/jquery.cookie.js')}}"></script>
<script src='{{asset('backend/js/fullcalendar.min.js')}}'></script>
{{--<script src='{{asset('backend/js/jquery.dataTables.min.js')}}'></script>--}}
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script src="{{asset('backend/js/excanvas.js')}}"></script>
<script src="{{asset('backend/js/jquery.flot.js')}}"></script>
<script src="{{asset('backend/js/jquery.flot.pie.js')}}"></script>
<script src="{{asset('backend/js/jquery.flot.stack.js')}}"></script>
<script src="{{asset('backend/js/jquery.flot.resize.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.chosen.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.uniform.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.cleditor.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.noty.js')}}"></script>
<script src="{{asset('backend/js/jquery.elfinder.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.raty.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.iphone.toggle.js')}}"></script>
<script src="{{asset('backend/js/jquery.uploadify-3.1.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.imagesloaded.js')}}"></script>
<script src="{{asset('backend/js/jquery.masonry.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.knob.modified.js')}}"></script>
<script src="{{asset('backend/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('backend/js/counter.js')}}"></script>
<script src="{{asset('backend/js/retina.js')}}"></script>
<script src="{{asset('backend/js/custom.js')}}"></script>
<script src="{{asset('backend/sweat_aleart/sweataleart.min.js')}}"></script>

<!-- end: JavaScript-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> {{--// for toastr popup--}}


<script>
    $(document).on('click','#delete', function (e) {
        e.preventDefault();
        var  form_id = $(this).attr('form_id');
        bootbox.confirm('Are you want to delete!!', function (confirmed) {
            if(confirmed){
                document.getElementById(form_id).submit();
            };
        });
    });
</script>

{{--<script>

    $(function()
    {
        @if(Session('success'))
            Swal.fire("Successful!", "{{ Session('success') }} {{Session::put('success',null)}}", "success");
        @endif

        @if(Session('error'))
            Swal.fire("Warning!", "{{ Session('error') }} {{Session::put('error',null)}}", "error");
        @endif
    });

</script>--}}

{{--Preview Image Before Upload Using JavaScript--}}
<script type='text/javascript'>
    function preview_image(event)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

{{--// delete ajax--}}
{{--<script>
    $('.deletebtnAjex').on('click',function () {
        $('#productModel').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function () {
            return $(this).text();
        }).get();
        console.log(data)
        $('#delete_id').val(data[0]);
    });

$('#deleteFormId').on('submit',function (e) {
    e.preventDefault();
    var id = $('#delete_id').val();

    $.ajax({
       type:"DELETE",
        url:"/delete-product/"+id,
        data:$('#deleteFormId').serialize(),
        success:function (response) {
            console.log(response);
            $('#productModel').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Your work has been delete done',
                    showConfirmButton: false,
                    timer: 1500
                });
            location.reload()
        },
        error:function (error) {
                $("#productModel").modal('hide');
                Swal.fire({
                    position: 'top-end',
                    type: 'warning',
                    title: 'Your work has been not delete',
                    showConfirmButton: false,
                    timer: 2500
                });
            location.reload()
        }



    });
})

</script>--}}
{{--// delete ajax--}}


{{--<script>
    function deleteData(id) {
        alert(id);
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });



    }// end of function
</script>--}}

{{--<script>
    $(".deleteRecord").click(function(){
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax(
            {
                url: "/delete-product/"+id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function (){
                    console.log("it Works");
                    location.reload();
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Your work has been delete done',
                        showConfirmButton: false,
                        timer: 1500
                    });

                },
                error:function () {
                    alert('error')
                }
            });

    });
</script>--}}

{{--<script>
    $(document).on('click','.deleteData', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
       $.ajax({
           url: "{{ url('delete-product') }}/"+id,
           method:'DELETE',
           success: function (response) {
                   alert(response);
           },
           error:function (error) {
               alert(error)
           }
       })
    })
</script>--}}
