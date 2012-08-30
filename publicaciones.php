<?php	 
	include('./core/util_helper.php');

	//requiredincludes
    require('./config/settings.php');
	require('./controllers/paginacion.php');
			
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
			}
			
			//si viene de una categoría... Recuperar la información de la misma (para el breadcrum)
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
				}
			}
			
			// revisar si hay "promoción destacada" para la publicación
			$path_promo_destacada = "./json/promociones_destacadas/promo_destacada_publicacion_".$id_publicacion.".json";
			if (file_exists($path_promo_destacada)) {
				$json = file_get_contents($path_promo_destacada);
				$pd = json_decode($json);
				
				if (count($pd->promo_destacada) > 0) {
					$data["pd"] = $pd;	//pasar la promoción destacada a la vista
					//include_once('./components/promocion_destacada.php');
				}
			}
			
			//sacar las promociones de la publicación y sus detalles correspondientes, sin importar cuántos formatos tenga
			$path_promociones = "./json/publicaciones/promos_publicacion_".$id_publicacion.".json";
			//echo $path_promociones;
			if (file_exists($path_promociones)) {
				$json = file_get_contents($path_promociones);
				$promos = json_decode($json);
				
				//pasar la información de las promociones de la publicación a la vista 
				//$data['ofertas_publicacion'] = $promos;
				
				$detalles = array();
				//Obtener los detalles de las promociones:
				foreach ($promos->promociones as $promo) {
					//sacar las promociones del archivo
					$path_detalle_promo = "./json/detalle_promociones/detalle_promo_".$promo->id_promocion.".json";
					
					//echo $path_detalle_promo;
					if (file_exists($path_detalle_promo)) {
						$json = file_get_contents($path_detalle_promo);
						$detalle_promo = json_decode($json);
						$promo->detalle = $detalles[] = $detalle_promo[0];	//Se guarda el primer elemento que viene de un array, sólo debe ser uno
					}
				}
				
				//toda la información de la promoción
				$data['ofertas_publicacion'] = $promos;
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
			
			//definir la vista que se cargará con la oferta/el detalle de la promción
			if (strtolower($mostrar) === "detalle" ) {			//la publicación sólo tiene un formato
				$view .= $mostrar;
			} else if (strtolower($mostrar) === "ofertas" ) {	//la publicación tiene varios formatos
				$view .= $mostrar;
				//agregar información para el filtro por formatos
				// revisar si hay "promoción destacada" para la publicación
				$path_formatos = "./json/formatos.json";
				if (file_exists($path_formatos)) {
					$json = file_get_contents($path_formatos);
					$cat_formatos = json_decode($json);
					
					if (count($cat_formatos->formatos) > 0) {
						$data["formatos"] = $cat_formatos;	//pasar la promoción destacada a la vista
						//include_once('./components/filtro_formatos.php');
					}
				}
				//cargar los formatos que se ocupan realmente par ala publicación
				$path_formatos_pp = "./json/publicaciones/formatos_publicacion" . $id_publicacion . ".json";
				if (file_exists($path_formatos_pp)) {
					$json = file_get_contents($path_formatos_pp);
					$formatos_pp = json_decode($json);
					/*echo "formatos_pp<pre>";
					print_r($formatos_pp);
					echo "</pre>";*/
					if (count($formatos_pp->formatos_pp) > 0) {
						$data["formatos_pp"] = $formatos_pp->formatos_pp;	//pasar la promoción destacada a la vista
						//include_once('./components/filtro_formatos.php');
					}
				}
				
				//cargar los criterios de ordenación para el listado
				$path_criterios = "./json/criterios_ordenacion.json";
				if (file_exists($path_criterios)) {
					$json = file_get_contents($path_criterios);
					$criterios = json_decode($json);
					/*echo "formatos_pp<pre>";
					print_r($criterios);
					echo "</pre>";*/
					
					$data["criterios"] = $criterios->criterios;	//pasar la promoción destacada a la vista
				}
				
				//filtro por formato:
				if ($_POST) {
					// $ofertas_publicacion: trae un array de objects 
					$promos_filtradas = array();
					//total de las promociones
					$op = $data['ofertas_publicacion'];
					
					$filtro_values = array();		//almacena los valores enviados 
					//recuperación de los valores para el filtro 
					$filtro_values = recuperar_filtros();
					//realizar el filtrado:
					$op->promociones = filtrar_promociones_por_formatos($op->promociones, $filtro_values);
					
					//ordenamiento
					$orden = (array_key_exists('sel_ordenar', $_POST) ? $_POST['sel_ordenar'] : NULL);
					
					//$op->promociones = ordenar_promociones($op->promociones, $criterio);
					
					
					//re seasignan las promociones que se van a desplegar...
					$data['ofertas_publicacion'] = $op;
					
					###Ordenamiento de promociones
					
				}
			}
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
	
	/**
	 * Recupera los valores del POST para filtrar las promociones por formato
	 */
	function recuperar_filtros() {
		$valores = array();
		$prefijo = "chk_formato";		//para ubicar los valores de los formatos que se usarán para el filtro
		//$str_filtros = "filtros: ";
		foreach ($_POST as $filtro => $value) {
			//si existen las variables de filtro se guardan sus valores
			//$str_filtros .= (is_integer((strpos($filtro, $prefijo))) ? $filtro . " - " : "");
			if (is_integer(strpos($filtro, $prefijo))) {
				$valores[] =  $value;
			}
		}
		//echo $str_filtros;
		return $valores;
	}
	
	/**
	 * Realiza el filtro de las promociones en base a los formatos
	 * @param $promociones Listado de promociones
	 * @param $filtros Lista con los filtros de formatos
	 */
	function filtrar_promociones_por_formatos($promos, $formatos) {
		if (!empty($formatos) && !empty($promos)){
			$promos_filtradas = array();
			foreach ($promos as $p) {
				for($i = 0; $i < count($formatos); $i++) {
					if ($p->id_formato == $formatos[$i]) {
						$promos_filtradas[] = $p;
					}
				}
			}
			return $promos_filtradas;
		} else {
			//si no trae formatos para filtrar, regresa las promociones tal cual
			return $promos;
		}
	}
	
	/**
	 * ordenar el arreglo de promociones de acuerdo al criterio solicitado:
	 * @param criterio: precio ascendente, precio descendente, nombre de la promoción 
	 */
	function ordenar_promociones($promos, $criterio) {
		
		//for ($i = 1; )
	}
	
	
?>

