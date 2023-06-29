<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_246") ?></li>
</ol>


<hr>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open(site_url("admin/payment_settings_pro"), array("class" => "form-horizontal")) ?>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_251") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" class="" id="name-in" name="payment_enabled" <?php if($this->settings->info->payment_enabled) echo "checked" ?> value="1">
        <span class="help-block"><?php echo lang("ctn_252") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_286") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" id="name-in" name="global_premium" <?php if($this->settings->info->global_premium) echo "checked" ?> value="1">
        <span class="help-block"><?php echo lang("ctn_287") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_253") ?></label>
    <div class="col-sm-10">
    	<input type="text" class="form-control" id="name-in" name="paypal_email" placeholder="" value="<?php echo $this->settings->info->paypal_email ?>">
    	<span class="help-block"><?php echo lang("ctn_254") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_255") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name-in" name="paypal_currency" placeholder="" value="<?php echo $this->settings->info->paypal_currency ?>">
        <span class="help-block"><?php echo lang("ctn_256") ?>: <a href="https://developer.paypal.com/docs/classic/api/currency_codes/">https://developer.paypal.com/docs/classic/api/currency_codes/</a>.</span>
    </div>
</div>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_257") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name-in" name="payment_symbol" placeholder="" value="<?php echo $this->settings->info->payment_symbol ?>">
    </div>
</div>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_376") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name-in" name="stripe_secret_key" placeholder="" value="<?php echo $this->settings->info->stripe_secret_key ?>">
    </div>
</div>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_377") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name-in" name="stripe_publish_key" placeholder="" value="<?php echo $this->settings->info->stripe_publish_key ?>">
    </div>
</div>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_397") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name-in" name="checkout2_secret" placeholder="" value="<?php echo $this->settings->info->checkout2_secret ?>">
    </div>
</div>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_398") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name-in" name="checkout2_accountno" placeholder="" value="<?php echo $this->settings->info->checkout2_accountno ?>">
    </div>
</div>

<input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_13") ?>" />
<?php echo form_close() ?>
</div>
</div>
</div>