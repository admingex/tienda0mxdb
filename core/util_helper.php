<?php
	#root 
	const 	TIENDA =	'/tienda/';	//http://tienda.grupoexpansion.mx
	const   GUIDX  =    '{ADE835D7-3DEA-F42C-31EA-B7950C54D592}'; // guidx para el sitio de la tienda
	//Para el inicio de sessión de la tienda y bloqueos e intentos
	$TIPO_ACTIVIDAD = array(
		"BLOQUEO"=> 0, 
		"DESBLOQUEO"=> 1, 
		"SOLICITUD_PASSWORD"=>2,
		"CAMBIO_PASSWORD"=>3,
		"ACCESO_INCORRECTO"=>4
	);

# acciones


# vistas

	
	# resultados por página
	# const PAGE_SIZE = 5;
	
	/**
	 * Imprime una cadena
	 */
	function site_url($url = '') {
		return TIENDA.$url;
	}

	/**
	 * Cargar vistas, pasar el nombre de la vista que coincide con el nombre del archivo de la vista
	 */
	function cargar_vista($vista, $data = array()) {
		//Creación de las variables que se pasan a través del satsa
		if(!empty($data)) {
			//echo "hay data";
			//print_r($data);
			foreach ($data as $key => $value) {
				$$key = $value;
			}
		}
		
		//header
		require('./templates/header.php');
		
		//contenido
		include('./views/'.$vista.'.php');
		//include('./components/promociones.php');
		
		//footer
		require('./templates/footer.php');
	}
	/*
	 * Funcion para crear los guidz que se enviaran a ecommerce pagos
	 */
	function guid(){
    	if (function_exists('com_create_guid')){
        	return com_create_guid();
    	}
    	else{
        	mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        	$charid = strtoupper(md5(uniqid(rand(), true)));
        	$hyphen = chr(45);// "-"
        	$uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
        	return $uuid;
    	}
	}


//NO ending