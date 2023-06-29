<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> <a href="<?php echo site_url("admin/edit_member/" . $member->ID) ?>" class="btn btn-warning btn-sm"><?php echo lang("ctn_22") ?></a> <input type="button" class="btn btn-primary btn-sm" value="Add To User Group" data-toggle="modal" data-target="#addModal" />
</div>
</div>
<!--<ol class="breadcrumb">-->
<!--  <li><a href="--><?php //echo site_url() ?><!--">--><?php //echo lang("ctn_2") ?><!--</a></li>-->
<!--  <li><a href="--><?php //echo site_url("admin") ?><!--">--><?php //echo lang("ctn_1") ?><!--</a></li>-->
<!--  <li><a href="--><?php //echo site_url("admin/members") ?><!--">--><?php //echo lang("ctn_21") ?><!--</a></li>-->
<!--  <li class="active">--><?php //echo lang("ctn_15") ?><!--</li>-->
<!--</ol>-->

<table class="table table-bordered table-striped table-hover">
<tr class="table-header"><td><?php echo lang("ctn_389") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
<?php foreach($user_groups->result() as $r) : ?>
<tr><td><?php echo $r->name ?></td><td><a href="<?php echo site_url("admin/remove_user_from_group/" . $r->userid . "/" . $r->groupid . "/" . $this->security->get_csrf_hash()) ?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-danger btn-xs" title="<?php echo lang("ctn_130") ?>"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
<?php endforeach; ?>
</table>

</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title m-auto" id="myModalLabel"><?php echo lang("ctn_129") ?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("admin/add_member_to_group_pro/" . $member->ID), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="email-in" class="col-md-3 label-heading">User Group</label>
                    <div class="col-md-9">
                       	<select name="groupid" class="form-control">
                       	<?php foreach($groups->result() as $r) : ?>
                       		<option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
                       	<?php endforeach; ?>
                       	</select>
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