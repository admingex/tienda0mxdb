<?php
	$json = file_get_contents('json/promociones-especiales.js');
	$data = json_decode($json);
	
	if (count($data->promocion_especial_destacada) != 0)
	
	foreach ($data->promocion_especial_destacada as $j) {
?>
<div class="container">
	<div id="images">
	    <?php
		echo "
			<form name='comprar_promocion_destacada' action='".ECOMMERCE."api/". $j->id_sitioSi."/".$j->id_canalSi."/".$j->id_promocionIn."/pago' method='post'>
			  	<div class='promo-left'>
			      	<input type='hidden' name='guidx' value='".API::GUIDX."'/>
			      	<input type='hidden' name='guidz' value='".API::guid()."'/>
			      	<a href=''><img src='".TIENDA.$j->url_imagenVc."'/></a>
			      	<div class='descripcion'>".$j->descripcionVc."</div>
			      	<div class='descripcion'>".$j->tarifaDc."</div>
			      	<div class='descripcion'>
			          	<input type='submit' name='comprar_ahora' value=''/>
			      	</div>
	    		</div>
	      	</form>
      		<img src='".TIENDA.$j->url_imagenVc."' onclick='document.comprar_promocion_destacada.submit();'/>";
		?>
	</div>
</div>
<?php
	}
?>
<div class="contenedor-promo">
<?php
	foreach ($data->promociones_especiales as $v) {
		echo "
			<form name='comprar_promocion_especial' action='".ECOMMERCE."api/". $v->id_sitioSi."/".$v->id_canalSi."/".$v->id_promocionIn."/pago' method='post'>
				<div class='promo-left'>
				    <input type='hidden' name='guidx' value='".API::GUIDX."' />
			     	<input type='hidden' name='guidz' value='".API::guid()."' />
			    	<a href=''><img src='".TIENDA.$v->url_imagenVc."' /></a>
			      	<div class='descripcion'>".$v->descripcionVc."</div>
			      	<div class='descripcion'>".$v->tarifaDc."</div>
			      	<div class='descripcion'>
		          		<input type='submit' name='comprar_ahora' value=' ' class='boton_continuar_compra' />
			      	</div>
	      		</div>
	      </form>";
	}
?>
</div>
