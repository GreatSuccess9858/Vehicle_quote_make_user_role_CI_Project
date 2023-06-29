<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Sedes extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null) {
		//$this->load->view('example.php', (array) $output);
		$this->template->loadData("activeLink",
			array("sedes" => array("index" => 1)));
		$this->template->loadContent("crud_simple.php", (array) $output);

	}
	function cambiar_sede($sedes_id) {
		_helper_set_sede($sedes_id);

		$link = $_SERVER['HTTP_REFERER'];
		redirect($link);
	}

	function index() {

		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('ce_sedes');
			$crud->set_subject('Sedes');
			$crud->required_fields('name');
			$crud->required_fields(array('status', 'name'));
			$crud->columns('name', 'address', 'tel', 'status');
			$crud->fields('name', 'address', 'tel', 'pdf_header_1', 'pdf_header_2', 'pdf_header_3', 'pdf_header_4', 'status');
			$array['name'] = 'Nombre de la sede';
			$array['address'] = 'Dirección';
			$array['tel'] = 'Teléfono';
			$array['pdf_header_1'] = 'Encabezado documento(linea 1)';
			$array['pdf_header_2'] = 'Encabezado documento(linea 2)';
			$array['pdf_header_3'] = 'Encabezado documento(linea 3)';
			$array['pdf_header_4'] = 'Encabezado documento(linea 4)';

			$array['status'] = 'Estado';
			$crud->display_as($array);
			$crud->field_type('status', 'dropdown', array(0 => 'Inactivo', 1 => 'Activo'));
			$output = $crud->render();
			//	$output = _helper_active_link((array) $output, 'sedes');
			$this->_example_output($output);

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}
}