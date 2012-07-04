<div class="contenedor-promo">	
	<?php				    
		$json = file_get_contents('json/promocioneshome.js');
		$data = json_decode($json);				
			foreach($data->promociones as $v){
				echo "<div class='promo-left'>
					      <img src='".TIENDA.$v->urltumb."' />	
					      <a href='".$v->linkPromocion."'>".$v->tituloPromocion."</a>
					      <div class='descripcion'>".$v->descripcionPromocion."
					      </div>
					      <div class='descripcion'>".$v->precioPromocion."
					      </div>
				      </div>";							
			}	
	?>
</div>	
