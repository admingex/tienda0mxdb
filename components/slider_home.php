<div class="container">		
	<div id="images"> 				
	    <?php				    
			$json = file_get_contents('./json/slider_home.json');
			$data = json_decode($json);				
				foreach($data->imagenes as $k){
					if(!empty($k->linkPromocion)){
						echo "<a href='".$k->linkPromocion."'><img src='".TIENDA.$k->urlImagen."' /></a>";		
					}
					else{
						echo "<img src='".TIENDA.$k->urlImagen."' />";
					}					
				}	
		?>					  						 											
	</div>						
</div>	
