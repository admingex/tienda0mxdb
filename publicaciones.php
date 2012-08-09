<?php	 
	include('./core/util_helper.php');

	//requiredincludes
    require('./config/settings.php');
			
    //header (y/o menús)
    $menues = TRUE;
	
	//incluir archivos js
	$scripts = array();	
	$scripts [] = TIENDA."js/login.js";
	$scripts [] = TIENDA."js/registro.js";
	
	//información para la vista
	$title = "Promociones Por Publicaci&oacute;n";
	$subtitle = "Promociones";
	
	$data = array();
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	if ($_GET) {
		$mostrar = (array_key_exists('mostrar', $_GET)) ? $_GET['mostrar'] : "";		
		$view = 'promos_publicacion_';			//vista que se cargará dependiendo del número de formatos de la publicación
		
		if (array_key_exists('id_publicacion', $_GET) && filter_var($_GET['id_publicacion'], FILTER_VALIDATE_INT, array('min_range' => 1))) {	### TO DO seguridad!
			$id_publicacion = $_GET['id_publicacion'];
			$data['id_publicacion'] = $id_publicacion;
			
			
			if (strtolower($mostrar) === "detalle" ) {			//la publicación sólo tiene un formato
				$view .= $mostrar;
			} else if (strtolower($mostrar) === "ofertas" ) {	//la publicación tiene varios formatos
				$view .= $mostrar;
			}
			
			### BORRAR
			$data['mostrar'] = $mostrar;
			
			
			//sacar la información de la publicación
			$path_publicaciones = "./json/publicaciones/publicaciones.json";
			
			if (file_exists($path_publicaciones)) {
				$json = file_get_contents($path_publicaciones);
				$p = json_decode($json);
				
				//Obtener la información de la publicación que se consulta
				foreach ($p->publicaciones as $pub) {
					if ($pub->id_publicacionSi == $id_publicacion) {
						//se pasa la info a la vista
						$data["info_publicacion"] = $pub;
						break;
					}
				}
				
				/*echo "<pre>";
				print_r($data["info_publicacion"]);
				echo "</pre>";
				exit;*/
			}
		}
	} else {	//si no trae parámetros de la publicación manda al home
		##### TO DO: definir este flujo
		$view = "$mostrar";		
		$data['pubs_m'] = "Promos de la publicación, no trae get";
		$url = site_url("home");
		header("Location: $url");
	} 
	/*
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	*/
	cargar_vista($view, $data);
	exit;
	
?>

