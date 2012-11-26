<?php
	/** 
	 * Mostrará el listado de promocionesde una publicación que tiene promociones en diferentes formatos,
	 * además de permitir filtrarlas por formato y precio 
	
	echo "<pre>"; 
	print_r($ofertas_publicacion);
	echo "</pre>";
	*/
	// formación del breadcum correspondiente
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
	
	##### Promos destacadas por publicación
	##comente esta opcion falta definir el estilo para que no aparesca en el header
	if (isset($pd) && count($pd) == 1) {
		//include_once('./components/promocion_destacada.php');
	}
	##### Filtro por formatos y precio
	if (isset($formatos)) {
		echo "<script type='text/javascript' src='".TIENDA."js/filtro_formato.js'></script>";
		echo "<script type='text/javascript' src='".TIENDA."js/slide.js'></script>";
		echo "<script type='text/javascript' src='".TIENDA."js/funcion_slide.js'></script>";
		//$scripts [] = TIENDA."js/funcion_slide.js";
		//include_once('./components/filtro_formatos.php');
		/*echo "<pre>";
			print_r($formatos);
		echo "</pre>";
		 * 
		 */		
		##incluye el html de formatos para el canal idc es necesario que no se haya elegido ningun formato por medio del POST
		if( !$_POST && $info_publicacion->nombreVc == "IDC" ){		
			include ("views/canal_idc.php");
		}
		
		if( !$_POST && $info_publicacion->nombreVc == "Expansión" ){		
			include ("views/canal_exp.php");			
		}
		
	}
	#### Promociones de la publicación (listado)
	## agregue $_POST para obligar a que se seleccione por lo menos un filtro para poder mostrar las ofertas lo origino el nuevo diseño con las flechas para IDC
	if (isset($ofertas_publicacion) && $_POST) {
		//último nivel de detalle		

		echo "<link type='text/css' href='".TIENDA."css/viewlet-slide-idc.css' rel='stylesheet' />";		
		
		include_once('./components/promociones_publicacion.php');
		//exit;
	}
// fin del archivo de la vista que despliega las promociones de una publicación con más de un formato asociado: "promos_publicacion_ofertas.php"