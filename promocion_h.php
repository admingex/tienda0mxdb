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
	
	$path_promos_especiales = "./json/promociones_padre/promo_padre_".$data['id_promo_padre'].".json";
	if (file_exists($path_promos_especiales)) {
		$json = file_get_contents($path_promos_especiales);
		$jph = json_decode($json);		
					
		//se pasan a la vista las promociones hijas obtenidas para la promocion padre
		$data["promociones_hijas"] = $jph;
					
	}
		
	cargar_vista('promociones_hijas', $data);
	
	exit;
?>
