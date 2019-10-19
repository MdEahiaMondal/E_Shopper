<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bootstrapmaster.com/live/metro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:56:12 GMT -->
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title> Admin</title>
    <meta name="description" content="Metro Admin Template.">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="csrf-token" content="{{ csrf_token() }}">{{-- for ajax--}}
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    @include('backend.admin.parsials.cssLink')

</head>

<body>

@include('backend.admin.parsials.headerTop') {{--header Top--}}

    <div class="container-fluid-full">
        <div class="row-fluid">

            <!-- start: Main Menu -->
        @include('backend.admin.parsials.sidebar')
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
            </div>
            <!-- end: Content -->

        </div><!-- end: row-fluid -->
    </div><!-- end: container-fluid-full"> -->


{{--<div class="modal hide fade" id="myModal">
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
</div>--}}

<div class="clearfix"></div>

<footer style="background: rgb(47, 64, 80);">

    <p>
        <span style="text-align:left;float:left">&copy; 2019 <a href="#0" alt="Bootstrap Themes">creative</a></span>
        <span class="hidden-phone" style="text-align:right;float:right">Powered by: <a href="#0">Md.Eahia Khan</a></span>
    </p>

</footer>



@include('backend.admin.parsials.script')
@yield('script')



</body>

<!-- Mirrored from bootstrapmaster.com/live/metro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:56:47 GMT -->
</html>
