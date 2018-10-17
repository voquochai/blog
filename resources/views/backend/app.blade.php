<!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <link href="" rel="shortcut icon">
        <link href="{{ asset('public/packages/material/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/packages/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/packages/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/packages/metismenu/metisMenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/packages/toast/toast.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/packages/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/packages/validationEngine/css/validationEngine.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/packages/waves/waves.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/backend/css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/backend/css/responsive.css') }}" rel="stylesheet" type="text/css">
        @yield('style')
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
                        @include('backend.blocks.message')
                        <!-- start page title -->
                        @include('backend.blocks.breadcrumb')
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
        <script type="text/javascript">
            window.Laravel = {!! json_encode([
                'baseUrl'   =>  url('/'),
                'currUrl'   =>  url()->current(),
                'csrf_token'=>  csrf_token(),
            ]) !!}
        </script>
        <script src="{{ asset('public/packages/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/axios.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/metismenu/metisMenu.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/toast/toast.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/validationEngine/js/validationEngine.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/validationEngine/js/languages/jquery.validationEngine-vi.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/waves/waves.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/jquery.mask.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/backend/js/app.js') }}" type="text/javascript"></script>
        @yield('script')
    </body>

</html>