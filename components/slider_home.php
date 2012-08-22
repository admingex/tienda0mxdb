<div class="container">		
	<div id="featured"> 				
	    <?php
	    //Sacar la información de la categoría
		$path_promos_carrusel = "./json/carrusel_home.json";
		
		if (file_exists($path_promos_carrusel)) {
			
			$json = file_get_contents($path_promos_carrusel);
			$cp = json_decode($json);
			
			foreach ($cp->promos_carrusel as $p) {
				$url_p = TIENDA."promocion/". $p->id_promocion;
				echo "<a href='".$url_p."'><img src='".TIENDA.$p->url_imagen."' /></a>";
			}
		}	
		?>					  						 											
	</div>						
</div>	