<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Proyectos extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (defined('REQUEST') && REQUEST == "external") {
			return;
		}
		$this->template->loadData("activeLink",
			array("home" => array("general" => 1)));

		$this->load->model("user_model");
		$this->load->model("home_model");
		$this->load->model("instancias_model");

		if (!$this->user->loggedin) {
			redirect(site_url("login"));
		}
	}

	function adjuntar_cotizacion() {
		$proyectos_id = $this->input->post('proyectos_id');
		$sedes_id = $this->input->post('sedes_id');
		$cotizacion_id = $this->input->post('cotizacion_id');

		$up = array();
		$up['proyectos_id'] = $proyectos_id;
		$t = $this->db->select('proyectos_id')->where('cotizacion_id', $cotizacion_id)->get('ce_cotizacion')->row_array();
		/*verificamo que   la cotizacion no esta asignado a un proyecto.*/
		if (count($t) > 0 && (int) $t['proyectos_id'] == 0) {

			$this->db->where('cotizacion_id', $cotizacion_id)
				->update('ce_cotizacion', $up);

		}

		$r['proyectos_id'] = $proyectos_id;

		_json_ok("Se adjunto correctamente la cotizacion al  proyecto.", $r);
	}

	function ajax_crear() {

		$nombre = $this->input->post("nombre");
		$cotizacion_id = $this->input->post("cotizacion_id");

		$_num = $this->db->where('nombre', $nombre)->get('ce_proyectos')->num_rows();
		if ($_num > 0) {
			_json_error("Existe un proyecto con  el mismo nombre");
		}

		$_num = $this->db->where('cotizacion_id', $cotizacion_id)->where('proyectos_id >', 0)->get('ce_cotizacion')->num_rows();
		if ($_num > 0) {
			_json_error("La cotización que intenta agregar ya se encuentra  adjuntada en otro proyecto.");
		}

		$sedes_id = _helper_sedes_id();

		$fecha_entrada = $this->input->post("fecha_entrada");
		$descripcion = $this->input->post("descripcion");
		$cotizacion_id = $this->input->post("cotizacion_id");

		$in['nombre'] = $nombre;
		$in['fecha_entrada'] = $fecha_entrada;
		$in['descripcion'] = $descripcion;
		$in['sedes_id'] = $sedes_id;
		//	$in['cotizacion_id'] = $cotizacion_id;

		$in = _created($in);

		$this->db->insert("ce_proyectos", $in);
		$proyectos_id = $this->db->insert_id();

		$up = array();
		$up['proyectos_id'] = $proyectos_id;
		$t = $this->db->select('proyectos_id')->where('cotizacion_id', $cotizacion_id)->get('ce_cotizacion')->row_array();
		/*verificamo que   la cotizacion no esta asignado a un proyecto.*/
		if (count($t) > 0 && (int) $t['proyectos_id'] == 0) {

			$this->db->where('cotizacion_id', $cotizacion_id)
				->update('ce_cotizacion', $up);

		}

		$r['proyectos_id'] = $proyectos_id;

		_json_ok("Se agrego un nuevo proyecto.", $r);
	}

	function ajax_list() {

		$current = $this->input->post('current');
		$rowCount = $this->input->post('rowCount');
		$rows = $this->db->select("X.* ")
			->from("ce_proyectos X");
		//->join("ce_links Y", "Y.proyectos_id=X.id", "left")

		//->group_by("X.id")
		//	->get()->result_array();

		$_temp_num = $total = $this->db->count_all_results('', false); //$this->db->get()->num_rows();
		$rows = $this->db->limit($rowCount, ($current - 1) * $rowCount)->get()->result_array();

		$response['rows'] = $rows;
		$response['current'] = $current;
		$response['rowCount'] = $rowCount;
		$response['total'] = $total;

		echo json_encode($response);
		exit();

	}

	function ajax_save_informacion_general() {

		$proyectos_id = $this->input->post("proyectos_id");
		$programacion = $this->input->post("programacion");
		$fecha_entrada = $this->input->post("fecha_entrada");
		$fecha_produccion = $this->input->post("fecha_produccion");
		$fecha_entrega = $this->input->post("fecha_entrega");
		$arte_aprobado = $this->input->post("arte_aprobado");
		$mercancia_comprada = $this->input->post("mercancia_comprada");
		$insumos_comprados = $this->input->post("insumos_comprados");

		_proyectos($proyectos_id);

		$up['programacion'] = $programacion;
		$up['fecha_entrada'] = $fecha_entrada;
		$up['fecha_produccion'] = $fecha_produccion;
		$up['fecha_entrega'] = $fecha_entrega;
		$up['arte_aprobado'] = $arte_aprobado;
		$up['mercancia_comprada'] = $mercancia_comprada;
		$up['insumos_comprados'] = $insumos_comprados;

		$this->db->where('proyectos_id', $proyectos_id)->update("ce_proyectos", $up);
		_json_ok();
		exit();
	}
	function ajax_list_links($id) {

		$q = $this->input->post("searchPhrase");
		$current = $this->input->post('current');
		$rowCount = $this->input->post('rowCount');
		$query = $this->db->select("X.* ")
			->from("ce_links X")
			->where('proyectos_id', $id);

		if (!empty($q)) {
			$query->like("nombre", $q);

		}

		if ($current > 0) {
			$query->limit($rowCount, ($current - 1) * $rowCount);
		}
		$rows = $query->get()->result_array();

		if (count($rows) > 0) {

			foreach ($rows as $k => $v) {
				$rows[$k]['site1_precio'] = _numero($v['site1_precio']);
				$rows[$k]['site2_precio'] = _numero($v['site2_precio']);
				$rows[$k]['site3_precio'] = _numero($v['site3_precio']);
				$rows[$k]['site4_precio'] = _numero($v['site4_precio']);
				$rows[$k]['site5_precio'] = _numero($v['site5_precio']);
			}
		}

		$response['rows'] = $rows;
		$response['current'] = $current;
		$response['rowCount'] = $rowCount;

		$query2 = $this->db->from("ce_links");
		if (!empty($q)) {
			$query2->like("nombre", $q);
		}

		$response['total'] = $this->db->count_all_results();

		echo json_encode($response);
		exit();

	}

	/* cambiar el estado  del proyecto status_row*/
	function change_status($status, $proyectos_id) {
		$status = (int) $status;
		if ($status < 0 || $status > 4) {
			$status = 0;
		}
		$up['status_row'] = $status;

		$up = _modified($up);
		$up['status_row_info'] = _get_user();
		$this->db->where('proyectos_id', $proyectos_id)->update("ce_proyectos", $up);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function delete_costo() {
		$costos_id = $this->input->post('costos_id');
		$proyectos_id = $this->input->post("proyectos_id");
		/*validams si tiene permiso para  borrar costos.*/
		_proyectos($proyectos_id);

		$up['status'] = 0;
		$up['status_info'] = _get_user();
		$up = _modified($up);

		$this->db->where('costos_id', $costos_id)->update('ce_costos', $up);
		_json_ok('El registro de costo fue eliminado.');
	}

	function delete_cotizacion() {
		$cotizacion_id = $this->input->post('cotizacion_id');
		//$costos_id = $this->input->post('costos_id');
		$proyectos_id = $this->input->post("proyectos_id");
		_proyectos($proyectos_id);

		$up['status'] = 1;
		$up['proyectos_id'] = 0;
		$up = _modified($up);

		$this->db->where('cotizacion_id', $cotizacion_id)->update('ce_cotizacion', $up);
		_json_ok('El registro de cotizacion fue retirado.');

	}

	function detalles($proyectos_id = false) {

		if ($proyectos_id === false) {
			echo 'error';
			exit();
		}

		$rows = array();
		$this->template->loadData("activeLink",
			array("proyectos" => array("index" => 1)));
		$data = array(
			"new_members" => 0,
			"stats" => 0,
			"online_count" => 0,

		);

		/**/

		$costos = array(); // $this->db->where('proyectos_id', $proyectos_id)->get('ce_costos')->row_array();

		$proyecto = $this->db->where('proyectos_id', $proyectos_id)->get('view_proyectos_1')->row_array();
		/*sacando informacion de  cotizacion */
		$cotizaciones = ''; /*$this->db->select('X.*,count(Y.id) as num_productos')->where('proyectos_id', $proyectos_id)->from('ce_cotizacion X')->join('ce_cotizacion_detalle Y', 'X.cotizacion_id=Y.cotizacion_id')->group_by('X.cotizacion_id')->get()->result_array();
		*/
		/**/
		$data['proyecto'] = $proyecto;
		$data['cotizaciones'] = $cotizaciones;
		$data['costos'] = $costos;
		$data['proyectos_id'] = $proyectos_id;
		$this->template->loadContent("proyectos/detalles.php", $data);
	}

	function finalizar_proyecto($opcion = 0) {
		$proyectos_id = $this->input->post('proyectos_id');

		/*estamos cerrando*/
		if ($opcion == 0) {
			_proyectos($proyectos_id);
			$up['finalizado'] = 1;
		} else {
			/* estamos reabriendo rl proyecto */
			$up['finalizado'] = 0;
			if (!_is_admin()) {
				_json_error("Solo puede reabrir un proyecto un administrador.");
				exit();
			}
		}

		$up['finalizado_info'] = _get_user();

		$up = _modified($up);
		$this->db->where('proyectos_id', $proyectos_id)->update('ce_proyectos', $up);
		_json_ok("");
		exit();
	}

	function form_add_cotizacion() {
		$proyectos_id = $this->input->post('proyectos_id');
		$sedes_id = _helper_sedes_id();
		///$cotizaciones=$this->db->where('proyectos_id',$proyectos_id)->get("ce_cotizacion")->result_array();
		$cotizaciones = $this->db->where("status_row", 1)->where('sedes_id', $sedes_id)->get("view_cotizaciones_1")->result_array();
		$data['cotizaciones'] = $cotizaciones;
		$data['proyectos_id'] = $proyectos_id;
		$data['sedes_id'] = $sedes_id;
		$r['html'] = $this->load->view('proyectos/form_add_cotizacion', $data, true);
		echo json_encode($r);
		exit();
	}

	function form_costos($costos_id = false) {
		$data = array();

		/*leyendo costos  categorias*/
		$costos_categorias = $this->db->select('costos_categorias_id ,nombre as value')->where('status', 1)->get('ce_costos_categorias')->result_array();

		$costos_items = $this->db->select('costos_items_id  ,costos_categorias_id, nombre as value')->where('status', 1)->get('ce_costos_items')->result_array();
		$data['costos_categorias'] = $costos_categorias;
		$data['costos_items'] = $costos_items;

		$data['proyectos_id'] = $this->input->post('proyectos_id');
		$data['costos_id'] = $costos_id = $this->input->post('costos_id');
		//$data['costos_id'] = $costos_id;

		$costo = array();
		$costo['monto_oc'] = 0;
		$costo['pago'] = 0;
		$costo['pagado'] = 0;
		$costo['fecha_pagado'] = '';
		$costo['costos_categorias_id'] = 0;
		$costo['costos_items_id'] = 0;
		if ((int) $costos_id > 0) {
			$costo = $this->db->where('costos_id', $costos_id)->get("ce_costos")->row_array();
		}
		$data['costo'] = $costo;
		$html = $this->load->view('proyectos/form_costos', $data, true);

		$r['html'] = $html;

		echo json_encode($r);
		exit();
	}

	function get_costos() {
		$proyectos_id = $this->input->post('proyectos_id');
		$costos = $this->db->select("X.*, Y.nombre as categorias_nombre, Z.nombre as items_nombre")->where('proyectos_id', $proyectos_id)->from('ce_costos X')->join('ce_costos_categorias Y', 'Y.costos_categorias_id=X.costos_categorias_id', 'left')
			->join('ce_costos_items Z', 'Z.costos_items_id=X.costos_items_id', 'left')->where("X.status", 1)->get()->result_array();
		$data['costos'] = $costos;
		$html = $this->load->view('proyectos/get_costos', $data, true);

		$json['html'] = $html;

		echo json_encode($json);
		exit();
	}

	function get_cotizaciones() {
		$proyectos_id = $this->input->post('proyectos_id');
		///$cotizaciones=$this->db->where('proyectos_id',$proyectos_id)->get("ce_cotizacion")->result_array();
		$cotizaciones = $this->db->select('X.*,count(Y.id) as num_productos')->where('proyectos_id', $proyectos_id)->from('ce_cotizacion X')->join('ce_cotizacion_detalle Y', 'X.cotizacion_id=Y.cotizacion_id')->group_by('X.cotizacion_id')->get()->result_array();
		$data['cotizaciones'] = $cotizaciones;

		$r['html'] = $this->load->view('proyectos/get_cotizaciones', $data, true);
		echo json_encode($r);
		exit();
	}

	function index() {
		$rows = array(); // $this->instancias_model->get(array());

		$this->template->loadData("activeLink",
			array("proyectos" => array("index" => 1)));
		$data = array(
			"new_members" => 0,
			"stats" => 0,
			"online_count" => 0,

		);
		$data['instancias'] = $rows;
		$this->template->loadContent("proyectos/index.php", $data);
	}

	function operacion() {
		$rows = array();

		// obtenemos la sede id que ha sido seleccionada por el usuario
		$sedes_id = _helper_sedes_id();

		$data = array(
			"new_members" => 0,
			"stats" => 0,
			"online_count" => 0,

		);

		/* obtenemos todas las cotizaciones aprobadas */

		/* solo listamos las cotizaciones de la sede  que esten aprobadas.*/
		$cotizaciones = $this->db->where("status_row", 1)->where('sedes_id', $sedes_id)->get("view_cotizaciones_1")->result_array();
		$data['rows'] = $rows;

		$data['cotizaciones'] = $cotizaciones;

		$this->template->loadContent("proyectos/operacion.php", $data);
	}

	function save_costos() {
		$proyectos_id = $this->input->post('proyectos_id');
		$costos_categorias_id = $this->input->post('costos_categorias_id');
		$costos_items_id = $this->input->post('costos_items_id');
		$monto_oc = $this->input->post('monto_oc');
		$pago = $this->input->post('pago');
		$pagado = $this->input->post('pagado');
		$fecha_pagado = $this->input->post('fecha_pagado');

		_proyectos($proyectos_id);

		$in['proyectos_id'] = $proyectos_id;
		$in['costos_categorias_id'] = $costos_categorias_id;
		$in['costos_items_id'] = $costos_items_id;
		$in['monto_oc'] = $monto_oc;
		$in['pago'] = $pago;
		$in['pagado'] = $pagado;
		$in['fecha_pagado'] = $fecha_pagado;

		$costos_id = $this->input->post('costos_id');

		if ($costos_id > 0) {
			$is_update = true;
		} else {
			$is_update = false;
		}

		if ($is_update) {
			$in = _modified($in);
			$this->db->where('costos_id', $costos_id)->update('ce_costos', $in);
		} else {
			$in = _created($in);
			$this->db->insert('ce_costos', $in);
		}

		$array['is_update'] = (int) $is_update;

		_json_ok('La operacion se realizó con éxito.', $array);
	}

	function view_cotizacion() {
		$r = array();

		$r['html'] = '';
		$cotizacion_id = $this->input->post('cotizacion_id');
		$data['cotizacion_id'] = $cotizacion_id;
		$r['html'] = $this->load->view('proyectos/view_cotizacion', $data, true);
		echo json_encode($r);
		exit();
	}

}
