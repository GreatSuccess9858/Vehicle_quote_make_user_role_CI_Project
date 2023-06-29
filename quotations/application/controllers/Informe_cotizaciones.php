<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Informe_cotizaciones extends CI_Controller {

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
		$this->template->loadData("activeLink",
			array("informe_cotizaciones" => array("index" => 1)));
		// obtenemos la sede id que ha sido seleccionada por el usuario
		$sedes_id = _helper_sedes_id();

		$data = array(
			"new_members" => 0,
			"stats" => 0,
			"online_count" => 0,

		);

		/* obtenemos todas las cotizaciones aprobadas */
		$anio = $this->input->post('anio');
		$mes = $this->input->post('mes');
		$vendedor = $this->input->post('vendedor');

		$data['anio'] = $anio;
		$data['mes'] = $mes;
		$data['users_id'] = $vendedor;

		 

		/* solo listamos las cotizaciones de la sede  que esten aprobadas.*/
		$vendedores = $this->db->where_in("user_role", array(1, 10))->get("users")->result_array();

		$data['vendedores'] = $vendedores;
		//$cotizaciones=$this->db->get('view_cotizaciones_reporte')->result_array();
		/**/

		$sql_add = '';
		if (isset($anio) && $anio > 0) {
			$sql_add = ' year(created)=' . $anio . ' and ';
		}
		if (isset($mes) && $mes > 0) {

			$sql_add .= ' month(created)=' . $mes . ' and  ';
		}
		if(isset($vendedor) && $vendedor>0){
			$sql_add .= 'X.ID=' . $vendedor . ' and  ';	
		}

		$sql = "SELECT year(created) as year, month(created) as month, sum(total) as importe_total,  X.ID, concat(X.first_name,'', X.last_name) as vendedor,
        SUM(CASE WHEN `status` = '0' THEN 1 ELSE 0 END) as pendiente,
        SUM(CASE WHEN `status` = '1' THEN 1 ELSE 0 END) as aprobado,
        SUM(CASE WHEN `status` = '2' THEN 1 ELSE 0 END) as rechazado,
count(0) as total
FROM    ce_cotizacion, users as X
 where " . $sql_add . " X.ID=ce_cotizacion.user_created  GROUP BY user_created,year(created),month(created) order by created  ";

		$cotizaciones = $this->db->query($sql)->result_array();
/**/

		$data['cotizaciones'] = $cotizaciones;
		$this->template->loadContent("informe_cotizaciones/informe_cotizaciones__index.php", $data);
	}

}