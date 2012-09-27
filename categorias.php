<?php
	/*atiende las peticiones en el nivel de categorías*/
	include('./core/util_helper.php');

	//required includes
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
		if (array_key_exists('id_categoria', $_GET) && filter_var($_GET['id_categoria'], FILTER_VALIDATE_INT, array('min_range' => 1))) {	### TO DO seguridad!
			$id_categoria = $_GET['id_categoria'];
			$data['id_categoria'] = $id_categoria;
			
			//Sacar la información de la categoría
			$path_categoria = "./json/categorias/categorias.json";
			
			if (file_exists($path_categoria)) {
				$json = file_get_contents($path_categoria);
				$c = json_decode($json);
				
				//obtener la información de la categoría que se consulta
				foreach ($c->categorias as $cat) {
					if ($cat->id_categoriaSi == $id_categoria) {
						$data["info_categoria"] = $cat;
						break;
					}
				}
			} else {
				//si no existe el archivo con la información ¿¿ir a BD??
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

?>
