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
	
	
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	
	if ($_GET) {
		if (array_key_exists('id_categoria', $_GET)) {	### TO DO seguridad!
			$id_categoria = $_GET['id_categoria'];
			$data['id_categoria'] = $id_categoria;
		}
	}
	
	cargar_vista('categoria_publicaciones', $data);
	exit;
    //contenido
    //include('./components/categorias.php');
    //echo "Categorías aquí";
