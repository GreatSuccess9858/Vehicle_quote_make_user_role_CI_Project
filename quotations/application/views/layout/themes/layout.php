<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Urora - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="<?php echo base_url() ?>themes/images/favicon.ico">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/plugins/fullcalendar/vanillaCalendar.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/plugins/jvectormap/jquery-jvectormap-2.0.2.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/plugins/metro/MetroJs.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>themes/plugins/carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/plugins/carousel/owl.theme.default.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>themes/plugins/animate/animate.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/css/bootstrap-material-design.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/css/icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/css/style.css" type="text/css">

</head>


<body class="fixed-left">

<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<!-- Begin page -->
<div id="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
            <i class="mdi mdi-close"></i>
        </button>

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> Urora</a>-->
                <a href="index.html" class="logo">
                    <img src="<?php echo base_url() ?>themes/images/logo-lg.png" alt="" class="logo-large">
                </a>
            </div>
        </div>

        <div class="sidebar-inner slimscrollleft" id="sidebar-main">

            <div id="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>

                    <li>
                        <a href="index.html" class="waves-effect">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span> Dashboard
                                        <span class="badge badge-pill badge-primary float-right">7</span>
                                    </span>
                        </a>
                    </li>

                    <li>
                        <a href="calendar.html" class="waves-effect">
                            <i class="mdi mdi-calendar-clock"></i>
                            <span> Calendar </span>
                        </a>
                    </li>
                    <li class="menu-title">Components</li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-animation"></i>
                            <span> UI Elements </span>
                            <span class="float-right">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                        </a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="ui-badge.html">Badge</a>
                            </li>
                            <li>
                                <a href="ui-alertify.html">Alertify</a>
                            </li>
                            <li>
                                <a href="ui-buttons.html">Buttons</a>
                            </li>
                            <li>
                                <a href="ui-carousel.html">Carousel</a>
                            </li>
                            <li>
                                <a href="ui-dropdowns.html">Dropdowns</a>
                            </li>
                            <li>
                                <a href="ui-typography.html">Typography</a>
                            </li>
                            <li>
                                <a href="ui-cards.html">Cards</a>
                            </li>
                            <li>
                                <a href="ui-grid.html">Grid</a>
                            </li>
                            <li>
                                <a href="ui-rating.html">Rating</a>
                            </li>
                            <li>
                                <a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a>
                            </li>
                            <li>
                                <a href="ui-modals.html">Modals</a>
                            </li>
                            <li>
                                <a href="ui-images.html">Images</a>
                            </li>
                            <li>
                                <a href="ui-alerts.html">Alerts</a>
                            </li>
                            <li>
                                <a href="ui-progressbars.html">Progress Bars</a>
                            </li>
                            <li>
                                <a href="ui-pagination.html">Pagination</a>
                            </li>
                            <li>
                                <a href="ui-rangeslider.html">Range Slider</a>
                            </li>
                            <li>
                                <a href="ui-navs.html">Navs</a>
                            </li>
                            <li>
                                <a href="ui-popover-tooltips.html">Popover & Tooltips</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-table"></i>
                            <span> Tables </span>
                            <span class="float-right">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                        </a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="tables-basic.html">Basic Tables</a>
                            </li>
                            <li>
                                <a href="tables-datatable.html">Data Table</a>
                            </li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-cards"></i>
                            <span> Forms </span>
                            <span class="badge badge-pill badge-info float-right">8</span>
                        </a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="form-elements.html">Form Elements</a>
                            </li>
                            <li>
                                <a href="form-validation.html">Form Validation</a>
                            </li>
                            <li>
                                <a href="form-advanced.html">Form Advanced</a>
                            </li>
                            <li>
                                <a href="form-mask.html">Form Mask</a>
                            </li>
                            <li>
                                <a href="form-editors.html">Form Editors</a>
                            </li>
                            <li>
                                <a href="form-uploads.html">Form File Upload</a>
                            </li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-emoticon-poop"></i>
                            <span> Icons </span>
                            <span class="float-right">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                        </a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="icons-material.html">Material Design</a>
                            </li>
                            <li>
                                <a href="icons-fontawesome.html">Font Awesome</a>
                            </li>
                            <li>
                                <a href="icons-themify.html">Themify Icons</a>
                            </li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-chart-areaspline"></i>
                            <span> Charts </span>
                            <span class="float-right">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                        </a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="charts-morris.html">Morris Chart</a>
                            </li>
                            <li>
                                <a href="charts-chartist.html">Chartist Chart</a>
                            </li>
                            <li>
                                <a href="charts-chartjs.html">Chartjs Chart</a>
                            </li>
                            <li>
                                <a href="charts-flot.html">Flot Chart</a>
                            </li>
                            <li>
                                <a href="charts-c3.html">C3 Chart</a>
                            </li>
                            <li>
                                <a href="charts-xchart.html">X Chart</a>
                            </li>
                            <li>
                                <a href="charts-other.html">Jquery Knob Chart</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-title">Extra</li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-map-marker-multiple"></i>
                            <span> Maps </span>
                            <span class="badge badge-pill badge-danger float-right">2</span>
                        </a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="maps-google.html"> Google Map</a>
                            </li>
                            <li>
                                <a href="maps-vector.html"> Vector Map</a>
                            </li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-layers"></i>
                            <span> Pages </span>
                            <span class="float-right">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                        </a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="pages-login.html">Login</a>
                            </li>
                            <li>
                                <a href="pages-register.html">Register</a>
                            </li>
                            <li>
                                <a href="pages-recoverpw.html">Recover Password</a>
                            </li>
                            <li>
                                <a href="pages-lock-screen.html">Lock Screen</a>
                            </li>
                            <li>
                                <a href="pages-blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="pages-404.html">Error 404</a>
                            </li>
                            <li>
                                <a href="pages-500.html">Error 500</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- end sidebarinner -->
    </div>
    <!-- Left Sidebar End -->

    <!-- Start right Content here -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <!-- Top Bar Start -->
            <div class="topbar">

                <nav class="navbar-custom">
                    <div class="dropdown notification-list nav-pro-img">

                        <div class="list-inline-item hide-phone app-search">
                            <form role="search" class="">
                                <div class="form-group pt-1">
                                    <input type="text" class="form-control" placeholder="Search..">
                                    <a href="">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <ul class="list-inline float-right mb-0 mr-3">
                        <!-- language-->
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                               aria-expanded="false">
                                <i class="ti-email noti-icon"></i>
                                <span class="badge badge-danger heartbit noti-icon-badge">5</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title align-self-center">
                                    <h5>
                                        <span class="badge badge-danger float-right">745</span>Messages</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon">
                                        <img src="<?php echo base_url() ?>themes/images/users/avatar-2.jpg" alt="user-img" class="img-fluid rounded-circle"
                                        /> </div>
                                    <p class="notify-details">
                                        <b>Charles M. Jones</b>
                                        <small class="text-muted">Dummy text of the printing and typesetting industry.</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon">
                                        <img src="<?php echo base_url() ?>themes/images/users/avatar-3.jpg" alt="user-img" class="img-fluid rounded-circle"
                                        /> </div>
                                    <p class="notify-details">
                                        <b>Thomas J. Mimms</b>
                                        <small class="text-muted">You have 87 unread messages</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon">
                                        <img src="<?php echo base_url() ?>themes/images/users/avatar-4.jpg" alt="user-img" class="img-fluid rounded-circle"
                                        /> </div>
                                    <p class="notify-details">
                                        <b>Luis M. Konrad</b>
                                        <small class="text-muted">It is a long established fact that a reader will</small>
                                    </p>
                                </a>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                               aria-expanded="false">
                                <i class="ti-bell noti-icon"></i>
                                <span class="badge badge-success a-animate-blink noti-icon-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5>
                                        <span class="badge badge-danger float-right">87</span>Notification</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-cart-outline"></i>
                                    </div>
                                    <p class="notify-details">
                                        <b>Your order is placed</b>
                                        <small class="text-muted">Dummy text of the printing and typesetting industry.</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success">
                                        <i class="mdi mdi-message"></i>
                                    </div>
                                    <p class="notify-details">
                                        <b>New Message received</b>
                                        <small class="text-muted">You have 87 unread messages</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning">
                                        <i class="mdi mdi-martini"></i>
                                    </div>
                                    <p class="notify-details">
                                        <b>Your item is shipped</b>
                                        <small class="text-muted">It is a long established fact that a reader will</small>
                                    </p>
                                </a>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                               aria-expanded="false">
                                <img src="<?php echo base_url() ?>themes/images/users/avatar-1.jpg" alt="user" class="rounded-circle img-thumbnail">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5>Welcome</h5>
                                </div>
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-wallet m-r-5 text-muted"></i> My Wallet</a>
                                <a class="dropdown-item d-block" href="#">
                                    <span class="badge badge-success float-right">5</span>
                                    <i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                            </div>
                        </li>
                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                    </ul>

                    <div class="clearfix"></div>

                </nav>

            </div>
            <!-- Top Bar End -->

            <div class="page-content-wrapper dashborad-v">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="btn-group float-right">
                                    <ol class="breadcrumb hide-phone p-0 m-0">
                                        <li class="breadcrumb-item"><a href="#">Urora</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- end page title end breadcrumb -->
                    <div class="row">
                        <!-- Column -->
                        <div class="col-sm-12 col-md-6 col-xl-3">
                            <div class="card bg-danger m-b-30">
                                <div class="card-body">
                                    <div class="d-flex row">
                                        <div class="col-3 align-self-center">
                                            <div class="round">
                                                <i class="mdi mdi-google-physical-web"></i>
                                            </div>
                                        </div>
                                        <div class="col-8 ml-auto align-self-center text-center">
                                            <div class="m-l-10 text-white float-right">
                                                <h5 class="mt-0 round-inner">18090</h5>
                                                <p class="mb-0 ">Visits Today</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-info m-b-30">
                                <div class="card-body">
                                    <div class="d-flex row">
                                        <div class="col-3 align-self-center">
                                            <div class="round">
                                                <i class="mdi mdi-account-multiple-plus"></i>
                                            </div>
                                        </div>
                                        <div class="col-8 text-center ml-auto align-self-center">
                                            <div class="m-l-10 text-white float-right">
                                                <h5 class="mt-0 round-inner">562</h5>
                                                <p class="mb-0 ">New Users</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-success m-b-30">
                                <div class="card-body">
                                    <div class="d-flex row">
                                        <div class="col-3 align-self-center">
                                            <div class="round ">
                                                <i class="mdi mdi-basket"></i>
                                            </div>
                                        </div>
                                        <div class="col-8 ml-auto align-self-center text-center">
                                            <div class="m-l-10 text-white float-right">
                                                <h5 class="mt-0 round-inner">7514</h5>
                                                <p class="mb-0 ">New Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-primary m-b-30">
                                <div class="card-body">
                                    <div class="d-flex row">
                                        <div class="col-3 align-self-center">
                                            <div class="round">
                                                <i class="mdi mdi-calculator"></i>
                                            </div>
                                        </div>
                                        <div class="col-8 ml-auto align-self-center text-center">
                                            <div class="m-l-10 text-white float-right">
                                                <h5 class="mt-0 round-inner">$32874</h5>
                                                <p class="mb-0">Total Sales</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xl-5">
                            <div class="card m-b-30">
                                <div class="card-body metro-widget">
                                    <h5 class="header-title mt-0 pb-3">Statistics</h5>
                                    <div id="morris-bar-example"></div>
                                    <div class="row text-center d-flex justify-content-around">

                                        <div class="col-4">
                                            <p class="mb-0 font-14">New Orders</p>
                                            <div class="live-tile m-0 w-100" data-mode="carousel" data-direction="horizontal" data-delay="3900" data-height="10">
                                                <div>
                                                    <small class="text-muted"> today</small>
                                                    <h3 class=" text-dark">1,088
                                                        <small>
                                                            <i class="mdi mdi-menu-down text-danger"></i>
                                                        </small>
                                                    </h3>
                                                </div>
                                                <div>
                                                    <small class="text-muted">yesterday</small>
                                                    <h3 class="text-dark">1,420
                                                        <small>
                                                            <i class="mdi mdi-menu-up text-success"></i>
                                                        </small>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p class="mb-0 font-14">Visits</p>
                                            <div class="live-tile m-0 w-100" data-mode="carousel" data-direction="vertical" data-delay="3500" data-height="10">
                                                <div>
                                                    <small class="text-muted"> today</small>
                                                    <h3 class=" text-dark">1,955</h3>
                                                </div>
                                                <div>
                                                    <small class="text-muted">yesterday</small>
                                                    <h3 class="text-dark">2,091</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p class="mb-0 font-14">Bounce Rate</p>
                                            <div class="live-tile m-0 w-100" data-mode="carousel" data-direction="vertical" data-delay="4200" data-height="10">
                                                <div>
                                                    <small class="text-muted">Minmum</small>
                                                    <h3 class=" text-dark">3.8 %
                                                        <small>
                                                            <i class="mdi mdi-menu-up text-success"></i>
                                                        </small>
                                                    </h3>
                                                </div>
                                                <div>
                                                    <small class="text-muted">Maximum</small>
                                                    <h3 class="text-dark">7.1 %
                                                        <small>
                                                            <i class="mdi mdi-menu-down text-danger"></i>
                                                        </small>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-7">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title mt-0 pb-3">Revenue </h5>
                                    <div id="morris-area-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xl-4">
                            <div class="card m-b-30 h-360">
                                <div class="card-body">
                                    <h5 class="header-title mt-0 pb-3">Product Stock </h5>
                                    <div class="row">
                                        <div class="col-8">
                                            <div id="animating-donut" class="ct-chart ct-golden-section"></div>
                                        </div>
                                        <div class="col-4 stock-detail">
                                            <p>
                                                <i class="mdi mdi-cellphone text-primary mr-2 mt-3 font-24"></i>20% Mobiles</p>
                                            <p>
                                                <i class="mdi mdi-tablet-android text-success mr-2 mt-3 font-24"></i>20% Tablets</p>
                                            <p>
                                                <i class="mdi mdi-laptop text-danger mr-2 mt-3 font-24"></i>20% Laptops</p>
                                            <p>
                                                <i class="mdi mdi-television text-info mr-2 mt-3 font-24"></i>40% Televisions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-5">
                            <div class="card m-b-30 h-360">
                                <div class="card-body">
                                    <h5 class="header-title mt-0">Order Status </h5>
                                    <div class="row">
                                        <div class="col-6 align-self-center text-center">
                                            <h6 class="text-muted">Todays Perfomance</h6>
                                        </div>
                                        <div class="col-6 align-self-center text-center">
                                            <h6 class="font-40">
                                                <i class="mdi mdi-menu-up text-success"></i>52 %</h6>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <span class="float-right">18%</span>
                                        <span class="badge badge-boxed  badge-danger text-center mb-2">Delivered</span>
                                        <span class="float-left">82%</span>

                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 18%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <span class="float-right">45%</span>
                                        <span class="badge badge-boxed  badge-success mb-2">Shipped</span>
                                        <span class="float-left">55%</span>

                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <span class="float-right">70%</span>
                                        <span class="badge badge-boxed badge-warning text-center mb-2">Pending</span>
                                        <span class="float-left">30%</span>

                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <span class="float-right text-danger">Late</span>
                                        <span class="float-left text-primary">On Time</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-3">
                            <div class="card m-b-30 border-0">

                                <div class="card-body  text-center">
                                    <img src="<?php echo base_url() ?>themes/images/users/avatar-5.jpg" alt="" class="rounded-circle mx-auto d-block w-25">

                                    <div class="text-center">
                                        <h5>Robert N. Carlile</h5>
                                        <p class="text-muted">Founder of Company</p>
                                        <button class="btn btn-block btn-raised btn-info mb-3">Follow</button>
                                    </div>

                                    <div class="row text-center profile-block">
                                        <div class="col-6 align-self-center py-3 border-right">
                                            <h3 class="profile-count">
                                                <b class="font-22">15,521</b>
                                            </h3>
                                            <p class="mb-0">Followers</p>
                                        </div>
                                        <div class="col-6 align-self-center py-3">
                                            <h3 class="profile-count">
                                                <b class="font-22">772</b>
                                            </h3>
                                            <p class="mb-0">Followings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-xl-6">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title mb-3 mt-0">Order List</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                            <tr>
                                                <th class="border-top-0 w-60">Product</th>
                                                <th class="border-top-0">Pro Name</th>
                                                <th class="border-top-0">Country</th>
                                                <th class="border-top-0">Order Date/Time</th>
                                                <th class="border-top-0">Pcs.</th>
                                                <th class="border-top-0">Amount ($)</th>
                                                <th class="border-top-0">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <img class="" src="<?php echo base_url() ?>themes/images/products/pro1.png" alt="user" width="40"> </td>
                                                <td>
                                                    Chair
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/us_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>3/09/2018 4:29 PM</td>
                                                <td>2</td>
                                                <td> $ 50</td>
                                                <td>
                                                    <span class="badge badge-boxed  badge-success">Shipped</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="" src="<?php echo base_url() ?>themes/images/products/pro2.png" alt="user" width="40"> </td>
                                                <td>
                                                    Mobile
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/french_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>3/15/2018 1:09 PM</td>
                                                <td>1</td>
                                                <td> $ 70</td>
                                                <td>
                                                    <span class="badge badge-boxed  badge-danger">Delivered</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="" src="<?php echo base_url() ?>themes/images/products/pro3.png" alt="user" width="40"> </td>
                                                <td>
                                                    LED
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/spain_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>3/18/2018 12:09 PM</td>
                                                <td>3</td>
                                                <td> $ 200</td>
                                                <td>
                                                    <span class="badge badge-boxed badge-warning">Pending</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="" src="<?php echo base_url() ?>themes/images/products/pro4.png" alt="user" width="40"> </td>
                                                <td>
                                                    Chair
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/russia_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>3/27/2018 8:27 PM</td>
                                                <td>2</td>
                                                <td> $ 20</td>
                                                <td>
                                                    <span class="badge badge-boxed  badge-success">Shipped</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="" src="<?php echo base_url() ?>themes/images/products/pro2.png" alt="user" width="40"> </td>
                                                <td>
                                                    Mobile
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/italy_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>4/01/2018 5:09 PM</td>
                                                <td>1</td>
                                                <td> $ 150</td>
                                                <td>
                                                    <span class="badge badge-boxed badge-warning">Pending</span>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="card m-b-30">
                                <div class="card-body new-user">
                                    <h5 class="header-title mb-3 mt-0">New Users</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                            <tr>
                                                <th class="border-top-0 w-60">Users</th>
                                                <th class="border-top-0">Name</th>
                                                <th class="border-top-0">Country</th>
                                                <th class="border-top-0">Reviews</th>
                                                <th class="border-top-0">Socials</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <img class="rounded-circle" src="<?php echo base_url() ?>themes/images/users/avatar-2.jpg" alt="user" width="40"> </td>
                                                <td>
                                                    <a href="javascript:void(0);">Ruby T. Curd</a>
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/us_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star-half text-warning"></i>
                                                    <i class="mdi mdi-star-outline text-warning"></i>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-facebook text-primary"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-linkedin text-danger"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-twitter-alt text-info"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="rounded-circle" src="<?php echo base_url() ?>themes/images/users/avatar-3.jpg" alt="user" width="40"> </td>
                                                <td>
                                                    <a href="javascript:void(0);">William A. Johnson</a>
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/french_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star-half text-warning"></i>
                                                    <i class="mdi mdi-star-outline text-warning"></i>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-facebook text-primary"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-linkedin text-danger"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-twitter-alt text-info"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="rounded-circle" src="<?php echo base_url() ?>themes/images/users/avatar-4.jpg" alt="user" width="40"> </td>
                                                <td>
                                                    <a href="javascript:void(0);">Bobby M. Gray</a>
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/spain_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star-half text-warning"></i>
                                                    <i class="mdi mdi-star-outline text-warning"></i>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-facebook text-primary"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-linkedin text-danger"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-twitter-alt text-info"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="rounded-circle" src="<?php echo base_url() ?>themes/images/users/avatar-5.jpg" alt="user" width="40"> </td>
                                                <td>
                                                    <a href="javascript:void(0);">Robert N. Carlile</a>
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/russia_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star-half text-warning"></i>
                                                    <i class="mdi mdi-star-outline text-warning"></i>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-facebook text-primary"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-linkedin text-danger"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-twitter-alt text-info"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="rounded-circle" src="<?php echo base_url() ?>themes/images/users/avatar-6.jpg" alt="user" width="40"> </td>
                                                <td>
                                                    <a href="javascript:void(0);">Ruby T. Curd</a>
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url() ?>themes/images/flags/italy_flag.jpg" alt="" width="30">
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star-half text-warning"></i>
                                                    <i class="mdi mdi-star-outline text-warning"></i>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-facebook text-primary"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-linkedin text-danger"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                <i class="ti-twitter-alt text-info"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xl-5">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="owl-carousel">
                                        <div class="owl-inner row">
                                            <div class="col-2">
                                                <img src="<?php echo base_url() ?>themes/images/users/avatar-1.jpg" alt="" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="col-10">
                                                <p>"Lorem Ipsum is simply dummy text of the and typesetting industry. A
                                                    list is perfect for defining terms."</p>
                                                <h6 class="text-right mr-1 mb-0">- Robert Kennedy</h6>
                                            </div>
                                        </div>
                                        <div class="owl-inner row">
                                            <div class="col-2">
                                                <img src="<?php echo base_url() ?>themes/images/users/avatar-2.jpg" alt="" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="col-10">
                                                <p>"Lorem Ipsum is simply dummy text of the and typesetting industry. A
                                                    list is perfect for defining terms."</p>
                                                <h6 class="text-right mr-1  mb-0">- William Brewer</h6>
                                            </div>
                                        </div>
                                        <div class="owl-inner row">
                                            <div class="col-2">
                                                <img src="<?php echo base_url() ?>themes/images/users/avatar-3.jpg" alt="" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="col-10">
                                                <p>"Lorem Ipsum is simply dummy text of the and typesetting industry. A
                                                    list is perfect for defining terms."</p>
                                                <h6 class="text-right mr-1  mb-0">- Steven Gonzalez</h6>
                                            </div>
                                        </div>
                                        <div class="owl-inner row">
                                            <div class="col-2">
                                                <img src="<?php echo base_url() ?>themes/images/users/avatar-4.jpg" alt="" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="col-10">
                                                <p>"Lorem Ipsum is simply dummy text of the and typesetting industry. A
                                                    list is perfect for defining terms."</p>
                                                <h6 class="text-right mb-0 mr-1">- Stephen Gaines</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title mt-0 pb-2">Calendar</h5>
                                    <div id="v-cal">
                                        <div class="vcal-header">
                                            <button class="vcal-btn" data-calendar-toggle="previous">
                                                <svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
                                                </svg>
                                            </button>

                                            <div class="vcal-header__label" data-calendar-label="month">
                                                March 2017
                                            </div>
                                            <button class="vcal-btn" data-calendar-toggle="next">
                                                <svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="vcal-week">
                                            <span>Mon</span>
                                            <span>Tue</span>
                                            <span>Wed</span>
                                            <span>Thu</span>
                                            <span>Fri</span>
                                            <span>Sat</span>
                                            <span>Sun</span>
                                        </div>
                                        <div class="vcal-body" data-calendar-area="month"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-7">
                            <div class="card m-b-30">
                                <div class="card-body dash-map">
                                    <h5 class="header-title mt-0 pb-3">World Market </h5>
                                    <div class="row mb-2">
                                        <div class="col-6 col-sm-3 border-right usa">
                                            <p class="data-attributes text-center">
                                                <span data-peity='{ "fill": ["#6954cd", "#eeeeee"],   "innerRadius": 20, "radius": 24 }'>7/10</span>
                                            </p>
                                            <h6 class="text-muted">USA
                                                <span class="float-right">70%</span>
                                            </h6>
                                        </div>
                                        <div class="col-6 col-sm-3 border-right afri">
                                            <p class="data-attributes text-center">
                                                <span data-peity='{ "fill": ["#0fb795", "#eeeeee"],   "innerRadius": 20, "radius": 24 }'>6/10</span>
                                            </p>
                                            <h6 class="text-muted">Africa
                                                <span class="float-right">60%</span>
                                            </h6>
                                        </div>
                                        <div class="col-6 col-sm-3 border-right ">
                                            <p class="data-attributes text-center ind">
                                                <span data-peity='{ "fill": ["#eb6296", "#eeeeee"],   "innerRadius": 20, "radius": 24 }'>5/10</span>
                                            </p>
                                            <h6 class="text-muted">India
                                                <span class="float-right">50%</span>
                                            </h6>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <p class="data-attributes text-center can">
                                                <span data-peity='{ "fill": ["#f5b741", "#eeeeee"],   "innerRadius": 20, "radius": 24 }'>4/10</span>
                                            </p>
                                            <h6 class="text-muted">Canada
                                                <span class="float-right">40%</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div id="world-map-markers"></div>

                                </div>
                            </div>
                        </div>
                    </div><!--end row-->

                </div>
                <!-- container -->

            </div>
            <!-- Page content Wrapper -->
        </div>
        <!-- content -->

        <footer class="footer">
            © 2018 Urora by Mannatthemes.
        </footer>

    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->
