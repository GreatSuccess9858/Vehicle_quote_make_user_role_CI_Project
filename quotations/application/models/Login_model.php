<?php

class Login_Model extends CI_Model 
{

	public function getUser($email, $pass) 
	{
		return $this->db->select("ID")
		->where("email", $email)->where("password", $pass)->get("users");
	}

	public function getUserByEmail($email) 
	{
		return $this->db->select("ID,email,password,token,active,online_timestamp")
		->where("email", $email)->get("users");
	}

	public function getUserByUsername($username) 
	{
		return $this->db->select("ID,email,password,token,active,online_timestamp")
		->where("username", $username)->get("users");
	}

	public function updateUserToken($userid, $token) 
	{
		$this->db->where("ID", $userid)
		->update("users", array("token" => $token));
	}

	public function addToResetLog($ip) 
	{
		$this->db->insert("reset_log", 
			array(
				"IP" => $ip, 
				"timestamp" => time()
			)
		);
	}

	public function getResetLog($ip) 
	{
		return $this->db->where("IP", $ip)->get("reset_log");
	}

	public function getUserEmail($email) 
	{
		return $this->db->where("email", $email)
		->select("ID, username")->get("users");
	}

	public function resetPW($userid, $token) 
	{
		$this->db->insert("password_reset", 
			array(
				"userid" => $userid, 
				"token" => $token, 
				"IP" => $_SERVER['REMOTE_ADDR'], 
				"timestamp" => time()
			)
		);
	}

	public function getResetUser($token, $userid) 
	{
		return $this->db->where("token", $token)
		->where("userid", $userid)->get("password_reset");
	}

	public function updatePassword($userid, $password) 
	{
		$this->db->where("ID", $userid)
		->update("users", array("password" => $password));
	}

	public function deleteReset($token) 
	{
		$this->db->where("token", $token)->delete("password_reset");
	}

	public function get_oauth_user($provider, $oauth_id) 
	{
		return $this->db->where("oauth_provider", $provider)
		->where("oauth_id", $oauth_id)
		->get("users");
	}

	public function update_facebook_user($provider, $oauth_id, $token) 
	{
		$this->db->where("oauth_id", $oauth_id)
		->where("oauth_provider", $provider)
		->update("users", array(
			"oauth_token" => $token,
			"IP" => $_SERVER['REMOTE_ADDR']
			)
		);
	}

	public function update_google_user($provider, $oauth_id, $token) 
	{
		$this->db->where("oauth_id", $oauth_id)
		->where("oauth_provider", $provider)
		->update("users", array(
			"oauth_token" => $token,
			"IP" => $_SERVER['REMOTE_ADDR']
			)
		);
	}

	public function update_oauth_user($oauth_token, $oauth_secret,
		$oauth_id, $provider) 
	{

		$this->db->where("oauth_id", $oauth_id)
		->where("oauth_provider", $provider)
		->update("users", array(
			"oauth_token" => $oauth_token,
			"oauth_secret" => $oauth_secret,
			"IP" => $_SERVER['REMOTE_ADDR']
			)
		);
	}

	public function get_login_attempts($ip, $username, $time) 
    {
    	return $this->db->where("IP", $ip)->where("username", $username)
    		->where("timestamp >", time() - $time)->get("login_attempts");
    }

    public function update_login_attempt($id, $data) 
    {
    	$this->db->where("ID", $id)->update("login_attempts", $data);
    }

    public function add_login_attempt($data) 
    {
    	$this->db->insert("login_attempts", $data);
    }

}

?>