<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra form-inline">

    	         <div class="form-group has-feedback no-margin">
<div class="input-group">
<input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
<div class="input-group-btn">
    <input type="hidden" id="search_type" value="0">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
          <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok" id="search-like"></span> <?php echo lang("ctn_337") ?></a></li>
          <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok no-display" id="search-exact"></span> <?php echo lang("ctn_338") ?></a></li>
          <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok no-display" id="title-exact"></span> <?php echo lang("ctn_11") ?></a></li>
          <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok no-display" id="language-exact"></span> <?php echo lang("ctn_148") ?></a></li>
        </ul>
      </div><!-- /btn-group -->
</div>
</div>

<input type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" value="<?php echo lang("ctn_407") ?>">

</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_62") ?></li>
</ol>

<p><?php echo lang("ctn_63") ?></p>

<hr>

<div class="table-responsive">
<table id="ann-table" class="table table-bordered table-striped table-hover">
<thead>
<tr class="table-header"><td><?php echo lang("ctn_11") ?></td><td><?php echo lang("ctn_404") ?></td><td><?php echo lang("ctn_148") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
</thead>
<tbody>
</tbody>
</table>
</div>

</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-send"></span> <?php echo lang("ctn_407") ?></h4>
      </div>
      <div class="modal-body">
         <?php echo form_open(site_url("admin/add_email_template"), array("class" => "form-horizontal")) ?>
          <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_11") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="title" value="">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_404") ?></label>
                    <div class="col-md-8">
                        <select name="hook" class="form-control">
                        <option value="email_activation"><?php echo lang("ctn_405") ?></option>
                        <option value="forgot_password"><?php echo lang("ctn_174") ?></option>
                        </select>
                        <span class="help-block"><?php echo lang("ctn_406") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_148") ?></label>
                    <div class="col-md-8">
                        <select name="language" class="form-control">
                        <?php foreach($languages as $k=>$v) : ?>
					      	<option value="<?php echo $k ?>"><?php echo $v['display_name'] ?></option>
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
                        <textarea name="template" id="ann-area"></textarea>
                    </div>
            </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_407") ?>">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
CKEDITOR.replace('ann-area', { height: '150'});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
   var st = $('#search_type').val();
    var table = $('#ann-table').DataTable({
        "dom" : "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 15,
        "serverSide": true,
        "orderMulti": false,
        "order": [
          
        ],
        "columns": [
        null,
        null,
        null,
        { "orderable": false }
    ],
        "ajax": {
            url : "<?php echo site_url("admin/email_template_page") ?>",
            type : 'GET',
            data : function ( d ) {
                d.search_type = $('#search_type').val();
            }
        },
        "drawCallback": function(settings, json) {
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
    $('#form-search-input').on('keyup change', function () {
    table.search(this.value).draw();
});

} );
function change_search(search) 
    {
      var options = [
        "search-like", 
        "search-exact",
        "title-exact",
        "language-exact"
      ];
      set_search_icon(options[search], options);
        $('#search_type').val(search);
        $( "#form-search-input" ).trigger( "change" );
    }

function set_search_icon(icon, options) 
    {
      for(var i = 0; i<options.length;i++) {
        if(options[i] == icon) {
          $('#' + icon).fadeIn(10);
        } else {
          $('#' + options[i]).fadeOut(10);
        }
      }
    }
</script>