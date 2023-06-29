<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title text-center"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
</div>
<div class="db-header-extra form-inline">
    <div class="form-group has-feedback no-margin pt-0">
        <div class="input-group">
            <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
            <div class="input-group-btn">
                <input type="hidden" id="search_type" value="0">
<!--                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>-->
<!--                <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">-->
<!--                    <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok" id="search-like"></span> --><?php //echo lang("ctn_337") ?><!--</a></li>-->
<!--                    <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok no-display" id="search-exact"></span> --><?php //echo lang("ctn_338") ?><!--</a></li>-->
<!--                    <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok no-display" id="user-exact"></span> --><?php //echo lang("ctn_339") ?><!--</a></li>-->
<!--                    <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok no-display" id="action-exact"></span> --><?php //echo lang("ctn_472") ?><!--</a></li>-->
<!--                </ul>-->
            </div><!-- /btn-group -->
        </div>
    </div>
</div>

<div class="table-responsive">
<table id="member-table" class="table table-striped table-hover table-bordered">
<thead>
<tr class="table-header"><td><?php echo lang("ctn_339") ?></td><td><?php echo lang("ctn_472") ?></td><td><?php echo lang("ctn_70") ?></td><td><?php echo lang("ctn_37") ?></td></tr>
</thead>
<tbody>
</tbody>
</table>
</div>

</div>

<script type="text/javascript">
$(document).ready(function() {

   var st = $('#search_type').val();
    var table = $('#member-table').DataTable({
        "dom" : "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 10,
        "serverSide": true,
        "orderMulti": false,
        "order": [
        ],
        "columns": [
        null,
        { "orderable" : false },
        null,
        { "orderable" : false }
    ],
        "ajax": {
            url : "<?php echo site_url("admin/user_log_page") ?>",
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
        "user-exact",
        "action-exact",
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