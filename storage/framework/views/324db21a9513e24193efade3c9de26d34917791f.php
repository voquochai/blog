<div class="navbar-custom">
    <ul class="list-unstyled topbar-right-menu float-right mb-0">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span>
                    <span class="account-user-name"><?php echo e(auth()->user()->name); ?></span>
                    <span class="account-position">Founder</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                <!-- item-->
                <form method="post" action="<?php echo e(route('admin.logout')); ?>" id="frm-logout">
                    <?php echo csrf_field(); ?>
                </form>
                <a href="javascript:;" class="dropdown-item notify-item" onclick="document.getElementById('frm-logout').submit();">
                    <i class="mdi mdi-logout"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
    <button class="button-menu-mobile open-left disable-btn">
        <i class="mdi mdi-menu"></i>
    </button>
    <div class="app-search">
        <form>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="mdi mdi-magnify"></span>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
</div>