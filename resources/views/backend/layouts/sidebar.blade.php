<div class="left-side-menu">
    <div class="slimscroll-menu">

        <!-- LOGO -->
        <a href="index.html" class="logo text-center">
            {{--
            <span class="logo-lg">
                <img src="assets/images/logo.png" alt="" height="16">
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo_sm.png" alt="" height="16">
            </span>
            --}}
        </a>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    <span class="badge badge-success float-right">7</span>
                    <span> Bảng điều khiển </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    <span> Sản phẩm </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('admin.categories.index', ['type'=>'san-pham']) }}">Danh mục</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.suppliers.index', ['type'=>'default']) }}">Nhà cung cấp</a>
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
                        <a href="{{ route('admin.users.index', ['type'=>'mod']) }}"> Tài khoản </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>