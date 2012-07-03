<div class="container">		
	<div id="images"> 				
	    <?php				    
			$json = file_get_contents('json/sliderhome.js');
			$data = json_decode($json);				
				foreach($data->imagenes as $k){
					if(!empty($k->linkPromocion)){
						echo "<a href='".$k->linkPromocion."'><img src='".$k->urlImagen."' /></a>";		
					}
					else{
						echo "<img src='".$k->urlImagen."' />";
					}					
				}	
		?>					  						 											
	</div>						
</div>	
