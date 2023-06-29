<?php error_reporting(E_ALL);
ini_set('display_errors', 1);?>
<?php _helper_tcpdf();
$path = $this->config->item('cotizaciones_path');
class MYPDF extends TCPDF {

	//Page header

	var $htmlHeader;
	var $cotizacion_id;
	var $pdf_header_1;
	var $pdf_header_2;
	var $pdf_header_3;
	var $pdf_header_4;
	var $pdf_footer;
	var $logo;
	var $path;

	public function setHtmlHeader($htmlHeader) {
		$this->htmlHeader = $htmlHeader;
	}
	public function setCotizacionId($cotizacion_id) {
		$this->cotizacion_id = $cotizacion_id;
	}
/*
public function Header() {
$this->SetFont('times', 'I', 8);
$this->writeHTMLCell(
"100%", 30, 15, 15,
$this->htmlHeader, 1, 1, 0,
true, 'top', true);
}*/

	public function setInfo($path, $logo = '', $pdf_header_1 = 'line1', $pdf_header_2 = 'line2', $pdf_header_3 = 'line3', $pdf_header_4 = 'line4', $pdf_footer = 'footer') {
		$this->pdf_header_1 = $pdf_header_1;
		$this->pdf_header_2 = $pdf_header_2;
		$this->pdf_header_3 = $pdf_header_3;
		$this->pdf_header_4 = $pdf_header_4;

		$this->pdf_footer = $pdf_footer;
		$this->path = $path;
		$this->logo = $logo;
	}

	public function Header() {
		// Logo

		// Set font
		$this->SetFont('times', 'B', 20);
		// Title
		$y = 10;
		$this->SetXY(15, $y);
		$this->Cell(0, 30, $this->pdf_header_1, 0, false, 'R', 0, '', 0, false, 'M', 'M');

		if (isset($this->pdf_header_2) && !empty($this->pdf_header_2)) {
			$this->SetXY(15, $y + 7);
			$this->SetFont('times', 'B', 10);
			$this->Cell(0, 30, $this->pdf_header_2, 0, false, 'R', 0, '', 0, false, 'M', 'M');
		}

		if (isset($this->pdf_header_3) && !empty($this->pdf_header_3)) {
			$this->SetXY(15, $y + 7 * 2);
			$this->Cell(0, 15, $this->pdf_header_3, 0, false, 'R', 0, '', 0, false, 'M', 'M');
		}

		if (isset($this->pdf_header_4) && !empty($this->pdf_header_4)) {

			$this->SetXY(15, $y + 7 * 3);
			$this->Cell(0, 15, $this->pdf_header_4, 0, false, 'R', 0, '', 0, false, 'M', 'M');

		}

		$this->SetFillColor(255, 255, 128);
		$this->writeHTMLCell(
			0, 0, 150, 35,
			"<span class='numero' style='background-color: #d8d8d8;
	color:#fff;
	font-size: 18px;'>Cotizacion #" . $this->cotizacion_id . "</span>", 1, 1, true,
			true, 'R', true);

		$image_file = ($this->path . "../uploads/pdf_logos/" . $this->logo);

/*
$image_file = base_url($this->path . "../uploads/pdf_logos/" . $this->logo);

$this->writeHTMLCell(
0, 0, 150, 35,
$image_file . "TEST <img alt='kkk' src='" . $image_file . "'>", 1, 1, true,
true, 'L', true);
//$this->Image($image_file, 10, 10, 180, 50, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

 */
		$this->Image($image_file, 10, 10, 40, '', 'PNG', '', 'T', true, 250, '', false, false, 0, false, false, false);

	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-18);
		// Set font
		$this->SetFont('times', 'I', 8);
		// Page number/*
		//$this->Cell(0, 10, "<p> <b>hola</b> </p>", 0, false, 'C', 0, '', 0, false, 'T', 'M');
		/*
		Los términos y condiciones de esta cotización tienen valides por 30 días.  Los precios son con entrega en la Ciudad de Panamá y para el interior de la República se hace un cargo adicional de transporte.  Incluye la preparación de los artes, pero no la creación de logos, diseño gráfico entre otros. Algunos productos existen en cantidades limitadas y se garantiza la existencia solo después de revisado el inventario, firmada la orden de compra o factura y el pago respectivo.  Los tiempos de entrega son basados en días laborales (lunes a viernes) a partir de la aprobación de artes y pago del abono inicial.   El cliente suministrará los diseños o logos en formato de diseño adobe illustrator y jpeg. Cheques dirigidos a CAPSA PANAMA, S.A. Depositos ACH a BANCO GENERAL, S.A , cuenta corriente  No.03-06-01-115998-4 , CAPSA PANAMA, S.A.
		*/
		$text = "<p style='width:100%;'>" . $this->pdf_footer . "</p>";
		$this->SetFont('times', 'I', 7);
		$this->writeHTMLCell(
			0, 260, '', '',
			$text, 0, 1, 0,
			true, 'top', true);

	}
}

