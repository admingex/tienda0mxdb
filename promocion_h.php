<?php
	include('./core/util_helper.php');

	//requiredincludes
    require('./config/settings.php');
	
	//Paginador
	include("./controllers/paginacion.php");
			
    //header (y/o menús)
    $menues = TRUE;	
	
	//Scripts
	$scripts = '';
	$scripts [] = TIENDA."js/slide.js";
	$scripts [] = TIENDA."js/funcion_slide.js";	

	
	//información para la vista
	$title = "Publicaciones por Promoción";
	$subtitle = "Publicaciones por Promoción";
	
	$data = array();
	
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;		
	
	$data['id_promo_padre'] = $_GET['id_promo_padre'];	
	
	$dist_promo= array();
	
	$path_promos_especiales = "./json/promociones_padre/promo_padre_".$data['id_promo_padre'].".json";
	if (file_exists($path_promos_especiales)) {
		$json = file_get_contents($path_promos_especiales);
		$jph = json_decode($json);	
		/*	
		echo "<pre>";
			print_r($jph);
		echo "</pre>";
		 */ 			
		//echo "promo_padre".$id_promo_padre;								
		
		foreach($jph as $i => $ph){
			if(count($dist_promo)>0){
				$repetido = 0;
				foreach($dist_promo as $j){
					if($ph->nombre == $j->nombre){
						$repetido = 1;	
					}				
				}			 		
				if($repetido == 0){		
					$dist_promo[] = $ph;
				}
			}		
			else{
				$dist_promo[]= $ph;
			}				
		}
		
		$agrupadas = array();
		foreach($dist_promo as $p){
			foreach($jph as $k => $promo){
				if($promo->nombre == $p->nombre)
					$agrupadas[($p->nombre)][]= $promo;
			}			 
		}
		//se pasan a la vista las promociones hijas obtenidas para la promocion padre
		/*
		echo count($jph);		
		 * 
		 */	
		$data["promociones_hijas"] = $dist_promo;
					
	}
	
	if(!isset($_GET['publicacion'])){
		if(count($dist_promo) >1){						
			cargar_vista('promociones_hijas', $data);
		}	
		else{
			$dist_promo = end($dist_promo);			 			
			$data['detalles_promociones'] = obtiene_detalle_promos($dist_promo->nombre, $agrupadas); 			
			cargar_vista('promos_publicacion_detalle', $data);
		}
	}
	else if($_GET['publicacion']){
		$pub = str_replace('_', ' ', $_GET['publicacion']);
		$pub = str_replace('.', '&', $pub);		
		if(array_key_exists($pub, $agrupadas)){			
			$data['detalles_promociones'] = obtiene_detalle_promos($pub, $agrupadas);			
			cargar_vista('promos_publicacion_detalle', $data);		
		}					
		
	}	
		
	/// obtiene el detalle completo de las promociones que se agruparon recibe como parametro el nombre de lapublicacion y las agrupadas
	function obtiene_detalle_promos($nombre_pub, $agrupadas){
		$detalle_promos = array();
		foreach($agrupadas[$nombre_pub] as $p){
			$path_promos = "./json/detalle_promociones/detalle_promo_".$p->id_promocion.".json";
			if (file_exists($path_promos)) {
				$json = file_get_contents($path_promos);
				$jph = json_decode($json);
				$detalle_promos[] = end($jph);
			}			
		}		 	
				
		return $detalle_promos; 
	}	
		
	exit;
?>
