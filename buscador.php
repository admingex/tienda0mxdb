<?php	 
	include('./core/util_helper.php');

	//requiredincludes
    require('./config/settings.php');
	require('./controllers/paginacion.php');
	# Importar modelo de abstracción de base de datos 
	require_once('./core/db_abstract_model.php');
	require_once('./models/json_model.php');
	
			
    //header (y/o menús)
    $menues = TRUE;
	
	//incluir archivos js
	$scripts = array();	
	$scripts [] = TIENDA."js/login.js";
	$scripts [] = TIENDA."js/registro.js";
	
	//información para la vista
	$title = "Resultados de la busqueda";
	$subtitle = "Buscador";
	
	$data = array();
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	if ($_GET) {
		//$mostrar = (array_key_exists('mostrar', $_GET)) ? $_GET['mostrar'] : "";
		$mostrar = "busqueda";		
		//echo $mostrar;
		$view = 'promos_publicacion_';			//vista que se cargará dependiendo del número de formatos de la publicación
		
		$fb=$_GET['filtro_busqueda'];
		echo $_GET['s'];
		
		if (array_key_exists('s', $_GET) && filter_var($_GET['s'], FILTER_VALIDATE_INT, array('min_range' => 1))) {	### TO DO seguridad!
			//recuperar el parámetro de la consulta
			$id_publicacion = $_GET['s'];
			
			$data['id_publicacion'] = $id_publicacion;
			echo $id_publicacion;
			
			
			/****************************************************************************************************************************************/			
			switch ($fb){
				case 'all':
					//algo
					$path_promociones = "./json/publicaciones/promos_publicacion_".$id_publicacion.".json";
					break;
				case '1':
				case '2':
				case '3':
				case '4':
					
					$path_promociones = "./json/publicaciones/promos_publicacion_".$id_publicacion.".json";
					break;
			}
			//sacar las promociones de la publicación y sus detalles correspondientes, sin importar cuántos formatos tenga
			/*if($fb=='all'){
				$path_promociones = "./json/publicaciones/promos_publicacion_".$id_publicacion.".json";	
			}*/
			
			
			//echo $path_promociones;
			if (file_exists($path_promociones)) {
				$json = file_get_contents($path_promociones);
				$promos = json_decode($json);
				
				//pasar la información de las promociones de la publicación a la vista 
				//$data['ofertas_publicacion'] = $promos;
				
				$detalles = array();	//detalles de las promociones
				$secciones = array();	//secciones de las promociones
				//Obtener los detalles de las promociones:
				foreach ($promos->promociones as $promo) {
					$id_promocion = $promo->id_promocion;
					//sacar las promociones del archivo
					$path_detalle_promo = "./json/detalle_promociones/detalle_promo_".$id_promocion.".json";
					
					//echo $path_detalle_promo;
					if (file_exists($path_detalle_promo)) {
						$json = file_get_contents($path_detalle_promo);
						$detalle_promo = json_decode($json);
						$promo->detalle = $detalles[] = $detalle_promo[0];	//Se guarda el primer elemento que viene de un array, sólo debe ser uno
					}
					
					/**
					 * Secciones asociadas con la promoción
					 */
					$path_secciones = "./json/secciones/seccion_oc_".$id_promocion.".json";
					//echo "secciones " . $path_secciones;
					if (file_exists($path_secciones)) {
						$json = file_get_contents($path_secciones);
						$js = json_decode($json);		//json secciones
						$secciones[$id_promocion] = $js;	//Se guarda el primer elemento que viene de un array, sólo debe ser uno
					}
				}
				/*echo "<pre>";
				print_r($secciones);
				echo "</pre>";*/
				
				//toda la información de la promoción
				$data['ofertas_publicacion'] = $promos;
				//secciones de las promociones
				$data['secciones'] = $secciones;
				//total de promociones de la publicación, se usa para mostrar el filtro siempre en caso de que las promociones mostradas sean menos de las mínimas para mostrar el filtro
				$data['total_promociones'] = count($data['ofertas_publicacion']->promociones);
				/*
				echo "Temp<pre>";
				print_r($detalles);
				echo "</pre>";
				*/
				//los detalles sólo se usan en las suscripciones, pdfs, seminarios...
				$data['detalles_promociones'] = $detalles;
			}
			
		
				$view .= $mostrar;			
		}
	} else {	//si no trae parámetros de la publicación manda al home
		##### TO DO: definir este flujo
		$view = "$mostrar";		
		$data['pubs_m'] = "Promos de la publicación, no trae inforación en la petición.";
		$url = site_url("home");
		header("Location: $url");
	}
	
	cargar_vista($view, $data);
	exit;
	
	
?>

