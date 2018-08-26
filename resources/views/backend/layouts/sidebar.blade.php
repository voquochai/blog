<div class="left-side-menu">
    <div class="slimscroll-menu">

        <!-- LOGO -->
        <a href="index.html" class="logo text-center">
            <span class="logo-lg">
                <img src="assets/images/logo.png" alt="" height="16">
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo_sm.png" alt="" height="16">
            </span>
        </a>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="index.html" class="side-nav-link">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    <span class="badge badge-success float-right">7</span>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    <span> Apps </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="apps-calendar.html">Calendar</a>
                    </li>
                    <li class="side-nav-item">
                        <a href="javascript: void(0);" aria-expanded="false">Projects
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="side-nav-third-level" aria-expanded="false">
                            <li>
                                <a href="apps-projects-list.html">List</a>
                            </li>
                            <li>
                                <a href="apps-projects-details.html">Details</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="apps-tasks.html">Tasks</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    <span> Pages </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="pages-starter.html">Starter Page</a>
                    </li>
                    <li>
                        <a href="pages-profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="pages-invoice.html">Invoice</a>
                    </li>
                    <li>
                        <a href="pages-faq.html">FAQ</a>
                    </li>
                    <li>
                        <a href="pages-pricing.html">Pricing</a>
                    </li>
                    <li>
                        <a href="pages-maintenance.html">Maintenance</a>
                    </li>
                    <li>
                        <a href="pages-login.html">Login</a>
                    </li>
                    <li>
                        <a href="pages-register.html">Register</a>
                    </li>
                    <li>
                        <a href="pages-logout.html">Logout</a>
                    </li>
                    <li>
                        <a href="pages-recoverpw.html">Recover Password</a>
                    </li>
                    <li>
                        <a href="pages-lock-screen.html">Lock Screen</a>
                    </li>
                    <li>
                        <a href="pages-confirm-mail.html">Confirm Mail</a>
                    </li>
                    <li>
                        <a href="pages-404.html">Error 404</a>
                    </li>
                    <li>
                        <a href="pages-404-alt.html">Error 404-alt</a>
                    </li>
                    <li>
                        <a href="pages-500.html">Error 500</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    <span> Layouts </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="layouts-horizontal.html">Horizontal</a>
                    </li>
                    <li>
                        <a href="layouts-light-sidenav.html">Light Sidenav</a>
                    </li>
                    <li>
                        <a href="layouts-collapsed.html">Collapsed Sidenav</a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="right-bar-toggle">Right Sidebar</a>
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