<?php

class Hook_model extends CI_Model {

	public function update_status_instancia($instancias_id) {
		/*vericamos el status de todos los alumnos de una instancia*/
		$query = $this->db->select('status')->where('instancias_id', $instancias_id)->group_by('status')->get('ce_alumnos');

		if ($query->num_rows() == 1) {
			$row = $query->row_array();
			$temp = array();
			$status = $temp['status'] = $row['status'];

			$this->db->where('id', $instancias_id)->limit(1)->update("ce_instancias", $temp);
		} else {

			$rows = $query->result_array();
			$status = 0;
			foreach ($rows as $k => $v) {
				if ($v['status'] == '-1') {
					$status = -1;
				}
			}

			$temp = array();
			$temp['status'] = $status;

			$this->db->where('id', $instancias_id)->limit(1)->update("ce_instancias", $temp);

		}
		return $status;

	}

	public function get($where) {
		return $this->db->select("ce_instancias.*, (select count(0) from ce_alumnos where ce_alumnos.instancias_id=ce_instancias.id) as total_alumnos")
			->where($where)->get("ce_instancias")->result_array();
	}

	public function get_by_id($id) {
		$where['id'] = $id;
		$rows = $this->get($where);

		if (count($rows) > 0) {
			return $rows[0];
		} else {
			return array();
		}
	}

	function get_alumnos($id) {
		$rows = $this->db->select("*")->where('instancias_id', $id)->get("ce_alumnos")->result_array();

		return $rows;

	}
}