//$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$obj_pdf->SetCreator(PDF_CREATOR);
$title = "PDF Report";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('times');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(5);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP  , PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, 23);
$obj_pdf->SetFont('times', '', 6);
//$obj_pdf->SetFont('dejavusans', '', 10);
$obj_pdf->setCotizacionId($cotizacion_id);

 

$obj_pdf->setInfo($path, '--', "aaa", "", "", "", "");

//$_header = $this->load->view('cotizacion/pdf_header', array(), true);
//$obj_pdf->setHtmlHeader($_header);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$obj_pdf->AddPage();
$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => true,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => false,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0, 0, 0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'times',
	'fontsize' => 8,
	'stretchtext' => 2,
);
//$style['bgcolor'] = array(255,255,240);
//$style['fgcolor'] = array(127,0,0);

// Left position
$style['position'] = 'L';
//5234299004385020180415120002018043013000338213862
//$obj_pdf->write1DBarcode('5234299004382018080120180901502018081535000201808304000049488320', 'C128C', '', '', '', 15, 0.4, $style, 'N');
//$obj_pdf->write1DBarcode('52342990043850201804151200020180430130003382138620', 'C128C', '', '', '',20, 0.4, $style, 'N');

//$obj_pdf->Ln(2);
$path = $this->config->item('cotizaciones_path');
ob_start();

