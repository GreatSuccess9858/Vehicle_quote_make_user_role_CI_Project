<?php

function _l($key = '', $r = false) {
	if ($r) {

		$temp = lang($key);
		if (empty($temp)) {
			return $key;
		} else {
			return $temp;
		}

	} else {
		$temp = lang($key);
		if (empty($temp)) {
			echo $key;
		} else {
			echo $temp;
		}
	}

}
function _helper_switch($id = '', $checked = 0, $on = 'Sí', $off = 'No') {
	?>
 	<input  value="1" type="checkbox"  <?php if ($checked == 1) {echo "checked";}?> class="switch-button" id="<?php echo $id; ?>" name="<?php echo $id; ?>" data-toggle="toggle"
 	data-on="<?php echo $on; ?>" data-off="<?php echo $off; ?>">
 	<?PHP
}
function _helper_modal($id = '', $title = '', $class = '', $submit = true) {
	$sub_class = '';

//	if (is_array($id)) {
	$id_modal = (isset($id['id'])) ? $id['id'] : $id;
	$title = (isset($id['title'])) ? $id['title'] : $title;

	$class = (isset($id['class'])) ? $id['class'] : $class;
	$sub_class = (isset($id['sub_class'])) ? $id['sub_class'] : '';
	$submit = (isset($id['submit'])) ? $id['submit'] : $submit;

	$submit_text = (isset($id['submit_text'])) ? $id['submit_text'] : 'Enviar';
	$title = (isset($id['title'])) ? $id['title'] : '';
	$title = (isset($id['title'])) ? $id['title'] : '';
	//}
	?>

<div class="modal fade   <?php echo $class; ?>" id="<?php echo $id_modal; ?>"   role="dialog">
	<div class="modal-dialog <?php echo $sub_class; ?>">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style=" "><span class="glyphicon glyphicon-plus"></span> <?php echo $title; ?></h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer text-right">

					 <?php if ($submit): ?>
					 	<button type="button" data-target="#submit" class="btn js-submit   btn-primary pull-rig ht" ><span class="glyphicon glyphicon-ok"></span> <?php echo $submit_text; ?> </button>
					 <?php endif?>




				<button type="button" class="btn  btn-default pull-rig ht" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>




			</div>
		</div>
	</div>
</div>

	<?PHP

}
function _helper_tt($text, $title = '', $icon = false) {
	_helper_tooltip($text, $title, $icon);
}
function _helper_tooltip($text, $title = '', $icon = false) {
	?>
 <span  data-toggle="tooltip" title="<?PHP echo $title; ?>">
 	 <?php if ($icon===false): ?>
 				<?php _icon('info-sign');?>	 	
 	<?php else: ?>
 		<?php if (strstr($icon,'fa-')): ?>
 			<?php  _icon_fa($icon); ?>
 			<?php else: ?>
 				<?php _icon($icon); ?>
 		<?php endif ?>
 	 <?php endif ?>
 
  <?php echo $text; ?></span>
 	<?PHP

}
 function _icon_fa($icon='',$tam='1')
 {
 	 $class='class=" fa ' . $icon.' fa-'.$tam .'"';


 	  
 
 	  
 	 echo '<i '.$class.' aria-hidden="true" ></i>';
 }
