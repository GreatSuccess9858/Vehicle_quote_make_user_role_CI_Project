<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php if (isset($page_title)): ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>
    <meta content="Admin Dashboard" name="description"/>
    <meta content="Mannatthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<!--    <link href="--><?php //echo base_url(); ?><!--bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
<!--    <link href="--><?php //echo base_url(); ?><!--bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">-->
    <link href="<?php echo base_url(); ?>styles/layouts/dark_fire/main.css" rel="stylesheet" type="text/css">
<!--    <link href="--><?php //echo base_url(); ?><!--styles/elements.css" rel="stylesheet" type="text/css">-->

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/plugins/fullcalendar/vanillaCalendar.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/plugins/jvectormap/jquery-jvectormap-2.0.2.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/plugins/metro/MetroJs.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/plugins/carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/plugins/carousel/owl.theme.default.min.css">
    <link rel="stylesheet"
          href="<?php echo base_url() ?>assets/theme/plugins/timepicker/tempusdominus-bootstrap-4.css"/>
    <link rel="stylesheet"
          href="<?php echo base_url() ?>assets/theme/plugins/timepicker/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/plugins/animate/animate.css" type="text/css">
<!--    <link rel="stylesheet" href="--><?php //echo base_url() ?><!--assets/theme/css/bootstrap-material-design.min.css"-->
<!--          type="text/css">-->
    <link href="<?php echo base_url() ?>assets/theme/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="<?php echo base_url(); ?>node_modules\jquery-bootgrid\dist/jquery.bootgrid.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo base_url(); ?>node_modules\select2\dist\css/select2.min.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo base_url(); ?>bower_components\bootstrap-toggle/css/bootstrap-toggle.min.css"
          rel="stylesheet">
    <link href="<?php echo base_url(); ?>bower_components\jQuery-Tag-This\dist/jquery-tag-this.min.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo base_url(); ?>node_modules\jquery-confirm\dist/jquery-confirm.min.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo base_url(); ?>node_modules\@fortawesome\fontawesome-free\css/all.min.css" rel="stylesheet" type="text/css">

    <link
        href="<?php echo base_url(); ?>node_modules\bootstrap-datetimepicker-npm\build\css\bootstrap-datetimepicker.min.css">
    <link href="<?php echo base_url(); ?>scripts\excel_table/excel-bootstrap-table-filter-style.css" rel="stylesheet"
          type="text/css">

    <link href="<?php echo base_url(); ?>node_modules\font-awesome\css\font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo base_url() ?>assets/theme/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css"
          rel="stylesheet"/>
    <script type="text/javascript">
        var global_base_url = "<?php //echo site_url('/') ?>";
        var global_hash = "<?php echo $this->security->get_csrf_hash() ?>";
        var _controller = "<?php echo $this->router->fetch_class(); ?>";
        var _action = "<?php echo $this->router->fetch_method(); ?>";
        var _site_url = "<?php echo site_url(); ?>";
        var _decimals = 4;
    </script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/custom.css" type="text/css">
    <!-- DataTables -->
