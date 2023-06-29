<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li><a href="<?php echo site_url("admin/email_templates") ?>"><?php echo lang("ctn_3") ?></a></li>
  <li class="active"><?php echo lang("ctn_4") ?></li>
</ol>

<p><?php echo lang("ctn_5") ?></p>

<hr>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open(site_url("admin/edit_email_template_pro/" . $email_template->ID), array("class" => "form-horizontal")) ?>

<div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_11") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="title" value="<?php echo $email_template->title ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_404") ?></label>
                    <div class="col-md-8">
                        <select name="hook" class="form-control">
                        <option value="email_activation"><?php echo lang("ctn_405") ?></option>
                        <option value="forgot_password" <?php if($email_template->hook == "forgot_password") echo "selected" ?>><?php echo lang("ctn_174") ?></option>
                        </select>
                        <span class="help-block"><?php echo lang("ctn_406") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_148") ?></label>
                    <div class="col-md-8">
                        <select name="language" class="form-control">
                        <?php foreach($languages as $k=>$v) : ?>
                          <option value="<?php echo $k ?>" <?php if($k == $email_template->language) echo "selected" ?>><?php echo $v['display_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <table class="table table-bordered">
      <tr><td>[NAME]</td><td> <?php echo lang("ctn_7") ?></td></tr>
      <tr><td>[SITE_URL]</td><td> <?php echo lang("ctn_8") ?></td></tr>
      <tr><td>[SITE_NAME]</td><td> <?php echo lang("ctn_9") ?></td></tr>
      <tr><td>[EMAIL_LINK]</td><td> <?php echo lang("ctn_10") ?></td></tr>
      </table>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_3") ?></label>
                    <div class="col-md-8">
                        <textarea name="template" id="ann-area"><?php echo $email_template->message ?></textarea>
                    </div>
            </div>   

<input type="submit" class="form-control btn btn-primary" value="<?php echo lang("ctn_13") ?>" />
<?php echo form_close() ?>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
CKEDITOR.replace('ann-area', { height: '150'});
});
</script>