function _helper_back($extra = '') {

	redirect($_SERVER['HTTP_REFERER']);
}
function _helper_cotizacion_name($cotizacion_id) {
	return 'cotizacion-' . md5($cotizacion_id) . '-' . $cotizacion_id . '.pdf';

}
function _if($operator, $yes = 'Si', $no = 'No') {
	if ($operator) {
		echo $yes;
	} else {
		echo $no;
	}
}
function _format_number($numero, $currency = '') {
	$CI = get_instance();
	$_decimals = $CI->config->item('decimals');
	return $currency . ' ' . number_format($numero, $_decimals);

}
function _set_devises() {
	$CI = get_instance();
	$fecha = date("Y-m-d");
	$sql = 'SELECT id,TIMESTAMPDIFF(HOUR, fecha,now()) as horas FROM `ce_devises`  where   date(fecha)="' . $fecha . '" ';
	$rows = $CI->db->query($sql)->row_array();
	if (count($rows) > 0) {
// actualizamos
		$id = $rows['id'];

		$up['fecha'] = date('Y-m-d H:i:s');
		$horas = $rows['horas'];
		if ($horas > 3) {
			$t = file_get_contents("http://www.apilayer.net/api/live?access_key=e30d67caa71358630e99e708ae955ea1&format=1");

			$up['data'] = $t;
			$CI->db->where('id', $id)->update('ce_devises', $up);
		}

	} else {
		$t = file_get_contents("http://www.apilayer.net/api/live?access_key=e30d67caa71358630e99e708ae955ea1&format=1");
// insertamos
		$data['data'] = $t;
		$data['fecha'] = date('Y-m-d H:i:s');
		$CI->db->insert('ce_devises', $data);
	}
}
function _get_devises() {
	$CI = get_instance();

	$fecha = date("Y-m-d");

	$row = $CI->db->select("data")->where('date(now())', $fecha, true)->get('ce_devises')->row_array();

	$t = json_decode($row['data'], true);

	return $t['quotes'];

}
function _helper_sedes_idd() {
	return $_SESSION['sedes_id'];
}
function _helper_get_sede($sedes_id = false) {

	if ($sedes_id === false) {
		$sedes_id = $_SESSION['sedes_id'];
	} else {

	}
	$CI = get_instance();
	return $CI->db->where('sedes_id', $sedes_id)->get('ce_sedes')->row_array();

}
function _helper_set_sede($sedes_id) {
	$CI = get_instance();

	$users_id = _id();

	$up2['selected'] = 0;
	$CI->db->where('users_id', $users_id)->update('ce_sedes_users', $up2);

	$up['selected'] = 1;
	$CI->db->where('users_id', $users_id)->where('sedes_id', $sedes_id)->update('ce_sedes_users', $up);

	$_SESSION['sedes_id'] = $sedes_id;
}
function _helper_db_sede($sedes_id) {

}
function _helper_my_sedes() {
	$CI = get_instance();

	$my_sedes = $CI->db->select('X.sedes_id,X.name,X.address,X.tel,X.status,Y.selected,pdf_header_1,pdf_header_2,pdf_header_3,pdf_header_4')->where('Y.status', 1)->where('Y.users_id', _id())->from('ce_sedes X')->join('ce_sedes_users Y', 'X.sedes_id=Y.sedes_id')->get()->result_array();

	 if(count($my_sedes)<=0){
	 	return array($my_sedes, array());
	 }

	$flag = false;
	$selected = array();
	foreach ($my_sedes as $k => $v) {
		if ($v['selected'] == 1) {
			$flag = true;
			$selected = $v;
		}
	}
	if ($flag === false) {

		$selected = $my_sedes[0];
		_helper_set_sede($selected['sedes_id']);
	}
	$_SESSION['sedes_id'] = $selected['sedes_id'];

	$_SESSION['pdf_header_1'] = $selected['pdf_header_1'];
	$_SESSION['pdf_header_2'] = $selected['pdf_header_2'];
	$_SESSION['pdf_header_3'] = $selected['pdf_header_3'];
	$_SESSION['pdf_header_4'] = $selected['pdf_header_4'];

	return array($my_sedes, $selected);

}
function _numero($numero) {
	$numero = preg_replace("/([^0-9\\.])/i", "", $numero);
	return number_format($numero, 2, '.', ',');
}
function _time_file($filename, $hours) {

	if (time() - filemtime($filename) > $hours * 3600) {
		return true;
	} else {
		return false;
	}
}
function _curl($url) {
	$params = array();
	$curl = curl_init($url);

	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	//curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	$res = curl_exec($curl);
	curl_close($curl);
	return $res;
}
function _exec_curl($url_temp, $filename, $html = '', $path) {
	$html = _curl($url_temp);

	file_put_contents($path . $filename, $html);
	echo "Imprimiendo pagina>" . $url_temp;
	echo "<hr>";
}

function _helper_verify_sedes() {
	if (_helper_sedes_id() === false) {
		redirect(site_url('home/sedes'));
	}
}

function _helper_sedes_id() {

	if (isset($_SESSION['sedes_id']) && $_SESSION['sedes_id'] > 0) {
		return $_SESSION['sedes_id'];
	} else {
		return false;
	}
}

function _site($site, $pre = '', $post = '') {
	switch ($site) {
	case 1:
		return $pre . "base_sanpablo" . $post;
		break;
	case 2:
		return $pre . "base_fahorro" . $post;
		break;

	case 3:
		return $pre . "base_farmatodo" . $post;
		break;
	case 4:
		return $pre . "base_superama" . $post;
		break;

	case 5:
		return $pre . "base_lacomer" . $post;
		break;

	default:
		# code...
		break;
	}
}
function _status_proyecto($status) {
	switch ($status) {
	case 0:
		return "Iniciado";
		break;
	case 1:
		return "Entregado y Cobrado";
		break;
	case -1:
		return "danger";
		break;
	case 2:
		return "En Producción";
		break;
	case 3:
		return "Entregado X Cobrar";
		break;
	case 4:
		return "Con Inconvenientes";
		break;
	default:
		# code...
		break;
	}
}

