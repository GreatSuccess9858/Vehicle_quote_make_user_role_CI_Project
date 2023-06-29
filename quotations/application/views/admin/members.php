<div class="white-area-content">
    <div class="db-header clearfix  ">
        <div class="page-header-title text-center"><span class="glyphicon glyphicon-user"></span>Manage Members</div>
    </div>

<!--        <ol class="breadcrumb">-->
<!--            <li><a href="--><?php //echo site_url() ?><!--">--><?php //echo lang("ctn_2") ?><!--</a></li> /-->
<!--            <li><a href="--><?php //echo site_url("admin") ?><!--">--><?php //echo lang("ctn_1") ?><!--</a></li> / -->
<!--            <li class="active">--><?php //echo lang("ctn_74") ?><!--</li>-->
<!--        </ol>-->
    <div class="db-header-extra form-inline d-flex justify-content-between">
        <div class="form-group has-feedback no-margin pt-0">
            <div class="input-group">
                <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>"
                       id="form-search-input"/>
<!--                    <div class="input-group-btn">-->
<!--                        <input type="hidden" id="search_type" value="0">-->
<!--                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"-->
<!--                                aria-haspopup="true" aria-expanded="false">-->
<!--                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>-->
<!--                        <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">-->
<!--                            <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok"-->
<!--                                                                             id="search-like"></span> --><?php //echo lang("ctn_337") ?>
<!--                                </a></li>-->
<!--                            <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok no-display"-->
<!--                                                                             id="search-exact"></span> --><?php //echo lang("ctn_338") ?>
<!--                                </a></li>-->
<!--                            <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok no-display"-->
<!--                                                                             id="user-exact"></span> --><?php //echo lang("ctn_339") ?>
<!--                                </a></li>-->
<!--                            <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok no-display"-->
<!--                                                                             id="fn-exact"></span> --><?php //echo lang("ctn_340") ?>
<!--                                </a></li>-->
<!--                            <li><a href="#" onclick="change_search(4)"><span class="glyphicon glyphicon-ok no-display"-->
<!--                                                                             id="ln-exact"></span> --><?php //echo lang("ctn_341") ?>
<!--                                </a></li>-->
<!--                            <li><a href="#" onclick="change_search(5)"><span class="glyphicon glyphicon-ok no-display"-->
<!--                                                                             id="role-exact"></span> --><?php //echo lang("ctn_342") ?>
<!--                                </a></li>-->
<!--                            <li><a href="#" onclick="change_search(6)"><span class="glyphicon glyphicon-ok no-display"-->
<!--                                                                             id="email-exact"></span> --><?php //echo lang("ctn_78") ?>
<!--                                </a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
            </div>
        </div>
        <input type="button" class="btn btn-primary" value="<?php echo lang("ctn_73") ?>" data-toggle="modal"
               data-target="#memberModal"/>
    </div>

    <p class="little-show-p"><?php echo lang("ctn_75") ?></p>
    <div class="table-responsive">
        <table id="member-table" class="table table-striped table-hover table-bordered">
            <thead>
            <tr class="table-header">
                <td><?php echo lang("ctn_191") ?></td>
                <td><?php echo lang("ctn_29") ?></td>
                <td><?php echo lang("ctn_30") ?></td>
                <td><?php echo lang("ctn_78") ?></td>
                <td><?php echo lang("ctn_322") ?></td>
                <td><?php echo lang("ctn_194") ?></td>
                <td><?php echo lang("ctn_195") ?></td>
                <td><?php echo lang("ctn_52") ?></td>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var st = $('#search_type').val();
        var table = $('#member-table').DataTable({
            "dom": "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "processing": false,
            "pagingType": "full_numbers",
            "pageLength": 10,
            "serverSide": true,
            "orderMulti": false,
            "order": [
                [5, "asc"]
            ],
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"orderable": false}
            ],
            "ajax": {
                url: "<?php echo site_url("admin/members_page") ?>",
                type: 'GET',
                data: function (d) {
                    d.search_type = $('#search_type').val();
                }
            },
            "drawCallback": function (settings, json) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
        $('#form-search-input').on('keyup change', function () {
            table.search(this.value).draw();
        });
    });

    function change_search(search) {
        var options = [
            "search-like",
            "search-exact",
            "user-exact",
            "fn-exact",
            "ln-exact",
            "role-exact",
            "email-exact"
        ];
        set_search_icon(options[search], options);
        $('#search_type').val(search);
        $("#form-search-input").trigger("change");
    }

    function set_search_icon(icon, options) {
        for (var i = 0; i < options.length; i++) {
            if (options[i] == icon) {
                $('#' + icon).fadeIn(10);
            } else {
                $('#' + options[i]).fadeOut(10);
            }
        }
    }
