<?php

class Funds_Model extends CI_Model 
{

	public function get_plans() 
	{
		return $this->db->get("payment_plans");
	}

	public function get_plan($id) 
	{
		return $this->db->where("ID", $id)->get("payment_plans");
	}

	public function update_plan($id, $data) 
	{
		$this->db->where("ID", $id)->update("payment_plans", $data);
	}


}

?>