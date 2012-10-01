<div class="container">		
	<div id="featured"> 				
	    <?php
	    
	    //Sacar la información de la categoría
		$path_promos_carrusel = "./json/carrusel_home.json";
		
		if (file_exists($path_promos_carrusel)) {
			
			$json = file_get_contents($path_promos_carrusel);
			$cp = json_decode($json);
			
			foreach ($cp->promos_carrusel as $p) {
				$url_p = TIENDA ."promocion/" .$p->id_promocion;
				echo "<a href='".$url_p."'><img src='".TIENDA. "p_images/" .$p->url_imagen."' width='529px' height='246px' /></a>";
			}
		}		
		$path_promo_padre_carrusel = "./json/promociones_padre/promos_padre.json";	
		if (file_exists($path_promo_padre_carrusel)) {
			$json = file_get_contents($path_promo_padre_carrusel);
			$promos_padre = json_decode($json);								
			foreach($promos_padre as $p ){
				if($p->descripcion_canal=="HOME CARRUSEL"){					
					$url_p = TIENDA ."promocion_h/" .$p->id_promocionIn;
					echo "<a href='".$url_p."'><img src='".TIENDA. "p_images/" .$p->url_imagen."' width='529px' height='246px' />$p->url_imagen</a>";						
				}				
			} 								
		}		
					
		?>					  						 											
	</div>						
</div>	