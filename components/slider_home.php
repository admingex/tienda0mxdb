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
				
				$path_promo_padre = "./json/promociones_padre/promos_padre.json";	
				if (file_exists($path_promo_padre)) {
					$json = file_get_contents($path_promo_padre);
					$promos_padre = json_decode($json);										
					foreach($promos_padre as $p ){
						if($p->descripcion_canal=="HOME CARRUSEL"){						
							$cp->promos_carrusel[($items)] = $p;
							$items++;
						}					
					} 								
				}	
					
						
			
				foreach ($cp->promos_carrusel as $p) {
					if ($p->publicado == 1) {
						if(isset($p->promo_padre)) {
							$url_p = TIENDA ."promocion_h/" .$p->id_promocionIn;
						} else {
							$url_p = TIENDA ."promocion/" .$p->id_promocion;
						}
						echo "<a href='".$url_p."'><img src='".TIENDA. "p_images/" .$p->url_imagen."' width='530px' height='310px' /></a>";
					}
				}
			}		    					
			?>						  						 											
			</div>						
		</div>		
	</div>	
	<div class="columna_derecha" >
		<?php
			$path_promos_destacada = "./json/home_promociones_destacadas.json";					  
	    	//$path_promos_carrusel = "./json/home_promociones_destacadas.json";
		
			if (file_exists($path_promos_destacada)) {
			
				$json = file_get_contents($path_promos_destacada);
				$cp = json_decode($json);
				
				
				$items = count($cp->homo_promos_destacada);
				//para ver cual promocion se va a incluir con el random
				$ind = rand(0, ($items-1));
				
			}			
		?>		
		<div class="titulos">
			<div>
				<a href='<?php echo TIENDA."promocion/" .$cp->homo_promos_destacada[$ind]->id_promocion;?>'><img src="<?php echo TIENDA."p_images/".$cp->homo_promos_destacada[$ind]->imagen_eslogan?>" /></a>
			</div>
		</div>	
		<div class="spread">
			<div>
		    	<a href='<?php echo TIENDA."promocion/" .$cp->homo_promos_destacada[$ind]->id_promocion;?>'><img src="<?php echo TIENDA."p_images/".$cp->homo_promos_destacada[$ind]->imagen_portada?>" /></a>
		    </div>		
		</div>												  
		<?php
			$path_apps = "./json/apps.json";					  
	    	//$path_promos_carrusel = "./json/home_promociones_destacadas.json";
		
			if (file_exists($path_apps)) {
			
				$json = file_get_contents($path_apps);
				$apps = json_decode($json);
			}	
			
			
		?>
		<div class="pleca_apps">
			<div class="apps">APPS</div>
			<a href='http://itunes.apple.com/mx/app/expansion/id447270447?mt=8' target="_blank"><div class='links expan'></div></a>
			<a href='https://play.google.com/store/apps/details?id=com.aurasma.skinned.quo_en_vivo' target="_blank"><div class='links quo'></div></a>
			<a href='http://itunes.apple.com/mx/app/chilango/id474609773' target="_blank"><div class='links chi'></div></a>
			<a href='http://itunes.apple.com/mx/app/cnnexpansion/id332010537' target="_blank"><div class='links cnn'></div></a>						
		</div>		
	</div>
</div>		
