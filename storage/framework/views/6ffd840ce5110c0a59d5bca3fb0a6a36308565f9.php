<!DOCTYPE html>
    <html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8" />
        <title>Administrator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="" rel="shortcut icon">
        <link href="<?php echo e(asset('public/packages/material/css/materialdesignicons.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/metismenu/metisMenu.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/toast/toast.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/packages/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/backend/css/app.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/backend/css/responsive.css')); ?>" rel="stylesheet" type="text/css">
        <?php echo $__env->yieldContent('style'); ?>
    </head>
    <body>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <?php echo $__env->make('backend.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <?php echo $__env->make('backend.layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <?php echo $__env->make('backend.blocks.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <!-- start page title -->
                        <?php echo $__env->make('backend.blocks.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <!-- end page title -->
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                <?php echo $__env->make('backend.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->
        <script src="<?php echo e(asset('public/packages/jquery.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/bootstrap/js/bootstrap.bundle.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/metismenu/metisMenu.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/toast/toast.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/sweetalert2/sweetalert2.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/slimScroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/backend/js/app.js')); ?>" type="text/javascript"></script>
        <?php echo $__env->yieldContent('script'); ?>
    </body>

</html>