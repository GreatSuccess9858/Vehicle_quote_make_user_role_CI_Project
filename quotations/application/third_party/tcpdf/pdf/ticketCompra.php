<?php

require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";

require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;


public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA COMPRA

$itemCompra = "codigo";
$valorCompra = $this->codigo;

$respuestaCompra = ControladorCompras::ctrMostrarCompras($itemCompra, $valorCompra);

date_default_timezone_set('America/Mexico_city');

$fecha = substr($respuestaCompra["fecha"],0,-8);
$horaactual= date("H:i:s");
$productos = json_decode($respuestaCompra["productos"], true);
$neto = number_format($respuestaCompra["neto"],2);
$impuesto = number_format($respuestaCompra["impuesto"],2);
$total = number_format($respuestaCompra["total"],2);

//TRAEMOS LA INFORMACIÓN DEL PROVEEDOR

$itemProveedor = "id";
$valorProveedor = $respuestaCompra["id_proveedor"];
$respuestaProveedor = ControladorProveedores::ctrMostrarProveedores($itemProveedor, $valorProveedor);

//TRAEMOS LA INFORMACIÓN DEL USUARIO

$itemProveedor = "id";
$valorProveedor = $respuestaCompra["id_usuario"];

$respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemProveedor, $valorProveedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage('P','A6');

// ---------------------------------------------------------

$bloque1 = <<<EOF

<table>
		
<tr>			
	<td  style="text-align: center;"><img src="images/logohelado.png" height="50px" ></td>
</tr>

<tr>

	<td style="font-size:8px;background-color:white; width:250px; color:black;text-align:center">
	<br><br>TICKET N.$valorCompra
	<br>
	Distribuidora Donofrio D'Luisa
			<br>
			Dirección: Jiron Camilo Dongo Dongo N°225 - Ate
			<br>
			Teléfono: 926 574 774 
			<br>
			distribuidora.d.luisa@gmail.com 
			<br>
			Fecha: $fecha
			<br>
			Hora: $horaactual
			<br>
			Proveedor: $respuestaProveedor[nombre]
			<br>
			Usuario: $respuestaUsuario[nombre]

	</td>
	
	

</tr>

</table>



EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

<table style="font-size:8px; padding:5px 10px;">
	<tr>
		<td style="border-bottom: 1px solid #666; background-color:white; width:240px"></td>
	</tr>
</table>


EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">

		<tr>
		
		<td style="background-color:white; width:55px; text-align:center">Producto</td>
		<td style="background-color:white; width:90px; text-align:center">Cantidad</td>
		<td style="background-color:white; width:60px; text-align:center">Valor</td>
		<td style="background-color:white; width:60px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($respuestaProducto["precio_compra"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:8px; padding:0px;">

		<tr>
			
			<td style=" color:#333; background-color:white; width:80px; text-align:left">
				$item[descripcion]
			</td>

			<td style="color:#333; background-color:white; width:60px; text-align:center">
				$item[cantidad]
			</td>

			<td style="color:#333; background-color:white; width:60px; text-align:center">S/
				$valorUnitario
			</td>

			<td style="color:#333; background-color:white; width:60px; text-align:center">S/
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:8px;font-weight: bold;">
	

	<hr>
	<br>
	
		<tr>		
			<td style="background-color:white;text-align:rigth;width:155px">
				Total Neto:
			</td>

			<td style="color:#333; background-color:white;text-align:rigth;width:100px">
				S/ $neto
			</td>

		</tr>

		<tr>
			
			<td style="background-color:white;text-align:rigth">
				Impuesto:
			</td>
		
			<td style="color:#333; background-color:white;text-align:rigth">
			S/$impuesto
			</td>

		</tr>

		<tr>
		
		
			<td style="background-color:white;text-align:rigth">
				Total:
			</td>
			
			<td style="color:#333; background-color:white;text-align:rigth">
				S/ $total
			</td>

		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('ticket.pdf', 'I');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>