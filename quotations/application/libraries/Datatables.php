<?php

class Datatables {

	var $draw;
	var $start;
	var $length;
	var $total_rows;

	var $col;
	var $dir;
	var $field;
	var $order = null;

	var $search;
	var $search_type;
	var $search_flag;

	var $data = array();

	var $error="";
	var $CI = null;

	public function __construct() 
	{
		$this->CI =& get_instance();
		$this->draw = intval($this->CI->input->get("draw"));
		$this->start = intval($this->CI->input->get("start"));
		$this->length = intval($this->CI->input->get("length"));

		if($this->length < 0 ) $this->length = 0;
		if($this->start < 0) $this->start = 0;

		$this->get_search_data();
	}

	public function set_default_order($col, $dir) 
	{
		$this->order = array();
		$this->order[] = array("field" => $col,"sort" => $dir);
		return $this;
	}

	public function set_total_rows($rows) 
	{
		$this->total_rows = $rows;
	}


	/*
		$ordering contains an array of ordering options.
		each value of ordering is a key[column index] and value[array 
		of options].
		The array of options is a key=>value pairing(key is field name, 
		value is sort type. If value is 0, sort type is determined by 
		user input).
	*/
	public function ordering($ordering) 
	{
		// First get user's order
		if(isset($_GET['order'])) {
			$order = $this->CI->input->get("order"); // Array
			if(!empty($order)) {
				foreach($order as $o) {
					$this->col = $o['column'];
					$this->dir= $o['dir'];
				}
			}
		}

		if($this->dir != "asc" && $this->dir != "desc") $this->dir = "asc";

		// Now check users order choice is valid
		if(isset($ordering[$this->col])) {
			$this->order = array();
			foreach($ordering[$this->col] as $k=>$v) {
				if(empty($v) || $v === 0 ) {
					$v = $this->dir;
				}
				$this->order[] = array("field" => $k, "sort" => $v);
			}
		} else {
			// They tried to search something dodgy
			$this->error = "You tried to search for an invalid section.";
		}
	}

	public function get_search_data() 
	{
		$search = $this->CI->input->get("search"); // Search data (array)
		$search_type = intval($this->CI->input->get("search_type"));

		$search_value = "";
		if(!empty($search['value'])) {
			$search_value = $this->CI->common->nohtml($search['value']);
		}
		$this->search = $search_value;
		$this->search_type = $search_type;
	}

	public function process() 
	{
		$output = array(
			"draw" => $this->draw,
  			"recordsTotal" => $this->total_rows,
  			"recordsFiltered" => $this->total_rows,
  			"data" => $this->data
  		);
		if($this->total_rows == 0) {
			//$output['error'] = "No data was found!";
		}
		return $output;
	}

	public function db_order() 
	{
		if($this->order != null) {
			foreach($this->order as $order) {
				$this->CI->db->order_by($order['field'], $order['sort']);
			}
		}
	}

	public function get($table_name) 
	{
		$this->CI->db->stop_cache();
		if($this->search_flag) {
			// A search was performed, so we need to recalculate total rows.
			$this->CI->db->from($table_name);
			$this->total_rows = $this->CI->db->count_all_results();
		}
		$s=  $this->CI->db->limit($this->length, $this->start)
			->get($table_name);
		$this->CI->db->flush_cache();
		return $s;
	}

	/* 
		Default DB Search method.
	*/
	public function db_search($columns, $cache=false) 
	{
		if(!empty($this->search)) {
			if($this->search_type == 0) {

				if($cache) {
					$this->CI->db->start_cache();
				}

				// Search all columns for likeness
				$words = explode(" ", $this->search);
				$this->CI->db->group_start();
				foreach($words as $word) {
					foreach($columns as $field) {
						$this->CI->db->or_like($field, $word);
					}
				}
				$this->CI->db->group_end();

			} elseif($this->search_type == 1) {

				// Search all colums for likeness for whole string
				$this->CI->db->group_start();
				foreach($columns as $field) {
					$this->CI->db->or_like($field, $this->search);
				}
				$this->CI->db->group_end();

			} else {

				if($cache) {
					$this->CI->db->start_cache();
				}

				// Search for each individual column. 
				// First 2 indexes are reserved for above
				if(isset($columns[$this->search_type-2])) {
					$this->CI->db->group_start();
					$this->CI->db->or_like($columns[$this->search_type-2], 
						$this->search);
					$this->CI->db->group_end();
				}
			}

			// Get new search count
			$this->search_flag = true;
		}
	}

}

?>