function _status_proyecto_color($status) {
	switch ($status) {
	case 0:
		return "default";
		break;
	case 1:
		return "info";
		break;
	case -1:
		return "danger";
		break;
	case 2:
		return "sucess";
		break;
	case 3:
		return "warning";
		break;
	case 4:
		return "danger";
		break;
	default:
		# code...
		break;
	}
}
function _status_instancia_label($status) {
	switch ($status) {
	case 0:
		return "warning";
		break;
	case 1:
		return "info";
		break;
	case -1:
		return "danger";
		break;
	case 2:
		return "warning";
		break;
	case 3:
		return "success";
		break;
	default:
		# code...
		break;
	}
}
function _alumnos_flag($flag) {
	$flag = (int) $flag;
	switch ($flag) {
	case 0:
		return 'warning';
		break;

	case -1:
		return 'danger';
		break;

	default:
		return 'success';
		break;
	}
}
function _status_instancia($status) {
	switch ($status) {
	case 0:
		return "Pendiente";
		break;
	case 1:
		return "En progreso";
		break;
	case -1:
		return "Observado";
		break;
	case 2:
		return "Corregido";
		break;
	case 3:
		return "Aprobado";
		break;
	default:
		# code...
		break;
	}

}

function _status_text($status) {
	switch ($status) {
	case "0":
		return "Pendiente";
		break;
	case "1":
		return "En progreso";
		break;
	case "-1":
		return "Observado";
		break;
	case "2":
		return "Corregido";
		break;
	case "3":
		return "Aprobado";
		break;
	default:
		# code...
		break;
	}

}

function _modal($id = '') {
	?>

<!-- Modal -->
<div class="modal fade" id="<?PHP echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>
 	<?PHP
}
function _get_mensaje() {
	if (isset($_SESSION['mensaje_global'])) {
		$mensaje_global = $_SESSION['mensaje_global'];
		$_SESSION['mensaje_global'] = '';
	} else {
		$mensaje_global = '';

	}

	if (isset($_SESSION['mensaje_global_tipo'])) {
		$tipo = $_SESSION['mensaje_global_tipo'];
	} else {
		$tipo = 1;

	}

	//$_SESSION['mensaje_global'] = '';
	if ($tipo == 1) {
		$str = 'danger';
	} else {
		$str = 'success';
	}
	if (isset($mensaje_global) && !empty($mensaje_global)):
	?>
                    <div class="row session_native">
                        <div class="col-md-12">
                                <div class="alert alert-<?PHP echo $str; ?>"><b><span class="glyphicon glyphicon-ok"></span></b>
                                	<?php echo $mensaje_global; ?></div>
                        </div>
                    </div>
	<?PHP
endif;
}
function _set_mensaje($message, $tipo = 0) {
	$CI = get_instance();

	$CI->session->set_flashdata("globalmsg_tipo", $tipo);
	$CI->session->set_flashdata("globalmsg", $message);
	$_SESSION['mensaje_global'] = $message;
	$_SESSION['mensaje_global_tipo'] = $tipo;

}
function is_login() {
	$CI = get_instance();

	if ($CI->user->loggedin) {
		return true;
	} else {
		redirect(base_url() . 'user/login', 'refresh');
	}

}
function _is_tutor() {
	/*$CI = get_instance();
		if ($CI->user->info->user_role == 8) {
			return true;
		} else {
			return false;
	*/
}
function _is_vendedor() {
	$CI = get_instance();
	if ($CI->user->info->user_role == 10) {
		return true;
	} else {
		return false;
	}
}
function _is_banned() {
	$CI = get_instance();
	if ($CI->user->info->user_role == 6) {
		return true;
	} else {
		return false;
	}
}
function _is_admin() {
	$CI = get_instance();
	if ($CI->user->info->user_role == 1) {
		return true;
	} else {
		return false;
	}

}
function _is_gestor() {
	$CI = get_instance();
	if ($CI->user->info->user_role == 7) {
		return true;
	} else {
		return false;
	}
}

