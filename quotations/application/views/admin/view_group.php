<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"><input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_129") ?> <?php echo $group->name ?>" data-toggle="modal" data-target="#memberModal" />
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li><a href="<?php echo site_url("admin/user_groups") ?>"><?php echo lang("ctn_15") ?></a></li>
  <li class="active"><?php echo lang("ctn_125") ?></li>
</ol>

<p><?php echo lang("ctn_126") ?> <b><?php echo $group->name ?></b> - <?php echo lang("ctn_127") ?> <b><?php echo number_format($total_members) ?></b></p>

<hr>

<table class="table table-bordered">
<tr class="table-header"><td><?php echo lang("ctn_25") ?></td><td><?php echo lang("ctn_128") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
<?php foreach($users->result() as $r) : ?>
<tr><td><?php echo $r->username ?></td><td><?php echo $r->name ?></td><td><a href="<?php echo site_url("admin/remove_user_from_group/" . $r->userid . "/" . $r->groupid . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs"><?php echo lang("ctn_130") ?></a></td></tr>
<?php endforeach; ?>
</table>

<div class="align-center">
<?php echo $this->pagination->create_links() ?>
</div>

<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title m-auto" id="myModalLabel"><?php echo lang("ctn_129") ?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("admin/add_user_to_group_pro/" . $group->ID), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_132") ?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="email-in" name="usernames">
                        <span class="help-text"><?php echo lang("ctn_131") ?></span>
                    </div>
            </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_61") ?>" />
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
</div>