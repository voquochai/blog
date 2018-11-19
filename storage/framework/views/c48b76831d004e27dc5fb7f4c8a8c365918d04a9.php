<div class="left-side-menu">
    <div class="slimscroll-menu">

        <!-- LOGO -->
        <a href="index.html" class="logo text-center">
            
        </a>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="side-nav-link">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    <span class="badge badge-success float-right">7</span>
                    <span> Bảng điều khiển </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link waves-light">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    <span> Sản phẩm </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="<?php echo e(route('admin.categories.index', ['type'=>'san-pham'])); ?>">Danh mục</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.suppliers.index', ['type'=>'default'])); ?>">Nhà cung cấp</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.attributes.index', ['type'=>'product_color'])); ?>">Color</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.products.index', ['type'=>'san-pham'])); ?>">Sản phẩm</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-title side-nav-item mt-1">Components</li>

            <li class="side-nav-item">
                <a href="javascript:;" class="side-nav-link">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    <span> Quản trị </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="maps-vector.html">Nhóm quyền</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.users.index', ['type'=>'mod'])); ?>"> Tài khoản </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>