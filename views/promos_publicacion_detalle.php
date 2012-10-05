<?php
	/**
	 * Mostrará el detalle de una promoción final dependiendo del order code type del primer art;iculo de la promoción consultada.
	 * En principio se encargará del despliegue de promociones consultadas a través de una publicación,
	 * y se espera que sea la base para mostrar los detalles de promociones que se consultan a través de los distintos canales
	 * de la tienda, como son el "Home"/ Inicio, el carrusel, las búsquedas del encabezado de la tienda, promociones especiales y
	 * las promociones destacadas de categorías, publicaciones, etc.
	 */

	// formación del breadcum correspondiente en base a la publicación
	if (isset($info_publicacion)) {
		//si el flujo proviene de un listado de categoría...se incluye esta parte para la navegación
		$url_breadcum 	= (isset($info_categoria)) 	? site_url("categoria/".$info_categoria->id_categoriaSi) : NULL;
		$bread_cat 		= (!empty($url_breadcum))	? " <a href='$url_breadcum'> ".ucwords(strtolower($info_categoria->nombreVc))."</a><div class='triangulo-negro-der'></div>" : '';
		$bread_pub 		= '';
		$desc_producto	= '';	//descripción mostrada del tipo de artículo en la promoción
		
		//formación del breadcum de la publicación
		if ($info_publicacion->formatos > 1) {
			$bread_pub 	= (!empty($url_breadcum))	? " <a href='$url_breadcum/publicacion/ofertas/$info_publicacion->id_publicacionSi'> ".$info_publicacion->nombreVc."</a> " 
			: " <a href='".site_url("publicacion/ofertas/$info_publicacion->id_publicacionSi"). "'> ".$info_publicacion->nombreVc."</a> ";
		} else {
			$bread_pub 	= (!empty($url_breadcum))	? " <a href='$url_breadcum/publicacion/detalle/$info_publicacion->id_publicacionSi'> ".$info_publicacion->nombreVc."</a> " 
			: " <a href='".site_url("publicacion/detalle/$info_publicacion->id_publicacionSi"). "'> ".$info_publicacion->nombreVc."</a> ";
		}
		
		//catálogo de descripciones del tipo de artículo principal de la promoción
		$order_code_cat = array(
			0	=> 	"Suscripción",				//"Subscription",
			1	=>	"PDF / Ejemplar Suelto",	//"Single Copy",	//PDF
			2	=>	"Producto",					//"Product",		//Seminario
			3	=>	"PDF"						//"Electronic Document"	//PDF
		);
		
		//ya que se mostrará el detalle de una promoción, se verifica por dicho arreglo de información
		if (isset($detalles_promociones) && count($detalles_promociones) > 0) {
			$oc = $detalles_promociones[0]->order_code_type;
			$desc_producto 	= " <div class='triangulo-negro-der'></div><div class='noref'>". $order_code_cat[$oc] . "</div>";
		}
		
		//breadcum final para el detalle de promoción
		echo "<div id='breadcrumbs'><a href='".site_url("home")."'>Home</a><div class='triangulo-negro-der'></div>". $bread_cat . $bread_pub . $desc_producto ."</div>";
		//echo "<div><h3><a href='".site_url("home")."'> Home </a> > ". $bread_cat ." <a href=''>".ucwords(strtolower($info_publicacion->nombreVc))."</a></h3></div>";
		
		//echo $info_publicacion->formatos;
		
		//si hay promoción, incluir el componente para desplegar el detalle de la promoción en base al order code type de la primera promoción
	}
	#### NOTA:
		/**
		 * La información de "$ofertas_publicacion" sólo viene cuando se hace una consulta directa a una publicación que no tiene más de un formato,
		 * de otro modo, sólo se trae el detalle de uns promoción en particular. Esto cambiará conforme se detallen las distintas consultas en la tienda.
		 * 
		 * La información en "$detalles_promociones" viene siempre, ya sea por consultas desde PUBLICACIONES o directas en PROMOCIONES.
		 */ 
		//echo "<pre>";
		//print_r($info_publicacion);
		//print_r($ofertas_publicacion);
		//print_r($secciones);
		//print_r($detalles_promociones);	//siempre viene
		//echo "</pre>";
		
	### //despliegue del detalle de la promoción si es que hay alguno
	if (!empty($detalles_promociones)) {
		switch ($detalles_promociones[0]->order_code_type) {
			case 0:
				//suscripciones
				include_once('./components/suscripcion.php');
				break;
			case 1:
				//material web, PDFs...
				$detalle_promocion = $detalles_promociones[0];
				include_once('./components/pdf.php');
				break;
			case 2:
				//seminarios / carpetas / etc. / productos, en el componente se trata el "detalle"
				$detalle_promocion = $detalles_promociones[0];
				include_once('./components/seminario.php');
				break;
			case 3:
				//pdfs, por el momento se trata de la misma manera que productos.
				$detalle_promocion = $detalles_promociones[0];
				include_once('./components/pdf.php');
				break;
			default:
				//nada, tal vez ir al home...
				break;
		}
	}

// fin del archivo de la vista que despliega el detalle de las promociones de una publicación: "promos_publicacion_detalle.php"
