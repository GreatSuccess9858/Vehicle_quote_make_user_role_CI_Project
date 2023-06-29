<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li><a href="<?php echo site_url("admin/members") ?>"><?php echo lang("ctn_74") ?></a></li>
  <li class="active">Search Member</li>
</ol>

<p>Searching for members ...</p>

<hr>

<?php echo form_open(site_url("admin/search_member/"), array("class" => "form-inline")) ?>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail3"><?php echo lang("ctn_76") ?></label>
    <input type="text" class="form-control" id="exampleInputEmail3" placeholder="<?php echo lang("ctn_76") ?>" name="search">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword3"><?php echo lang("ctn_76") ?></label>
    <select name="option" class="form-control">
    <option value="0"><?php echo lang("ctn_77") ?></option>
    <option value="1"><?php echo lang("ctn_78") ?></option>
    <option value="2"><?php echo lang("ctn_79") ?></option>
    <option value="3"><?php echo lang("ctn_80") ?></option>
    </select>
  </div>
  <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_76") ?>" />
<?php echo form_close() ?>

<hr>

<table class="table table-bordered">
<tr class="table-header"><td><?php echo lang("ctn_77") ?>
</td><td><?php echo lang("ctn_81") ?>
</td><td><?php echo lang("ctn_78") ?>
</td><td><?php echo lang("ctn_322") ?>
</td><td><?php echo lang("ctn_83") ?>
</td><td><?php echo lang("ctn_84") ?>
</td><td><?php echo lang("ctn_52") ?>
</td></tr>

<?php foreach($members->result() as $r) : ?>
	<?php if($r->oauth_provider == "google") {
		$provider = "Google";
	} elseif($r->oauth_provider == "twitter") {
		$provider = "Twitter";
	} elseif($r->oauth_provider == "facebook") {
		$provider = "Facebook";
	} else {
		$provider =  lang("ctn_85");
	}
	?>
<tr><td><a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->username ?></a></td><td><?php echo $r->first_name . " " . $r->last_name ?></td><td><?php echo $r->email ?></td><td><?php echo $this->common->get_user_role($r) ?></td><td><?php echo date($this->settings->info->date_format, $r->joined) ?></td><td><?php echo $provider ?></td><td><a href="<?php echo site_url("admin/edit_member/" . $r->ID) ?>" class="btn btn-warning btn-xs"><?php echo lang("ctn_55") ?></a> <a href="<?php echo site_url("admin/delete_member/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" onclick="return confirm('<?php echo lang("ctn_86") ?>')" class="btn btn-danger btn-xs"><?php echo lang("ctn_57") ?></a></td></tr>
<?php endforeach; ?>

</table>
</div>