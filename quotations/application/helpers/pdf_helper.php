<?PHP
function _helper_tcpdf() {
	// require_once('tcpdf/config/lang/eng.php');
	// require_once('tcpdf/tcpdf.php');
	//require_once('tcpdf_include.php');

	require_once 'assets/TCPDF-master/tcpdf.php';
}

function __numero($numero) {
	$numero = preg_replace("/([^0-9\\.])/i", "", $numero);
	return number_format($numero, 2, ',', '.');
}

function _fecha_literal($fecha){
	$time=strtotime($fecha);

	$Y=date('Y',$time);
	$m=date('m',$time);
	$d=date('d',$time);
	$w=date('w',$time);
	$dia='';
switch ($w){ 
    case 0: $dia= "Domingo"; break; 
    case 1: $dia= "Lunes"; break; 
    case 2: $dia= "Martes"; break; 
    case 3: $dia= "Miercoles"; break; 
    case 4: $dia= "Jueves"; break; 
    case 5: $dia= "Viernes"; break; 
    case 6: $dia= "Sabado"; break; 
} 

switch ($m){ 
     
    case 1: $mes= "Enero"; break; 
    case 2: $mes= "Febrero"; break; 
    case 3: $mes= "Marzo"; break; 
    case 4: $mes= "Abril"; break; 
    case 5: $mes= "Mayo"; break; 
    case 6: $mes= "Junio"; break; 

    case 7: $mes= "Julio"; break; 
    case 8: $mes= "Agosto"; break; 
    case 9: $mes= "Setiembre"; break; 
    case 10: $mes= "Octubre"; break; 
    case 11: $mes= "Noviembre"; break; 
    case 12: $mes= "Diciembre"; break; 
} 
	$fecha=$dia.','.$d.' de  '.$mes.' del '.$Y;
	 return $fecha;
}
function _fecha($fecha)
{
	 if(!empty($fecha)){
	 	 return  $fecha;
	 }else{
	 	 return '--';
	 }

}
function _mes($mes)
{
	$m[1]='Enero';
	$m[2]='Febrero';
	$m[3]='Marzo';
	$m[4]='Abril';
	$m[5]='Mayo';
	$m[6]='Junio';
	$m[7]='Julio';
	$m[8]='Agosto';
	$m[9]='Setiembre';
	$m[10]='Octubre';
	$m[11]='Noviembre';
	$m[12]='Diciembre';
	 return $m[(int)$mes];
}
