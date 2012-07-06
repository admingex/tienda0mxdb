<div class="contenedor-promo">	
	<?php				    
		$json = file_get_contents('json/promociones-especiales.js');
		$data = json_decode($json);				
			foreach($data->promociones_especiales as $v){
				echo "<form name='comprar_home' action='http://localhost/ecommerce/api/". $v->id_sitioSi."/".$v->id_canalSi."/".$v->id_promocionIn."/pago' method='post'>
					  <div class='promo-left'>
					      <input type='hidden' name='guidx' value='".GUIDX."' />					      
					      <input type='hidden' name='guidz' value='".guid()."' />
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
