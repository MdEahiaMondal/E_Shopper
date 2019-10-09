<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bootstrapmaster.com/live/metro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:56:12 GMT -->
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>Metro Admin Template - Metro UI Style Bootstrap Admin Template</title>
    <meta name="description" content="Metro Admin Template.">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="csrf-token" content="{{ csrf_token() }}">{{-- for ajax--}}
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->
    <!-- start: CSS -->
    <link id="bootstrap-style" href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
    <link id="base-style" href="{{asset('backend/css/style.css')}}" rel="stylesheet">
    <link id="base-style-responsive" href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"> {{--// for toastr popup--}}

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- end: CSS -->

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- end: Favicon -->

</head>

<body>
<!-- start: Header -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="index.html"><span>Metro</span></a>

            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
                    <li class="dropdown hidden-phone">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white warning-sign"></i>
                        </a>
                        <ul class="dropdown-menu notifications">
                            <li class="dropdown-menu-title">
                                <span>You have 11 notifications</span>
                                <a href="#refresh"><i class="icon-repeat"></i></a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon blue"><i class="icon-user"></i></span>
                                    <span class="message">New user registration</span>
                                    <span class="time">1 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon green"><i class="icon-comment-alt"></i></span>
                                    <span class="message">New comment</span>
                                    <span class="time">7 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon green"><i class="icon-comment-alt"></i></span>
                                    <span class="message">New comment</span>
                                    <span class="time">8 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon green"><i class="icon-comment-alt"></i></span>
                                    <span class="message">New comment</span>
                                    <span class="time">16 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon blue"><i class="icon-user"></i></span>
                                    <span class="message">New user registration</span>
                                    <span class="time">36 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon yellow"><i class="icon-shopping-cart"></i></span>
                                    <span class="message">2 items sold</span>
                                    <span class="time">1 hour</span>
                                </a>
                            </li>
                            <li class="warning">
                                <a href="#">
                                    <span class="icon red"><i class="icon-user"></i></span>
                                    <span class="message">User deleted account</span>
                                    <span class="time">2 hour</span>
                                </a>
                            </li>
                            <li class="warning">
                                <a href="#">
                                    <span class="icon red"><i class="icon-shopping-cart"></i></span>
                                    <span class="message">Transaction was canceled</span>
                                    <span class="time">6 hour</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon green"><i class="icon-comment-alt"></i></span>
                                    <span class="message">New comment</span>
                                    <span class="time">yesterday</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon blue"><i class="icon-user"></i></span>
                                    <span class="message">New user registration</span>
                                    <span class="time">yesterday</span>
                                </a>
                            </li>
                            <li class="dropdown-menu-sub-footer">
                                <a>View all notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- start: Notifications Dropdown -->
                    <li class="dropdown hidden-phone">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white tasks"></i>
                        </a>
                        <ul class="dropdown-menu tasks">
                            <li class="dropdown-menu-title">
                                <span>You have 17 tasks in progress</span>
                                <a href="#refresh"><i class="icon-repeat"></i></a>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">iOS Development</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim red">80</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">Android Development</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim green">47</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">Django Project For Google</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim yellow">32</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">SEO for new sites</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim greenLight">63</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">New blog posts</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim orange">80</div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-menu-sub-footer">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- end: Notifications Dropdown -->
                    <!-- start: Message Dropdown -->
                    <li class="dropdown hidden-phone">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white envelope"></i>
                        </a>
                        <ul class="dropdown-menu messages">
                            <li class="dropdown-menu-title">
                                <span>You have 9 messages</span>
                                <a href="#refresh"><i class="icon-repeat"></i></a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img src="{{asset('backend/img/avatar.jpg')}}" alt="Avatar"></span>
                                    <span class="header">
											<span class="from">
										    	Łukasz Holeczek
										     </span>
											<span class="time">
										    	6 min
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img src="{{asset('backend/img/avatar2.jpg')}}" alt="Avatar"></span>
                                    <span class="header">
											<span class="from">
										    	Megan Abott
										     </span>
											<span class="time">
										    	56 min
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img src="{{asset('backend/img/avatar3.jpg')}}" alt="Avatar"></span>
                                    <span class="header">
											<span class="from">
										    	Kate Ross
										     </span>
											<span class="time">
										    	3 hours
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img src="{{asset('backend/img/avatar4.jpg')}}" alt="Avatar"></span>
                                    <span class="header">
											<span class="from">
										    	Julie Blank
										     </span>
											<span class="time">
										    	yesterday
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img src="{{asset('backend/img/avatar5.jpg')}}" alt="Avatar"></span>
                                    <span class="header">
											<span class="from">
										    	Jane Sanders
										     </span>
											<span class="time">
										    	Jul 25, 2012
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-menu-sub-footer">View all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- end: Message Dropdown -->
                    <li>
                        <a class="btn" href="#">
                            <i class="halflings-icon white wrench"></i>
                        </a>
                    </li>
                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> <?php $admin = \App\Admin::first()?>{{$admin->name}}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <span>Account Settings</span>
                            </li>
                            <li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="halflings-icon off"></i> {{ __('Logout') }}
                                    </a>
                                </form></li>
                        </ul>
                    </li>
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li><a href="{{URL::to('dashboard')}}"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Category</span><span class="label label-important"></span></a>
                        <ul>
                            <li><a class="submenu" href="{{route('categories.index')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Categories</span></a></li>
                            <li><a class="submenu" href="{{route('categories.create')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Category</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Brand</span><span class="label label-important"></span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('all-brand')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Brands</span></a></li>
                            <li><a class="submenu" href="{{URL::to('add-brand')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Brand</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Product</span><span class="label label-important"></span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('all-product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Products</span></a></li>
                            <li><a class="submenu" href="{{URL::to('add-product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Product</span></a></li>
                            <li><a class="submenu" href="{{URL::to('recycle-product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Recycle Bin</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Slider</span><span class="label label-important"></span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('add-slider')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Add Slider</span></a></li>
                            <li><a class="submenu" href="{{URL::to('all-slider')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Slider</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Order</span><span class="label label-important"></span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('all-order')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Orders</span></a></li>
                        </ul>
                    </li>
                    <li><a href="form.html"><i class="icon-edit"></i><span class="hidden-tablet"> Social Links</span></a></li>
                    <li><a href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Delevaries Man</span></a></li>
                    <li><a href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Shop Name</span></a></li>
                </ul>
            </div>
        </div>
        <!-- end: Main Menu -->

        <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

        <!-- start: Content -->
        <div id="content" class="span10">
            @yield('admin_content')
        </div><!--/row-->



        </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>

<div class="clearfix"></div>

<footer>

    <p>
        <span style="text-align:left;float:left">&copy; 2013 <a href="http://bootstrapmaster.com/" alt="Bootstrap Themes">creativeLabs</a></span>
        <span class="hidden-phone" style="text-align:right;float:right">Powered by: <a href="http://admintemplates.co/" alt="Bootstrap Admin Templates">Metro</a></span>
    </p>

</footer>




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

@yield('script')





</body>

<!-- Mirrored from bootstrapmaster.com/live/metro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:56:47 GMT -->
</html>