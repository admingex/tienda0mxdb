<?php
	//algunas configuraciones de php, headers...
	require_once('./config/settings.php');
	 
	//algunas constantes y funciones genéricas
	include_once('./core/util_helper.php');
	
		
	$title = 'Iniciar Sesi&oacute;n'; 				// Capitalize the first letter
	$subtitle = 'Iniciar Sesi&oacute;n Segura'; 	// Capitalize the first letter
	
	//almacerá información que va a la vista 
	$data = array();
		
	
	####### Para la carga de la página ########
	$scripts = array();
	
	
	//información para la vista
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	####### END carga de la página
	
	####### Lógica del administrador de usuario	

	
	if($_GET){
		//no caché
		no_cache();
		
		//Incluir el controlador
		include('./controllers/administrador_usuario.php');
		//se instancia al controlador
		$admin_controller = new Administrador_Usuario();
		//se atiende la petición con la instancia del controlador
						
		if(array_key_exists("accion", $_GET)){
			//echo "accion:".$_GET['accion'];
			switch ($_GET['accion']) {
				case 'consulta_mail':
									//requiere $_GET['mail]
									//if (filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL))																									
										$admin_controller->consulta_mail($_GET['mail']);
																											
									break;
				case 'cliente_id': 
									//requiere $_GET['id_cliente'];
									if(is_numeric($_GET['id_cliente'])){									
										$cliente = $admin_controller->cliente_id($_GET['id_cliente']);
										include('./views/cuenta_usuario/formulario_usuario.php');
									}	
									break;					
				case 'actualizar_cliente':
									//requiere $_POST con la informacion que se va a actualizar
									if(array_key_exists("id_cliente", $_POST))
										if(is_numeric($_POST['id_cliente']))
											$admin_controller->actualizar_cliente($_POST['id_cliente']);	
									break;
									
				case 'listar_razon_social':									
									if(array_key_exists("id_cliente", $_POST))
										if(is_numeric($_POST['id_cliente']))
											$admin_controller->listar_razon_social($_POST['id_cliente']);																																																											
									break;	
				case 'listar_direccion_facturacion':
									if(array_key_exists("id_cliente", $_POST))
										if(is_numeric($_POST['id_cliente']))																						
											$admin_controller->listar_direccion_facturacion($_POST['id_cliente']);
									break;												
				case 'listar_direccion_envio':
									if(array_key_exists("id_cliente", $_POST))
										if(is_numeric($_POST['id_cliente']))
											$admin_controller->listar_direccion_envio($_POST['id_cliente']);										    
									break;	
				case 'listar_tarjetas':
									if(array_key_exists("id_cliente", $_POST))
										if(is_numeric($_POST['id_cliente']))											
											$admin_controller->listar_tarjetas($_POST['id_cliente']);										    
									break;		
				case 'eliminar_rs':
									if(array_key_exists('id_rs', $_POST))
										if(is_numeric($_POST['id_rs']))	
											$admin_controller->eliminar_rs($_POST['id_rs']);
									break;	
				case 'eliminar_direccion':
									if(array_key_exists('id_dir', $_POST) && array_key_exists('id_cliente', $_POST))
										if(is_numeric($_POST['id_dir']) && is_numeric($_POST['id_cliente']))
											$admin_controller->eliminar_direccion($_POST['id_dir'], $_POST['id_cliente']);
									break;
									
				case 'editar_rs':
									if(array_key_exists('id_rs', $_GET))
										if(is_numeric($_GET['id_rs']))										
											$admin_controller->editar_rs($_GET['id_rs']);
									break;	
									
				case 'editar_dir_facturacion':
									if(array_key_exists('id_dir', $_GET) && array_key_exists('id_cliente', $_GET))
										if(is_numeric($_GET['id_dir']) && is_numeric($_GET['id_cliente']))											
											$admin_controller->editar_direccion_facturacion($_GET['id_dir'], $_GET['id_cliente']);
									break;		
				case 'editar_dir_envio':
									if(array_key_exists('id_dir', $_GET) && array_key_exists('id_cliente', $_GET))
										if(is_numeric($_GET['id_dir']) && is_numeric($_GET['id_cliente']))
											$admin_controller->editar_dir_envio($_GET['id_dir'], $_GET['id_cliente']);												
									break;												
																																																
																			
			}						 
		}	
		
	}	
	
	####### END Lógica del administrador de usuario
		
// FIn del front controller de administrador de usuario archivo /administrador_usuario.php