</script>
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="display: contents">
                <h4 class="modal-title text-center p-3" id="myModalLabel">Add Member</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open(site_url("admin/add_member_pro"), array("class" => "form-horizontal js-validation--custom-1", "ID" => "js-validation--custom-1")) ?>
                <div class="form-group">
                    <label for="email-in" class="col-md-6 label-heading"><?php echo lang("ctn_78") ?></label>
                    <div class="col-md-12">
                        <input type="email" class="form-control" id="email-in" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username-in" class="col-md-6 label-heading"><?php echo lang("ctn_77") ?></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="username" name="username">
                        <div id="username_check"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-in" class="col-md-6 label-heading"><?php echo lang("ctn_87") ?></label>
                    <div class="col-md-12">
                        <input type="password" class="form-control" id="password-in" name="password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpassword-in" class="col-md-6 label-heading"><?php echo lang("ctn_88") ?></label>
                    <div class="col-md-12">
                        <input type="password" class="form-control" id="cpassword-in" name="password2" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name-in" class="col-md-6 label-heading"><?php echo lang("ctn_79") ?></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="name-in" name="first_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name-in" class="col-md-6 label-heading"><?php echo lang("ctn_80") ?></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="name-in" name="last_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name-in" class="col-md-6 label-heading"><?php echo lang("ctn_322") ?></label>
                    <div class="col-md-12">
                        <select name="user_role" class="form-control">
                            <option value="0" selected><?php echo lang("ctn_46") ?></option>
                            <?php foreach ($user_roles->result() as $r): ?>
                                <option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name-in" class="col-md-6 label-heading">*<?php _l('sedes'); ?></label>
                    <div class="col-md-12">
                        <?php $sedes = $this->db->where('status', 1)->get('ce_sedes')->result_array(); ?>
                        <?php foreach ($sedes as $k => $v) {
                            ?>
                            <label class="radio" for="sedes_<?PHP echo $k; ?>">
                                <input type="checkbox" id="sedes_<?PHP echo $k; ?>" name="sedes[]"
                                       value="<?php echo $v['sedes_id']; ?>">
                                <?php echo $v['name']; ?>
                            </label>
                            <?PHP
                        } ?>
                    </div>
                </div>
                <?php foreach ($fields->result() as $r): ?>
                    <div class="form-group">
                        <label for="name-in"
                               class=" label-heading"><?php echo $r->name ?> <?php if ($r->required): ?>*<?php endif; ?></label>
                        <div class="col-md-12">
                            <?php if ($r->type == 0): ?>
                                <input type="text" class="form-control" id="name-in" name="cf_<?php echo $r->ID ?>"
                                       value="<?php if (isset($_POST['cf_' . $r->ID])) {
                                           echo $_POST['cf_' . $r->ID];
                                       }
                                       ?>">
                            <?php elseif ($r->type == 1): ?>
                                <textarea name="cf_<?php echo $r->ID ?>" rows="8"
                                          class="form-control"><?php if (isset($_POST['cf_' . $r->ID])) {
                                        echo $_POST['cf_' . $r->ID];
                                    }
                                    ?></textarea>
                            <?php elseif ($r->type == 2): ?>
                                <?php $options = explode(",", $r->options); ?>
                                <?php if (count($options) > 0): ?>
                                    <?php foreach ($options as $k => $v): ?>
                                        <div class="form-group"><input type="checkbox"
                                                                       name="cf_cb_<?php echo $r->ID ?>_<?php echo $k ?>"
                                                                       value="1" <?php if (isset($_POST['cf_cb_' . $r->ID . "_" . $k])) {
                                                echo "checked";
                                            }
                                            ?>> <?php echo $v ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php elseif ($r->type == 3): ?>
                                <?php $options = explode(",", $r->options); ?>
                                <?php if (count($options) > 0): ?>
                                    <?php foreach ($options as $k => $v): ?>
                                        <div class="form-group"><input type="radio" name="cf_radio_<?php echo $r->ID ?>"
                                                                       value="<?php echo $k ?>" <?php if (isset($_POST['cf_radio_' . $r->ID]) && $_POST['cf_radio_' . $r->ID] == $k) {
                                                echo "checked";
                                            }
                                            ?>> <?php echo $v ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php elseif ($r->type == 4): ?>
                                <?php $options = explode(",", $r->options); ?>
                                <?php if (count($options) > 0): ?>
                                    <select name="cf_<?php echo $r->ID ?>" class="form-control">
                                        <?php foreach ($options as $k => $v): ?>
                                            <option
                                                value="<?php echo $k ?>" <?php if (isset($_POST['cf_' . $r->ID]) && $_POST['cf_' . $r->ID] == $k) {
                                                echo "selected";
                                            }
                                            ?>><?php echo $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                            <?php endif; ?>
                            <span class="help-text"><?php echo $r->help_text ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
<!--                <p>--><?php //echo lang("ctn_351") ?><!--</p>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
                <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_61") ?>"/>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>