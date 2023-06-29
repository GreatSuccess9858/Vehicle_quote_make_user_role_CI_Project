<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_189") ?></div>

</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_189") ?></a></li>
  <li><a href="<?php echo site_url("members") ?>"><?php echo lang("ctn_189") ?></a></li>
  <li class="active"><?php echo lang("ctn_197") ?></li>
</ol>

<p><?php echo lang("ctn_198") ?> "<b><?php echo $search ?></b>"</p>

<hr>


<table class="table table-bordered">
<tr class="table-header"><td><?php echo lang("ctn_191") ?>
</td><td><?php echo lang("ctn_192") ?>
</td><td><?php echo lang("ctn_322") ?>
</td><td><?php echo lang("ctn_194") ?>
</td><td><?php echo lang("ctn_195") ?>
</td></tr>

<?php foreach($members->result() as $r) : ?>
	<?php if($r->oauth_provider == "google") {
		$provider = "Google";
	} elseif($r->oauth_provider == "twitter") {
		$provider = "Twitter";
	} elseif($r->oauth_provider == "facebook") {
		$provider = "Facebook";
	} else {
		$provider = lang("ctn_196");
	}
	?>
<tr><td><a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->username ?></a></td><td><?php echo $r->first_name . " " . $r->last_name ?></td><td><?php echo $this->common->get_user_role($r) ?></td><td><?php echo date($this->settings->info->date_format, $r->joined) ?></td><td><?php echo $provider ?></td></tr>
<?php endforeach; ?>

</table>
</div>