<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-cog"></span> <?php echo lang("ctn_224") ?></div>
    <div class="db-header-extra"> <a href="<?php echo site_url("user_settings/change_password") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_225") ?></a> <a href="<?php echo site_url("user_settings/social_networks") ?>" class="btn btn-info btn-sm"><?php echo lang("ctn_422") ?></a>
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("user_settings") ?>"><?php echo lang("ctn_224") ?></a></li>
  <li class="active"><?php echo lang("ctn_225") ?></li>
</ol>

<p><?php echo lang("ctn_237") ?></p>

<hr>


	<div class="panel panel-default">
  	<div class="panel-body">
  	<?php echo form_open(site_url("user_settings/change_password_pro"), array("class" => "form-horizontal")) ?>
            <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_238") ?></label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" name="current_password">
			    </div>
			</div>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_239") ?></label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" name="new_pass1">
			    </div>
			</div>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_240") ?></label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" name="new_pass2">
			    </div>
			</div>
			 <input type="submit" name="s" value="<?php echo lang("ctn_241") ?>" class="btn btn-primary form-control" />
    <?php echo form_close() ?>
    </div>
    </div>

    </div>