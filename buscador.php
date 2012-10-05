<?php	 
	include('./core/util_helper.php');


	//requiredincludes
    require('./config/settings.php');
	require('./controllers/paginacion.php');
	
	require('./controllers/json_creator.php');
	
			
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

	$jc = new Json_Creator();

				//vista que se cargará dependiendo del número de formatos de la publicación
		
		$fb=$_GET['fb'];
		$s=$_GET['s'];
		
		/****************************************************************************************************************************************/			
		switch ($fb){
			case 'all':
				//algo		archivo_busqueda_formatos.$formato.".json"
				$path_promociones = "./json/publicaciones/promos_publicacion_".$s.".json";
				break;
			case '1':
			case '2':
			case '3':
			case '4':
			case '5':
				$jc->generar_json_buscador_formatos($fb,$s);
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
						if (file_exists($path_detalle_promo)==1) {
							$json = file_get_contents($path_detalle_promo);
							$detalle_promo = json_decode($json);
							$promo->detalle = $detalles[] = $detalle_promo[0];	//Se guarda el primer elemento que viene de un array, sólo debe ser uno
							$promo_resultado[]=$promo;
							
							
						}
						
					}
					$promos->promociones = $promo_resultado;
					$data['ofertas_publicacion'] = $promos;
					$data['total_promociones'] = count($data['ofertas_publicacion']->promociones);
					$data['detalles_promociones'] = $detalles;
					/*echo "<pre>";					
					print_r($promos);
					print_r($promo_resultado);
					echo "</pre>";
					exit;*/
				}
								
				break;
			case 'codigo_promocion':
				$jc->generar_json_buscador_promocion($s);
				$path_promociones = "./json/busqueda/promocion_".$s.".json";
				break;
			case 'promociones_especiales':
				$jc->generar_json_buscador_promociones_especiales($s);
				
				//datos
				$data['id_categoria'] = 6;
				$path_promo_padre_especiales = "./json/busqueda/promocion_especial_".$s.".json";
				//echo $path_promo_padre_especiales;
				if (file_exists($path_promo_padre_especiales)) {
					$json = file_get_contents($path_promo_padre_especiales);
					$promos_padre = json_decode($json);	
					$items = 0;					
					foreach($promos_padre->promociones as $p){
						
							$data["promociones_especiales"][$items] = $p;
							$items++;
						
					}
																					 							
				}
				
				//vista
				$view='promociones_especiales';
				break;
			case 'palabras_clave':
				
				break;
		}
		
		//echo $path_promociones;
		
			
	
	
	cargar_vista($view, $data);
	exit;
	
	
?>