<!--    <link href="--><?php //echo base_url() ?><!--assets/theme/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>-->
<!--    <link href="--><?php //echo base_url() ?><!--assets/theme/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Responsive datatable examples -->
    <link href="<?php echo base_url() ?>assets/theme/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
    <script src="<?php echo base_url() ?>assets/theme/js/jquery.min.js"></script>
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
            <div class="text-center d-flex justify-content-center align-items-center">
                <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> Urora</a>-->
                <a class="navbar-brand-two" href="<?php echo site_url() ?>"
                   title="<?php echo $this->settings->info->site_name ?>"><img
                        src="<?php echo base_url() ?>images/huerta_hd-white.png"
                        width="132" ></a>
            </div>
        </div>
        <div class="sidebar-inner slimscrollleft" id="sidebar-main">
            <div id="sidebar-menu">
                <?php if (isset($sidebar)): ?>
                    <?php echo $sidebar ?>
                <?php endif; ?>
                <?php include APPPATH . "views/layout/sidebar_links.php" ?>
            </div>
            <div class="clearfix"></div>
        </div>
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

                        <?php if ($this->user->loggedin): ?>
                            <?php $_temp = _helper_my_sedes();
                            $mis_sedes = $_temp[0];
                            $mis_sedes_selected = $_temp[1];
                            ?>
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                   data-toggle="dropdown"
                                   href="#" role="button" aria-haspopup="false"
                                   aria-expanded="false">
                                    <img
                                        src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>"
                                        alt="user" class="rounded-circle img-thumbnail">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5><?php echo $this->user->info->username ?></h5>
                                    </div>
                                    <a class="dropdown-item"
                                       href="<?php echo site_url("profile/" . $this->user->info->username) ?>">
                                        <i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="<?php echo site_url("user_settings") ?>">
                                        <i class="mdi mdi-settings m-r-5 text-muted"></i> <?php echo lang("ctn_156") ?>
                                    </a>
                                    <!--                                    --><?php //if ($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings"), $this->user)): ?>
                                    <!--                                        <span role="separator" class="divider"></span>-->
                                    <!--                                        <a class="dropdown-item d-block" href="-->
                                    <?php //echo site_url("admin") ?><!--">-->
                                    <!--                                            <i class="mdi mdi-settings m-r-5 text-muted"></i> --><?php //echo lang("ctn_157") ?>
                                    <!--                                        </a>-->
                                    <!--                                    --><?php //endif; ?>
                                    <a class="dropdown-item"
                                       href="<?php echo site_url("login/logout/" . $this->security->get_csrf_hash()) ?>">
                                        <i class="mdi mdi-logout m-r-5 text-muted"></i> <?php echo lang("ctn_149") ?>
                                    </a>
                                </div>
                            </li>
                        <?php else: ?>
                            <li><a href="<?php echo site_url("login") ?>"><?php echo lang("ctn_150") ?></a></li>
                            <li><a href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a></li>
                        <?php endif; ?>
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

                <!--                --><?php //include APPPATH . "views/layout/mobile_links.php" ?>
                <!--                --><?php //if ($this->settings->info->install): ?>
                <!--                    <div class="row">-->
                <!--                        <div class="col-md-12">-->
                <!--                            <div class="alert alert-info"><b>NOTICE</b> - <a href="-->
                <?php //echo site_url("install") ?><!--">Great job on-->
                <!--                                    uploading all the files and setting up the site correctly! Let's now create the Admin account-->
                <!--                                    and set the default settings. Click here! This message will disappear once you have run the-->
                <!--                                    install process.</a></div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                --><?php //endif; ?>
                <?php
                $gl = $this->session->flashdata('globalmsg');
                $gl_tipo = $this->session->flashdata('globalmsg_tipo');
                if ($gl_tipo == 1) {
                    $str = 'danger';
                } else {
                    $str = 'success';
                }
                ?>
                <!--                --><?php //if (!empty($gl)): ?>
                <!--                    <div class="row">-->
                <!--                        <div class="col-md-12">-->
                <!--                            <div class="alert alert---><?PHP //echo $str; ?><!--"><b><span-->
                <!--                                        class="glyphicon glyphicon-ok"></span></b> --><?php //echo $this->session->flashdata('globalmsg') ?>
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                --><?php //endif; ?>

                <?php // _get_mensaje();?>

                <?php echo $content ?>
                <!-- container -->

            </div>
            <!-- Page content Wrapper -->
        </div>
        <!-- content -->

        <footer class="footer">
            © 2023 TRANSPORTES DEDICADOS

        </footer>

    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->