?>
<html>
	<head>
		<?php $css = file_get_contents(base_url("styles/pdf.css"));?>
		<style>

		<?PHP echo $css; ?>

		.page {
    background: url(<?php  echo base_url('styles/bg/background3.jpg'); ?>) no-repeat 0 0;
    background-image-resize: 6;
}


		.Estilo1 {font-size: 12px}
		.Estilo2 {font-size: 12px; color: #FFFFFF; }
		.Estilo3 {font-size: 12px}
		.Estilo5 {color: #FFFFFF; font-size: 16px; }
        .Estilo7 {color: #FFFFFF; font-weight: bold; }
        .Estilo8 {color: #FFFFFF; font-size: 16px; font-weight: bold; }
        .Estilo9 {font-size: 10px}
        </style>
	</head>
	<body>
		 <header>


		 </header>
		  <footer><p class="Estilo9">
</p>
		  </footer>
		<main>
			<div class="fila">
				 <div class="page">
				 	<strong>CDMX a <?php  echo date("d") ?> de <?php 
				 	 echo _mes(date('m')); ?> de <?PHP echo date('Y');  ?>		<br />
At'n <?php  echo _info('nombre',$cotizacion_info); ?> / <?php  echo _info('empresa',$cotizacion_info); ?><br />
Tel. <?php  echo _info('telefono',$cotizacion_info); ?> </strong><br />


				 	<p>Por medio de la presente me permito distraer su amable atención con el objeto de enviar el presupuesto que amablemente nos solicitó
				 	</p>
				 	<table id="detalles">
				 		<tr><td>Tipo de Unidad:</td>  <td>Lowboy</td></tr>
				 		<tr><td>Origen</td>  <td><?php  echo _info('origen',$cotizacion_info); ?></td></tr>
				 		<tr><td>Destino</td>  <td><?php  echo _info('destino',$cotizacion_info); ?></td></tr>
				 		<tr><td>Descripción de la Carga</td>  <td><?php  echo _info('descripcion',$cotizacion_info); ?></td></tr>
				 		<tr><td>Peso por Embarque</td>  <td><?php  echo _info('peso_embarque',$cotizacion_info); ?> tns</td></tr>
				 		<tr><td>Importe del Servicio</td>  <td>$<?php  echo _info('importe',$cotizacion_info); ?></td></tr>
				 		<tr><td>Maniobras Liquidación 100% Anticipado</td>  <td>$<?php  echo _info('maniobras_importe',$cotizacion_info); ?></td></tr>

				 		<tr><td>Fecha del Servicio</td>  <td><?php _fecha(_info('fecha_a',$cotizacion_info)); ?></td></tr>
				 		<tr><td>Valor Declarado por Cliente</td>  <td>$<?php  echo _info('valor_declarado',$cotizacion_info); ?>0</td></tr>
				 		<tr><td>Kilómetros</td>  <td><?php  echo _info('kilometros',$cotizacion_info); ?></td></tr>
				 		<tr><td>Gestoría de Prima de Seguro Liquidación 100% Anticipada</td>  <td>
				 			Porcentaje de Prima: <?php  echo _info('prima',$cotizacion_info); ?>% Monto % de Prima: $<?php  echo _info('valor_declarado',$cotizacion_info)*_info('prima',$cotizacion_info)/100; ?>
				 		</td></tr>

				 		<tr>
				 			<td>Disposición Inmediata Total</td>
				 			<td>$NUMERO MXN Mas IVA</td>

				 		</tr>
				 	</table>

				 	 <table>
				 	 	<tr>
				 	 		<td>IMAGEN</td>
				 	 		<td> IMGEN CON INFO DE CUENTAS</td>
				 	 	</tr>
				 	 </table>
<p>Este servicio incluye: Servicio de flete con Operador, Recolecci&oacute;n y Entrega. Se incluye Maniobras de carga y descarga.<br />
  <br />
  <span class="Estilo1"> Seguro: Esta cotizaci&oacute;n no incluye seguro de la mercanc&iacute;a si lo requiere ser&iacute;a. El 1% sobre el valor declarado de su Mercanc&iacute;a m&aacute;s I.V.A. S&iacute;<br />
  la mercanc&iacute;a alcanza a tener un valor de m&aacute;s de un Mill&oacute;n de Pesos M.N., se le manejar&iacute;a costo preferencial del porcentaje antes<br />
mencionado.</span></p>
<p>Confirmaci&oacute;n de servicio con 24 Horas de anticipaci&oacute;n de preferencia; o bien si requiere FLETE URGENTE contamos con disposici&oacute;n inmediata. Los 
  tiempos de entrega est&aacute;n sujetos a imprevistos fuera de nuestro alcance como lo puede ser: Retenes Federales, Condiciones Climatol&oacute;gicas o 
  imprevistos de &uacute;ltimo momento.<br />
  <br />  
  <strong>Condiciones de Pago:<br />
  1) 100% Anticipado en servicios locales, en productos perecederos o productos peligrosos.<br />
  2) 50% Anticipo y 50% antes de la descarga, en carga general.<br />
  3) Se recomienda al cliente que se trancite de d&iacute;a en servicios que viajen hacia el sureste. cuando la carga rebase los $ 500,000.00 pesos, es 
  importante que se considere custodia adicional al servicio y al seguro de carga (no obligatorio).</strong><br />
  <br />
  <strong>Forma de Pago: Transferencia Electr&oacute;nica Interbancaria o Dep&oacute;sito en Firme en nuestra cuenta Bancomer.<br />
&ldquo;En caso de vernos favorecidos con su preferencia solicitamos su Orden de Compra y Carta de instrucciones, Direcci&oacute;n de Carga, 
Direcci&oacute;n de Descarga con Contacto y Tel&eacute;fono, indicarnos tambi&eacute;n la hora exacta de Carga, as&iacute; como Datos Fiscales y RFC para elaborar 
factura electr&oacute;nica.&ldquo;</strong><br />
<br /> 
Una vez confirmado el dep&oacute;sito correspondiente al pago del servicio, podemos dar salida a la unidad para presentarnos en tiempo y forma como 
ustedes lo solicitaron. Sin m&aacute;s por el momento, agradecemos su preferencia, quedo al pendiente de sus comentarios. Reiter&aacute;ndole las m&aacute;s atenta y 
distinguida consideraci&oacute;n.<br />
<strong><br />
Toda cancelaci&oacute;n causara honorarios del 40% sobre el monto total de la negociaci&oacute;n mas el I.V.A.</strong><br />
<br />
Favor de enviar su comprobante de pago o anticipo en tiempo y forma a los siguientes correos que aparecen al calce 
</p>
				 </div>


				 <div class="page">
				 	<h4>CARTA RESPONSIVA DE EMBARQUE SIN SEGURO</h4>

				 	<p align="right"><strong>CD. DE MEXICO, 17/06/2019</strong></p>
<p><br />
  <strong>ATENCI&Oacute;N:</strong><br />
  <strong>O.F. FLETES Y LOGISTICA DE MEXICO, S.A. DE C.V.</strong></p>
<p>  POR MEDIO DE LA PRESENTE CARTA RESPONSIVA, DOY LA AUTORIZACI&Oacute;N PARA QUE LA CARGA TRANSPORTADA A<br />
  CONTINUACI&Oacute;N DESCRITA, VIAJE SIN SEGURO MANIFESTANDO QUE CONOZCO LOS RIESGOS QUE DICHA ACCI&Oacute;N<br />
PUDIESE DERIVAR, Y CONOCIENDO LOS RIESGOS QUE ESTO PUDIERA IMPLICAR DURANTE EL TRAYECTO DEL<br />
EMBARQUE DEL ORIGEN AL DESTINO.</p>
<p>  AS&Iacute; MISMO, LIBERO DE TODA RESPONSABILIDAD A O.F. FLETES Y LOG&Iacute;STICA DE M&Eacute;XICO, S.A. DE C.V.. EN CUANTO A<br />
PROBLEMAS LEGALES QUE PUDIERA OCASIONAR LA OMISI&Oacute;N DEL ASEGURAMIENTO DE LA CARGA.</p>
<p>  SIN M&Aacute;S POR EL MOMENTO, ME PONGO A SU DISPOSICI&Oacute;N PARA CUALQUIER ACLARACI&Oacute;N.</p>
<p>  NOMBRE DEL CLIENTE: walter<br />
  DOMICILIO: desconocido 5<br />
  TEL&Eacute;FONO: 5510483965<br />
  CORREO: merca.tech@gmail.com<br />
  DESCRIPCI&Oacute;N DEL EMBARQUE: Exceso de dimensiones<br />
  VALOR DECLARADO DE LA CARGA: $900,000.00 MXN<br />
  FECHA DE SALIDA: lunes, 17 de junio de 2019<br />
  FECHA ESTIMADA DE LLEGADA: lunes, 17 de junio de 2019<br />
  CLAVE INE: NA<br />
  ANEXAR COPIA DE IDENTIFICACI&Oacute;N DE QUIEN AUTORIZA.<br />
  DECLARO BAJO PROTESTA DE DECIR VERDAD, QUE LOS DATOS ANTES REFERIDOS EN ESTA CARTA SON LOS<br />
  CORRECTOS, LOS CUALES FUERON PROPORCIONADOS POR EL SUSCRITO. <br />
</p>


 <table id="acepto">
 	<tr><td>ACEPTO LA RESPONSABILIDAD</td>
 	<td>
 		FIRMA DE ENTERADO
 	</td></tr>

 	<tr>
 		<td>______________</td>
 		<td>______________</td>
 	</tr>
 	<tr>
 		<td>Nombre Cliente</td>
 		<td>Nombre Compañia</td>
 	</tr>
 </table>
				 </div>


				 <div class="page">
				 	

<p align="center"><strong>CONDICIONES DEL CONTRATO DE TRANSPORTE QUE AMPARA ESTA CARTA PORTE</strong></p>
<p>  
  <strong>PRIMERA.-</strong> Para los efectos del presente contrato de transporte se denomina &quot;Porteador&quot; al transportista y &quot;Remitente&quot;  
  al usuario que contrate el servicio.</p>
<p>  <strong>SEGUNDA.- </strong>El &ldquo;Remitente&rdquo; es responsable de que la informaci&oacute;n proporcionada al &ldquo;Porteador&rdquo; sea veraz y que la 
documentaci&oacute;n que entregue para efectos del transporte sea la correcta.</p>
<p><strong>TERCERA.-</strong> El &ldquo;Remitente&rdquo; debe declarar al &ldquo;Porteador&rdquo; el tipo de mercanc&iacute;a o efecto de que se trate, peso, medidas  
  y/o n&uacute;mero de la carga que se entrega para su transporte y en su caso el valor de la misma. La carga que se entregue a  
  granel ser&aacute; pesada por el &ldquo;Porteador&rdquo; en el primer punto donde haya b&aacute;scula apropiada o, en su defecto, aforada en  
metros c&uacute;bicos con la conformidad del remitente.</p>
<p><strong>CUARTA.-</strong> Para efectos del transporte, el &ldquo;Remitente&rdquo; deber&aacute; entrega al &ldquo;Porteador&rdquo; los documentos que las leyes y  
  reglamentos exijan para llevar a cabo el servicio, en caso de no cumplirse con estos requisitos el &ldquo;Porteador&rdquo; est&aacute;  
obligado a rehusar el transporte de las mercanc&iacute;as.</p>
<p><strong>QUINTA.-</strong> Si por sospecha de falsedad en la declaraci&oacute;n del contenido de un bulto el &ldquo;porteador&rdquo; deseare proceder a su  
  reconocimiento, podr&aacute; hacerlo ante testigos y con una asistencia del &ldquo;Remitente&rdquo; o del consignatario. Si este &uacute;ltimo no  
  concurriere, se solicitar&aacute; la presencia de un inspector de la secretaria de comunicaciones y transportes, y se levantar&aacute; el  
  acta correspondiente. El &ldquo;Porteador&rdquo; tendr&aacute; en todo caso la obligaci&oacute;n de dejar los bultos en el estado en que se  
encontraban antes del reconocimiento.</p>
<p><strong>SEXTA.-</strong> El &ldquo;Porteador&rdquo; deber&aacute; recoger y entregar la carga precisamente en los domicilios que se&ntilde;ale el &ldquo;Remitente&rdquo;  
  ajust&aacute;ndose a los t&eacute;rminos y condiciones convenidos. El &ldquo;Porteador&rdquo; s&oacute;lo est&aacute; obligado a llevar la carga al domicilio del  
  consignatario para su entrega una sola vez. Si &eacute;sta no fuera recibida, se dejar&aacute; aviso de que la mercanc&iacute;a queda a  
disposici&oacute;n del interesado en las bodegas que indique el &ldquo;Porteador&rdquo;.</p>
<p><strong>SEPTIMA.-</strong> Si la carga no fuere retirada dentro de los 30 d&iacute;as siguientes a aqu&eacute;l en que hubiere sido puesta a  
  disposici&oacute;n del consignatario, el &ldquo;Porteador&rdquo; podr&aacute; solicitar la venta en p&uacute;blica subasta con arreglo en lo que dispone el  
C&oacute;digo de Comercio.</p>
<p><strong>OCTAVA.-</strong> El &ldquo;Porteador&rdquo; y el &ldquo;Remitente&rdquo; negociar&aacute;n libremente el precio del servicio, tomando en cuenta su tipo,  
caracter&iacute;sticas de los embarques, volumen, regularidad, clase de carga y sistema de pago.</p>
<p><strong>NOVENA.-</strong> Si el &ldquo;Remitente&rdquo; desea que el &ldquo;Porteador&rdquo; asuma la responsabilidad por el valor de la mercanc&iacute;a, o efectos  
  que &eacute;l declare y que cubra toda clase de riesgo, inclusive los derivados de casos fortuitos o de fuerza mayor, las partes  
  deber&aacute;n convenir un cargo adicional, equivalente al valor de la prima del seguro que se contrate, el cual se deber&aacute;  
expresar en la carta de porte.</p>
<p><strong>DECIMA.-</strong> Cuando el importe del flete no incluya el cargo adicional, la responsabilidad del &ldquo;Porteador&rdquo; queda  
  expresamente limitada a la cantidad equivalente a 15 d&iacute;as del salario m&iacute;nimo vigente en el Distrito Federal por tonelada  
  o cuando se trate de embarques cuyo peso sea mayor de 200kg. peso menor de 1000kg. y a 4 d&iacute;as del salario m&iacute;nimo  
por remesa cuando se trate de embarques con peso hasta de 200 kg.</p>
<p><strong>DECIMA PRIMERA.-</strong> El precio del transporte deber&aacute; pagarse en origen, salvo convenio entre las partes de pago en  
  destino. Cuando el transporte se hubiere concertado &ldquo;Flete por Cobrar&rdquo;, la entrega de las mercanc&iacute;as o efectos se har&aacute;  
  contra el pago del flete y el &ldquo;Porteador&rdquo; tendr&aacute; derecho a retenerlos mientras no se cubra el precio convenido. *** Para  
  poder ingresar a las instalaciones del cliente en anden o rampa, es necesario que se cubra el 100% de la factura en  
firme sin excepci&oacute;n de lo contrario se facturaran estad&iacute;as de acuerdo al tipo de unidad. ***</p>
<p><strong>DECIMO SEGUNDA.-</strong> Si al momento de la entrega resultare alg&uacute;n faltante o aver&iacute;a, el consignatario deber&aacute; hacerla  
  constar en ese acto en la carta porte y formular su reclamaci&oacute;n por escrito al &ldquo;Porteador&rdquo;, dentro de las 24 horas  
siguientes.</p>
<p><strong>DECIMO TERCERA.-</strong> El &ldquo;Porteador&rdquo; queda eximido de la obligaci&oacute;n de recibir mercanc&iacute;a o efectos para su transporte,  
  en los siguientes casos:  
  a) Cuando se trate de carga que por su naturaleza, peso, volumen, embalaje defectuoso o cualquier otra circunstancia  
  no pueda transportarse sin destruirse o sin causar otro da&ntilde;o a los dem&aacute;s art&iacute;culos o al material rodante, salvo que la  
  empresa de que se trate tenga el equipo adecuado.  
  b) Las mercanc&iacute;as cuyo transporte haya sido prohibido por disposiciones legales o reglamentarias. Cuando tales  
  disposiciones no proh&iacute;ban precisamente el transporte de determinadas mercanc&iacute;as, pero si ordenen la presentaci&oacute;n de  
  ciertos documentos para que puedan ser transportados, el &ldquo;Remitente&rdquo; estar&aacute; obligado a entregar al &ldquo;Porteador&rdquo; los  
