<?php
	//algunas configuraciones de php, headers...
	require_once('./config/settings.php');
	 
	//algunas constantes y funciones genéricas
	include('./core/util_helper.php');
	
	//el modelo del login	
	require_once('./models/login_registro_model.php');
		
	$title = 'Cerrar sesión'; 				// Capitalize the first letter
	$subtitle = 'Cerrar sesión'; 	// Capitalize the first letter
	
	//almacerá información que va a la vista 
	$data = array();
	
	####### Para la carga de la página ########
	$scripts = array();
	
	//incluir archivos js necesarios
	//$scripts [] = TIENDA."js/registro.js";
	
	//información para la vista
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	$data['proceso'] = 'Recupera tu contraseña';
	####### END carga de la página
	
	####### Lógica para cerrar la sesión en la tienda
	session_start();
	//no caché
	no_cache();
	
	cerrar_session();
	
	$url = site_url();
	header("Location: $url", TRUE, 302);
	
	/*
	echo "Enviar<pre>";
	print_r($_GET);
	print_r($_POST);
	print_r($_SESSION);
	echo "<pre>";
	exit;
	*/	
	####### END Lógica de logout
	
	function cerrar_session() {
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
	}
			
	//Si no hay petición POST, redireccionar al home
	cargar_vista('', $data);
	exit;
	
// FIN del front controller del registro /registro.php
