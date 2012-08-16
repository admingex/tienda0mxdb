<?php
	/*Motrará una promoción final dependiendo del order code*/

	//se revisa si el objeto con la información existe
	if (isset($info_publicacion)) {
		//si el flujo proviene de un istado de categoría...
		$url_breadcum 	= (isset($info_categoria)) 	? site_url("categoria/".$info_categoria->id_categoriaSi) : NULL;
		$bread_cat 		= (!empty($url_breadcum))	? " <a href='$url_breadcum'> ".ucwords(strtolower($info_categoria->nombreVc))."</a> > " : '';
		
		//breadcum
		echo "<div><h3><a href='".site_url("home")."'> Home </a> > ". $bread_cat ." <a href=''>".ucwords(strtolower($info_publicacion->nombreVc))."</a></h3></div>";
		//echo $info_publicacion->formatos;
		
		echo "<pre>";
		//print_r($info_publicacion);
		//print_r($ofertas_publicacion);
		//print_r($detalles_promociones);
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
					include_once('./components/pdf.php');
					break;
				case 2:
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