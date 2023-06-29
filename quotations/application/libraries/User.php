<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User 
{

	var $info=array();
	var $loggedin=false;
	var $u=null;
	var $p=null;
	var $oauth_provider = null;
	var $oauth_id = null;
	var $oauth_token = null;
	var $oauth_secret = null;

	public function __construct() 
	{
		$CI =& get_instance();
		$config = $CI->config->item("cookieprefix");
		$this->u = $CI->input->cookie($config . "un", TRUE);
		$this->p = $CI->input->cookie($config . "tkn", TRUE);

		$this->oauth_provider = $CI->input->cookie($config . "provider", TRUE);
		$this->oauth_id = $CI->input->cookie($config . "oauthid", TRUE);
		$this->oauth_token = $CI->input->cookie($config . "oauthtoken", TRUE);
		$this->oauth_secret = $CI->input->cookie($config . "oauthsecret", TRUE);
 		
 		$user = null; 

 		$select = "users.`ID`, users.`username`, users.`email`, 
				users.first_name, 
				users.last_name, users.`online_timestamp`, users.avatar,
				users.email_notification, users.aboutme, users.phone, users.points,
				users.premium_time, users.active, users.activate_code,
				users.profile_comments, users.address_1, users.address_2,
				users.city, users.state, users.zipcode, users.country,
				users.noti_count,
				users.user_role, user_roles.name as ur_name,
				user_roles.admin, user_roles.admin_settings, 
				user_roles.admin_members, user_roles.admin_payment,
				user_roles.banned,
				user_roles.ID as user_role_id";
 		
 		// Twitter
		if($this->oauth_provider === "twitter") {
			if($this->oauth_provider && $this->oauth_id &&
			  $this->oauth_token && $this->oauth_secret) {
			 	$user = $CI->db->select($select)
				 ->where("oauth_provider", $this->oauth_provider)
				 ->where("oauth_id", $this->oauth_id)
				 ->where("oauth_token", $this->oauth_token)
				 ->where("oauth_secret", $this->oauth_secret)
				 ->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
				 ->get("users"); 
			}
		}

		// Facebook
		if($this->oauth_provider === "facebook") {
			if($this->oauth_provider && $this->oauth_id &&
			  $this->oauth_token) {
			 	$user = $CI->db->select($select)
				 ->where("oauth_provider", $this->oauth_provider)
				 ->where("oauth_id", $this->oauth_id)
				 ->where("oauth_token", $this->oauth_token)
				 ->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
				 ->get("users"); 
			}
		}

		// Google
		if($this->oauth_provider === "google") {
			if($this->oauth_provider && $this->oauth_id &&
			  $this->oauth_token) {
			 	$user = $CI->db->select($select)
				 ->where("oauth_provider", $this->oauth_provider)
				 ->where("oauth_id", $this->oauth_id)
				 ->where("oauth_token", $this->oauth_token)
				 ->join("user_roles", "user_roles.ID = users.user_role", 
				 	"left outer")
				 ->get("users"); 
			}
		}

		if ($this->u && $this->p && empty($this->oauth_provider)) {
			$user = $CI->db->select($select)
			->where("users.email", $this->u)->where("users.token", $this->p)
			->join("user_roles", "user_roles.ID = users.user_role", "left outer")
			->get("users");
		}

		if($user !== null) {
			if ($user->num_rows() == 0) {
				$this->loggedin=false;
			} else {
				$this->loggedin=true;
				$this->info = $user->row();

				if( (empty($this->info->username) || empty($this->info->email)) && ($CI->router->fetch_class() != "register") && ($CI->router->fetch_class() != "login")) {
					redirect(site_url("register/add_username"));
				}

				if($this->info->online_timestamp < time() - 60*5) {
					$this->update_online_timestamp($this->info->ID);
				}

				if (isset($this->info->banned) && $this->info->banned) {
					$CI->load->helper("cookie");
					$this->loggedin = false;
					$CI->session->set_flashdata("globalmsg", 
						lang("success_36"));
					delete_cookie($config . "un");
					delete_cookie($config . "tkn");
					redirect(site_url("login/banned"));
				}
			}
		}
	}

	public function getPassword() 
	{
		$CI =& get_instance();
		$user = $CI->db->select("users.`password`")
		->where("ID", $this->info->ID)->get("users");
		$user = $user->row();
		return $user->password;
	}

	public function update_online_timestamp($userid) 
	{
		$CI =& get_instance();
		$CI->db->where("ID", $userid)->update("users", array(
			"online_timestamp" => time()
			)
		);
	}

}

?>
