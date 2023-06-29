<?php

class IPN_Model extends CI_Model 
{

	public function log_ipn($ipn) 
	{
		$this->db->insert("ipn_log", array(
			"data" => $ipn, 
			"timestamp" => time(), 
			"IP" => $_SERVER['REMOTE_ADDR']
			)
		);
	}

	public function add_payment($data) 
	{
		$this->db->insert("payment_logs", $data);
	}

	public function get_payment_log_hash($hash) 
	{
		return $this->db->where("hash", $hash)->get("payment_logs");
	}
}

?>