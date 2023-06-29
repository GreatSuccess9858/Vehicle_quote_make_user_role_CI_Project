<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_269") ?></li>
</ol>

<p><?php echo lang("ctn_270") ?></p>

<hr>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open(site_url("admin/edit_payment_plan_pro/" . $plan->ID), array("class" => "form-horizontal")) ?>

<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_260") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="email-in" name="name" value="<?php echo $plan->name ?>">
        </div>
</div>
<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_271") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="email-in" name="description" value="<?php echo $plan->description ?>">
        </div>
</div>
<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_261") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="email-in" name="cost" value="<?php echo $plan->cost ?>">
        </div>
</div>
<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_266") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control jscolor" id="email-in" name="color" value="<?php echo $plan->hexcolor ?>">
        </div>
</div>
<div class="form-group">
        <label for="username-in" class="col-md-3 label-heading"><?php echo lang("ctn_272") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control jscolor" id="username" name="fontcolor" value="<?php echo $plan->fontcolor ?>">
        </div>
</div>
<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_262") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="email-in" name="days" value="<?php echo $plan->days ?>">
        </div>
</div>
<div class="form-group">
        <label for="username-in" class="col-md-3 label-heading"><?php echo lang("ctn_347") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="username" name="icon" value="<?php echo $plan->icon ?>">
            <span class="help-block"><?php echo lang("ctn_348") ?> <a href="http://getbootstrap.com/components/">http://getbootstrap.com/components/</a>. <?php echo lang("ctn_349") ?></span>
        </div>
</div>
<input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_13") ?>" />
<?php echo form_close() ?>
</div>
</div>
</div>