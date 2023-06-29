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

                    <h2><?php echo lang("ctn_174") ?></h2>
                    <p><?php echo lang("ctn_175") ?></p>

                    <?php echo form_open(site_url("login/forgotpw_pro/")) ?>
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" name="email" class="form-control" placeholder="Email Address">
                    </div>
                    <br/>
                    <input type="submit" class="btn btn-flat-login form-control" value=" <?php echo lang("ctn_176") ?>">
                    <?php echo form_close() ?>

                    <p class="decent-margin align-center"><a
                            href="<?php echo site_url("login") ?>"> <?php echo lang("ctn_177") ?></a></p>
                </div>
            </div>

        </div>
    </div>
</div>