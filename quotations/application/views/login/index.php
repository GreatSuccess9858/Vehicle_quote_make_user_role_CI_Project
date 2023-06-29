<div class="container">
    <div class="row">
        <div class="col-md-4 center-block-e">
            <div class="login-form">
                <div class="login-form-inner">
                    <?php $gl = $this->session->flashdata('globalmsg'); ?>
                    <?php if (!empty($gl)) : ?>
                        <div class="alert alert-success"><b><span
                                    class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?>
                        </div>
                    <?php endif; ?>
                    <p class="login-form-intro"><img src="<?php echo base_url() ?>images/ava2.png" width="150"></p>
                    <?php if (isset($_GET['redirect'])) : ?>
                        <?php echo form_open(site_url("login/pro/" . urlencode($_GET['redirect'])), array("id" => "login_form")) ?>
                    <?php else : ?>
                        <?php echo form_open(site_url("login/pro"), array("id" => "login_form")) ?>
                    <?php endif; ?>
                    <div class="form-group login-form-area has-feedback">
                        <input type="text" class="form-control input_field" name="email"
                               placeholder="<?php echo lang("ctn_303") ?>">
                        <i class="glyphicon glyphicon-user form-control-feedback login-icon-color"></i>
                    </div>
                    <div class="form-group login-form-area has-feedback">
                        <input type="password" name="pass" class="form-control input_field" placeholder="*********">
                        <i class="glyphicon glyphicon-lock form-control-feedback login-icon-color"></i>
                    </div>
                    <p><input type="submit" class="btn btn-flat-login form-control"
                              value="<?php echo lang("ctn_150") ?>"></p>
                    <p class="decent-margin small-text"><a
                            href="<?php echo site_url("login/forgotpw") ?>"><?php echo lang("ctn_181") ?></a> <span
                            class="pull-right"><a
                                href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a></span></p>
                </div>
<!--                <div class="login-form-bottom clearfix">-->
<!--                    --><?php //if (!$this->settings->info->disable_social_login) : ?>
<!--                        <div class="text-center decent-margin-top">-->
<!--                            --><?php //if (!empty($this->settings->info->twitter_consumer_key) && !empty($this->settings->info->twitter_consumer_secret)) : ?>
<!--                                <div class="btn-group">-->
<!--                                    <a href="--><?php //echo site_url("login/twitter_login") ?><!--"-->
<!--                                       class="btn btn-flat-social-twitter">-->
<!--                                        <img src="--><?php //echo base_url() ?><!--images/social/twitter.png" height="20"-->
<!--                                             class='social-icon'/>-->
<!--                                        Twitter</a>-->
<!--                                </div>-->
<!--                            --><?php //endif; ?>
<!--                            --><?php //if (!empty($this->settings->info->facebook_app_id) && !empty($this->settings->info->facebook_app_secret)) : ?>
<!--                                <div class="btn-group">-->
<!--                                    <a href="--><?php //echo site_url("login/facebook_login") ?><!--"-->
<!--                                       class="btn btn-flat-social-facebook">-->
<!--                                        <img src="--><?php //echo base_url() ?><!--images/social/facebook.png" height="20"-->
<!--                                             class='social-icon'/>-->
<!--                                        Facebook</a>-->
<!--                                </div>-->
<!--                            --><?php //endif; ?>
<!--                            --><?php //if (!empty($this->settings->info->google_client_id) && !empty($this->settings->info->google_client_secret)) : ?>
<!--                                <div class="btn-group">-->
<!--                                    <a href="--><?php //echo site_url("login/google_login") ?><!--"-->
<!--                                       class="btn btn-flat-social-google">-->
<!--                                        <img src="--><?php //echo base_url() ?><!--images/social/google.png" height="20"-->
<!--                                             class='social-icon'/>-->
<!--                                        Google</a>-->
<!--                                </div>-->
<!--                            --><?php //endif; ?>
<!--                        </div>-->
<!--                    --><?php //endif; ?>
<!--                    <hr>-->
<!--                    --><?php //echo form_close() ?>
<!--                </div>-->
            </div>
        </div>
    </div>
</div>
<div class="login-footer">
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var form = "login_form";
        $('#' + form + ' input').on("focus", function (e) {
            clearerrors();
        });
        $('#' + form).on("submit", function (e) {

            e.preventDefault();
            // Ajax check
            var data = $(this).serialize();
            $.ajax({
                url: global_base_url + "login/ajax_check_login",
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
                        $('#' + form + ' input[type="submit"]').val("Logging In ...");
                        $('#' + form).unbind('submit').submit();
                    }
                    if (data.field_errors) {
                        var errors = data.fieldErrors;
                        console.log(errors);
                        for (var property in errors) {
                            if (errors.hasOwnProperty(property)) {
                                // Find form name
                                var field_name = '#' + form + ' input[name="' + property + '"]';
                                $(field_name).addClass("errorField");
                                // Get input group of field
                                $('#' + form).prepend('<div class="form-error">' + errors[property] + '</div>');


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
        $('.errorField').removeClass('errorField');
    }
</script>