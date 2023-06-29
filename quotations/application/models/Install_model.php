<?php

class Install_Model extends CI_Model 
{

	public function createAdmin($username, $email, $password) 
	{
		$this->db->insert("users", 
			array(
				"username" => $username,
				"email" => $email,
				"first_name" => "Admin",
				"last_name" => "User",
				"user_role" => 1,
				"password" => $password,
				"IP" => $_SERVER['REMOTE_ADDR'],
				"joined" => time(),
				"joined_date" => date("n-Y")
			)
		);
	}

	public function updateSite($name, $desc, $dir) 
	{
		$this->db->update("site_settings", 
			array(
				"site_name" => $name, 
				"site_desc" => $desc, 
				"upload_path" => $dir . "uploads",
				"upload_path_relative" => "uploads",
				"install" => 0
			)
		);
	}

	public function checkAdmin() 
	{
		$s = $this->db->where("user_roles.admin", 1)
			->join("user_roles", "user_roles.ID = users.user_role")
			->get("users");
		if ($s->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>
