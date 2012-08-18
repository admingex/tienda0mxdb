<div class="contenedor-promo">	
<?php				    
	
	//Sacar la información de la categoría
	$path_promos_home = "./json/promociones_home.json";
	
	if (file_exists($path_promos_home)) {
		$json = file_get_contents($path_promos_home);
		$promos_home = json_decode($json);
		
		//obtener la información de la categoría que se consulta
		foreach ($promos_home->promos_home as $p) {
			$url_detalle_promo = TIENDA ."promocion/" . $p->id_promocion;
			
			echo "
				<form name='comprar_home' action='". ECOMMERCE . "api/". $p->id_sitio . "/" . $p->id_canal . "/" . $p->id_promocion ."/pago' method='post'>
					<div class='promo-left'>
		    	  		<input type='hidden' name='guidx' value='".API::GUIDX."' />
				      	<input type='hidden' name='guidz' value='".API::guid()."' />
				      	<a href='". $url_detalle_promo ."'>
				      		<img src='" . TIENDA . "images/promociones/" . $p->imagen_tumb . "' />
				      	</a>
				      	<a href='". $url_detalle_promo . "'>" . $p->descripcion_promocion  . "</a>
				      	<div class='descripcion'>" . $p->descripcion_corta_publicacion . "</div>
				      	<div class='descripcion'>" . $p->costo . " " . $p->descuento_promocion ."</div>
				      	<div class='descripcion'>
				          	<input type='submit' name='comprar_ahora' value=' ' class='boton_continuar_compra' />
				      	</div>
			      	</div>
		      	</form>";
		}
	}
?>
</div>
