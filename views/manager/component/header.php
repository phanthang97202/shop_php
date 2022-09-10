<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản Trị Admin</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes" />

    <link rel="icon" href="/assets/upload/logoo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/assets/themify-icons/themify-icons.css">

    <link rel="stylesheet" href="https://lite.codedthemes.com/mega-able-html/assets/pages/waves/css/waves.min.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="https://lite.codedthemes.com/mega-able-html/assets/css/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://lite.codedthemes.com/mega-able-html/assets/pages/waves/css/waves.min.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="/assets/fontawesome-free-6.1.1-web/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://lite.codedthemes.com/mega-able-html/assets/css/jquery.mCustomScrollbar.css">

    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

    <link rel="stylesheet" type="text/css" href="https://lite.codedthemes.com/mega-able-html/assets/css/style.css">
    <script async src='https://lite.codedthemes.com/cdn-cgi/challenge-platform/h/g/scripts/invisible.js?ts=1655812800'></script>

</head>

<body>

    <style>
        body::-webkit-scrollbar {
            width: 8px;
        }

        body::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 6px;
        }
    </style>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i style="margin-left:18px;font-size:22px;" class="ti-menu"></i>
                        </a>

                        <a href="/">
                            <!-- <img class="img-fluid" src="https://lite.codedthemes.com/mega-able-html/assets/images/logo.png" alt="Theme-Logo" /> -->
                            <img width="44px;margin-right:10px;" class="img-fluid" src="/assets/upload/logoo.png" alt="Theme-Logo" />
                            <span><b>&nbsp;&nbsp;Mobile Store</b></span>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle">
                                    <a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-red"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                </ul>
                            </li>

                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <img style="height:40px;object-fit:cover;" src="/<?php echo $_SESSION['userAdmin']['avatar']; ?>" class="img-radius" alt="User-Profile-Image">
                                    <span>
                                        <?php echo $_SESSION['userAdmin']['name']; ?>
                                    </span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a href="#!">
                                            <i class="ti-settings"></i> Settings
                                        </a>
                                    </li>

                                    <li class="waves-effect waves-light">
                                        <a href="/admin/logout">
                                            <i class="ti-power-off"></i> Log Out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>