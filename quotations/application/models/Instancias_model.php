<?php

class Instancias_model extends CI_Model {

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
	function set_id_work($id, $usuarios_id) {
		$this->db->where('id', $id)->update("ce_instancias", array('usuarios_id_work' => $usuarios_id));
	}
	function get_alumnos($id) {
		$rows = $this->db->select("*")->where('instancias_id', $id)->get("ce_alumnos")->result_array();

		return $rows;

	}
}
