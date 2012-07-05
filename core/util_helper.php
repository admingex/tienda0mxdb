<?php
	#root 
	const 	TIENDA =	'/tienda/';	//http://tienda.grupoexpansion.mx
	
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
//NO ending