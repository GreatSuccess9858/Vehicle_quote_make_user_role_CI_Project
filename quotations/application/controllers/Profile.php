<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		
		// If the user does not have premium. 
		// -1 means they have unlimited premium
		if($this->settings->info->global_premium && 
			($this->user->info->premium_time != -1 && 
				$this->user->info->premium_time < time()) ) {
			$this->session->set_flashdata("globalmsg", lang("success_29"));
			redirect(site_url("funds/plans"));
		}
	}

	public function index($username="", $page=0) 
	{
		if(empty($username)) $this->template->error(lang("error_51"));
		$username = $this->common->nohtml($username);
		$page = intval($page);
		$user = $this->user_model->get_user_by_username($username);
		if($user->num_rows() == 0) $this->template->error(lang("error_52"));
		$user = $user->row();


		$role = $this->user_model->get_user_role($user->user_role);
		if($role->num_rows() == 0) {
			$rolename = lang("ctn_46");
		} else {
			$role = $role->row();
			$rolename = $role->name;
		}

		if(isset($role->banned)) {
			if($role->banned) $this->template->error(lang("error_53"));
		}

		$groups = $this->user_model->get_user_groups($user->ID);
		$fields = $this->user_model->get_custom_fields_answers(array(
			"profile" => 1), $user->ID);

		$comment_count = $this->user_model
			->get_total_profile_comments($user->ID);

		// Pagination
		$comments = $this->user_model->get_profile_comments($user->ID, $page);

		$this->load->library('pagination');
		$config['base_url'] = site_url("profile/index/" . $username);
		$config['total_rows'] = $comment_count;
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;

		include (APPPATH . "/config/page_config.php");

		$this->pagination->initialize($config); 

		// Update profile views
		$this->user_model->increase_profile_views($user->ID);

		$user_data = $this->user_model->get_user_data($user->ID);
		if($user_data->num_rows() == 0) {
			$user_data = null;
		} else {
			$user_data = $user_data->row();
		}

		$this->template->loadContent("profile/index.php", array(
			"user" => $user,
			"groups" => $groups,
			"role" => $rolename,
			"fields" => $fields,
			"comments" => $comments,
			"comment_count" => $comment_count,
			"user_data" => $user_data
			)
		);
	}

	public function comment($userid) 
	{
		if(!$this->settings->info->profile_comments) {
			$this->template->error(lang("error_263"));
		}
		$userid = intval($userid);
		$user = $this->user_model->get_user_by_id($userid);
		if($user->num_rows() == 0) $this->template->error(lang("error_52"));
		$user = $user->row();

		if(!$user->profile_comments) {
			$this->template->error(lang("error_263"));
		}

		$comment = $this->lib_filter->go($this->input->post("comment"));

		if(empty($comment)) {
			$this->template->error(lang("error_264"));
		}

		$this->user_model->add_profile_comment(array(
			"profileid" => $userid,
			"userid" => $this->user->info->ID,
			"comment" => $comment,
			"timestamp" => time()
			)
		);

		// Notification
		// Send notification of being added to the task
		$this->user_model->increment_field($user->ID, "noti_count", 1);
		$this->user_model->add_notification(array(
			"userid" => $user->ID,
			"url" => "profile/" . $user->username,
			"timestamp" => time(),
			"message" => "has written a comment on your profile!",
			"status" => 0,
			"fromid" => $this->user->info->ID,
			"email" => $user->email,
			"username" => $user->username,
			"email_notification" => $user->email_notification
			)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_440") . $user->username
			)
		);

		$this->session->set_flashdata("globalmsg", lang("success_45"));
		redirect(site_url("profile/" . $user->username));
	}

	public function delete_comment($id, $hash) 
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$comment = $this->user_model->get_profile_comment($id);
		if($comment->num_rows() == 0) {
			$this->template->error(lang("error_81"));
		}

		$comment = $comment->row();
		if( ($comment->userid != $this->user->info->ID && $comment->profileid != $this->user->info->ID) && !$this->common->has_permissions(array("admin", "admin_members"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$this->user_model->delete_profile_comment($id);

		$user = $this->user_model->get_user_by_id($comment->userid);
		if($user->num_rows() == 0) $this->template->error(lang("error_52"));
		$user = $user->row();

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_441")
			)
		);

		$user = $this->user_model->get_user_by_id($comment->profileid);
		if($user->num_rows() == 0) $this->template->error(lang("error_52"));
		$user = $user->row();

		$this->session->set_flashdata("globalmsg", lang("success_46"));
		redirect(site_url("profile/" . $user->username));
	}

}

?>