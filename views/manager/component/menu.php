<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div style="position:sticky;top:0;left:0;" class="pcoded-inner-navbar main-menu">
                <div class="">
                    <div class="main-menu-header">
                        <img style="height:60px;object-fit:cover;" class="img-80 img-radius" src="/<?php echo $_SESSION['userAdmin']['avatar']; ?>" alt="User-Profile-Image">
                        <div class="user-details">
                            <span id="more-details"><?php echo $_SESSION['userAdmin']['name']; ?></span>
                        </div>
                    </div>

                </div>
                <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Dashboard</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li style="margin:10px 0px;" class="active">
                        <a href="/admin" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Admin</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Users</div>
                    <li style="margin:10px 0px;" class="active">
                        <a href="/admin/customers" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Users</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Products</div>
                    <li style="margin:10px 0px;" class="active">
                        <a href="/admin/category" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-layout-grid2"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Categories</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li style="margin:10px 0px;" class="active">
                        <a href="/admin/product" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-server"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Products</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Orders &amp; Bills</div>
                    <li style="margin:10px 0px;" class="active">
                        <a href="/admin/orders" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-truck"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Order Details</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>



            </div>
        </nav>
        <div class="pcoded-content">