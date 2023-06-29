<div class="white-area-content">
	<div class="row">
		<!-- Column -->
		<div class="col-sm-12 col-md-6 col-xl-3">
			<div class="card bg-danger m-b-30">
				<div class="card-body">
					<div class="d-flex row">
						<div class="col-3 align-self-center">
							<div class="round">

								<i class="mdi mdi-account-multiple-plus"></i>
							</div>
						</div>
						<div class="col-8 ml-auto align-self-center text-center">
							<div class="m-l-10 text-white float-right">
								<h5 class="mt-0 round-inner"><?php echo number_format($stats->total_members) ?></h5>
								<p class="mb-0 "><?php echo lang("ctn_136") ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card bg-info m-b-30">
				<div class="card-body">
					<div class="d-flex row">
						<div class="col-3 align-self-center">
							<div class="round">
								<i class="mdi mdi-google-physical-web"></i>
							</div>
						</div>
						<div class="col-8 text-center ml-auto align-self-center">
							<div class="m-l-10 text-white float-right">
								<h5 class="mt-0 round-inner"><?php echo number_format($stats->new_members) ?></h5>
								<p class="mb-0 "><?php echo lang("ctn_137") ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card bg-success m-b-30">
				<div class="card-body">
					<div class="d-flex row">
						<div class="col-3 align-self-center">
							<div class="round ">
								<i class="mdi mdi-account-check"></i>
							</div>
						</div>
						<div class="col-8 ml-auto align-self-center text-center">
							<div class="m-l-10 text-white float-right">
								<h5 class="mt-0 round-inner"><?php echo number_format($stats->active_today) ?></h5>
								<p class="mb-0 "><?php echo lang("ctn_138") ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card bg-primary m-b-30">
				<div class="card-body">
					<div class="d-flex row">
						<div class="col-3 align-self-center">
							<div class="round">
								<i class="mdi mdi-account-network"></i>
							</div>
						</div>
						<div class="col-8 ml-auto align-self-center text-center">
							<div class="m-l-10 text-white float-right">
								<h5 class="mt-0 round-inner"><?php echo number_format($online_count) ?></h5>
								<p class="mb-0"><?php echo lang("ctn_139") ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
	</div>
    <hr>
    <div class="row">
<!--        <div class="col-md-8">-->
<!--            <div class="block-area align-center">-->
<!--                <h4 class="home-label">--><?php //echo lang("ctn_140") ?><!--</h4>-->
<!--                <canvas id="myChart" class="graph-height"></canvas>-->
<!--            </div>-->
<!--            <div class="block-area">-->
<!--                --><?php //echo lang("ctn_326") ?>
<!--                <b>--><?php //echo date($this->settings->info->date_format, $this->user->info->online_timestamp); ?><!--</b>-->
<!--            </div>-->
<!--        </div>-->
        <div class="col-md-12">
            <div class="block-area">
                <h4 class="home-label"><?php echo lang("ctn_141") ?></h4>
                <?php foreach ($new_members->result() as $r) : ?>
                    <div class="new-user">
                        <?php
                        if ($r->joined + (3600 * 24) > time()) {
                            $joined = lang("ctn_144");
                        } else {
                            $joined = date($this->settings->info->date_format, $r->joined);
                        }

                        if ($r->oauth_provider == "twitter") {
                            $ava = "images/social/twitter.png";
                        } elseif ($r->oauth_provider == "facebook") {
                            $ava = "images/social/facebook.png";
                        } elseif ($r->oauth_provider == "google") {
                            $ava = "images/social/google.png";
                        } else {
                            $ava = $this->settings->info->upload_path_relative . "/default.png";
                        }

                        ?>
                        <img
                            src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>"
                            class="new-member-avatar user-icon"/> <a
                            href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->username ?></a>
                        <div class="new-member-joined"><?php echo $joined ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="block-area align-center" id="membersTypeChatArea">
                <h4 class="home-label"><?php echo lang("ctn_145") ?></h4>
                <canvas id="memberTypesChart"></canvas>
            </div>
        </div>
    </div>
</div>