documentos correspondientes.</p>
<p><strong>DECIMA CUARTA.-</strong> Los casos no previstos en las presentes condiciones y las quejas derivadas de su aplicaci&oacute;n se  
someter&aacute;n por la v&iacute;a administrativa a la Secretar&iacute;a de Comunicaciones y Transportes.</p>
<p><strong>DECIMA QUINTA.-</strong> No se considera como pago cheques salvo buen cobro ni transferencias (SPEI) que no hayan sido  
  abonadas en firme en nuestra cuenta de cheques o bancaria. Por tal motivo se descargara la mercanc&iacute;a hasta que no  
se cubra el monto total del servicio y estad&iacute;as si fuera el caso.</p>
<p><strong>DECIMA SEXTA.- </strong>Para efectos del seguro es importante y necesario que se cubra el 100% del seguro, antes de cargar  
dicha mercanc&iacute;a.</p>
<p><strong>DECIMA SEPTIMA.-</strong> Para poder posicionar la unidad ya sea tr&aacute;iler, torton, camioneta, lowboy o gr&uacute;as es importante  
que se deposite o se haga transferencia por lo menos con dos horas de anticipaci&oacute;n, para recolectar en tiempo y forma.</p>
<p><strong>DECIMA OCTAVA.- </strong>El transporte o transportista tendr&aacute; 48 horas para posicionar la unidad para cargar en origen sin  
  cargo para dicho transportista. Si el cliente cancela el servicio antes de esas 48 horas, ser&aacute; penalizado con el 40% del  
