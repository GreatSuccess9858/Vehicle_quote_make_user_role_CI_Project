<div class="container">
    <div class="row">
    <div class="col-md-5 center-block-e">

      

      <div class="login-form">
 <h2>Install Application</h2>

<p>This is the install file for the <?php echo $this->settings->info->site_name ?> System. You should delete this file after you have setup your application: application/controllers/Install.php</p>

 <?php echo form_open(site_url("install/install_pro")) ?>
<div class="panel panel-default">
	<div class="panel-heading">Install</div>
	<div class="panel-body">
		<div class="form-group">
			<div class="row">
				<div class="col-md-12">
			    	<label for="username-in">Admin Username <span class="required full-rounded-corners">REQUIRED</span></label>
			    	<input type="text" class="form-control" id="username-in" name="username" placeholder="" />
			    </div>
			</div>
	  	</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-md-12">
			    	<label for="username-in">Admin Email <span class="required full-rounded-corners">REQUIRED</span></label>
			    	<input type="text" class="form-control" id="username-in" name="email" placeholder="Enter email" />
			    </div>
			</div>
	  	</div>
	  	<div class="form-group">
			<div class="row">
				<div class="col-md-12">
			    	<label for="password-in">Admin Password</label>
			    	<input type="password" class="form-control" id="password-in" name="password" />
			    </div>
			</div>
	  	</div>
	  	<div class="form-group">
			<div class="row">
				<div class="col-md-12">
			    	<label for="password2-in">Repeat Admin Password</label>
			    	<input type="password" class="form-control" id="password2-in" name="password2" />
			    </div>
			</div>
	  	</div>
	  	<div class="form-group">
			<div class="row">
				<div class="col-md-12">
			    	<label for="sn-in">Site Name</label>
			    	<input type="text" class="form-control" id="sn-in" name="site_name" value="<?php echo $this->settings->info->site_name ?>" />
			    </div>
			</div>
	  	</div>
	  	<div class="form-group">
			<div class="row">
				<div class="col-md-12">
			    	<label for="sn-in">Site Description</label>
			    	<input type="text" class="form-control" id="sn-in" name="site_desc" value="<?php echo $this->settings->info->site_desc ?>" />
			    </div>
			</div>
	  	</div>

	<input type="submit" class="btn btn-primary form-control" name="s" value="Install">
	<?php echo form_close() ?>
	</div>
</div>

</div>
</div>
</div>
</div>