<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> <input type="button" class="btn btn-primary" value="<?php echo lang("ctn_65") ?>" data-toggle="modal" data-target="#ipModal" />
</div>
</div>

<!--<ol class="breadcrumb">-->
<!--  <li><a href="--><?php //echo site_url() ?><!--">--><?php //echo lang("ctn_2") ?><!--</a></li>-->
<!--  <li><a href="--><?php //echo site_url("admin") ?><!--">--><?php //echo lang("ctn_1") ?><!--</a></li>-->
<!--  <li class="active">--><?php //echo lang("ctn_66") ?><!--</li>-->
<!--</ol>-->

<p class="little-show-p"><?php echo lang("ctn_67") ?></p>

<hr>

<table class="table table-bordered tbl">
<tr class="table-header"><td><?php echo lang("ctn_68") ?></td><td><?php echo lang("ctn_69") ?></td><td><?php echo lang("ctn_70") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
<?php foreach($ipblock->result() as $r) : ?>
<tr><td><?php echo $r->IP ?></td><td><?php echo $r->reason ?></td><td><?php echo date($this->settings->info->date_format, $r->timestamp) ?></td><td><a href="<?php echo site_url("admin/delete_ipblock/" . $r->ID) ?>" class="btn btn-danger btn-xs" title="<?php echo lang("ctn_57") ?>"><i class="mdi mdi-delete-forever"></i></a></td></tr>
<?php endforeach; ?>
</table>


<div class="modal fade" id="ipModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title m-auto" id="myModalLabel"><?php echo lang("ctn_71") ?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("admin/add_ipblock"), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="email-in" class="col-md-12 label-heading"><?php echo lang("ctn_68") ?></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="email-in" name="ip">
                    </div>
            </div>
            <div class="form-group">

                        <label for="username-in" class="col-md-12 label-heading"><?php echo lang("ctn_72") ?></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="username" name="reason">
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