<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Links extends CI_Controller {

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

	function descargar($id) {

		$rows = $this->db->select("X.*,
			A.modified as site1_modified,
			B.modified as site2_modified,
			C.modified as site3_modified,
			D.modified as site4_modified,
			E.modified as site5_modified
			")->where("X.proyectos_id", $id)->from("ce_links X")

			->join("ce_base_fahorro A", "A.id=X.base_fahorro_id", "left outer")
			->join("ce_base_farmatodo B", "B.id=X.base_fahorro_id", "left outer")
			->join("ce_base_lacomer C", "C.id=X.base_fahorro_id", "left outer")
			->join("ce_base_sanpablo D", "D.id=X.base_sanpablo_id", "left outer")
			->join("ce_base_superama E", "E.id=X.base_superama_id", "left outer")

			->get()->result_array();
		if (count($rows) > 0) {

			foreach ($rows as $k => $v) {
				$rows[$k]['site1_precio'] = _numero($v['site1_precio']);
				$rows[$k]['site2_precio'] = _numero($v['site2_precio']);
				$rows[$k]['site3_precio'] = _numero($v['site3_precio']);
				$rows[$k]['site4_precio'] = _numero($v['site4_precio']);
				$rows[$k]['site5_precio'] = _numero($v['site5_precio']);
			}
		}
		$data['rows'] = $rows;

		$this->load->view("links/descargar", $data);
	}
	function forzar($id) {

		$row = $this->db->where('id', $id)->get("ce_links")->row_array();

		$codigo = $row['codigo'];

		$url = "https://www.farmaciasanpablo.com.mx/search/?text=" . $codigo;

		$url2 = "https://www.fahorro.com/catalogsearch/result/?q=" . $codigo;
		/*******************************************************/
		$html = $this->_curl($url);
		$vector = $this->_site1($html);
		$html = $this->_curl($url2);
		$vector2 = $this->_site2($html);
		$update['site1_link'] = trim($vector['href']);
		$update['site1_precio'] = trim($vector['precio']);
		$update['site1_nombre'] = trim($vector['producto']);

		$update['site2_link'] = trim($vector2['href']);
		$update['site2_precio'] = trim($vector2['precio']);
		$update['site2_nombre'] = trim($vector2['producto']);

		if (!empty($vector['producto'])) {
			$update['nombre'] = trim($vector['producto']);
		}
		if (!empty($vector2['producto'])) {
			$update['nombre'] = trim($vector2['producto']);
		}

		/*******************************************************/
		$this->db->where("id", $id)->update("ce_links", $update);
		$update['id'] = $id;
		$update['url'] = $url;
		echo json_encode($update);
		exit();
		/*******************************************************/
	}
	function _site1($res) {
		$doc = new \DOMDocument();

		libxml_use_internal_errors(true);
		$doc->loadHTML($res);
		libxml_clear_errors();

		$xpath = new \DOMXpath($doc);
//p[@class="item-title"][1]//parent::*[1]
		//$articles = $xpath->query('//div[@class="item"]//p[contains(@class, "item-title") or contains(@class, "item-prize")]');
		$href = $producto = $precio = '-';
		$producto = '';
		$articles = $xpath->query('//div[@class="item"]/div//p[@class="item-title"]/ancestor-or-self::a');
		if ($articles->length) {

			$element = $articles->item(0);
			$href = $element->getAttribute("href");

			$producto = $element->nodeValue;
		}
		$articles = $xpath->query('//div[@class="item"]/div//p[@class="item-prize"]');
		if ($articles->length) {

			$element = $articles->item(0);

			$precio = $element->nodeValue;
		}
		return array('href' => $href, "producto" => $producto, "precio" => $precio);

	}

	function _site2($res) {
		$doc = new \DOMDocument();

		libxml_use_internal_errors(true);
		$doc->loadHTML($res);
		libxml_clear_errors();

		$xpath = new \DOMXpath($doc);
//p[@class="item-title"][1]//parent::*[1]
		//$articles = $xpath->query('//div[@class="item"]//p[contains(@class, "item-title") or contains(@class, "item-prize")]');
		$href = $producto = $precio = '-';
		$producto = '';
		/**************************************/
		$query1 = '//div[@class="category-products"]//li[contains(@class, "item")][1]//h2[contains(@class, "product-name")]/a';
		$articles = $xpath->query($query1);
		if ($articles->length) {

			$element = $articles->item(0);
			$href = $element->getAttribute("href");

			$producto = $element->nodeValue;
		}
		/**************************************/
		$query2 = '//div[@class="category-products"]//li[contains(@class, "item")][1]//span[contains(@class, "price")]';
		$articles = $xpath->query($query2);
		if ($articles->length) {

			$element = $articles->item(0);

			$precio = $element->nodeValue;
		}
		return array('href' => $href, "producto" => $producto, "precio" => $precio);
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
	function temp() {
		$secretKey = "sk_test_1234567";

		$url = "https://api.mywebsite.com/transaction/verify/" . $this->refcode;

		// append the header putting the secret key and hash

		$request_headers = array();
		$request_headers[] = 'Authorization: Bearer ' . $secretKey;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($ch);

		if (curl_errno($ch)) {
			print "Error: " . curl_error($ch);
		} else {
			// Show me the result

			$transaction = json_decode($data, TRUE);

			curl_close($ch);

			var_dump($transaction['data']);

		}
	}
	function load_base_fahorro() {
		$productos = array();
		$path = './get/fahorro/';
		$files = array_diff(scandir($path), array('.', '..'));

		foreach ($files as $file) {

			$file = './get/fahorro/' . $file;
			$temp = file_get_contents($file);

			$doc = new \DOMDocument();

			libxml_use_internal_errors(true);
			$doc->loadHTML($temp);
			libxml_clear_errors();

			$xpath = new \DOMXpath($doc);
			//p[@class="item-title"][1]//parent::*[1]
			//$articles = $xpath->query('//div[@class="item"]//p[contains(@class, "item-title") or contains(@class, "item-prize")]');
			$href = $producto = $precio = '-';
			$producto = '';
			/**************************************/

			$query1 = '//div[@class="category-products"]//li[contains(@class, "item")]';

			$articles1 = $xpath->query($query1);

			foreach ($articles1 as $key => $value) {

				$element = $articles1->item($key);

				$node = $xpath->query('.//h2[contains(@class, "product-name")]/a', $element);
				$link = $node->item(0);

				//echo "->" . $link . '<-';
				$href = trim($link->getAttribute("href"));

				$producto = trim($link->nodeValue);

				$node = $xpath->query('.//span[contains(@class, "price")]', $element);
				$link = $node->item(0);
				$precio = trim($link->nodeValue);

				$productos[] = array("url" => $href, 'producto' => $producto, "precio" => $precio);
			}
		}

		foreach ($productos as $k => $v) {

			$total = $this->db->where("producto", $v['producto'])->get("ce_base_fahorro")->num_rows();

			if ($total <= 0) {

				$this->db->insert('ce_base_fahorro', $v);
			}
		}
		echo "<pre>";
		print_r($productos);

		echo "</pre>";
	}

	function load_base_farmatodo() {

		$productos = array();
		$path = './get/farmatodo/';
		$domain = 'https://www.farmatodo.com.mx';
		$tabla = 'ce_base_farmatodo';
		$files = array_diff(scandir($path), array('.', '..'));

		foreach ($files as $file) {

			list($pre, $categoria, $index) = explode("-", $file);

			$file = $path . $file;

			$temp = file_get_contents($file);

			$doc = new \DOMDocument();

			libxml_use_internal_errors(true);
			if (!empty($temp)) {
				$doc->loadHTML($temp);
			}

			libxml_clear_errors();

			$xpath = new \DOMXpath($doc);
			//p[@class="item-title"][1]//parent::*[1]
			//$articles = $xpath->query('//div[@class="item"]//p[contains(@class, "item-title") or contains(@class, "item-prize")]');
			$href = $producto = $precio = '-';
			$producto = '';
			/**************************************/

			$query1 = '//div[contains(@class, "productmain")]';

			$articles1 = $xpath->query($query1);

			foreach ($articles1 as $key => $value) {

				$href = $producto = $precio = '-';
				$producto = '';

				$element = $articles1->item($key);

				$node = $xpath->query('.//strong//a', $element);
				if ($node->length > 0) {
					$link = $node->item(0);

					//echo "->" . $link . '<-';
					$href = trim($link->getAttribute("href"));

					$producto = trim($link->nodeValue);
				}
				$node = $xpath->query('.//div[@class="col-md-4"]/p', $element);
				if ($node->length > 0) {
					$link = $node->item(0);
					$precio = trim($link->nodeValue);
					preg_match_all('/[$]\d+[\d,.]*\s*/', $precio, $precios);
					$precio = $precios[0][0];

				}

				if (!empty($producto) && !empty($precio)) {

					$productos[] = array("categoria_id" => $categoria, "url" => $domain . $href, 'producto' => $producto, "precio" => $precio);
				}

			}
		}

		/* guardando en la base de datos*/
		foreach ($productos as $k => $v) {

			$total = $this->db->where("producto", $v['producto'])->get($tabla)->num_rows();

			if ($total <= 0) {

				$this->db->insert($tabla, $v);
			}
		}

	}
	function load_base_superama() {
		$productos = array();
		$path = './get/superama/';
		$domain = 'https://www.superama.com.mx';
		$files = array_diff(scandir($path), array('.', '..'));

		foreach ($files as $file) {

			list($pre, $categoria, $index) = explode("----", $file);

			$file = $path . $file;

			$temp = file_get_contents($file);

			$rows = json_decode($temp, true);

			if (count($rows['Products']) > 0) {

				foreach ($rows['Products'] as $key => $value) {
					$precio = $value['Precio'];
					$producto = trim($value['LargeDescription']);
					if (empty($producto)) {
						$producto = $value["Description"];
					}

					/*
						{{rutaBase}}catalogo/{{producto.SeoDepartamentoUrlName}}/{{producto.SeoFamiliaUrlName}}/{{producto.SeoLineaUrlName}}/{{producto.SeoProductUrlName}}/{{producto.Upc}}
					*/
					$url = $domain . "/catalogo/" . $value['SeoDepartamentoUrlName'];
					$url .= "/" . $value['SeoFamiliaUrlName'];
					$url .= "/" . $value['SeoLineaUrlName'];
					$url .= "/" . $value['SeoProductUrlName'];
					$url .= "/" . $value['Upc'];

					$productos[] = array("categoria_id" => $categoria, "url" => $url, 'producto' => $producto, "precio" => $precio);
				}
			}

			/*
				$productos[] = array("categoria_id" => $categoria, "url" => $domain . $href, 'producto' => $producto, "precio" => $precio);
			*/

		}

		/* guardando en la base de datos*/
		$tabla = 'ce_base_superama';
		foreach ($productos as $k => $v) {

			$total = $this->db->where("producto", $v['producto'])->get($tabla)->num_rows();

			if ($total <= 0) {

				$this->db->insert($tabla, $v);
			}
		}

	}
	function load_base_sanpablo() {
		$productos = array();
		$path = './get/sanpablo/';
		$files = array_diff(scandir($path), array('.', '..'));

		foreach ($files as $file) {

			list($pre, $categoria, $index) = explode("-", $file);

			$file = $path . $file;
			$temp = file_get_contents($file);

			$doc = new \DOMDocument();

			libxml_use_internal_errors(true);
			$doc->loadHTML($temp);
			libxml_clear_errors();

			$xpath = new \DOMXpath($doc);
			//p[@class="item-title"][1]//parent::*[1]
			//$articles = $xpath->query('//div[@class="item"]//p[contains(@class, "item-title") or contains(@class, "item-prize")]');
			$href = $producto = $precio = '-';
			$producto = '';
			/**************************************/

			$query1 = '//div[contains(@class, "product-listing")]//div[contains(@class, "item")]';

			$articles1 = $xpath->query($query1);

			foreach ($articles1 as $key => $value) {

				$element = $articles1->item($key);

				$node = $xpath->query('.//p[@class="item-title"]/ancestor-or-self::a', $element);
				$link = $node->item(0);

				//echo "->" . $link . '<-';
				$href = trim($link->getAttribute("href"));

				$producto = trim($link->nodeValue);

				$node = $xpath->query('.//p[@class="item-prize"]', $element);
				$link = $node->item(0);
				$precio = trim($link->nodeValue);

				$productos[] = array("categoria_id" => $categoria, "url" => "https://www.farmaciasanpablo.com.mx" . $href, 'producto' => $producto, "precio" => $precio);
			}
		}

		foreach ($productos as $k => $v) {

			$total = $this->db->where("producto", $v['producto'])->get("ce_base_sanpablo")->num_rows();

			if ($total <= 0) {

				$this->db->insert('ce_base_sanpablo', $v);
			}
		}
		echo "<pre>";
		print_r($productos);

		echo "</pre>";
	}
	function load_base_lacomer() {

		$productos = array();
		$path = './get/lacomer/';
		$domain = 'https://www.lacomer.com.mx';
		$files = array_diff(scandir($path), array('.', '..'));

		foreach ($files as $file) {

			list($pre, $categoria, $index) = explode("----", $file);

			$file = $path . $file;

			$temp = file_get_contents($file);

			$rows = json_decode($temp, true);

			if (count($rows['res']) > 0) {

				foreach ($rows['res'] as $key => $value) {
					$precio = $value['artPrven'];
					$producto = trim($value['artDes']);
					$producto .= '|' . $value['marDes'] . '|' . $value['artPres'] . '|' . $value['artUco'] . $value['artTun'];
					if (empty($producto)) {
						$producto = $value["artDes"];
					}

					/*
						{{rutaBase}}catalogo/{{producto.SeoDepartamentoUrlName}}/{{producto.SeoFamiliaUrlName}}/{{producto.SeoLineaUrlName}}/{{producto.SeoProductUrlName}}/{{producto.Upc}}
					*/
					/*

						https://www.lacomer.com.mx/lacomer/doHome.action?succId=14&artEan=7501092793045&ver=detallearticulo&opcion=detarticulo&padreId=2&&pasId=1&succFmt=100

					*/
					$url = $domain . "/lacomer/doHome.action?succId=14&artEan={ean}&ver=detallearticulo&opcion=detarticulo&padreId={padre}&&pasId=1&succFmt=100";
					$ean = $value['artEan'];
					$padre = $value['agruIdPadre'];

					$url = str_replace("{ean}", $ean, $url);
					$url = str_replace("{padre}", $padre, $url);

					$url_2 = "https://www.lacomer.com.mx/GSAServicesDos/searchArtPrior?col=lacomer_2&npagel=20&p=1&pasilloId=false&s=$ean&succId=14";
					$productos[] = array("categoria_id" => $categoria, "url" => $url, 'producto' => $producto, "precio" => $precio, "url_2" => $url_2);
				}
			}

			/*
				$productos[] = array("categoria_id" => $categoria, "url" => $domain . $href, 'producto' => $producto, "precio" => $precio);
			*/

		}

		/* guardando en la base de datos*/
		$tabla = 'ce_base_lacomer';
		foreach ($productos as $k => $v) {

			$total = $this->db->where("producto", $v['producto'])->get($tabla)->num_rows();

			if ($total <= 0) {

				$this->db->insert($tabla, $v);
			}
		}

	}
	function ajax_agregar_link() {
		$ins2['proyectos_id'] = $proyectos_id = $this->input->post("proyectos_id");
		$ins['nombre'] = $this->input->post("nombre");
		$ins['codigo'] = $codigo = $this->input->post("codigo");
		$ins2[_site(1) . '_id'] = $site_1_id = $this->input->post(_site(1, '', '_id'));
		$ins2[_site(2) . '_id'] = $site_2_id = $this->input->post(_site(2, '', '_id'));
		$ins2[_site(3) . '_id'] = $site_3_id = $this->input->post(_site(3, '', '_id'));
		$ins2[_site(4) . '_id'] = $site_4_id = $this->input->post(_site(4, '', '_id'));
		$ins2[_site(5) . '_id'] = $site_5_id = $this->input->post(_site(5, '', '_id'));

		$temp = array();
		$ins = array_merge($ins, $ins2);
		$temp = $this->_get_info_producto($site_1_id, 1);
		$ins = array_merge($ins, $temp);
		$temp = $this->_get_info_producto($site_2_id, 2);
		$ins = array_merge($ins, $temp);
		$temp = $this->_get_info_producto($site_3_id, 3);
		$ins = array_merge($ins, $temp);
		$temp = $this->_get_info_producto($site_4_id, 4);
		$ins = array_merge($ins, $temp);
		$temp = $this->_get_info_producto($site_5_id, 5);
		$ins = array_merge($ins, $temp);

		$num_rows = $this->db->where('codigo', $codigo)
			->where('proyectos_id', $proyectos_id)->get("ce_links")->num_rows();

		if ($num_rows > 0) {
			_json_error("Existe un producto en el proyecto con el mismo código.");
		}

		$num_rows = $this->db->where($ins2)->get("ce_links")->num_rows();

		if ($num_rows > 0) {
			_json_error("Existe un producto con la misma configuracion.");
		} else {
			//print_r($ins);
			$this->db->insert("ce_links", $ins);
		}

		_json_ok("Se agrego un nuevo producto a la tabla.");
	}

	function _get_info_producto($id, $site_id) {
		$row = $this->db->where('id', $id)->get("ce_" . _site($site_id))->row_array();
		$data['site' . $site_id . '_nombre'] = $row['producto'];
		$data['site' . $site_id . '_url'] = $row['url'];
		$data['site' . $site_id . '_precio'] = $row['precio'];

		return $data;
	}
	function ajax_form_agregar_link($proyectos_id) {
		$data['proyectos_id'] = $proyectos_id;
		$this->load->view("links/ajax_form_agregar_link", $data);
	}

	function ajax_delete($links_id) {
		$this->db->where("id", $links_id)->limit(1)->delete("ce_links");

		_json_ok("Se quito correctamente el link.");

	}
}