<?php if (isset($js_files) && count($js_files) > 0) {
    foreach ($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach;
}
?>
<script src="<?php echo base_url(); ?>scripts/custom/global.js"></script>
<script src="<?php echo base_url(); ?>scripts/libraries/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
    $.widget.bridge('uitooltip', $.ui.tooltip);
</script>

<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery  -->

<script src="<?php echo base_url() ?>assets/theme/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/pages/form-editor-init.js"></script>

<script src="<?php echo base_url() ?>assets/theme/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/js/bootstrap-material-design.js"></script>
<script src="<?php echo base_url() ?>assets/theme/js/modernizr.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/js/detect.js"></script>
<script src="<?php echo base_url() ?>assets/theme/js/fastclick.js"></script>
<script src="<?php echo base_url() ?>assets/theme/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url() ?>assets/theme/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url() ?>assets/theme/js/waves.js"></script>
<script src="<?php echo base_url() ?>assets/theme/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url() ?>assets/theme/js/jquery.scrollTo.min.js"></script>


<script src="<?php echo base_url() ?>assets/theme/plugins/carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/fullcalendar/vanillaCalendar.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/chartist/js/chartist.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/metro/MetroJs.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/raphael/raphael.min.js"></script>
<!--<script src="--><?php //echo base_url() ?><!--assets/theme/plugins/morris/morris.min.js"></script>-->
<!--<script src="--><?php //echo base_url() ?><!--assets/theme/pages/dashborad.js"></script>-->

<!-- Required datatable js -->
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/jszip.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url() ?>assets/theme/pages/datatables.init.js"></script>

<!--Wysiwig js-->
<script src="<?php echo base_url() ?>assets/theme/plugins/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/pages/form-editor-init.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<?php echo $cssincludes ?>


<?php if (isset($css_files) && count($css_files) > 0) {
    foreach ($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>"/>
    <?php endforeach;
} ?>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

<!--Form data-picker--->
<script src="<?php echo base_url() ?>assets/theme/plugins/timepicker/moment.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/timepicker/tempusdominus-bootstrap-4.js"></script>
<!--<script src="--><?php //echo base_url() ?><!--assets/theme/pages/form-advanced.js"></script>-->
<script src="<?php echo base_url() ?>assets/theme/plugins/bootstrap-maxlength/src/bootstrap-maxlength.js"></script>
<!--<script src="-->
<?php //echo base_url() ?><!--assets/theme/plugins/bootstrap-maxlength/src/bootstrap-maxlength.js"></script>-->
<!--<script src="-->
<?php //echo base_url() ?><!--assets/theme/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>-->
<!-- App js -->
<script src="<?php echo base_url() ?>assets/theme/js/app.js"></script>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>-->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/clockpicker/jquery-clockpicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/colorpicker/jquery-asColor.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/colorpicker/jquery-asGradient.js"></script>
<script src="<?php echo base_url() ?>assets/theme/plugins/colorpicker/jquery-asColorPicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/theme/pages/form-advanced.js"></script>
<script src="<?php echo base_url(); ?>node_modules\select2\dist\js\select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules\jquery-bootgrid\dist\jquery.bootgrid.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules\jquery-bootgrid\dist\jquery.bootgrid.fa.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules\jquery-validation\dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules\jquery-validation\dist/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules\jquery-validation\dist/localization/messages_es_PE.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules\jquery-confirm\dist/jquery-confirm.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules\moment\min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules\bootstrap-datetimepicker-npm\build\js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules\jquery-numeric-master/jquery.numeric.min.js"></script>
<script src="<?php echo base_url(); ?>bower_components\jQuery-Tag-This\dist/jquery.tagthis.min.js"></script>
<script src="<?php echo base_url(); ?>scripts\libraries\jquery-oLoader-v0.1\js/jquery.oLoader.min.js"></script>
<script src="<?php echo base_url(); ?>scripts/custom/jquery.custom-file-input.js"></script>
<script src="<?php echo base_url(); ?>scripts/custom/jquery.number.min.js?<?php echo time(); ?>"></script>
<script src="<?php echo base_url(); ?>bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<script src="<?php echo base_url(); ?>bower_components/chart.js\dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>scripts/custom/chartjs-plugin-labels.js?<?php echo time(); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/custom/custom_events.js?<?php echo time(); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/custom/my_functions.js?<?php echo time(); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/excel_table/excel-bootstrap-table-filter-bundle.js?<?php echo time(); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/custom/main.min.js?<?php echo time(); ?>"></script>
<?php _token(); ?>
</body>

</html>