<?php
	/*Motrará una promoción final dependiendo del order code*/

	//se revisa si el objeto con la información existe
	if (isset($info_publicacion)) {
		//si el flujo proviene de un istado de categoría...
		$url_breadcum 	= (isset($info_categoria)) 	? site_url("categoria/".$info_categoria->id_categoriaSi) : NULL;
		$bread_cat 		= (!empty($url_breadcum))	? " <a href='$url_breadcum'> ".ucwords(strtolower($info_categoria->nombreVc))."</a> > " : '';
		
		//breadcum
		echo "<div><h3><a href='".site_url("home")."'> Home </a> > ". $bread_cat ." <a href=''>".ucwords(strtolower($info_publicacion->nombreVc))."</a></h3></div>";
		//$info_publicacion->formatos
		
			/*echo "<pre>info_publicacion";
			 * //<p>$info_publicacion->descripcionVc</p>
			print_r($info_publicacion);
			echo "</pre>";
			exit;*/
	
	
		if (isset($mostrar)) {
			//echo $mostrar;
			include_once('./components/suscripcion.php');
		} else {
			echo $pubs_m."<br/>";
		}
	}