<?php

class Cotizacion_model extends CI_Model {

	public function get($where) {
		return $this->db->select("ce_cotizacion.*, (select count(0) from ce_alumnos where ce_alumnos.instancias_id=ce_instancias.id) as total_alumnos")
			->where($where)->get("ce_instancias")->result_array();
	}

	public function change_status($cotizacion_id, $status) {
		$this->db->where('cotizacion_id', $cotizacion_id);
		$up['fecha_respuesta'] = date("Y-m-d H:i:s");
		switch ((int) $status) {
		case 0:
			$up['status_row'] = 0;
			$up['fecha_respuesta'] = '';
			$up['status_row_info'] = _get_user();
			break;
		case 1:
			$up['status_row'] = 1;
			$up['status_row_info'] = _get_user();
			break;

		case 2:
			$up['status_row'] = 2;
			$up['status_row_info'] = _get_user();
			break;

		}

		$up = _modified($up);

		$this->db->update('ce_cotizacion', $up);
	}
	public function get_by_id($id) {
		$where['cotizacion_id'] = $id;
		$row = $this->db->limit(1)->where($where)->get('ce_cotizacion')->row_array();
		$productos = array();
		$cotizacion_empresa = array();
		if (count($row) > 0) {
			/*obtenemos el detalle*/
			/*datos de la empresa*/
		 
			/*datos del cliente*/
			/*datos del creador*/
			$id_creador = $row['user_created'];
			$creador = $this->db->select('email as creador_email, first_name as creador_nombre, last_name as creador_apellido')->where('id', $id_creador)->get("users")->row_array();
			/* fin de datos del creador*/
			$cotizacion_id = $row['cotizacion_id'];
			 
			 
			$row = array_merge($row, $creador);
			return array($row );
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
