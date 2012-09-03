<?php
header ('Content-type: text/html; charset=utf-8');
function obj2array($obj) {
		$out = array();
		foreach ($obj as $key => $val) {
			switch(true) {
				case is_object($val):
					$out[$key] = obj2array($val);
				break;
				case is_array($val):
					$out[$key] = obj2array($val);
				break;
				default:
					$out[$key] = $val;
			}
  		}
  	return $out;
}

$id_cliente = 'IDC';

try {  
	echo "Prueba<br/>";
	
	$servicio="http://10.177.73.45/TNDWebSvc/Service.asmx?WSDL"; //url del servicio
	$parametros=array(); //parametros de la llamada
	$parametros['descriptionOc'] = $id_cliente;
	$client = new SoapClient($servicio, $parametros);
	$result = $client->getOcThink ($parametros);//llamamos al métdo que nos interesa con los parámetro
	
	

$noticias=$result;
$n=count($noticias);
 
//procesamos el resultado como con cualquier otro array
for($i=0; $i<$n; $i++){
    $noticia=$noticias[$i];
    $id=$noticia[‘id’];
    //aquí iría el resto de tu código donde procesas los datos recibidos
}
		

	
	
	
	//$simple_result = $obj_result->getOcThinkResult ;		//regresa un solo objeto AMEX
	
	//		//es un objeto;
	//if ($simple_result->id_clienteIn != 0)
		//echo '<br/>apellido M: <br/>'.$simple_result->apellido_materno;
	
} catch (SoapFault $exception) {
	echo $exception;  
	echo '<br/>error: <br/>'.$exception->getMessage();
	//exit();
}
?>