function _is_user() {
	$CI = get_instance();
	if ($CI->user->info->user_role == 9) {
		return true;
	} else {
		return false;
	}
}
function _info($key,$obj,  $return = false) {
	if (!$return) {
		if (isset($obj[$key])) {
			echo $obj[$key];
		} else {
			echo '';
		}

	} else {

		if (isset($obj[$key])) {
			return $obj[$key];
		} else {
			return '';
		}
	}
}
function _v($obj, $key, $return = false) {
	if (!$return) {
		if (isset($obj->{$key})) {
			echo $obj->{$key};
		} else {
			echo '';
		}

	} else {

		if (isset($obj->{$key})) {
			return $obj->{$key};
		} else {
			return '';
		}
	}

}
function _va($obj, $key, $return = false) {
	if (!$return) {
		if (isset($obj[$key])) {
			echo $obj[$key];
		} else {
			echo '';
		}

	} else {

		if (isset($obj[$key])) {
			return $obj[$key];
		} else {
			return '';
		}
	}

}
function _id() {
	$CI = get_instance();
	$tutores_id = $CI->user->info->ID;
	return $tutores_id;
}
function _created_info($v) {
	$CI = get_instance();
	$id = $CI->user->info->ID;
	$v['created'] = date('Y-m-d H:i:s');
	$v['user_created'] = $id;
	return $v;
}
function _created($v) {
	return _created_info($v);
}
function _modified($v) {
	return _modified_info($v);
}
function _proyectos($proyectos_id) {
	$CI = get_instance();
	$id = $CI->user->info->ID;
	//$role_id = $CI->user->info->user_role;
	if (_is_admin() || _is_created_proyectos($proyectos_id, $id)) {
		return true;
	} else {
		_json_error("Usted no puede modificar este proyecto. Usted no ha creado este proyecto o no tiene permisos para realizar esta acción.");
		exit();
	}
	/* solo puede proceder si le pertenece o si es ADMINISTRADOR*/

}
 
function _cotizaciones($cotizacion_id, $ajax = true) {
	$CI = get_instance();
	$id = $CI->user->info->ID;
	//$role_id = $CI->user->info->user_role;
	if (_is_admin() || _is_created_cotizaciones($cotizacion_id, $id)) {
		return true;
	} else {
		$msg = "Usted no puede modificar esta cotizacion. Usted no ha creado esta cotización o no tiene permisos para realizar esta acción.";
		if ($ajax) {
			_json_error($msg);
		} else {

			_set_mensaje($msg, 1);
			_helper_back();
		}

		exit();
	}
	/* solo puede proceder si le pertenece o si es ADMINISTRADOR*/

}
function _is_created_proyectos($proyectos_id, $users_id) {
	$CI = get_instance();
	$num = $CI->db->where("proyectos_id", $proyectos_id)->where('user_created', $users_id)->get('ce_proyectos')->num_rows();
	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}
function _is_created_cotizaciones($cotizacion_id, $users_id) {
	$CI = get_instance();
	$num = $CI->db->where("cotizacion_id", $cotizacion_id)->where('user_created', $users_id)->get('ce_cotizacion')->num_rows();
	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}
function _modified_info($v) {
	$CI = get_instance();
	$id = $CI->user->info->ID;
	$v['modified'] = date('Y-m-d H:i:s');
	$v['user_modified'] = $id;
	return $v;
}
function _get_user() {
	$CI = get_instance();
	$id = $CI->user->info->ID;
	$firstname = $CI->user->info->first_name;
	$lastname = $CI->user->info->last_name;
	$email = $CI->user->info->email;

	$str = "(" . $id . ") " . $firstname . ' ' . $lastname . ' | ' . $email . ' | ' . date("Y-m-d H:i:s");

	return $str;
}
function _token() {
	$CI = get_instance();
	$name = $CI->security->get_csrf_token_name();
	$hash = $CI->security->get_csrf_hash();

	?>
 	  <input type="hidden" name="<?php echo $name; ?>" id="_token" value="<?php echo $hash; ?>">
 	 <?PHP
}
function _json($array, $error = 0) {

	if (!isset($array['error'])) {
		$array['error'] = $error;
	}
	if (!isset($array['redirect'])) {
		$array['redirect'] = '';
	}
	echo json_encode($array);
	exit();
}
function _json_error($message, $array = array()) {
	$array['message'] = $message;
	$array['error'] = '1';
	_json($array);

}
function _json_ok($message = '', $array = array()) {
	if ($message == '') {
		$message = 'La operación se realizó con éxito.';
	}
	$array['message'] = $message;
	$array['error'] = '0';
	_json($array);

}
function _input_hidden($name, $obj, $key) {
	?>
 	 <input type="hidden" name="<?php echo $name . '[' . $key . ']'; ?>" value="<?php _v($obj, $key)?>">
 	 <?PHP
}
function _simple_hidden($name, $obj, $key) {
	?>
 	 <input type="hidden" name="<?php echo $name; ?>" value="<?php _va($obj, $key)?>">
 	 <?PHP
}
function _icon($icon,$tam=1) {
	//user-graduate
	if ($icon == 'view') {$icon = 'eye-open';}
	?>

		<?php if (strstr($icon,'fa-')): ?>
 			<?php  _icon_fa($icon,$tam); ?>
 			<?php else: ?>
 				 <i class="glyphicon glyphicon-<?PHP echo $icon; ?>		"></i>
 		<?php endif ?>

 <?PHP
}
function _get_precio() {
	$CI = get_instance();
	$tutores_id = $CI->user->info->ID;
	$CI->db->where('status', 1);
	$CI->db->from('ce_precios');
	$query = $CI->db->get();
	if ($query->num_rows() > 0) {
		$catlog_data = $query->row_array();
		return $catlog_data['precio'];
	} else {return 0;}
}

