<?php
	/*Motrará una promoción final dependiendo del order code */

	// encabezado de la categoría
	if (isset($info_publicacion)) {
		//si el flujo proviene de un istado de categoría...
		$url_breadcum 	= (isset($info_categoria)) 	? site_url("categoria/".$info_categoria->id_categoriaSi) : NULL;
		$bread_cat 		= (!empty($url_breadcum))	? " <a href='$url_breadcum'> ".ucwords(strtolower($info_categoria->nombreVc))."</a> > " : '';
		
		//breadcum
		echo "<div><h3><a href='".site_url("home")."'> Home </a> > ". $bread_cat ." <a href=''>".ucwords(strtolower($info_publicacion->nombreVc))."</a></h3></div>";
	}
	
	##### Promos destacadas por publicación
	
	##### Filtro por formatos y precio
	
	
	if (isset($ofertas_publicacion)) {
		//último nivel de detalle
		include_once('./components/promociones_publicacion.php');
		exit;
	}