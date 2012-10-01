<div class="container">		
	<div id="featured"> 				
	    <?php
	    
	    $path_promos_carrusel = "./json/carrusel_home.json";
		
		if (file_exists($path_promos_carrusel)) {
			
			$json = file_get_contents($path_promos_carrusel);
			$cp = json_decode($json);
			$items = count($cp->promos_carrusel);			
			
			// se añaden las promociones padre para incluirlas en el carrusel
			$path_promo_padre_carrusel = "./json/promociones_padre/promos_padre.json";	
			if (file_exists($path_promo_padre_carrusel)) {
				$json = file_get_contents($path_promo_padre_carrusel);
				$promos_padre = json_decode($json);								
				foreach($promos_padre as $p ){
					if($p->descripcion_canal=="HOME CARRUSEL"){						
						$cp->promos_carrusel[($items+1)] = $p;
						$items++;
					}					
				} 								
			}	
							
			foreach ($cp->promos_carrusel as $p) {
				if(isset($p->promo_padre)){
					$url_p = TIENDA ."promocion_h.php?id_promo_padre=" .$p->id_promocionIn;	
				} else{
					$url_p = TIENDA ."promocion/" .$p->id_promocion;	
				}				
				echo "<a href='".$url_p."'><img src='".TIENDA. "p_images/" .$p->url_imagen."' width='529px' height='246px' /></a>";
			}														
		}		    
					
		?>					  						 											
	</div>						
</div>	