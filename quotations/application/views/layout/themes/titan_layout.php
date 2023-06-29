<!DOCTYPE html>
<?php if ($enable_rtl): ?>
<html dir="rtl">
<?php else: ?>
<html lang="es">
<?php endif;?>
    <head>
        <title><?php if (isset($page_title)): ?><?php echo $page_title ?> - <?php endif;?><?php echo $this->settings->info->site_name ?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

         <!-- Styles -->
        <link href="<?php echo base_url(); ?>styles/layouts/titan/main.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>styles/layouts/titan/responsive.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url(); ?>styles/elements.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,500,550,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

        <!-- SCRIPTS -->
        <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
        var global_hash = "<?php echo $this->security->get_csrf_hash() ?>";
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script>

        <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

        <?php if (isset($datatable_lang) && !empty($datatable_lang)): ?>
        <script type="text/javascript">
            $(document).ready(function() {
              $.extend( true, $.fn.dataTable.defaults, {
              "language": {
                "url": "<?php echo $datatable_lang ?>"
            }
              });
          });
        </script>
        <?php endif;?>


        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?>

        <!-- Favicon: http://realfavicongenerator.net -->
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="<?php echo base_url() ?>images/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo base_url() ?>images/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo base_url() ?>images/favicon/manifest.json">
        <link rel="mask-icon" href="<?php echo base_url() ?>images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->


    </head>
    <body>

    <nav class="navbar navbar-inverse navbar-header2">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php if ($this->settings->info->logo_option): ?>
          <a class="navbar-brand-two" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->settings->info->site_logo ?>" width="123" height="32"></a>
        <?php else: ?>
          <a class="navbar-brand" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><?php echo $this->settings->info->site_name ?></a>
        <?php endif;?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          <?php if ($this->user->loggedin): ?>
            <li><a href="#" data-target="#" onclick="load_notifications()" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="noti-menu-drop"><span class="glyphicon glyphicon-bell notification-icon"></span><?php if ($this->user->info->noti_count > 0): ?><span class="badge notification-badge small-text"><?php echo $this->user->info->noti_count ?></span><?php endif;?></a>

            <ul class="dropdown-menu" aria-labelledby="noti-menu-drop">
            <li>
            <div class="notification-box-title">
            <?php echo lang("ctn_412") ?> <?php if ($this->user->info->noti_count > 0): ?><span class="badge click" id="noti-click-unread" onclick="load_notifications_unread()"><?php echo $this->user->info->noti_count ?></span><?php endif;?>
            </div>
            <div id="notifications-scroll">
              <div id="loading_spinner_notification">
                <span class="glyphicon glyphicon-refresh" id="ajspinner_notification"></span>
              </div>
            </div>
            <div class="notification-box-footer">
            <a href="<?php echo site_url("home/notifications") ?>"><?php echo lang("ctn_414") ?></a>
            </div>
          </li>
          </ul>
          </li>
            <li class="user_bit"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" class="user_avatar"> <a href="javascript:void(0)" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo $this->user->info->username ?></a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="<?php echo site_url("profile/" . $this->user->info->username) ?>">Profile</a></li>
              <li><a href="<?php echo site_url("user_settings") ?>"><?php echo lang("ctn_156") ?></a></li>
              <?php if ($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings"), $this->user)): ?>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_157") ?></a></li>
              <?php endif;?>
            </ul>

            </li>
            <li><a href="<?php echo site_url("login/logout/" . $this->security->get_csrf_hash()) ?>"><?php echo lang("ctn_149") ?></a></li>
          <?php else: ?>
          <li><a href="<?php echo site_url("login") ?>"><?php echo lang("ctn_150") ?></a></li>
            <li><a href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a></li>
          <?php endif;?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="sidebar">
      <?php if (isset($sidebar)): ?>
          <?php echo $sidebar ?>
        <?php endif;?>
          <?php include APPPATH . "views/layout/sidebar_links.php"?>
    </div>

    <div id="main-content">

        <?php include APPPATH . "views/layout/mobile_links.php"?>

        <?php if ($this->settings->info->install): ?>
          <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-info"><b>NOTICE</b> - <a href="<?php echo site_url("install") ?>">Great job on uploading all the files and setting up the site correctly! Let's now create the Admin account and set the default settings. Click here! This message will disappear once you have run the install process.</a></div>
                        </div>
                    </div>
        <?php endif;?>
      <?php $gl = $this->session->flashdata('globalmsg');?>
        <?php if (!empty($gl)): ?>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
                        </div>
                    </div>
        <?php endif;?>

        <?php echo $content ?>

    </div>
    <div id="footer" class="clearfix">
      <span class="pull-left hidden"><?php echo lang("ctn_170") ?> <a href="#"> </a> <?php echo $this->settings->info->site_name ?> V<?php echo $this->settings->version ?></span> <span class="pull-right"><?php echo lang("ctn_430") ?>: <a href="<?php echo site_url("members/index/1") ?>"><?php echo $this->settings->info->currently_online ?></a> - <a href="<?php echo site_url("home/change_language") ?>"><?php echo lang("ctn_171") ?></a></span>
    </div>

    <!-- SCRIPTS -->
     <script src="<?php echo base_url(); ?>scripts/custom/global.js"></script>
    <script src="<?php echo base_url(); ?>scripts/libraries/jquery.nicescroll.min.js"></script>
    <script type="text/javascript">
      $.widget.bridge('uitooltip', $.ui.tooltip);
    </script>

    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

     <script type="text/javascript">
            $(document).ready(function() {
              $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    <script type="text/javascript">
     $(document).ready(function() {

        // Get sidebar height
       resize_layout();
       var sb_h = $('.sidebar').height();
        var mc_h = $('#main-content').height();
        if(sb_h > mc_h) {
          $('#main-content').css("min-height", sb_h+50 + "px");
        }

        $('.nav-sidebar li').on('shown.bs.collapse', function () {
           $(this).find(".glyphicon-menu-right")
                 .removeClass("glyphicon-menu-right")
                 .addClass("glyphicon-menu-down");
            resize_layout();
        });
        $('.nav-sidebar li').on('hidden.bs.collapse', function () {
           $(this).find(".glyphicon-menu-down")
                 .removeClass("glyphicon-menu-down")
                 .addClass("glyphicon-menu-right");
            resize_layout();
        });

        function resize_layout()
        {
          var sb_h = $('.sidebar').height();
          var mc_h = $('#main-content').height();
          var w_h = $(window).height();
          if(sb_h > mc_h) {
            $('#main-content').css("min-height", sb_h+50 + "px");
          }
          if(w_h > mc_h) {
            $('#main-content').css("min-height", (w_h-(51+30)) +"px");
          }
        }
     });
    </script>

    <script src="<?php echo base_url(); ?>node_modules\jquery-validation\dist/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>scripts/custom/my_functions.js"></script>
        <script src="<?php echo base_url(); ?>scripts/custom/main.js"></script>



    </body>
</html>