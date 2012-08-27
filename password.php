<?php
	//algunas configuraciones de php, headers...
	require_once('./config/settings.php');
	 
	//algunas constantes y funciones genéricas
	include('./core/util_helper.php');
	
	//el modelo del login	
	require_once('./models/login_registro_model.php');
		
	$title = 'Recupera tu contraseña'; 				// Capitalize the first letter
	$subtitle = 'Recupera tu contraseña'; 	// Capitalize the first letter
	
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
	
	$data["accion"]	= 'recordar';					//para definir la vista que se mostrará
	$data['proceso'] = 'Recupera tu contraseña';	//título al interior de la vista
	####### END carga de la página
	
	####### Lógica de recuperación de contraseña
	if ($_GET) {
		if (array_key_exists('accion', $_GET)) {
			$data['accion'] = $_GET['accion'];
			//definir el mensaje que se mostrará en la vista
			switch ($data['accion']) {
				case 'cambiar':
					$data['proceso'] = 'Escribe una nueva contraseña';
					break;
				case 'verificar':
					$data['proceso'] = 'Escribe la clave para crear una nueva contraseña';
					break;
				default:
					$data['proceso'] = 'Recupera tu contraseña';
					break;
			}
		}
		
		//si trae para recuperar contraseña para mostrara en el formulario de verificación
		if (array_key_exists('passtemp', $_GET))
			$data['password_temporal'] = $_GET['passtemp'];
	}
	//lógica de la recuperación de contraseña
	if ($_POST) {				
		
		//no caché
		no_cache();
		
		//Incluir el controlador
		include ('./controllers/password.php');
		//se instancia al controlador
		$password_controller = new Password_Controller();
		//se atiende la petición con la instancia del controlador
		switch ($data['accion']) {
			case 'enviar':
				$password_controller->enviar();
				break;
			case 'cambiar':
				$password_controller->cambiar();
				break;
			case 'verificar':
				$password_controller->verificar();
				break;
			default:	//enviar
				//$data['proceso'] = 'Recupera tu contraseña';
				break;
		}
		
		//si hubo errores, se pasan a la vista para que se muestre, de otro modo, se redirecciona a otro controlador ($td === $this->data)
		$td = $password_controller->get_data();
		if (!empty($td)) {
			foreach ($td as $key => $value) {
				$data[$key] = $value;
			}
		}
	}
	####### END Lógica de login
		
	//Si no hay petición POST, cargar la vista sencilla de login
	cargar_vista('password', $data);
	exit;
	
// FIN del front controller del registro /registro.php
