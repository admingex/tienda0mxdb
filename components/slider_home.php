<div id='contenido_carrusel'>
	<div class="carrusel_slide">
		<div>		
			<div id="featured"> 
			<?php	  
			$path_promos_carrusel = "./json/carrusel_home.json";					  
	    	//$path_promos_carrusel = "./json/home_promociones_destacadas.json";
		
			if (file_exists($path_promos_carrusel)) {
			
				$json = file_get_contents($path_promos_carrusel);
				$cp = json_decode($json);			
				$items = count($cp->promos_carrusel);			
			
			
				// se añaden las promociones padre para incluirlas en el carrusel
				/*
				$path_promo_padre = "./json/promociones_padre/promos_padre.json";	
				if (file_exists($path_promo_padre)) {
					$json = file_get_contents($path_promo_padre);
					$promos_padre = json_decode($json);										
					foreach($promos_padre as $p ){
						if($p->descripcion_canal=="HOME PROMOCION DESTACADA"){						
							$cp->homo_promos_destacada[($items)] = $p;
							$items++;
						}					
					} 								
				}	
				*/		
										
				//$rand = rand(0, ($items-1));	
				//$p	= $cp->homo_promos_destacada[$rand];
				//echo "<pre>";
				//	print_r($cp->homo_promos_destacada);
				//echo "</pre>";
			
				foreach ($cp->promos_carrusel as $p) {
					if(isset($p->promo_padre)){
						$url_p = TIENDA ."promocion_h.php?id_promo_padre=" .$p->id_promocionIn;	
					} else{
						$url_p = TIENDA ."promocion/" .$p->id_promocion;	
					}				
					echo "<a href='".$url_p."'><img src='".TIENDA. "p_images/" .$p->url_imagen."' width='530px' height='310px' /></a>";
				}														
			}		    					
			?>						  						 											
			</div>						
		</div>		
	</div>	
	<div class="columna_derecha" >
		<div class="titulos">
			<div>
				<img src="<?php echo TIENDA?>images/kiosco_contenido_logo.png" />
			</div>
		</div>	
		<div class="spread">
		    <img src="<?php echo TIENDA?>images/kiosco_contenido_spread.png" />	
		</div>	
		<div class="promo_destacada">
							
		    <?php
			/*
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
					echo "	<a href='".$url_p."'>							
								<img src='".TIENDA. "contenido_images/" .$p->url_imagen."' width='530px' height='310px' />
							</a>";
				}														
			}		    
			*/
			?>
		</div>
		<div class="pleca_apps">
			<div class="apps">APPS</div>
			<a href='exp'><div class='links expan'></div></a>
			<a href='quo'><div class='links quo'></div></a>
			<a href='chi'><div class='links chi'></div></a>
			<a href='cnn'><div class='links cnn'></div></a>						
		</div>		
	</div>
</div>