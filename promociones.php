<?php
	/*atiende las peticiones en el nivel de promociones*/
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
	$title = "Detalle de la Promoción";
	$subtitle = "Detalle de la Promoción";
	##### TO DO :
	
	
	$data = array();
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	if ($_GET) {
		//revisar si trae alguna promoción o parámetro de búsqueda
		if (array_key_exists('id_promocion', $_GET) && filter_var($_GET['id_promocion'], FILTER_VALIDATE_INT, array('min_range' => 1))) {	### TO DO seguridad!
			$id_promocion = $_GET['id_promocion'];
			$data['id_promocion'] = $id_promocion;
			
			//Sacar la información de la promoción para mostrarla
			$path_promocion = "./json/promociones_publicacion/detalle_promo_".$id_promocion.".json";
			
			//recuperar la promoción
			if (file_exists($path_promocion)) {
				$json = file_get_contents($path_promocion);
				$detalle_promocion = json_decode($json);
				
				$data["detalles_promociones"] = $detalle_promocion;
				/*
				echo "Detalle_promocion<pre>";
				print_r($detalle_promocion);
				echo "</pre>";
				*/
				
				//obtener la información del detalle de la promoción que se consulta, artículos y demás ...
				/*
				foreach ($promocion as $pr) {
					if ($pr->id_categoriaSi == $id_categoria) {
						$data["detalle_promocion"] = $pr;
						break;
					}
				}
				*/ 
			} else {
				//si no existe el archivo con la información ¿¿ir a BD??
			}
		}
		//si trae, recuperar la información de la publicación
		if (array_key_exists('id_publicacion', $_GET) && filter_var($_GET['id_publicacion'], FILTER_VALIDATE_INT, array('min_range' => 1))) {	### TO DO seguridad!
			//recuperar el parámetro de la consulta
			$id_publicacion = $_GET['id_publicacion'];
			$data['id_publicacion'] = $id_publicacion;
			
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
				/*
				if (!empty($data["info_publicacion"])) {
					echo "Info_publicacion<pre>";
					print_r($data["info_publicacion"]);
					echo "</pre>";
				}
				*/ 
			}
		}

		//si trae, recuperar la información de la categoría
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
				/*
				if (!empty($data["info_categoria"])) {
					echo "Info_categoria<pre>";
					print_r($data["info_categoria"]);
					echo "</pre>";
				}
				*/
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
	cargar_vista('promos_publicacion_detalle', $data);
	exit;

?>
