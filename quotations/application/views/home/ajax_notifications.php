<?php if($notifications->num_rows() > 0) : ?>
<?php foreach($notifications->result() as $r) : ?>
<div class="notification-box-bit animation-fade clearfix <?php if(!$r->status) : ?>active-noti<?php endif; ?>">
  <div class="notification-icon-bit">
    <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>" class="user-icon">
  </div>
  <div class="projects-text-bit small-text click" onclick="load_notification_url(<?php echo $r->ID ?>)">
    <a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->username ?></a> <?php echo $r->message ?>
    <p class="notification-datestamp"><?php echo $this->common->get_time_string_simple($this->common->convert_simple_time($r->timestamp)) ?></p>
  </div>
</div>
<?php endforeach; ?>
<?php else : ?>
	<div class="notification-box-bit animation-fade clearfix">
<p><?php echo lang("ctn_411") ?></p>
</div>
<?php endif; ?>