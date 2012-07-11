<?php
	#root path
	const 	TIENDA 	=	'/tienda/';	//http://tienda.grupoexpansion.mx
	const   GUIDX   =   '{ADE835D7-3DEA-F42C-31EA-B7950C54D592}';
	#API
	const 	API_KEY =	'AC35-4564-AE4D-0B881031F295';	//la que aparece en el controlador del API de la plataforma
	#Funciones de encriptación/descencriptación
	function encrypt($str, $key) {
		$str = trim($str);
    	$block = mcrypt_get_block_size('des', 'ecb');
    	$pad = $block - (strlen($str) % $block);
    	$str .= str_repeat(chr($pad), $pad);
    	return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $str, MCRYPT_MODE_ECB));
	}
	
	function decrypt($str, $key) {
		$str = base64_decode($str);
    	$str = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $str, MCRYPT_MODE_ECB);
    	$block = mcrypt_get_block_size('des', 'ecb');
    	$pad = ord($str[($len = strlen($str)) - 1]);
    	return substr($str, 0, strlen($str) - $pad);
	}
	
	########## PAGO
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
	
	//Para el inicio de sessión de la tienda y bloqueos e intentos
	$TIPO_ACTIVIDAD = array(
		"BLOQUEO"				=> 0, 
		"DESBLOQUEO"			=> 1, 
		"SOLICITUD_PASSWORD"	=> 2,
		"CAMBIO_PASSWORD"		=> 3,
		"ACCESO_INCORRECTO"		=> 4
	);

	class ENUMS {
		static $TIPO_ACTIVIDAD = array(
			"BLOQUEO"				=> 0, 
			"DESBLOQUEO"			=> 1, 
			"SOLICITUD_PASSWORD"	=> 2,
			"CAMBIO_PASSWORD"		=> 3,
			"ACCESO_INCORRECTO"		=> 4
		);
	
	}
# acciones


# vistas

	
	# resultados por página
	# const PAGE_SIZE = 5;
	
	/**
	 * Imprime una cadena con el web root del sitio
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
//NO ending