<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Informe_produccion extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->model("user_model");

		if (!$this->user->loggedin) {
			redirect(base_url());
		}

		$this->load->library('grocery_CRUD');

	}

	function index() {
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
		$vendedores = $this->db->where_in("user_role", array(1, 10))->get("users")->result_array();

/**/
		$users_id = $this->input->post('vendedor_id');
		$anio = $this->input->post('anio');
		$mes = $this->input->post('mes');
		$data['users_id'] = $users_id;
		$data['anio'] = $anio;
		$data['mes'] = $mes;

		$sql_add = '';
		if (isset($users_id) && !empty($users_id)) {
			$sql_add .= ' user_created=' . $users_id . ' and ';

		}
		if (isset($anio) && $anio > 0) {
			$sql_add .= ' year(created)=' . $anio . ' and ';
		}
		if (isset($mes) && $mes > 0) {

			$sql_add .= ' month(created)=' . $mes . ' and  ';
		}
		$sql_add .= ' 1=1 ';

/**/

		$data['proyectos'] = $this->db->where($sql_add)->get('view_proyectos_agrupados')->result_array();
		//echo $this->db->last_query();
		$data['vendedores'] = $vendedores;

		$this->template->loadContent("informe_produccion/informe_produccion__index.php", $data);
	}
	function get_informe() {

		$users_id = $this->input->post('vendedor_id');
		$anio = $this->input->post('anio');
		$mes = $this->input->post('mes');
		$data = array();
		$vendedores = $this->db->where_in("user_role", array(1, 10))->get("users")->result_array();

		$data['proyectos'] = $this->db->get('view_proyectos_agrupados')->result_array();
		$data['vendedores'] = $vendedores;

		$data['html'] = $data['content'] = $this->load->view('informe_ventas/get_informe', $data, TRUE);
		echo json_encode($data);
		exit();
		//$this->template->loadContent("informe_ventas/get_informe.php", $data);
	}

}