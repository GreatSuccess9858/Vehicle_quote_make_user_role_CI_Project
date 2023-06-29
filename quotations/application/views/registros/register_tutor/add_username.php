<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-cog"></span> <?php echo lang("ctn_206") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li class="active"><?php echo lang("ctn_206") ?></li>
</ol>

<p><?php echo lang("ctn_207") ?></p>

<hr>

	<div class="panel panel-default">
  	<div class="panel-body">
  	<?php echo form_open(site_url("register/add_username_pro"), array("class" => "form-horizontal")) ?>
			<div class="form-group">
					    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_208") ?></label>
					    <div class="col-md-9">
					    	<input type="email" class="form-control" id="email-in" name="email" value="<?php if(isset($email)) echo $email; ?>">
					    </div>
			  	</div>
			  	<div class="form-group">
					    <label for="username-in" class="col-md-3 label-heading"><?php echo lang("ctn_209") ?></label>
					    <div class="col-md-9">
					    	<input type="text" class="form-control" id="username" name="username" value="<?php if(isset($username)) echo $username; ?>">
					    </div>
			  	</div>
			 <input type="submit" name="s" value="<?php echo lang("ctn_211") ?>" class="btn btn-primary form-control" />
    <?php echo form_close() ?>
    </div>
    </div>
    </div>