
<?php
	/*Motrará una promoción final dependiendo del order code*/

	// encabezado de la categoría
	if (isset($info_publicacion)) {
		//si el flujo proviene de un istado de categoría...
		$url_breadcum 	= (isset($info_categoria)) 	? site_url("categoria/".$info_categoria->id_categoriaSi) : NULL;
		$bread_cat 		= (!empty($url_breadcum))	? " <a href='$url_breadcum'> ".ucwords(strtolower($info_categoria->nombreVc))."</a> > " : '';
		
		//breadcum
		echo "<div><h3><a href='".site_url("home")."'> Home </a> > ". $bread_cat ." <a href=''>".ucwords(strtolower($info_publicacion->nombreVc))."</a></h3></div>";
	}
?>
<div class="contenedor-promo">
<?php	
	if (isset($mostrar)){
		//echo $mostrar."";
	} else { 
		//echo $pubs_m."<br/>";
	}
	if (isset($ofertas_publicacion)) {
		echo "<pre>";
		print_r($ofertas_publicacion);
		print_r($detalles_promociones);
		echo "</pre>";
		
		/*Despliega las publicaciones de una categoría*/
		foreach ($ofertas_publicacion->promociones as $p) {
			//url de la puclicación
			$url_p = '';
			/*
			if($p->formatos > 1) {
				//URL para que se vaya a la lista de promociones y se pueda filtrar por formatos y precios
				$url_p = site_url('categoria/'.$p->id_categoria.'/publicacion/ofertas/') . $p->id_publicacion;
			} else {
				//Si no trae más de un formato, ir al detalle de la promoción: suscripción / producto / PDF
				$url_p = site_url('categoria/'.$p->id_categoria.'/publicacion/detalle/') . $p->id_publicacion;
			}
			*/
			echo "
				<div class='promo-left'>
			    	<a href='". $url_p . "'><img src='".TIENDA."images/img3.jpg' /></a>
			      	<div class='descripcion'>".$p->descripcion_promocion."</div>
			      	<div class='descripcion'>"./*$p->id_formato."-".strlen($p->desc_publicacion).*/"</div>
	      		</div>
		      ";
		}
		
	}
	
?>

</div>