<script src="<?php echo base_url() ?>themes/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>themes/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>themes/js/bootstrap-material-design.js"></script>
<script src="<?php echo base_url() ?>themes/js/modernizr.min.js"></script>
<script src="<?php echo base_url() ?>themes/js/detect.js"></script>
<script src="<?php echo base_url() ?>themes/js/fastclick.js"></script>
<script src="<?php echo base_url() ?>themes/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url() ?>themes/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url() ?>themes/js/waves.js"></script>
<script src="<?php echo base_url() ?>themes/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url() ?>themes/js/jquery.scrollTo.min.js"></script>


<script src="<?php echo base_url() ?>themes/plugins/carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>themes/plugins/fullcalendar/vanillaCalendar.js"></script>
<script src="<?php echo base_url() ?>themes/plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url() ?>themes/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?php echo base_url() ?>themes/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url() ?>themes/plugins/chartist/js/chartist.min.js"></script>
<script src="<?php echo base_url() ?>themes/plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
<script src="<?php echo base_url() ?>themes/plugins/metro/MetroJs.min.js"></script>
<script src="<?php echo base_url() ?>themes/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>themes/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url() ?>themes/pages/dashborad.js"></script>

<!-- App js -->
<script src="<?php echo base_url() ?>themes/js/app.js"></script>

</body>

</html>