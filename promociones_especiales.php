<?php
	/*atiende las peticiones de las promociones especiales*/
	include('./core/util_helper.php');

	//required includes
    require('./config/settings.php');
	
	//paginador
	require('./controllers/paginacion.php');			
    
    //header (y/o menús)
    $menues = TRUE;
	
	//incluir archivos js
	$scripts = array();		
	
	//información para la vista
	$title = "Promociones Especiales";
	$subtitle = "Promociones Especiales";
	
	$data = array();
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	if ($_GET) {
		if (array_key_exists('id_categoria', $_GET) && filter_var($_GET['id_categoria'], FILTER_VALIDATE_INT, array('min_range' => 1))) {	### TO DO seguridad!
			$id_categoria = $_GET['id_categoria'];
			$data['id_categoria'] = $id_categoria;
			
			##### TODO 	validar que corresponda con la de promos especiales
			if ($id_categoria == 6 ) {
				//Sacar la información de las promociones especiales
				$path_promos_especiales = "./json/promos_especiales.json";
				
				if (file_exists($path_promos_especiales)) {
					$json = file_get_contents($path_promos_especiales);
					$jpe = json_decode($json);
					
					//se pasan a la vista
					$data["promociones_especiales"] = $jpe->promos_especiales;
					
				} else {
					//si no existe el archivo con la información ¿¿ir a BD??
				}
				/*echo "<pre>";
				print_r($data["promociones_especiales"]);
				echo "</pre>";*/
			}
			
		}
	}
	/*
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	*/
	cargar_vista('promociones_especiales', $data);
	exit;

?>
