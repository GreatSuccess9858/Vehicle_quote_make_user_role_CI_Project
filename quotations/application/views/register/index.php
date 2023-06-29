<div class="container">
    <div class="row">
        <div class="col-md-4 center-block-e">


            <div class="login-form">
                <div class="login-form-inner">
                    <p class="login-form-intro"><img src="<?php echo base_url() ?>images/ava2.png" width="150"></p>


                    <?php if (!empty($fail)) : ?>
                        <div class="alert alert-danger"><?php echo $fail ?></div>
                    <?php endif; ?>

                    <?php echo form_open(site_url("register"), array("id" => "register_form")) ?>
                    <div class="form-group login-form-area has-feedback">
                        <input type="text" class="form-control" name="email" placeholder="<?php echo lang("ctn_214") ?>"
                               id="email" value="<?php if (isset($email)) echo $email; ?>">
                        <i class="glyphicon glyphicon-envelope form-control-feedback login-icon-color"
                           id="login-icon-email"></i>
                    </div>
                    <div class="form-group login-form-area has-feedback">
                        <input type="text" class="form-control" name="username" id="username"
                               placeholder="<?php echo lang("ctn_215") ?>"
                               value="<?php if (isset($username)) echo $username; ?>">
                        <i class="glyphicon glyphicon-user form-control-feedback login-icon-color"
                           id="login-icon-username"></i>
                    </div>
                    <div class="form-group login-form-area has-feedback">
                        <input type="password" class="form-control" name="password"
                               placeholder="<?php echo lang("ctn_216") ?>">
                        <i class="glyphicon glyphicon-lock form-control-feedback login-icon-color"></i>
                    </div>
                    <div class="form-group login-form-area has-feedback">
                        <input type="password" class="form-control" name="password2"
                               placeholder="<?php echo lang("ctn_217") ?>">
                        <i class="glyphicon glyphicon-lock form-control-feedback login-icon-color"></i>
                    </div>
                    <?php foreach ($fields->result() as $r) : ?>
                        <div class="form-group login-form-area">

                            <p><label for="name-in"
                                      class="label-heading"><?php echo $r->name ?> <?php if ($r->required) : ?>*<?php endif; ?></label>
                            </p>

                            <?php if ($r->type == 0) : ?>
                                <input type="text" class="form-control" id="name-in" name="cf_<?php echo $r->ID ?>"
                                       value="<?php if (isset($_POST['cf_' . $r->ID])) echo $_POST['cf_' . $r->ID] ?>">
                            <?php elseif ($r->type == 1) : ?>
                                <textarea name="cf_<?php echo $r->ID ?>" rows="8"
                                          class="form-control"><?php if (isset($_POST['cf_' . $r->ID])) echo $_POST['cf_' . $r->ID] ?></textarea>
                            <?php elseif ($r->type == 2) : ?>
                                <?php $options = explode(",", $r->options); ?>
                                <?php if (count($options) > 0) : ?>
                                    <?php foreach ($options as $k => $v) : ?>
                                        <div class="form-group"><input type="checkbox"
                                                                       name="cf_cb_<?php echo $r->ID ?>_<?php echo $k ?>"
                                                                       value="1" <?php if (isset($_POST['cf_cb_' . $r->ID . "_" . $k])) echo "checked" ?>> <?php echo $v ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php elseif ($r->type == 3) : ?>
                                <?php $options = explode(",", $r->options); ?>
                                <?php if (count($options) > 0) : ?>
                                    <?php foreach ($options as $k => $v) : ?>
                                        <div class="form-group"><input type="radio" name="cf_radio_<?php echo $r->ID ?>"
                                                                       value="<?php echo $k ?>" <?php if (isset($_POST['cf_radio_' . $r->ID]) && $_POST['cf_radio_' . $r->ID] == $k) echo "checked" ?>> <?php echo $v ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php elseif ($r->type == 4) : ?>
                                <?php $options = explode(",", $r->options); ?>
                                <?php if (count($options) > 0) : ?>
                                    <select name="cf_<?php echo $r->ID ?>" class="form-control">
                                        <?php foreach ($options as $k => $v) : ?>
                                            <option
                                                value="<?php echo $k ?>" <?php if (isset($_POST['cf_' . $r->ID]) && $_POST['cf_' . $r->ID] == $k) echo "selected" ?>><?php echo $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                            <?php endif; ?>
                            <span class="help-text"><?php echo $r->help_text ?></span>
                        </div>
                    <?php endforeach; ?>

                    <?php if (!$this->settings->info->disable_captcha) : ?>
                        <div class="form-group login-form-area">
                            <p><?php echo $cap['image'] ?></p>
                            <input type="text" class="form-control" id="captcha-in" name="captcha"
                                   placeholder="<?php echo lang("ctn_306") ?>" value="">
                        </div>
                    <?php endif; ?>

                    <?php if ($this->settings->info->google_recaptcha) : ?>
                        <div class="form-group login-form-area">
                            <div class="g-recaptcha"
                                 data-sitekey="<?php echo $this->settings->info->google_recaptcha_key ?>"></div>
                        </div>
                    <?php endif ?>


                    <input type="submit" name="s" class="btn btn-flat-login form-control"
                           value="<?php echo lang("ctn_221") ?>"/>

                    <hr>

                    <p><?php echo lang("ctn_222") ?></p>
                </div>


                <div class="login-form-bottom">


                    <?php if (!$this->settings->info->disable_social_login) : ?>
                        <div class="text-center decent-margin-top">
                            <?php if (!empty($this->settings->info->twitter_consumer_key) && !empty($this->settings->info->twitter_consumer_secret)) : ?>
                                <div class="btn-group">
                                    <a href="<?php echo site_url("login/twitter_login") ?>"
                                       class="btn btn-flat-social-twitter">
                                        <img src="<?php echo base_url() ?>images/social/twitter.png" height="20"
                                             class='social-icon'/>
                                        Twitter</a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($this->settings->info->facebook_app_id) && !empty($this->settings->info->facebook_app_secret)) : ?>
                                <div class="btn-group">
                                    <a href="<?php echo site_url("login/facebook_login") ?>"
                                       class="btn btn-flat-social-facebook">
                                        <img src="<?php echo base_url() ?>images/social/facebook.png" height="20"
                                             class='social-icon'/>
                                        Facebook</a>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($this->settings->info->google_client_id) && !empty($this->settings->info->google_client_secret)) : ?>
                                <div class="btn-group">
                                    <a href="<?php echo site_url("login/google_login") ?>"
                                       class="btn btn-flat-social-google">
                                        <img src="<?php echo base_url() ?>images/social/google.png" height="20"
                                             class='social-icon'/>
                                        Google</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <p class="decent-margin align-center"><a
                            href="<?php echo site_url("login") ?>"><?php echo lang("ctn_473") ?></a></p>

                    <?php echo form_close() ?>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var form = "register_form";
        $('#' + form + ' input').on("focus", function (e) {
            clearerrors();
        });

        $('#username').on("change", function () {
            $.ajax({
                url: global_base_url + "register/check_username",
                type: 'GET',
                data: {
                    username: $(this).val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.success) {
                        $("#login-icon-username").css("color", "green");
                    } else {
                        $("#login-icon-username").css("color", "#a0a0a0");
                        if (data.field_errors) {
                            var errors = data.fieldErrors;
                            for (var property in errors) {
                                if (errors.hasOwnProperty(property)) {
                                    // Find form name
                                    var field_name = '#' + form + ' input[name="' + property + '"]';
                                    $(field_name).addClass("errorField");
                                    if (errors[property]) {
                                        // Get input group of field
                                        $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">' + errors[property] + '</div>');
                                    }


                                }
                            }
                        }
                    }
                }
            });
        });

        $('#email').on("change", function () {
            $.ajax({
                url: global_base_url + "register/check_email",
                type: 'GET',
                data: {
                    email: $(this).val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.success) {
                        $("#login-icon-email").css("color", "green");
                    } else {
                        $("#login-icon-email").css("color", "#a0a0a0");
                        if (data.field_errors) {
                            var errors = data.fieldErrors;
                            for (var property in errors) {
                                if (errors.hasOwnProperty(property)) {
                                    // Find form name
                                    var field_name = '#' + form + ' input[name="' + property + '"]';
                                    $(field_name).addClass("errorField");
                                    if (errors[property]) {
                                        // Get input group of field
                                        $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">' + errors[property] + '</div>');
                                    }


                                }
                            }
                        }
                    }
                }
            });
        });

        $('#' + form).on("submit", function (e) {

            e.preventDefault();
            // Ajax check
            var data = $(this).serialize();
            $.ajax({
                url: global_base_url + "register/ajax_check_register",
                type: 'POST',
                data: {
                    formData: data,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash() ?>'
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.error) {
                        $('#' + form).prepend('<div class="form-error">' + data.error_msg + '</div>');
                    }
                    if (data.success) {
                        // allow form submit
                        $('#' + form).unbind('submit').submit();
                    }
                    if (data.field_errors) {
                        var errors = data.fieldErrors;
                        for (var property in errors) {
                            if (errors.hasOwnProperty(property)) {
                                // Find form name
                                var field_name = '#' + form + ' input[name="' + property + '"]';
                                $(field_name).addClass("errorField");
                                if (errors[property]) {
                                    // Get input group of field
                                    $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">' + errors[property] + '</div>');
                                }


                            }
                        }
                    }
                }
            });

            return false;


        });
    });

    function clearerrors() {
        console.log("Called");
        $('.form-error').remove();
        $('.form-error-no-margin').remove();
        $('.errorField').removeClass('errorField');
    }
</script>