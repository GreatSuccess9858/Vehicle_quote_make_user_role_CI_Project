<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Config extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null) {
		//$this->load->view('example.php', (array) $output);
		//$this->template->loadData("activeLink",
		//	array("sedes" => array("index" => 1)));
		$this->template->loadContent("crud_simple.php", (array) $output);
		
	}
	function vehiculos() {

		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('ce_vehiculos');
			$crud->set_subject('Vehiculos');
			$crud->required_fields('name');
		 
			$crud->set_field_upload('logo', 'uploads/vehiculos');
			$crud->callback_after_upload(array($this, 'example_callback_after_upload'));

			$crud->columns(  'name', 'description',   'status');
			$crud->fields( 'name','tipo_unidad' ,'description',   'logo', 'status');

			$array['name'] = 'Nombre del vehiculo';
			$array['description'] = 'Descripción';
			$array['tipo_unidad'] = 'Tipo de unidad';
			 
			$array['status'] = 'Estado';
			 

			$crud->display_as($array);
			$crud->field_type('status', 'dropdown', array(0 => 'Inactivo', 1 => 'Activo'));
			$output = $crud->render();
			$output = _helper_active_link((array) $output, 'config', 'vehiculos');
			$this->_example_output($output);

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}
	 function vehiculo_image()
	 {
	 	$id=$this->input->post('id');
	 	 if($id==''){  echo  'Vehiculo no seleccionado.'; exit();}
	 	 $vehiculo=$this->db->where('vehiculos_id',$id)->get("ce_vehiculos")->row_array()


	 	 ;



	 	    ?><img src="<?php  echo base_url('uploads/vehiculos/'.$vehiculo['logo']); ?>" alt="">
	 	    <?PHP
	 }
	function sedes() {

		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('ce_sedes');
			$crud->set_subject('Sedes');
			$crud->required_fields('name');
			$crud->required_fields(array('status', 'name', 'pdf_header_1', 'logo', 'pais'));
			$crud->set_field_upload('logo', 'uploads/pdf_logos');
			$crud->callback_after_upload(array($this, 'example_callback_after_upload'));

			$crud->columns('pais', 'name', 'address', 'tel', 'status');
			$crud->fields('pais', 'name', 'address', 'tel', 'email', 'contacto', 'NIT', 'pdf_header_1', 'pdf_header_2', 'pdf_header_3', 'pdf_header_4', 'pdf_footer', 'logo', 'status');

			$array['name'] = 'Nombre de la sede';
			$array['address'] = 'Dirección';
			$array['pais'] = 'Pais';
			$array['tel'] = 'Teléfono';
			$array['status'] = 'Estado';
			$array['email'] = 'E-mail';
			$array['contacto'] = 'Contacto';
			$array['NIT'] = 'NIT';
			$array['pdf_header_1'] = 'Encabezado  (linea 1)';
			$array['pdf_header_2'] = 'Encabezado  (linea 2)';
			$array['pdf_header_3'] = 'Encabezado  (linea 3)';
			$array['pdf_header_4'] = 'Encabezado  (linea 4)';
			$array['pdf_footer'] = 'Pie de página';

			$crud->display_as($array);
			$crud->field_type('status', 'dropdown', array(0 => 'Inactivo', 1 => 'Activo'));
			$output = $crud->render();
			$output = _helper_active_link((array) $output, 'capsa', 'sedes');
			$this->_example_output($output);

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}
	function example_callback_after_upload($uploader_response, $field_info, $files_to_upload) {
		$this->load->library('Image_moo');

//Is only one file uploaded so it ok to use it with $uploader_response[0].
		$file_uploaded = $field_info->upload_path . '/' . $uploader_response[0]->name;

		$this->image_moo->load($file_uploaded)->resize(400, 400)->save($file_uploaded, true);

		return true;
	}
	function empresas() {

		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('ce_empresas');
			$crud->set_subject('Empresas');

			$crud->required_fields(array('status', 'nombre', 'ruc', 'marca'));
			$crud->columns('nombre', 'marca', 'ruc', 'direccion', 'telefono', 'status');
			$crud->fields('nombre', 'marca', 'ruc', 'direccion', 'telefono', 'status');
			$array['nombre'] = 'Nombre de la empresa';
			$array['direccion'] = 'Dirección';
			$array['telefono'] = 'Teléfono';
			$array['status'] = 'Estado';
			$crud->display_as($array);
			$crud->field_type('status', 'dropdown', array(0 => 'Inactivo', 1 => 'Activo'));
			$output = $crud->render();
			$output = _helper_active_link((array) $output, 'capsa', 'empresas');
			$this->_example_output($output);

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}

	function clientes() {

		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('ce_clientes');
			$crud->set_subject('Clientes');
			$crud->required_fields('nombre');
			$crud->required_fields(array('status', 'nombre', 'email'));
			$crud->columns('nombre', 'email', 'telefono', 'status');

			$crud->fields('nombre', 'email', 'telefono', 'status', 'empresas_id');

			$crud->set_relation('empresas_id', 'ce_empresas', 'nombre', array('status' => '1'));

			$array['nombre'] = 'Nombre';
			$array['email'] = 'Email';
			$array['telefono'] = 'Teléfono';
			$array['status'] = 'Estado';
			$array['empresas_id'] = 'Empresa';
			$crud->display_as($array);
			$crud->field_type('status', 'dropdown', array(0 => 'Inactivo', 1 => 'Activo'));
			$output = $crud->render();
			$output = _helper_active_link((array) $output, 'capsa', 'clientes');
			$this->_example_output($output);

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}

	function comisiones($operation='',$id=0) {

		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('ce_config_comisiones');
			$crud->set_subject('Comisiones');
			//$crud->required_fields('nombre');
			$crud->required_fields(array('status', 'porcentaje_comision', 'users_id'));
			$crud->columns('users_id', 'porcentaje_comision', 'status');

			$crud->fields('porcentaje_comision', 'users_id', 'status');
			 if($operation!='edit' && $operation!='update' && $operation!='update_validation'){
			 	$crud->set_rules('users_id', 'Usuario(Ya esta registrado)','trim|required|is_unique[ce_config_comisiones.users_id]');
			 }
			
			$crud->set_primary_key('users_id', 'view_users');
			$crud->set_relation('users_id', 'view_users', 'first_name', array('active' => '1'));

			$array['first_name'] = 'Usuario';

			$array['porcentaje_comision'] = '% Comisión';
			$array['status'] = 'Estado';
			$array['users_id'] = 'Usuario';
			$crud->display_as($array);
			$crud->field_type('status', 'dropdown', array(0 => 'Inactivo', 1 => 'Activo'));
			$output = $crud->render();
			$output = _helper_active_link((array) $output, 'capsa', 'comisiones');
			$this->_example_output($output);

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}

	function costos_categorias() {

		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('ce_costos_categorias');
			$crud->set_subject('Costos(Categorias)');
			//$crud->required_fields('nombre');
			$crud->required_fields(array('status', 'nombre'));
			$crud->columns('nombre', 'status');

			$crud->fields('nombre', 'status');

			//$crud->set_primary_key('users_id','view_users');
			//$crud->set_relation('users_id', 'view_users', 'first_name', array('active' => '1'));

			$array['nombre'] = 'Nombre de la categoria';

			$array['status'] = 'Estado';

			$crud->display_as($array);
			$crud->field_type('status', 'dropdown', array(0 => 'Inactivo', 1 => 'Activo'));
			$output = $crud->render();
			$output = _helper_active_link((array) $output, 'capsa', 'costos_categorias');
			$this->_example_output($output);

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}

	function costos_items() {

		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('ce_costos_items');
			$crud->set_subject('Costos(Items)');
			//$crud->required_fields('nombre');
			$crud->required_fields(array('status', 'nombre'));
			$crud->columns('nombre', 'costos_categorias_id', 'status');

			$crud->fields('costos_categorias_id', 'nombre', 'status');

			//$crud->set_primary_key('users_id', 'view_users');
			$crud->set_relation('costos_categorias_id', 'ce_costos_categorias', 'nombre', array('status' => '1'));

			$array['nombre'] = 'Nombre del item';

			$array['costos_categorias_id'] = 'Categoria';
			$array['status'] = 'Estado';
			//$array['users_id'] = 'Usuario';
			$crud->display_as($array);
			$crud->field_type('status', 'dropdown', array(0 => 'Inactivo', 1 => 'Activo'));
			$output = $crud->render();
			$output = _helper_active_link((array) $output, 'capsa', 'costos_items');
			$this->_example_output($output);

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}
}