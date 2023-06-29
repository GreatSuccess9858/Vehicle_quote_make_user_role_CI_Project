<div class="container">
    <div class="row">
    <div class="col-md-5 center-block-e">

      

      <div class="login-form">
      	<div class="login-form-inner">
      <?php $gl = $this->session->flashdata('globalmsg'); ?>
        <?php if(!empty($gl)) :?>
          <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div> 
        <?php endif; ?>
  		<h2><?php echo lang("ctn_185") ?></h2>

    	<p><?php echo lang("ctn_186") ?></p>
		<?php echo form_open(site_url("login/resetpw_pro/" . $token . "/" . $userid)) ?>
			  	<div class="form-group">
				  	<div class="row">
						<div class="col-md-12">
					    	<label for="password-in"><?php echo lang("ctn_187") ?></label>
					    	<input type="password" class="form-control" id="password-in" name="npassword" />
					    </div>
					</div>
			  	</div>
			  	<div class="form-group">
				  	<div class="row">
						<div class="col-md-12">
					    	<label for="password-in"><?php echo lang("ctn_188") ?></label>
					    	<input type="password" class="form-control" id="password-in" name="npassword2" />
					    </div>
					</div>
			  	</div>

			  	<input type="submit" class="btn btn-primary" name="s" value="<?php echo lang("ctn_185") ?>">
		<?php echo form_close() ?>
	</div>

		</div>
</div>
</div>
</div>