monto total m&aacute;s el 16% de I.V.A. sin excepci&oacute;n.</p>
<p><strong>DECIMA NOVENA.- </strong>En caso de que la carga o mercanc&iacute;a haya sido robada &ndash; sustra&iacute;da; y el seguro dictamine  
  improcedente la indemnizaci&oacute;n de dicho siniestro, la empresa transportista se limitara a pagar solo el 1% del valor  
  declarado de la mercanc&iacute;a. (Siempre y cuando la gesti&oacute;n de la prima del seguro haya sido facturada por O.F. Fletes y  
log&iacute;stica de M&eacute;xico, s.a. de c.v. y/o Transportes Sigfra, s.a. de c.v.).</p>
<p><strong>VIG&Eacute;SIMA PRIMERA.-</strong> En caso de que el cliente no liquidara el 50% restante al momento de que la unidad &oacute; unidades,  
  hayan llegado a su destino final. Se le facturar&aacute;n estad&iacute;as a raz&oacute;n de: Camioneta $ 3,500.00 m&aacute;s I.V.A., Torton o Rab&oacute;n  
  $ 5,500.00 m&aacute;s I.V.A., Tr&aacute;iler $ 7,500.00 m&aacute;s I.V.A., y Lowboy a raz&oacute;n de $ 12,500.00 m&aacute;s I.V.A. Todos estos costos  
  son por d&iacute;a sin excepci&oacute;n.   
</p>

<div align="center"><strong>Visite nuestras paginas solo d&eacute; clik en cualquiera de los links</strong><br />
  <br />
    <strong>www.fletesenleon.com<br />
  www.fletesenmexico.mx<br />
  www.fletesylogistica.com.mx<br />
  www.fletesdemexico.com.mx<br />
  www.transportes-urgentes.com<br />
  www.fletesrefrigerados.com.mx </strong><br />
</div>


				 </div>
			</div>
		</main>
		</body>
		</html>
		<div>
		</div>
		<?php
  $content = ob_get_contents();
 
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, true);
//   $pdf->writeHTML($html, true, false, true, true);
if ($save === false) {
	$obj_pdf->Output('output.pdf', 'I');
} else {
	$nombre = _helper_cotizacion_name($cotizacion_id);
	//$path = 'G:\wamp20162\www\freelancer\CAPSA/cotizaciones/';

	$file = $path . $nombre;
	$obj_pdf->Output($file, 'F');
}
