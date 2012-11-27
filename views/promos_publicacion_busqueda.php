<?php
	/** 
	 * Mostrará el listado de promocionesde una publicación que tiene promociones en diferentes formatos,
	 * además de permitir filtrarlas por formato y precio 
	/*	 
	echo "<pre>"; 
	print_r($ofertas_publicacion);
	echo "</pre>";
	*/
	// formación del breadcum correspondiente
	/*
	if (isset($info_publicacion)) {
		//si el flujo proviene de un listado de categoría...se incluye esta parte para la navegación
		$url_breadcum 	= (isset($info_categoria)) 	? site_url("categoria/".$info_categoria->id_categoriaSi) : NULL;
		$bread_cat 		= (!empty($url_breadcum))	? " <a href='$url_breadcum'> ".ucwords(strtolower($info_categoria->nombreVc))."</a><div class='triangulo-negro-der'></div>" : '';
		
		//la ruta de la publicación va siempre en este caso
		//$bread_pub		= " <a href=''>".ucwords(strtolower($info_publicacion->nombreVc))."</a></h3></div>";
		$bread_pub		= "<div class='noref'>" . $info_publicacion->nombreVc . "</div>";
		
		//breadcum final
		echo "<div id='breadcrumbs'><a href='".site_url("home")."'>Home</a><div class='triangulo-negro-der'></div>". $bread_cat . $bread_pub . "</div>";
	}
	*/
	##### Promos destacadas por publicación
	/*if (isset($pd) && count($pd) == 1) {
		include_once('./components/promocion_destacada.php');
	}*/
	##### Filtro por formatos y precio
	//if (isset($formatos)) {
	if ($total_promociones > MAX_PROMOS_PAGINA) {
		//echo "No se encontraron resultados en la búsqueda";
		echo "<script type='text/javascript' src='".TIENDA."js/filtro_formato.js'></script>";
		include_once('./components/filtro_orden.php');
	}		
//	}
	#### Promociones de la publicación (listado)
	
	if (isset($ofertas_publicacion) && count($ofertas_publicacion) > 0) {		
		//último nivel de detalle
		include_once('./components/promociones_publicacion.php');
		//exit;
	}
// fin del archivo de la vista que despliega las promociones de una publicación con más de un formato asociado: "promos_publicacion_ofertas.php"