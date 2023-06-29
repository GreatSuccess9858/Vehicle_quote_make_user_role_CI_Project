<script src="<?php echo base_url();?>scripts/libraries/sortable/Sortable.min.js"></script>
<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span>User Roles</div>
    <div class="db-header-extra"><input type="button" class="btn btn-primary" value="<?php echo lang("ctn_319") ?>" data-toggle="modal" data-target="#memberModal" />
</div>
</div>
<!---->
<!--<ol class="breadcrumb">-->
<!--  <li><a href="--><?php //echo site_url() ?><!--">--><?php //echo lang("ctn_2") ?><!--</a></li>-->
<!--  <li><a href="--><?php //echo site_url("admin") ?><!--">--><?php //echo lang("ctn_1") ?><!--</a></li>-->
<!--  <li class="active">--><?php //echo lang("ctn_316") ?><!--</li>-->
<!--</ol>-->

  <p class="little-show-p"><?php echo lang("ctn_318") ?></p>


<table class="table table-bordered">
<tr class="table-header"><td><?php echo lang("ctn_320") ?></td><td><?php echo lang("ctn_307") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
<?php foreach($roles->result() as $r) : ?>
<tr><td><?php echo $r->name ?></td>
<td>
<?php foreach($permissions as $key => $p) : ?>
<?php if($r->$key) : ?>
<span class="btn btn-primary <?php echo $p['class'] ?>" title="<?php echo $p['desc'] ?>" data-placement="bottom" data-toggle="tooltip"><?php echo $p['name'] ?></span>
<?php endif; ?>
<?php endforeach; ?>
</td>
<td><a href="<?php echo site_url("admin/edit_user_role/" . $r->ID) ?>" class="btn btn-warning btn-xs" title="<?php echo lang("ctn_55") ?>"><i class="mdi mdi-settings"></i> </a> <a href="<?php echo site_url("admin/delete_user_role/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo lang("ctn_317") ?>')" title="<?php echo lang("ctn_57") ?>"><i class="mdi mdi-delete-forever
"></i> </a></td></tr>
<?php endforeach; ?>
</table>

<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title m-auto" id="myModalLabel"><?php echo lang("ctn_319") ?></h4>
      </div>
      <div class="modal-body">
      
      <?php echo form_open(site_url("admin/add_user_role_pro"), array("class" => "form-horizontal", "id" => "user_roles")) ?>

        <div class="form-group">
                <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_320") ?></label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="email-in" name="name">
                </div>
        </div>
        <hr>
        <div class="row">
        <div class="col-md-6">
        <strong><?php echo lang("ctn_408") ?></strong><br /><br />

        <ul id="items" style="width: 100%; min-height: 100px;"">
        <?php foreach($permissions as $p) : ?>
            <?php if(!$p['selected']) : ?>
        <li class="btn btn-primary <?php echo $p['class'] ?>" title="<?php echo $p['desc'] ?>" data-id="<?php echo $p['id'] ?>" data-placement="bottom" data-toggle="tooltip"><?php echo $p['name'] ?></li>
        <?php endif; ?>
        <?php endforeach; ?>
        </ul>

        </div>
        <div class="col-md-6"><strong><?php echo lang("ctn_409") ?></strong><br /><br />


        <ul id="active_items" style="width: 100%; min-height: 100px; border: 1px solid #DDD; border-radius: 4px; padding: 5px;">
        <?php foreach($permissions as $p) : ?>
            <?php if($p['selected']) : ?>
        <li class="btn btn-primary <?php echo $p['class'] ?>" title="<?php echo $p['desc'] ?>" data-id="<?php echo $p['id'] ?>" data-placement="bottom" data-toggle="tooltip"><?php echo $p['name'] ?></li>
        <?php endif; ?>
        <?php endforeach; ?>
        </ul>

        </div>

        </div>

        <p class="small-text"><?php echo lang("ctn_410") ?></p>

        <div id="hiddenforms">
        <input type="hidden" name="user_roles[]" id="user_roles_array">
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
<script type="text/javascript">
$(document).ready(function() {

    // Permissions
    var el = document.getElementById('items');
    var sortable = Sortable.create(el, {
        group : { 
            name: "permissions",
            put : ['active_permissions']
        },
        sort : false,
        animation: 100
    });

    // Active Permissions
    var active_permissions = document.getElementById('active_items');
    var ap = Sortable.create(active_permissions, {
        group : {
            name: "active_permissions",
            put: ['permissions']
        },
        animation: 100,
        sort : false,

    });

     $("#user_roles").submit(function(e) {
        var apA = ap.toArray();
        for(var i=0;i<apA.length;i++) {
            $("#hiddenforms").append('<input type="hidden" name="user_roles[]" value="'+apA[i]+'">');
        }
        return true;
    });

});
</script>