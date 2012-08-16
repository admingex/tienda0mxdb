
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
		//echo "<pre>";
		//print_r($ofertas_publicacion);
		//print_r($detalles_promociones);
		//echo "</pre>";
		
		/*Despliega las publicaciones de una categoría*/
		foreach ($ofertas_publicacion->promociones as $p) {
		/*foreach ($detalles_promociones as $detalle) {
			echo "<pre>";
			print_r((object)$detalle[0]);
			echo "</pre>";
			echo $detalle[0]->id_sitio."<br/>";
		}
		*/
			//url de la promoción para el detalle final de la promoción
			$url_promo = '';
			$url_promo = site_url((isset($id_categoria) ? 'categoria/' . $id_categoria.'/' : '') . (isset($id_publicacion) ? 'publicacion/' . $id_publicacion. '/' : '') .'promocion/' . $p->detalle->id_promocion);
			
			//$url_promo = site_url('categoria/'.$info_publicacion->id_categoria.'/publicacion/ofertas/') . $info_publicacion->id_publicacion;
			
			/*if ($info_publicacion->formatos > 1) {
				//URL para que se vaya a la lista de promociones y se pueda filtrar por formatos y precios
				$url_p = site_url('categoria/'.$info_publicacion->id_categoria.'/publicacion/ofertas/') . $info_publicacion->id_publicacion;
			} else {
				//Si no trae más de un formato, ir al detalle de la promoción: suscripción / producto / PDF
				$url_p = site_url('categoria/'.$info_publicacion->id_categoria.'/publicacion/detalle/') . $info_publicacion->id_publicacion;
			}
			*/
			
			
			$action = TIENDA . "carrito.php?id_sitio=" . $p->detalle->id_sitio . "&id_canal=" . $p->detalle->id_canal . "&id_promocion=" . $p->detalle->id_promocion;
			$action_form = ECOMMERCE."api/". $p->detalle->id_sitio . "/" . $p->detalle->id_canal . "/" . $p->detalle->id_promocion . "/pago";
			$onclick_action = "document.comprar_promocion" . $p->detalle->id_promocion . ".action='" . $action . "'; ";
			$onclick_event = "document.comprar_promocion".$p->detalle->id_promocion.".submit()";
			
			
			echo "
			<form name='comprar_promocion".$p->detalle->id_promocion."' action='". $action_form ."' method='post'>
				<div class='promo-left'>
			    	<a href='". $url_promo . "'><img src='".TIENDA."images/img3.jpg' /></a>
			      	<div class='descripcion'>".$p->descripcion_promocion."</div>
			      	<div class='descripcion'>".$p->detalle->costo."</div>
			      	<div class='descripcion'>"./*$p->id_formato."-".strlen($p->desc_publicacion).*/"</div>
			      	<div class='descripcion'>
		          		<input type='submit' name='btn_comprar_ahora' value=' ' class='boton_continuar_compra' />
			      	</div>
			      	<div class='descripcion'>
		          		<input type='button' name='btn_agregar_carrito' value='Añadir al Carrito' onclick=\"$onclick_action $onclick_event \"/>
			      	</div>
	      		</div>
	      	</form>";
		}
		/*echo $_SERVER['DOCUMENT_ROOT']."<br/>";
		echo TIENDA;
		 * 
		 */
	}
	
?>

</div>