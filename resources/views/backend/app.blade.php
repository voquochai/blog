<!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <title>Administrator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="" rel="shortcut icon">
        <link href="{{ asset('public/packages/material/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/packages/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/packages/metismenu/metisMenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/backend/css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/backend/css/responsive.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            @include('backend.layouts.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    @include('backend.layouts.header')
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        @include('backend.layouts.breadcrumb')
                        <!-- end page title -->
                        @yield('content')
                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                @include('backend.layouts.footer')
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->
        <script src="{{ asset('public/packages/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/metismenu/metisMenu.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/backend/js/app.js') }}" type="text/javascript"></script>
    </body>

</html>