function _get_facturacion_info() {
	$CI = get_instance();
	$tutores_id = $CI->user->info->ID;
	$CI->db->where('tutores_id', $tutores_id);
	$CI->db->from('ce_facturacion_info');
	$query = $CI->db->get();
	if ($query->num_rows() > 0) {
		$catlog_data = $query->row();
		return $catlog_data;
	} else {return false;}
}

function _get_colegios_info() {
	$CI = get_instance();
	$tutores_id = $CI->user->info->ID;
	$CI->db->where('tutores_id', $tutores_id);
	$CI->db->from('ce_colegios');
	$query = $CI->db->get();
	if ($query->num_rows() > 0) {
		$catlog_data = $query->row();
		return $catlog_data;
	} else {return false;}
}

function _all_rows($tableName = '', $where = '', $columnValue = '*', $colume = '') {
	$CI = get_instance();
	$CI->db->select($columnValue);
	$CI->db->where($where);
	$CI->db->from($tableName);
	$query = $CI->db->get();
	if ($query->num_rows() > 0) {
		$catlog_data = $query->result();
		return $catlog_data;
	} else {return false;}
}

function GenReferencia() {
	$mult = 2;
	$pref = 22;
	$fecha = getdate();
	$an = $fecha['year'] - 2000;
	$numero = $pref . $an . $fecha['mon'] . $fecha['mday'] . $fecha['hours'] . $fecha['minutes'] .
		$fecha['seconds'];
	$numero = trim($numero);
	$tam = strlen($numero);
	//echo "El numero es: \t\t",$numero, "\t\tEl tamaño es: \t\t",$tam, "<br>", "<br>";
	$i = 0;
	$sumatot = 0;
	for ($i = $tam; $i >= 1; $i--) {

		$dato = substr($numero, $i - 1, 1);
		$resul = intval($dato) * $mult;

		if ($resul > 9) {
			$otro = trim(strval($resul));
			$aux1 = substr($otro, 0, 1);
			$aux2 = substr($otro, 1, 1);
			$tot = intval($aux1) + intval($aux2);

		} else {
			$tot = $resul;
		}

		$sumatot = $sumatot + $tot;

		$mult = $mult + 1;

		if ($mult > 2) {
			$mult = 1;
		}

	}
	$maximo = intval(substr(trim(strval($sumatot)), 0, 1)) + 1;
	$maximo = $maximo * 10;
	$ref = $maximo - $sumatot;
	if ($maximo - $sumatot >= 10) {
		$ref = 0;
	}

	return $numero . $ref;
}

function _helper_sidebar_link($text = '', $link = '', $a = '', $b = '', $activeLink = array(), $icon = 'home sidebar-icon sidebar-icon-blue') {
	?>
<li class="<?php if (isset($activeLink[$a][$b])) {
		echo "active";
	}
	?>"><a href="<?php
echo site_url($link) ?>"><span class="glyphicon glyphicon-<?PHP echo $icon; ?>"></span>
<?php echo _l($text); ?>

<?php if (isset($activeLink[$a][$b])) {

		?>
<span class="sr-only">(current)</span>
	<?PHP
}?>
</a></li>


 	<?PHP
}