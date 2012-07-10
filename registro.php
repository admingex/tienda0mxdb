<?php
	//algunas configuraciones de php, headers...
	require_once('./config/settings.php');
	 
	//algunas constantes y funciones genéricas
	include('./core/util_helper.php');
	
	//el modelo del login	
	require_once('./models/login_registro_model.php');
		
	$title = 'Registro de cliente'; 				// Capitalize the first letter
	$subtitle = 'Registro de cliente en la tienda'; 	// Capitalize the first letter
	
	//almacerá información que va a la vista 
	$data = array();
	
	####### Para la carga de la página ########
	$scripts = array();
	
	//incluir archivos js necesarios
	$scripts [] = TIENDA."js/registro.js";
	
	//información para la vista
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	####### END carga de la página
	
	####### Lógica de registro	
	if ($_POST) {
		//inicio de la sesión
		session_start();
		
		//no caché
		no_cache();
		
		//Incluir el controlador
		include ('./controllers/registro.php');
		//se instancia al controlador
		$registro_controller = new Registro_Controller();
		//se atiende la petición con la instancia del controlador
		$registro_controller->registrar();
		
		//si hubo errores, se pasan a la vista para que se muestre, de otro modo, se redirecciona a otro controlador
		$td = $registro_controller->get_data();
		if (!empty($td)) {
			foreach ($td as $key => $value) {
				$data[$key] = $value;
			}
		}
	}
	####### END Lógica de login
	//echo "DATA<pre>";
	//print_r($data);
	//echo "<pre>";
	//exit;
	
	//Si no hay petición POST, cargar la vista sencilla de login
	cargar_vista('registro', $data);
	exit;
	
// FIN del front controller del registro /registro.php
