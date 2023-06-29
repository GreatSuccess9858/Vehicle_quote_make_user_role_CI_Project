<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> User Groups | Edit</div>
    <div class="db-header-extra">
</div>
</div>

<!--<ol class="breadcrumb">-->
<!--  <li><a href="--><?php //echo site_url() ?><!--">--><?php //echo lang("ctn_1") ?><!--</a></li>-->
<!--  <li><a href="--><?php //echo site_url("admin") ?><!--">--><?php //echo lang("ctn_1") ?><!--</a></li>-->
<!--  <li><a href="--><?php //echo site_url("admin/user_groups") ?><!--">--><?php //echo lang("ctn_15") ?><!--</a></li>-->
<!--  <li class="active">--><?php //echo lang("ctn_16") ?><!--</li>-->
<!--</ol>-->

    <p class="little-show-p"><?php echo lang("ctn_17") ?></p>

<hr>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open(site_url("admin/edit_group_pro/" . $group->ID), array("class" => "form-horizontal")) ?>

<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_18") ?></label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="email-in" name="name" value="<?php echo $group->name ?>">
        </div>
</div>
<div class="form-group">
        <label for="email-in" class="col-md-6 label-heading"><?php echo lang("ctn_19") ?></label>
        <div class="col-md-6">
            <input type="checkbox" name="default_group" value="1" <?php if($group->default) echo "checked" ?>>
            <span class="help-block"><?php echo lang("ctn_20") ?></span>
        </div>
</div>
<input type="submit" class="col-md-6   btn btn-primary" value="<?php echo lang("ctn_13") ?>" />
<?php echo form_close() ?>
</div>
</div>
</div>