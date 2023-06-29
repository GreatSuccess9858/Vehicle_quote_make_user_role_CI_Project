<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");

		if(!$this->user->loggedin) $this->template->error(lang("error_1"));
		
		$this->template->loadData("activeLink", 
			array("members" => array("general" => 1)));

		// If the user does not have premium. 
		// -1 means they have unlimited premium
		if($this->settings->info->global_premium && 
			($this->user->info->premium_time != -1 && 
				$this->user->info->premium_time < time()) ) {
			$this->session->set_flashdata("globalmsg", lang("success_29"));
			redirect(site_url("funds/plans"));
		}
	}

	public function index($type=0) 
	{
		$type = intval($type);
		$this->template->loadContent("members/index.php", array(
			"type" => $type
			)
		);
	}

	public function members_page($type=0) 
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("users.joined", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 0 => array(
				 	"users.username" => 0
				 ),
				 1 => array(
				 	"users.first_name" => 0
				 ),
				 2 => array(
				 	"users.last_name" => 0
				 ),
				 3 => array(
				 	"user_roles.name" => 0
				 ),
				 4 => array(
				 	"users.joined" => 0
				 ),
				 5 => array(
				 	"users.oauth_provider" => 0
				 )
			)
		);

		if($type == 0) {
			$this->datatables->set_total_rows(
				$this->user_model
					->get_total_members_count()
			);
			$members = $this->user_model->get_members($this->datatables);
		} else {
			$this->datatables->set_total_rows(
				$this->user_model
					->get_total_members_online_count()
			);
			$members = $this->user_model->get_members_online($this->datatables);
		}

		foreach($members->result() as $r) {
			if($r->oauth_provider == "google") {
				$provider = "Google";
			} elseif($r->oauth_provider == "twitter") {
				$provider = "Twitter";
			} elseif($r->oauth_provider == "facebook") {
				$provider = "Facebook";
			} else {
				$provider =  lang("ctn_196");
			}
			$this->datatables->data[] = array(
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp, "first_name" => $r->first_name, "last_name" => $r->last_name)),
				$r->first_name,
				$r->last_name,
				$this->common->get_user_role($r),
				date($this->settings->info->date_format, $r->joined),
				$provider
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function search() 
	{

		$search = $this->common->nohtml($this->input->post("search"));

		if(empty($search)) $this->template->error(lang("error_49"));

		$members = $this->user_model->get_members_by_search($search);
		if($members->num_rows() == 0) $this->template->error(lang("error_50"));

		$this->template->loadContent("members/search.php", array(
			"members" => $members,
			"search" => $search
			)
		);
	}

}

?>