<?php
	// Objetos dinamicos para PROBAR el metodo //
	$tc_soap = new StdClass;
	$tc_soap->id_clienteIn = 1;
	$tc_soap->consecutivo_cmsSi = 1;
	$tc_soap->id_tipo_tarjeta = 3;
	$tc_soap->nombre_titular = 'Heladio';
	$tc_soap->apellidoP_titular = 'Arteaga';
	$tc_soap->apellidoM_titular = '';
	$tc_soap->numero = '4012888888881881';
	$tc_soap->mes_expiracion = 01;
	$tc_soap->anio_expiracion = 2015;
	$tc_soap->renovacion_automatica = 1;
					
	$amex_soap = null;
						
	$informacion_orden = new StdClass;
	$informacion_orden->id_clienteIn = 1;
	$informacion_orden->consecutivo_cmsSi = 0;
	$informacion_orden->id_promocionIn = 1;
	$informacion_orden->digito = '123';
	
	// Metemos todos los parametros (Objetos) necesarios a una clase dinamica llamada parametros //
	$parametros = new stdClass;
	$parametros->tc_soap = $tc_soap;
	$parametros->amex_soap = $amex_soap;
	$parametros->informacion_orden = $informacion_orden;
	
	// Hacemos un encode de los objetos para poderlos pasar por POST ...
	$param = json_encode($parametros);
	echo "Params envío:<pre>";
	print_r($parametros);
	echo "</pre>";
	echo $param."<br/>";
	
	//$cliente = new SoapClient("https://10.177.73.61/ServicioWebCCTC/ws_cms_cctc.asmx?WSDL");
	//$parameter = array(	'informacion_tarjeta' => $tc_soap, 'informacion_amex' => $amex_soap, 'informacion_orden' => $informacion_orden);		
	//$obj_result = $cliente->PagarTC($parameter);
	
	// Inicializamos el CURL / SI no funciona se puede habilitar en el php.ini //
	$c = curl_init();
	// CURL de la URL donde se haran las peticiones //
	curl_setopt($c, CURLOPT_URL, 'http://localhost/interfase_cctc/orden_compra.php');
	//curl_setopt($c, CURLOPT_URL, 'http://10.43.29.196/interface_cctc/solicitar_post.php');
	// Se enviaran los datos por POST //
	curl_setopt($c, CURLOPT_POST, true);
	// Que nos envie el resultado del JSON //
	curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
	// Enviamos los parametros POST //
	curl_setopt($c, CURLOPT_POSTFIELDS, 'accion=PagarConObjetos&token=123456&parametros='.$param);
	// Ejecutamos y recibimos el JSON //
	$resultado = curl_exec($c);
	// Cerramos el CURL //
	curl_close($c); 
	
	// Le hacemos un decode al JSON y lo hacemos un array asociativo //
	$regreso = json_decode($resultado, TRUE);
	
	echo "Regreso array?:<pre>";
	print_r($regreso);
	echo "</pre>nada";
	exit;
	
	var_dump($regreso);
	
	// Si regreso información Convertimos el resultado a Objectos //
	if (isset($regreso)) {
		$p = ArrayToObject($regreso);
		var_dump($p);
	}
	else
	{
		echo "No se pudo procesar la solicitud.";
	}
	
	function ArrayToObject($array){
      $obj= new stdClass();
      foreach ($array as $k=> $v) {
         if (is_array($v)){
            $v = ArrayToObject($v);   
         }
         $obj->{$k} = $v;
      }
      return $obj;
   }
?>