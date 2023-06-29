<?php

class Register_Model extends CI_Model 
{

	public function registerUser($username, $email, $first_name, $last_name, $password,
	$access_level=1
	) {
		$this->db->insert("users", 
			array(
				"email" => $email,
				"username" => $username,
				"first_name" => $first_name, 
				"last_name" => $last_name,
				"password" => $password,
				"user_role" => $access_level, 
				"IP" => $_SERVER['REMOTE_ADDR'],
				"joined" => time(),
				"joined_date" => date("n-Y")
			)
		);
		return $this->db->insert_id();
	}

	public function add_user($data) 
	{
		$this->db->insert("users", $data);
		return $this->db->insert_id();
	}

	public function checkEmailIsFree($email) 
	{
		$s=$this->db->where("email", $email)->get("users");
		if ($s->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	public function check_username_is_free($username) 
	{
		$s=$this->db->where("username", $username)->get("users");
		if($s->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	public function add_username($userid, $username) 
	{
		$this->db->where("ID", $userid)
		->update("users", array("username" => $username));
	}

	public function register_twitter_user($provider,$oauth_id,$name,
		$oauth_token,$oauth_token_secret) 
	{

		$this->db->insert("users", array(
			"oauth_provider" => $provider,
			"oauth_id" => $oauth_id,
			"first_name" => $name,
			"oauth_token" => $oauth_token,
			"oauth_secret" => $oauth_token_secret,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"joined" => time(),
			"joined_date" => date("n-Y")
			)
		);
		return $this->db->insert_id();
	}

	public function register_facebook_user($provider,$oauth_id,$name,
		$oauth_token) 
	{

		$this->db->insert("users", array(
			"oauth_provider" => $provider,
			"oauth_id" => $oauth_id,
			"first_name" => $name,
			"oauth_token" => $oauth_token,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"joined" => time(),
			"joined_date" => date("n-Y")
			)
		);
		return $this->db->insert_id();
	}

	public function register_google_user($provider,$oauth_id,$name,
		$oauth_token) 
	{

		$this->db->insert("users", array(
			"oauth_provider" => $provider,
			"oauth_id" => $oauth_id,
			"first_name" => $name,
			"oauth_token" => $oauth_token,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"joined" => time(),
			"joined_date" => date("n-Y")
			)
		);
		return $this->db->insert_id();
	}

	public function update_username($userid, $username, $email) 
	{
		$this->db->where("ID", $userid)->update("users", array("username" => $username, "email" => $email));
	}

}

?>
