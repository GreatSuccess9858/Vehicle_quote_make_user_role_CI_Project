<table cellpadding="0" cellspacing="0" border="0" class="display groceryCrudTable table-bordered col-md-12"
       id="<?php echo uniqid(); ?>">
    <thead class="text-center pt-3 pb-3 ">
    <tr class="p-3">
        <?php foreach ($columns as $column) { ?>
            <th class="p-2"><?php echo $column->display_as; ?></th>
        <?php } ?>
        <?php if (!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)) { ?>
            <th class='actions text-center'><?php echo $this->l('list_actions'); ?></th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $num_row => $row) { ?>
        <tr id='row-<?php echo $num_row ?> ' class='text-center'>
            <?php foreach ($columns as $column) { ?>
                <td><?php echo $row->{$column->field_name} ?></td>
            <?php } ?>
            <?php if (!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)) { ?>
                <td class='actions'>
                    <?php
                    if (!empty($row->action_urls)) {
                        foreach ($row->action_urls as $action_unique_id => $action_url) {
                            $action = $actions[$action_unique_id];
                            ?>
                            <a href="<?php echo $action_url; ?>"
                               class="btn btn-primary"
                               role="button">
                                <span
                                    class="ui-button-icon-primary ui-icon <?php echo $action->css_class; ?> <?php echo $action_unique_id; ?>"></span><span
                                    class="ui-button-text">&nbsp;<?php echo $action->label ?></span>
                            </a>
                        <?php }
                    }
                    ?>
                    <?php if (!$unset_read) { ?>
                        <a href="<?php echo $row->read_url ?>"
                           class="btn btn-raised btn-info btn-sm"
                           role="button">
<!--                            <span class="ui-button-icon-primary ui-icon ui-icon-document"></span>-->
                            <span class="ui-button-text">&nbsp;<?php echo $this->l('list_view'); ?></span>
                        </a>
                    <?php } ?>

                    <?php if (!$unset_clone) { ?>
                        <a href="<?php echo $row->clone_url ?>"
                           class="btn btn-raised btn-info btn-sm"
                           role="button">
<!--                            <span class="ui-button-icon-primary ui-icon ui-icon-copy"></span>-->
                            <span class="ui-button-text">&nbsp;<?php echo $this->l('list_clone'); ?></span>
                        </a>
                    <?php } ?>

                    <?php if (!$unset_edit) { ?>
                        <a href="<?php echo $row->edit_url ?>"
                           class="btn btn-raised btn-info btn-sm"
                           role="button">
<!--                            <span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span>-->
                            <span class="ui-button-text">&nbsp;<?php echo $this->l('list_edit'); ?></span>
                        </a>
                    <?php } ?>

                    <?php if (!$unset_delete) { ?>
                        <a onclick="javascript: return delete_row('<?php echo $row->delete_url ?>', '<?php echo $num_row ?>')"
                           href="javascript:void(0)"
                           class="btn btn-raised btn-warning btn-sm"
                           role="button">
<!--                            <span class="ui-button-icon-primary ui-icon ui-icon-circle-minus"></span>-->
                            <span class="ui-button-text">&nbsp;<?php echo $this->l('list_delete'); ?></span>
                        </a>
                    <?php } ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
    <tr>
        <?php foreach ($columns as $column) { ?>
            <th><input type="text" name="<?php echo $column->field_name; ?>"
                       placeholder="<?php echo $this->l('list_search') . ' ' . $column->display_as; ?>"
                       class="search_<?php echo $column->field_name; ?>" style="padding: 7px"/></th>
        <?php } ?>
        <?php if (!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)) { ?>
            <th class="float-right d-flex">
                <button
                    class="btn btn-raised btn-success"
                    role="button" data-url="<?php echo $ajax_list_url; ?>">
                    <i class="mdi mdi-refresh"></i>
                </button>
                <a href="javascript:void(0)" role="button"
                   class="btn btn-raised btn-success d-flex" style="margin-left: 5px">
                    <span class="ui-button-text"><?php echo $this->l('list_clear_filtering'); ?></span>
                </a>
            </th>
        <?php } ?>
    </tr>
    </tfoot>
</table>
