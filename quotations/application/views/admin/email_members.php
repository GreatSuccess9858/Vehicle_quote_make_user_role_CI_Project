<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_41") ?></li>
</ol>

<p><?php echo lang("ctn_42") ?></p>

<hr>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open(site_url("admin/email_members_pro/"), array("class" => "form-horizontal")) ?>

<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_43") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="email-in" name="usernames" value="">
            <span class="help-text"><?php echo lang("ctn_44") ?></span>
        </div>
</div>
<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_45") ?></label>
        <div class="col-md-9">
            <select name="groupid" class="form-control"><option value="0"><?php echo lang("ctn_46") ?></option><option value="-1"><?php echo lang("ctn_47") ?></option>
            <?php foreach($groups->result() as $r) : ?>
            	<option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
            <?php endforeach; ?>
            </select>
        </div>
</div>
<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_48") ?></label>
        <div class="col-md-9">
            <input type="text" name="title" class="form-control" />
        </div>
</div>
<div class="form-group">
        <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_49") ?></label>
        <div class="col-md-9">
            <textarea name="message" class="form-control" rows="8"></textarea>
        </div>
</div>

<input type="submit" class="form-control btn btn-primary" value="<?php echo lang("ctn_50") ?>" />
<?php echo form_close() ?>
</div>
</div>
</div>