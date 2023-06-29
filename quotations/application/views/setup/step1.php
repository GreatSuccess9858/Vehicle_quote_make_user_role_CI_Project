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
                
                <div class="col-xs-3 bs-wizard-step active">
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="setup.php?stage=0" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Configuration Setup</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
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
    <h1 style="text-align: center">Welcome to the SETUP File</h1>

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
    <form action="setup.php?stage=2" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Site URL</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_url" value="">
                  <span class="help-block">Enter the URL that you wish to use to access the software. If you have installed the software in a subfolder on a domain, make sure to include it! Make sure to leave a trailing slash i.e. http://www.example.com/</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Enable Friendly URLs</label>
                <div class="col-sm-10">
                  <select name="mod_rewrite" class="form-control" id="mod_rewrite">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                  </select>
                  <span class="help-block">If you have <b>mod_rewrite</b> enabled on your server, you can make use of friendly URLs. </span>
                </div>
            </div>
            <div class="form-group" style="display: none;" id="folder_name">
                <label for="inputEmail3" class="col-sm-2 control-label">Sub Folder Name</label>
                <div class="col-sm-10">
                  <input type="text" name="sub_folder" class="form-control">
                  <span class="help-block">If you are installing the application in a subfolder of your root domain (i.e. http://www.example.com/my_site/), please enter the name here. If you are not, leave this field blank.</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Sessions</label>
                <div class="col-sm-10">
                  <select name="sessions" class="form-control">
                  <option value="0">Database</option>
                  <option value="1">File</option>
                  </select>
                  <span class="help-block">On some systems, writing sessions to file can cause errors. Storing session data in the database is the easiest option however it can be mildly slower than writing to file. You shouldn't really notice a difference unless you expect to have hundreds of users using your system at the same time.</span>
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

    	$("#mod_rewrite").on("change", function() {
    		if($('#mod_rewrite').val() == 0) {
    			$('#folder_name').fadeOut(10);
    		} else {
    			$('#folder_name').fadeIn(100);
    		}
    	});

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