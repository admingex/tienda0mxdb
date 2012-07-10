<?php
	//algunas configuraciones de php, headers...
	require_once('./config/settings.php');
	 
	//algunas constantes y funciones genéricas
	include('./core/util_helper.php');
	
	//el modelo del login	
	require_once('./models/login_registro_model.php');
		
	$title = 'Iniciar Sesi&oacute;n'; 				// Capitalize the first letter
	$subtitle = 'Iniciar Sesi&oacute;n Segura'; 	// Capitalize the first letter
	
	//almacerá información que va a la vista 
	$data = array();
	
	//sólo para login de usuario nuevo
	const NUEVO = "nuevo";
	
	####### Para la carga de la página ########
	$scripts = array();
	
	//incluir archivos js necesarios
	$scripts [] = TIENDA."js/login.js";
	//$scripts [] = TIENDA."js/registro.js";
	
	//información para la vista
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	####### END carga de la página
	
	####### Lógica de login	
	if ($_POST) {
		//inicio de la sesión
		session_start();
		
		//para pruebas
		//$_SESSION = array();
		
		//no caché
		no_cache();
		
		//Incluir el controlador
		include ('./controllers/login.php');
		
		//exit;
					
	} //else {	//If hay $_POST
	
	####### END Lógica de login
	
	//Si no hay petición POST, cargar la vista sencilla de login
	cargar_vista('login', $data);
	exit;
	//}
	
// FIn del front controller de login archivo /login.php
 