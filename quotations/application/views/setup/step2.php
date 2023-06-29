<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Setup File</title>         
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

         <!-- Styles -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,500,550,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

        <style type="text/css">
            .bs-wizard {margin-top: 40px;}

/*Form Wizard*/
.bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
.bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
.bs-wizard > .bs-wizard-step + .bs-wizard-step {}
.bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
.bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
.bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #fbe8aa; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;} 
.bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #fbbd19; border-radius: 50px; position: absolute; top: 8px; left: 8px; } 
.bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
.bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #fbe8aa;}
.bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
.bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
.bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
.bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
.bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
.bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
.bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
/*END Form Wizard*/
        </style>
        

    </head>
    <body>

    <div class="container">

        <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-xs-3 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="setup.php?stage=0" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Configuration Setup</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step active"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="setup.php?stage=3" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Database Setup</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="setup.php?stage=5" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Admin Account</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                  <div class="text-center bs-wizard-stepnum">Step 4</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="setup.php?stage=7" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Finish Up</div>
                </div>
            </div>

    <div class="row">
    <div class="col-md-12">
    <h1 style="text-align: center">DATABASE SETUP</h1>

    <p>This file will attempt to setup the software for you. In order to do this, the following files must be <b>temporarily</b> made writable.</p>

    <p>Please make sure the files below are writable (CHMOD 777):</p>
    <p><ul>
    <li>application/config/config.php <span id="config-status" class="alert-danger">NOT WRITABLE</span></li>
    <li>application/config/database.php <span id="database-status" class="alert-danger">NOT WRITABLE</span></li>
    <li>.htaccess <span id="htaccess-status" class="alert-danger">NOT WRITABLE</span></li>
    </ul>
    </p>

    <hr>

    <div class="panel panel-default">
    <div class="panel-body">
    <form action="setup.php?stage=4" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Database Host</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="database_host" value="localhost">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Database Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="database_name" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Database User</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="database_user" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Database Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="database_password" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Database Driver</label>
                <div class="col-sm-10">
                  <select name="database_driver" class="form-control">
                  <option value="0">MYSQLI</option>
                  <option value="1">MYSQL</option>
                  </select>
                  <span class="help-block">We recommend using the MYSQLI driver as MYSQL is not deprecated. If you need to use PDO or another alternative driver, please modify the database config file.</span>
                </div>
            </div>

    <p><input type="submit" name="s" value="Continue" class="btn btn-primary form-control" /></p>
   	</form>
    </div>
    </div>

    </div>
    </div>
    </div>

    </body>
    </html>

    <script type="text/javascript">
    $(document).ready(function() {

    	$.ajax({
    		URL: 'setup.php',
    		type: 'GET',
    		data: {
    			stage : 99
    		},
    		dataType: 'JSON',
    		success: function(msg) {
    			if(msg.config_status) {
    				$('#config-status').removeClass("alert-danger");
    				$('#config-status').addClass("alert-success");
    				$('#config-status').html("WRITABLE!");
    			}
    			if(msg.database_status) {
    				$('#database-status').removeClass("alert-danger");
    				$('#database-status').addClass("alert-success");
    				$('#database-status').html("WRITABLE!");
    			}
    			if(msg.htaccess_status) {
    				$('#htaccess-status').removeClass("alert-danger");
    				$('#htaccess-status').addClass("alert-success");
    				$('#htaccess-status').html("WRITABLE!");
    			}
    		}
    	});
    });
    </script>