<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"><span class="glyphicon glyphicon-cog"></span> <?php echo lang("ctn_224") ?></div>
        <div class="db-header-extra"><a href="<?php echo site_url("user_settings/change_password") ?>"
                                        class="btn btn-primary"><?php echo lang("ctn_225") ?></a> <a
                href="<?php echo site_url("user_settings/social_networks") ?>"
                class="btn btn-info"><?php echo lang("ctn_422") ?></a>
        </div>
    </div>

    <!--<ol class="breadcrumb">-->
    <!--  <li><a href="--><?php //echo site_url() ?><!--">--><?php //echo lang("ctn_2") ?><!--</a></li>-->
    <!--  <li class="active">--><?php //echo lang("ctn_224") ?><!--</li>-->
    <!--</ol>-->

    <p class="little-show-p"><?php echo lang("ctn_226") ?></p>
    <hr>
    <div role="tabpanel">
        <!-- Nav tabs -->
        <!--        <ul class="nav nav-tabs" role="tablist">-->
        <!--            <li role="presentation" class="active">-->
        <!--                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Dato básicos</a>-->
        <!--            </li>-->
        <!---->
        <!---->
        <!--        </ul>-->

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <!-- formulario basico -->

                <?php echo form_open_multipart(site_url("user_settings/pro"), array("class" => "form-horizontal with-padding")) ?>
                <!--                <div class="form-group">-->
                <!--                    <label for="inputEmail3" class="col-sm-2 control-label">-->
                <?php //echo lang("ctn_228") ?><!--</label>-->
                <!--                    <div class="col-sm-10">-->
                <!--                        <a href="-->
                <?php //echo site_url("profile/" . $this->user->info->username) ?><!--">-->
                <?php //echo $this->user->info->username ?><!--</a>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                --><?php //if ($this->settings->info->payment_enabled): ?>
                <!--                    <div class=" hidden form-group">-->
                <!--                        <label for="inputEmail3" class="col-sm-2 control-label">-->
                <?php //echo lang("ctn_423") ?><!--</label>-->
                <!--                        <div class="col-sm-10">-->
                <!--                            <p>--><?php //echo lang("ctn_248") ?><!--: -->
                <?php //echo number_format($this->user->info->points, 2) ?><!--.-->
                <!--                                <a href="--><?php //echo site_url("funds") ?><!--">-->
                <?php //echo lang("ctn_245") ?><!--</a></p>-->
                <!---->
                <!--                            --><?php //if ($this->user->info->premium_time > 0): ?>
                <!--                                --><?php //$time = $this->common->convert_time($this->user->info->premium_time) ?>
                <!--                                <p>--><?php //echo lang("ctn_276") ?><!---->
                <?php //echo $this->common->get_time_string($time) ?><!----><?php //echo lang("ctn_281") ?><!--</p>-->
                <!--                            --><?php //elseif ($this->user->info->premium_time == -1): ?>
                <!--                                <p>--><?php //echo lang("ctn_282") ?><!--</p>-->
                <!--                            --><?php //endif; ?>
                <!--                            <p><a href="--><?php //echo site_url("funds/plans") ?><!--">-->
                <?php //echo lang("ctn_285") ?><!--</a></p>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                --><?php //endif; ?>
                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-2 control-label"><?php echo lang("ctn_229") ?></label>
                            <div class="col-sm-10">
                                <p>
                                    <img
                                        src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>"/>
                                </p>
                                <?php if ($this->settings->info->avatar_upload): ?>
                                    <p class="small-text"><?php echo lang("ctn_434") ?>
                                        : <?php echo $this->settings->info->avatar_width ?>px
                                        - <?php echo lang("ctn_433") ?>
                                        : <?php echo $this->settings->info->avatar_height ?>px.</p>
                                    <input type="file" name="userfile"/>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-12 control-label"><?php echo lang("ctn_230") ?></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email"
                                       value="<?php echo $this->user->info->email ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-12 control-label"><?php echo lang("ctn_231") ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="first_name"
                                       value="<?php echo $this->user->info->first_name ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-12 control-label"><?php echo lang("ctn_232") ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="last_name"
                                       value="<?php echo $this->user->info->last_name ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-12 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone"
                                       value="<?php echo $this->user->info->phone ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-12 control-label"><?php echo lang("ctn_233") ?></label>
                            <div class="col-sm-10">
                        <textarea class="form-control" name="aboutme"
                                  rows="8"><?php echo nl2br($this->user->info->aboutme) ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				<hr>
				<div class="col-md-12">
					<p class="panel-subheading"><?php echo lang("ctn_390") ?></p>
				</div>
				<div class="d-flex">
					<div class="col-md-6">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label"><?php echo lang("ctn_391") ?></label>
							<div class="col-sm-10">
								<input type="text" name="address_1" class="form-control"
									   value="<?php echo $this->user->info->address_1 ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label"><?php echo lang("ctn_392") ?></label>
							<div class="col-sm-10">
								<input type="text" name="address_2" class="form-control"
									   value="<?php echo $this->user->info->address_2 ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label"><?php echo lang("ctn_393") ?></label>
							<div class="col-sm-10">
								<input type="text" name="city" class="form-control"
									   value="<?php echo $this->user->info->city ?>">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label"><?php echo lang("ctn_394") ?> </label>
							<div class="col-sm-10">
								<input type="text" name="state" class="form-control"
									   value="<?php echo $this->user->info->state ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label"><?php echo lang("ctn_395") ?></label>
							<div class="col-sm-10">
								<input type="text" name="zipcode" class="form-control"
									   value="<?php echo $this->user->info->zipcode ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label"><?php echo lang("ctn_396") ?></label>
							<div class="col-sm-10">
								<input type="text" name="country" class="form-control"
									   value="<?php echo $this->user->info->country ?>">
							</div>
						</div>
					</div>
				</div>
                <?php foreach ($fields->result() as $r): ?>
                    <div class="hidden form-group">

                        <label for="name-in"
                               class="col-sm-12 label-heading"><?php echo $r->name ?> <?php if ($r->required): ?>*<?php endif; ?></label>
                        <div class="col-sm-10">
                            <?php if ($r->type == 0): ?>
                                <input type="text" class="form-control" id="name-in" name="cf_<?php echo $r->ID ?>"
                                       value="<?php echo $r->value ?>">
                            <?php elseif ($r->type == 1): ?>
                                <textarea name="cf_<?php echo $r->ID ?>" rows="8"
                                          class="form-control"><?php echo $r->value ?></textarea>
                            <?php elseif ($r->type == 2): ?>
                                <?php $options = explode(",", $r->options); ?>
                                <?php $values = array_map('trim', (explode(",", $r->value))); ?>
                                <?php if (count($options) > 0): ?>
                                    <?php foreach ($options as $k => $v): ?>
                                        <div class="form-group"><input type="checkbox"
                                                                       name="cf_cb_<?php echo $r->ID ?>_<?php echo $k ?>"
                                                                       value="1" <?php if (in_array($v, $values)) {
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
                                                                       value="<?php echo $k ?>" <?php if ($r->value == $v) {
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
                                            <option value="<?php echo $k ?>" <?php if ($r->value == $v) {
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
                <div class="hidden">
                    <p><?php echo lang("ctn_351") ?></p>

                    <p class="panel-subheading"><?php echo lang("ctn_234") ?></p>
                    <div class="d-flex container">
                        <div class="form-group d-flex col-md-6">
                            <div class="col-sm-1">
                                <input type="checkbox" name="enable_email_notification"
                                       value="1" <?php if ($this->user->info->email_notification) {
                                    echo "checked";
                                }
                                ?>>
                            </div>
                            <label for="inputEmail3" class="col-sm-11 control-label"><?php echo lang("ctn_235") ?></label>
                        </div>
                        <div class="form-group d-flex col-md-6">
                            <div class="col-sm-1">
                                <input type="checkbox" name="profile_comments"
                                       value="1" <?php if ($this->user->info->profile_comments) {
                                    echo "checked";
                                }
                                ?>>
                            </div>
                            <label for="inputEmail3" class="col-sm-11 control-label"><?php echo lang("ctn_424") ?></label>
                        </div>
                    </div>

                </div>
                <input type="submit" name="s" value="<?php echo lang("ctn_236") ?>"
                       class="btn btn-primary float-right"/>
                <?php echo form_close() ?>
                <!-- fin formulario basico -->
            </div>
        </div>
    </div>
<!--    <div class=" hidden panel panel-default">-->
<!--        <div class="panel-body">-->
<!--            <p class="panel-subheading">--><?php //echo lang("ctn_227") ?><!--</p>-->
<!---->
<!--        </div>-->
<!--    </div>-->
</div>