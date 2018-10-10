<!DOCTYPE html>
    <html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
        
        <link href="" rel="shortcut icon">
        <link href="<?php echo e(asset('public/packages/material/css/materialdesignicons.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/bootstrap-select/css/bootstrap-select.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/metismenu/metisMenu.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/toast/toast.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/validationEngine/css/validationEngine.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/backend/css/app.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/backend/css/responsive.css')); ?>" rel="stylesheet" type="text/css">
        <?php echo $__env->yieldContent('style'); ?>
    </head>
    <body>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <?php echo $__env->make('backend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <?php echo $__env->make('backend.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <?php echo $__env->make('backend.blocks.message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <!-- start page title -->
                        <?php echo $__env->make('backend.blocks.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <!-- end page title -->
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                <?php echo $__env->make('backend.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->
        <script type="text/javascript">
            window.Laravel = <?php echo json_encode([
                'baseUrl'   =>  url('/'),
                'currUrl'   =>  url()->current(),
                'csrf_token'=>  csrf_token(),
            ]); ?>

        </script>
        <script src="<?php echo e(asset('public/packages/jquery.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/axios.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/bootstrap/js/bootstrap.bundle.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/bootstrap-select/js/bootstrap-select.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/metismenu/metisMenu.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/toast/toast.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/sweetalert2/sweetalert2.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/slimScroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/validationEngine/js/validationEngine.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/validationEngine/js/languages/jquery.validationEngine-vi.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/backend/js/app.js')); ?>" type="text/javascript"></script>
        <?php echo $__env->yieldContent('script'); ?>
    </body>

</html>