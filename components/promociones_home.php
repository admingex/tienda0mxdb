<div class="contenedor-promo">	
<?php				    
	$json = file_get_contents('./json/promociones_home.json');
	$data = json_decode($json);
	foreach ($data->promociones as $v) {
		echo "
			<form name='comprar_home' action='http://localhost/ecommerce/api/3/24/54/pago' method='post'>
				<div class='promo-left'>
	    	  		<input type='hidden' name='guidx' value='".API::GUIDX."' />
			      	<input type='hidden' name='guidz' value='".API::guid()."' />
			      	<a href='".$v->linkPromocion."'><img src='".TIENDA.$v->urltumb."' /></a>
			      	<a href='".$v->linkPromocion."'>".$v->tituloPromocion."</a>
			      	<div class='descripcion'>".$v->descripcionPromocion."</div>
			      	<div class='descripcion'>".$v->precioPromocion."</div>
			      	<div class='descripcion'>
			          	<input type='submit' name='comprar_ahora' value=' ' class='boton_continuar_compra' />
			      	</div>
		      	</div>
	      	</form>";
	}
?>
</div>