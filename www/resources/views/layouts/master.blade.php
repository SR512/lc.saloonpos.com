<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{config('constants.APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico')}}">
    @include('layouts.head')
    @toastr_css
</head>

<body data-layout="detached" data-topbar="colored">
{{--<body data-layout="detached" data-topbar="colored" data-keep-enlarged="true" class="vertical-collpsed">?--}}
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div class="container-fluid">
        <div id="layout-wrapper">
            @include('layouts.topbar')
            @include('layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                <!-- End Page-content -->
                @include('layouts.footer')
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
    </div>
    <!-- END container-fluid -->


    <!-- Right Sidebar -->
{{--    @include('layouts.right-sidebar')--}}
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts.footer-script')
    @toastr_js
    @toastr_render
</body>

</html>
