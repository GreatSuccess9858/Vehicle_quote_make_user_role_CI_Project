<div class="row">
    <div class="col-md-5">
        <div class="white-area-content">
            <div class="profile-icon align-center">
                <img
                    src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>"
                    class="profile-user-icon">
                <p class="profile-p"><?php echo $user->first_name ?><?php echo $user->last_name ?></p>
                <p class="small-text">@<a
                        href="<?php echo site_url("profile/" . $user->username) ?>"><?php echo $user->username ?></a>
                </p>
            </div>
            <div class="align-center">
                <?php if (isset($user_data) && $user_data->twitter) : ?>
                    <div class="project-info project-block align-center">
                        <a href="https://twitter.com/<?php echo $this->security->xss_clean($user_data->twitter) ?>">
                            <img src="<?php echo base_url() ?>images/social/twitter.png" height="20"
                                 class='social-icon'/></a>
                    </div>
                <?php endif; ?>
                <?php if (isset($user_data) && $user_data->facebook) : ?>
                    <div class="project-info project-block align-center">
                        <a href="https://www.facebook.com/<?php echo $this->security->xss_clean($user_data->facebook) ?>">
                            <img src="<?php echo base_url() ?>images/social/facebook.png" height="20"
                                 class='social-icon'/></a>
                    </div>
                <?php endif; ?>
                <?php if (isset($user_data) && $user_data->google) : ?>
                    <div class="project-info project-block align-center">
                        <a href="https://plus.google.com/<?php echo $this->security->xss_clean($user_data->google) ?>">
                            <img src="<?php echo base_url() ?>images/social/google.png" height="20"
                                 class='social-icon'/></a>
                    </div>
                <?php endif; ?>
                <?php if (isset($user_data) && $user_data->linkedin) : ?>
                    <div class="project-info project-block align-center">
                        <a href="https://www.linkedin.com/in/<?php echo $this->security->xss_clean($user_data->google) ?>">
                            <img src="<?php echo base_url() ?>images/social/linkedin.png" height="20"
                                 class='social-icon'/></a>
                    </div>
                <?php endif; ?>
                <?php if (isset($user_data) && $user_data->website) : ?>
                    <div class="project-info project-block align-center">
                        <a href="<?php echo $this->security->xss_clean($user_data->website) ?>">
                            <span class="glyphicon glyphicon-link"></span></a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="align-center">
                <div class="project-info project-block align-center">
                    <p class="project-info-bit profile-big-text"><?php echo number_format($user->profile_views) ?></p>
                    <p class="project-info-title"><?php echo lang("ctn_415") ?></p>
                </div>
                <div class="project-info project-block align-center">
                    <p class="project-info-bit profile-big-text"><?php echo $comment_count ?></p>
                    <p class="project-info-title"><?php echo lang("ctn_416") ?></p>
                </div>
                <div class="project-info project-block align-center">
                    <p class="project-info-bit profile-big-text">
                        <?php if ($user->online_timestamp > time() - (60 * 15)) : ?>
                            <span class="profile-online"><?php echo lang("ctn_139") ?></span>
                        <?php else : ?>
                            <span class="profile-offline"><?php echo lang("ctn_335") ?></span>
                        <?php endif; ?>
                    </p>
                    <p class="project-info-title"><?php echo lang("ctn_418") ?></p>
                </div>
            </div>
        </div>
        <div class="white-area-content content-separator">
            <h4 class="profile-heading"><?php echo lang("ctn_419") ?></h4>
            <table class="table borderless small-text">
                <tr>
                    <td><?php echo lang("ctn_201") ?> <span
                            class="profile-info-content"><?php echo $user->first_name ?><?php echo $user->last_name ?></span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo lang("ctn_322") ?> <span class="profile-info-content"><?php echo $role ?></span></td>
                </tr>
                <tr>
                    <td><?php echo lang("ctn_202") ?> <span
                            class="profile-info-content"><?php echo date($this->settings->info->date_format, $user->joined) ?></span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo lang("ctn_203") ?> <span
                            class="profile-info-content"><?php echo date($this->settings->info->date_format, $user->online_timestamp) ?></span>
                    </td>
                </tr>
                <?php if ($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                    <tr>
                        <td><?php echo lang("ctn_24") ?> <span
                                class="profile-info-content"><?php echo $user->email ?></span></td>
                    </tr>
                    <tr>
                        <td>Phone <span
                                class="profile-info-content"><?php echo $user->phone ?></span></td>
                    </tr>
                    <tr>
                        <td><?php echo lang("ctn_391") ?> <span
                                class="profile-info-content"><?php echo $user->address_1 ?></span></td>
                    </tr>
                    <tr>
                        <td><?php echo lang("ctn_392") ?> <span
                                class="profile-info-content"><?php echo $user->address_2 ?></span></td>
                    </tr>
                    <tr>
                        <td><?php echo lang("ctn_393") ?> <span
                                class="profile-info-content"><?php echo $user->city ?></span></td>
                    </tr>
                    <tr>
                        <td><?php echo lang("ctn_394") ?> <span
                                class="profile-info-content"><?php echo $user->state ?></span></td>
                    </tr>
                    <tr>
                        <td><?php echo lang("ctn_395") ?><span
                                class="profile-info-content"><?php echo $user->zipcode ?></span></td>
                    </tr>
                    <tr>
                        <td><?php echo lang("ctn_396") ?> <span
                                class="profile-info-content"><?php echo $user->country ?></span></td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($fields->result() as $r) : ?>
                    <?php if ($r->type == 1) : ?>
                        <tr>
                            <td><?php echo $r->name ?><br/><strong><?php echo $r->value ?></strong></td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td><?php echo $r->name ?> <span class="profile-info-content"><?php echo $r->value ?></span>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
        <!--        --><?php //if ($groups->num_rows() > 0) : ?>
        <!--            <div class="white-area-content content-separator">-->
        <!--                <h4 class="profile-heading">--><?php //echo lang("ctn_15") ?><!--</h4>-->
        <!--                --><?php //foreach ($groups->result() as $r) : ?>
        <!--                    <label class="label label-default">--><?php //echo $r->name ?><!--</label>-->
        <!--                --><?php //endforeach; ?>
        <!--            </div>-->
        <!--        --><?php //endif; ?>
    </div>
    <div class="col-md-7 mt-2">
        <div class="white-area-content">
            <h4 class="profile-heading"><?php echo $user->username ?><?php echo lang("ctn_420") ?></h4>
            <?php if (empty($user->aboutme)) : ?>
                <p><?php echo lang("ctn_759") ?></p>
            <?php else : ?>
                <p><?php echo nl2br($user->aboutme) ?></p>
            <?php endif; ?>
        </div>
        <?php if ($this->settings->info->profile_comments && $user->profile_comments) : ?>
            <div class="white-area-content content-separator">
                <h4 class="profile-heading"><?php echo lang("ctn_402") ?></h4>
                <?php foreach ($comments->result() as $r) : ?>
                    <div class="media">
                        <div class="media-left">
                            <?php echo $this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)) ?>
                        </div>
                        <div class="media-body">
                            <?php if ($r->userid == $this->user->info->ID || $r->profileid == $this->user->info->ID || $this->common->has_permissions(array("admin", "admin_members"), $this->user)) : ?>
                                <div class="pull-right">
                                    <a href="<?php echo site_url("profile/delete_comment/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>"
                                       class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom"
                                       title="<?php echo lang("ctn_57") ?>"><span
                                            class="glyphicon glyphicon-trash"></span></a>
                                </div>
                            <?php endif; ?>
                            <?php echo $r->comment ?>
                            <p class="small-text"><?php echo date($this->settings->info->date_format, $r->timestamp) ?></p>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <div class="align-center"><?php echo $this->pagination->create_links() ?></div>
                <hr>
                <?php echo form_open(site_url("profile/comment/" . $user->ID), array("class" => "form-horizontal")) ?>
                <div class="form-group">
                    <div class="col-md-12  ui-front">
                        <textarea name="comment" id="msg-area" style="width: 100%;"></textarea>
                    </div>
                </div>
                <p><input type="submit" class="btn btn-primary float-right"
                          value="<?php echo lang("ctn_421") ?>"/></p>
                <?php echo form_close(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('msg-area', {height: '100'});
</script>