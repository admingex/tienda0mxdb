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
	$title = "Publicaciones por Catgoría";
	$subtitle = "Publicaciones por Catgoría";
	
	$data = array();
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	if ($_GET) {
		if (array_key_exists('id_categoria', $_GET)) {	### TO DO seguridad!
			$id_categoria = $_GET['id_categoria'];
			$data['id_categoria'] = $id_categoria;
			
			//Sacar la información de la categoría
			$path_categoria = "./json/categorias/categorias.json";
			if (file_exists($path_categoria)) {
				$json = file_get_contents($path_categoria);
				$c = json_decode($json);
				//el índice de la categoría es el id de la misma:
				/*
				echo "<pre>";
				print_r($c->categorias[$id_categoria - 1]);
				echo "</pre>";
				exit;
				*/
				$data["info_categoria"] = $c->categorias[$id_categoria - 1];
			}
		}
	}
	/*
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	*/
	cargar_vista('categoria_publicaciones', $data);
	exit;
    //contenido
    //include('./components/categorias.php');
    //echo "Categorías aquí";
