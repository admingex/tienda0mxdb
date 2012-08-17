<?php
	/*Motrará una promoción final dependiendo del order code*/

	//se revisa si el objeto con la información existe
	if (isset($info_publicacion)) {
		//si el flujo proviene de un istado de categoría...
		$url_breadcum 	= (isset($info_categoria)) 	? site_url("categoria/".$info_categoria->id_categoriaSi) : NULL;
		$bread_cat 		= (!empty($url_breadcum))	? " <a href='$url_breadcum'> ".ucwords(strtolower($info_categoria->nombreVc))."</a> > " : '';
		$bread_pub 		= '';
		
		//Para cuando se regresa del datalle
		if ($info_publicacion->formatos > 1) {
			//$bread_pub 	= " <a href='".site_url("publicacion/ofertas/$info_publicacion->id_publicacionSi"). "'> ".ucwords(strtolower($info_publicacion->nombreVc))."</a> ";
			$bread_pub 	= (!empty($url_breadcum))	? " <a href='$url_breadcum/publicacion/ofertas/$info_publicacion->id_publicacionSi'> ".ucwords(strtolower($info_publicacion->nombreVc))."</a> " 
			: " <a href='".site_url("publicacion/ofertas/$info_publicacion->id_publicacionSi"). "'> ".ucwords(strtolower($info_publicacion->nombreVc))."</a> ";
		} else {
			//$bread_pub 	= " <a href='".site_url("publicacion/detalle/$info_publicacion->id_publicacionSi"). "'> ".ucwords(strtolower($info_publicacion->nombreVc))."</a> ";
			$bread_pub 	= (!empty($url_breadcum))	? " <a href='$url_breadcum/publicacion/detalle/$info_publicacion->id_publicacionSi'> ".ucwords(strtolower($info_publicacion->nombreVc))."</a> " 
			: " <a href='".site_url("publicacion/detalle/$info_publicacion->id_publicacionSi"). "'> ".ucwords(strtolower($info_publicacion->nombreVc))."</a> ";
		}
		
		//breadcum
		echo "<div><h3><a href='".site_url("home")."'> Home </a> > ". $bread_cat . $bread_pub ;//" <a href='$bread_pub'>".ucwords(strtolower($info_publicacion->nombreVc))."</a></h3></div>";
		echo "<br/>detalle_promocion_general<br/>";
		
		echo $info_publicacion->formatos;
		
		$oc = $detalles_promociones[0]->order_code_type;
		
		echo "order_code_type: $oc<pre>";
		//if (isset($info_publicacion)) print_r($info_publicacion);
		//if (isset($info_categoria)) print_r($info_categoria);
		//if (isset($detalles_promociones)) print_r($detalles_promociones);
		echo "</pre>";
		
		$order_code_cat = array(
			0	=> 	"Subscription",
			1	=>	"Single Copy",	//PDF
			2	=>	"Product",		//Seminario
			3	=>	"Electronic Document"	//PDF
		);
		
		if (!empty($detalles_promociones)) {
			switch ($detalles_promociones[0]->order_code_type) {
				case 0:
					include_once('./components/suscripcion.php');
					//echo "Ya quedó SUSCR";
					break;
				case 1:
					//material web, PDFs...
					$detalle_promocion = $detalles_promociones[0];
					include_once('./components/pdf.php');
					break;
				case 2:
					//seminarios / carpetas / etc. / productos
					include_once('./components/producto.php');
					break;
				case 3:
					include_once('./components/pdf.php');
					break;
				default:
					
					break;
			}
		}

	}

// fin del archivo de la vista del detalle de las promociones: promos_publicacion_detalle.php
