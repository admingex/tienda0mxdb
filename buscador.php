<?php	 
	include('./core/util_helper.php');
	
	//requiredincludes
    require('./config/settings.php');
	require('./controllers/paginacion.php');
	
	require('./controllers/json_creator.php');
			
    //header (y/o menúes)
    $menues = TRUE;
	
	//incluir archivos js
	$scripts = array();	
	$scripts [] = TIENDA."js/login.js";
	$scripts [] = TIENDA."js/registro.js";
	
	//información para la vista
	$title = "Resultados de la búsqueda";
	$subtitle = "Buscador";
	
	$data = array();
	$jc = new Json_Creator();

	//vista que se cargará dependiendo del número de formatos de la publicación
	$fb = $_GET['fb'];
	$s = $_GET['s'];
	$data["criterios_ordenacion"] = catalogo_criterios_ordenacion();	//para mostraren el combo de la búsqueda
	
	//echo $fb;
	/****************************************************************************************************************************************/			
	switch ($fb) {
		case 'all':
			$jc->generar_json_buscador_all($s);
			$path_promociones = "./json/busqueda/all_promociones.json";
			//vista
			$view = 'promos_publicacion_busqueda';
			//DATOS
			if (file_exists($path_promociones)) {
				$json = file_get_contents($path_promociones);
				$promos = json_decode($json);
				$detalles = array();	//detalles de las promociones
				$promo_resultado = array();
				
				//Obtener los detalles de las promociones:
				foreach ($promos->promociones as $promo) {
					$id_promocion = $promo->id_promocion;
					$data['id_publicacion'] = property_exists(get_class($promo), 'id_publicacion') ? $promo->id_publicacion: 0;
					//sacar las promociones del archivo
					//echo $id_promocion;
					$path_detalle_promo = "./json/detalle_promociones/detalle_promo_".$id_promocion.".json";
					
					//echo "<br>". $path_detalle_promo." - ".file_exists($path_detalle_promo);
					if (file_exists($path_detalle_promo) == 1) {
						$json = file_get_contents($path_detalle_promo);
						$detalle_promo = json_decode($json);
						$promo->detalle = $detalles[] = $detalle_promo[0];	//Se guarda el primer elemento que viene de un array, sólo debe ser uno
						$promo_resultado[] = $promo;
					}
				}
				
				$promos->promociones = $promo_resultado;
				$data['ofertas_publicacion'] = $promos;
				$data['total_promociones'] = count($data['ofertas_publicacion']->promociones);
				$data['detalles_promociones'] = $detalles;
				$data['criterios_ordenacion'] = catalogo_criterios_ordenacion();
				$data['buscador'] = 1;
				$data['fb'] = $fb;
				$data['s'] = $s;
			}
			break;
			
		case 'promociones_especiales':
			$jc->generar_json_buscador_promociones_especiales($s);
			$data['fb'] = $fb;
			$data['s'] = $s;
			$data['palabra'] = $s;
			$data['id_promo_padre'] = $s;
			
			$path_promos_especiales = "./json/busqueda/promocion_especial_".$data['id_promo_padre'].".json";
			if (file_exists($path_promos_especiales)) {
				$json = file_get_contents($path_promos_especiales);
				$jph = json_decode($json);
				//se pasan a la vista las promociones hijas obtenidas para la promocion padre
				$data["promociones_hijas"] = $jph;
				$data['ofertas_publicacion']=$jph;
			}
			//vista*/
			$view = 'promociones_hijas_busqueda';
			
			break;
			
		case '1':
		case '2':
		case '3':
		case '4':
		case '5':
		case '32':
		case '33':
		case '34':
		case '35':
		case '36':
			$jc->generar_json_buscador_formatos($fb, $s);
			$path_promociones = "./json/busqueda/b_".$fb.".json";
			//vista
			$view = 'promos_publicacion_busqueda';
			//DATOS		
			if (file_exists($path_promociones)) {
				$json = file_get_contents($path_promociones);
				$promos = json_decode($json);
				$detalles = array();	//detalles de las promociones
				$promo_resultado=array();
				
				//Obtener los detalles de las promociones:
				foreach ($promos->promociones as $promo) {
					$id_promocion = $promo->id_promocion;
					$data['id_publicacion'] = property_exists(get_class($promo), 'id_publicacion') ? $promo->id_publicacion: 0;
					//sacar las promociones del archivo
					$path_detalle_promo = "./json/detalle_promociones/detalle_promo_".$id_promocion.".json";
					
					//echo "<br>". $path_detalle_promo." - ".file_exists($path_detalle_promo);
					if (file_exists($path_detalle_promo) == 1) {
						$json = file_get_contents($path_detalle_promo);
						$detalle_promo = json_decode($json);
						$promo->detalle = $detalles[] = $detalle_promo[0];	//Se guarda el primer elemento que viene de un array, sólo debe ser uno
						$promo_resultado[] = $promo;
					}
				}
				$promos->promociones = $promo_resultado;
				$data['ofertas_publicacion'] = $promos;
				$data['total_promociones'] = count($data['ofertas_publicacion']->promociones);
				$data['detalles_promociones'] = $detalles;
				$data['criterios_ordenacion'] = catalogo_criterios_ordenacion();
				$data['buscador'] = 1;
				$data['fb'] = $fb;
				$data['s'] = $s;
			}
			break;
			
		case 'codigo_promocion':
			$jc->generar_json_buscador_promocion($s);
			$data['fb'] = $fb;
			$data['s'] = $s;
			$data['palabra'] = $s;
			$data['id_promo_padre'] = $s;
			
			$path_promociones = "./json/busqueda/codigo_promocion_".$s.".json";
						
			if (file_exists($path_promociones)) {
				$json = file_get_contents($path_promociones);
				$jph = json_decode($json);
				//se pasan a la vista las promociones hijas obtenidas para la promocion padre
				$data["promociones_hijas"] = $jph;
				$data['ofertas_publicacion']=$jph;
				
			}
			//vista*/
			$view = 'promociones_hijas_busqueda';
			break;
			
		/*
		case 'palabras_clave':
			break;
		*/
		default:
			break;
	}

	//filtro por formato:
	if ($_POST) {
		//ordenamiento -todas y formatos
		$orden = (array_key_exists('sel_ordenar', $_POST) ? $_POST['sel_ordenar'] : NULL);
		$op = $data['ofertas_publicacion'];
		if ($orden) {
			$op->promociones = ordenar_promociones($op->promociones, $orden);
		}
		
		//re seasignan las promociones que se van a desplegar...
		$data['ofertas_publicacion'] = $op;
		
		//ordenamiento -especiales y codigos
		/*$orden2 = (array_key_exists('sel_ordenar_dos', $_POST) ? $_POST['sel_ordenar_dos'] : NULL);
		
		if ($orden2) {
			$op2 = $data['promociones_hijas'];
			$op2->promociones = ordenar_promociones($op2->promociones, $orden);
		}				
		//re seasignan las promociones que se van a desplegar...
		$data['promociones_hijas'] = $op2;*/
		###Ordenamiento de promociones
	}

	cargar_vista($view, $data);
	exit;
		
	/**
	 * Recupera el catálogo de criterios para el ordenamiento de las promociones
	 * 
	 */
	function catalogo_criterios_ordenacion() {
		//cargar los criterios de ordenación para el listado
		$path_criterios = "./json/criterios_ordenacion.json";
		if (file_exists($path_criterios)) {
			$json = file_get_contents($path_criterios);
			$criterios = json_decode($json);
			/*echo "formatos_pp<pre>";
			print_r($criterios);
			echo "</pre>";*/
			return $criterios->criterios;
			//$data["criterios"] = $criterios->criterios;
		}
	}
	
	/**
	 * ordenar el arreglo de promociones de acuerdo al criterio solicitado:
	 * @param criterio: precio ascendente, precio descendente, nombre ascendente y descendente de la promoción 
	 */
	function ordenar_promociones($promos, $criterio) {
		//echo $criterio;		
		switch ($criterio) {
			case 'nombre_desc':
				if (count($promos) > 1) {
					for ($i = 1; $i < count($promos); $i++) {
						$temp = $promos[$i];
						$descripcion_temp = !empty($temp->detalle->descripcion_issue) ? $temp->detalle->descripcion_issue : $temp->descripcion_promocion;					
						//$promocion = $promos[0];
						//$descripcion_promocion = !empty($promocion->detalle->descripcion_issue) ? $promocion->detalle->descripcion_issue : $promocion->descripcion_promocion;
						for ($j = $i - 1; $j >= 0; $j--) {
							$promocion = $promos[$j];
							$descripcion_promocion = !empty($promocion->detalle->descripcion_issue) ? $promocion->detalle->descripcion_issue : $promocion->descripcion_promocion;
							
							if (strcmp($descripcion_promocion, $descripcion_temp) < 0) {
								$promos[$j + 1] = $promos[$j]; //intercambia
							} else {
								break;
							}
						}
						$promos[$j + 1] = $temp;
					}
				}
				break;
			case 'nombre_asc':
				if (count($promos) > 1) {
					for ($i = 1; $i < count($promos); $i++) {
						$temp = $promos[$i];
						$descripcion_temp = !empty($temp->detalle->descripcion_issue) ? $temp->detalle->descripcion_issue : $temp->descripcion_promocion;
						
						for ($j = $i - 1; $j >= 0; $j--) {
							$promocion = $promos[$j];
							$descripcion_promocion = !empty($promocion->detalle->descripcion_issue) ? $promocion->detalle->descripcion_issue : $promocion->descripcion_promocion;
							
							if (strcmp($descripcion_promocion, $descripcion_temp) > 0) {
								$promos[$j + 1] = $promos[$j]; //intercambia
							} else {
								break;
							}
						}
						$promos[$j + 1] = $temp;
					}
				}
				break;
			case 'precio_desc':
				if (count($promos) > 1) {
					for ($i = 1; $i < count($promos); $i++) {
						$temp = $promos[$i];
						
						for ($j = $i - 1; ($j >= 0) && ($promos[$j]->detalle->costo < $temp->detalle->costo); $j--) {
							$promos[$j + 1] = $promos[$j]; //intercambia
						}
						$promos[$j + 1] = $temp;
					}
				}
				break;
			case 'precio_asc':
				if (count($promos) > 1) {
					for ($i = 1; $i < count($promos); $i++) {
						$temp = $promos[$i];
						
						for ($j = $i - 1; ($j >= 0) && ($promos[$j]->detalle->costo > $temp->detalle->costo); $j--) {
							$promos[$j + 1] = $promos[$j]; //intercambia
						}
						$promos[$j + 1] = $temp;
					}
				}
				break;
					
			default:
				//$promos = $promos;
				break;
		}
		return $promos;
	}
?>

