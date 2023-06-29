<script src="<?php echo base_url(); ?>scripts/libraries/sortable/Sortable.min.js"></script>
<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"><span class="glyphicon glyphicon-user"></span> User Roles | Edit User Role</div>
        <div class="db-header-extra">
        </div>
    </div>
    <!---->
    <!--<ol class="breadcrumb">-->
    <!--  <li><a href="--><?php //echo site_url() ?><!--">--><?php //echo lang("ctn_1") ?><!--</a></li>-->
    <!--  <li><a href="--><?php //echo site_url("admin") ?><!--">--><?php //echo lang("ctn_1") ?><!--</a></li>-->
    <!--  <li><a href="--><?php //echo site_url("admin/user_roles") ?><!--">-->
    <?php //echo lang("ctn_316") ?><!--</a></li>-->
    <!--  <li class="active">--><?php //echo lang("ctn_321") ?><!--</li>-->
    <!--</ol>-->


    <div class="panel panel-default">
        <div class="panel-body">

            <?php echo form_open(site_url("admin/edit_user_role_pro/" . $role->ID), array("class" => "form-horizontal", "id" => "user_roles")) ?>

            <div class="form-group">
                <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_320") ?></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="email-in" name="name" value="<?php echo $role->name ?>">
                </div>
            </div>
            <hr>
            <div class="row container">
                <div class="col-md-6">
                    <strong><?php echo lang("ctn_408") ?></strong><br/><br/>

                    <ul id="items" style="width: 100%; min-height: 100px;"
                    ">
                    <?php foreach ($permissions as $p) : ?>
                        <?php if (!$p['selected']) : ?>
                            <li class="btn btn-primary <?php echo $p['class'] ?>" title="<?php echo $p['desc'] ?>"
                                data-id="<?php echo $p['id'] ?>" data-placement="bottom"
                                data-toggle="tooltip"><?php echo $p['name'] ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-6"><strong><?php echo lang("ctn_409") ?></strong><br/><br/>
                    <ul id="active_items"
                        style="width: 100%; min-height: 100px; border: 1px solid #DDD;   padding: 5px;">
                        <?php foreach ($permissions as $p) : ?>
                            <?php if ($p['selected']) : ?>
                                <li class="btn btn-primary <?php echo $p['class'] ?>" title="<?php echo $p['desc'] ?>"
                                    data-id="<?php echo $p['id'] ?>" data-placement="bottom"
                                    data-toggle="tooltip"><?php echo $p['name'] ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <p class="small-text"><?php echo lang("ctn_410") ?></p>
            <div id="hiddenforms">
                <input type="hidden" name="user_roles[]" id="user_roles_array">
            </div>

            <hr>
            <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_13") ?>">
            <?php echo form_close() ?>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        // Permissions
        var el = document.getElementById('items');
        var sortable = Sortable.create(el, {
            group: {
                name: "permissions",
                put: ['active_permissions']
            },
            sort: false,
            animation: 100
        });

        // Active Permissions
        var active_permissions = document.getElementById('active_items');
        var ap = Sortable.create(active_permissions, {
            group: {
                name: "active_permissions",
                put: ['permissions']
            },
            animation: 100,
            sort: false,

        });

        $("#user_roles").submit(function (e) {
            var apA = ap.toArray();
            for (var i = 0; i < apA.length; i++) {
                $("#hiddenforms").append('<input type="hidden" name="user_roles[]" value="' + apA[i] + '">');
            }
            return true;
        });

    });
</script>