<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-piggy-bank"></span> <?php echo lang("ctn_250") ?></div>
    <div class="db-header-extra"> <a href="<?php echo site_url("funds/payment_log") ?>" class="btn btn-info btn-sm"><?php echo lang("ctn_388") ?></a>
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("funds") ?>"><?php echo lang("ctn_250") ?></a></li>
  <li class="active"><?php echo lang("ctn_388") ?></li>
</ol>

<hr>

<table id="payment_table" class="table table-bordered table-hover table-striped">
<thead>
<tr class="table-header"><td><?php echo lang("ctn_25") ?></td><td><?php echo lang("ctn_291") ?></td><td><?php echo lang("ctn_292") ?></td><td><?php echo lang("ctn_293") ?></td><td><?php echo lang("ctn_378") ?></td></tr>
</thead>
<tbody>
</tbody>
</table>

</div>
<script type="text/javascript">
$(document).ready(function() {

   var st = $('#search_type').val();
    var table = $('#payment_table').DataTable({
        "dom" : "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 15,
        "serverSide": true,
        "orderMulti": false,
        "order": [
          [3, "asc" ]
        ],
        "columns": [
        { "orderable" : false },
        { "orderable" : false },
        null,
        null,
        null
    ],
        "ajax": {
            url : "<?php echo site_url("funds/payment_logs_page") ?>",
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