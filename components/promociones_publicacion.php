<div class="contenedor-promo">
<?php	
	/*despliega las promociones de una publicación */
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
		
		$action = TIENDA . "carrito.php?id_sitio=" . $p->detalle->id_sitio . "&id_canal=" . $p->detalle->id_canal . "&id_promocion=" . $p->detalle->id_promocion;
		$action_form = ECOMMERCE."api/". $p->detalle->id_sitio . "/" . $p->detalle->id_canal . "/" . $p->detalle->id_promocion . "/pago";
		$onclick_action = "document.comprar_promocion" . $p->detalle->id_promocion . ".action='" . $action . "'; ";
		$onclick_event = "document.comprar_promocion".$p->detalle->id_promocion.".submit()";
		
		
		echo "
		<form name='comprar_promocion".$p->detalle->id_promocion."' action='". $action_form ."' method='post'>
			<div class='promo-left'>
				<input type='hidden' name='guidx' value='".API::GUIDX."' />
			    <input type='hidden' name='guidz' value='".API::guid()."' />
			    <input type='hidden' name='imagen' value='".TIENDA."images/img3.jpg' />
			    <input type='hidden' name='descripcion' value='".$p->descripcion_promocion."' />
			    <input type='hidden' name='precio' value='".$p->detalle->costo."' />
			    <input type='hidden' name='cantidad' value='1' />
			    
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
?>
</div>
