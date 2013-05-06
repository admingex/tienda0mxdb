<?php session_start();
	#root path
	const 	TIENDA 	=	'http://kiosco/';	//http://tienda.grupoexpansion.mx
	const	ECOMMERCE = 'http://ecommerce/';	//http://pagos.grupoexpansion.mx
	const	MAX_PROMOS_PAGINA	=	6;
	/**
	 * Clase genérica para la funcionalidad del API
	 */
	class API {
		const   GUIDX   =   '{ADE835D7-3DEA-F42C-31EA-B7950C54D592}';
		const 	API_URL	=	'http://ecommerce/api/';	//http://tienda.grupoexpansion.mx
		#API
		const 	API_KEY =	'AC35-4564-AE4D-0B881031F295';	//la que aparece en el controlador del API de la plataforma
		#Funciones de encriptación/descencriptación
		static function encrypt($str, $key) {
			$str = trim($str);
	    	$block = mcrypt_get_block_size('des', 'ecb');
	    	$pad = $block - (strlen($str) % $block);
	    	$str .= str_repeat(chr($pad), $pad);
	    	return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $str, MCRYPT_MODE_ECB));
		}
		
		static function decrypt($str, $key) {
			$str = base64_decode($str);
	    	$str = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $str, MCRYPT_MODE_ECB);
	    	$block = mcrypt_get_block_size('des', 'ecb');
	    	$pad = ord($str[($len = strlen($str)) - 1]);
	    	return substr($str, 0, strlen($str) - $pad);
		}
		
		########## PAGO
		static function guid() {
			//para la integracion con IDC y CNN es necesario que guidx y guidz sean iguales para la cadena de comprobacion, por lo tanto desactivamos el generador automatico
			/*
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
			 */
			return '{ADE835D7-3DEA-F42C-31EA-B7950C54D592}';	  
		}
	}
	//Para el inicio de sessión de la tienda y bloqueos e intentos
	class ENUMS {
		static $TIPO_ACTIVIDAD = array(
			"BLOQUEO"				=> 0, 
			"DESBLOQUEO"			=> 1, 
			"SOLICITUD_PASSWORD"	=> 2,
			"CAMBIO_PASSWORD"		=> 3,
			"ACCESO_INCORRECTO"		=> 4
		);
	}

	/**
	 * Imprime una cadena con el web root del sitio
	 */
	function site_url($url = '') {
		return TIENDA.$url;
	}

	/**
	 * Cargar vistas, pasar el nombre de la vista que coincide con el nombre del archivo de la vista
	 */
	function cargar_vista($vista = '', $data = array()) {
		//Si no especifica una vista, se va al home de la tienda
		if (empty($vista)) {
			$url = site_url();
			header("Location: $url", TRUE, 302);
			exit;
		}
		
		
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