<script type="text/javascript" src="<?php echo TIENDA;?>js/slide.js"></script>
<script type="text/javascript" src="<?php echo TIENDA;?>js/funcion_slide.js"></script>
<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-slide.css" rel="stylesheet" />
<div id='contenedor_slide'>
	<div class='list_carousel responsive'>
				<ul id='slider'>
<?php
	//echo "promo_padre".$id_promo_padre;		
	/*
	echo "<pre>";
		print_r($promociones_hijas);
	echo "</pre>";
	 * 
	 */	
	$dist_promo= array();
	
	foreach($promociones_hijas as $i => $ph){
		if(count($dist_promo)>0){
			$repetido = 0;
			foreach($dist_promo as $j){
				if($ph->nombre == $j->nombre){
					$repetido = 1;	
				}				
			}			 		
			if($repetido == 0){		
				$dist_promo[] = $ph;
			}
		}		
		else{
			$dist_promo[]= $ph;
		}				
	}		
	/*
	echo "<pre>";
		print_r($dist_promo);
	echo "</pre>";
	*/						
	
	foreach ($dist_promo as $p) {
		echo "<li>";			
		//url de la publicación
		$url_p = '';
		
		//Si no trae más de un formato, ir al detalle de la promoción: suscripción / producto / PDF
		$url_p = site_url('promocion/'. $p->id_promocion);
		
		//revisar que exista la imagen en caso contrario ponemos el cuadro negro						
		if(file_exists("./p_images/".$p->url_imagen)){
			$src = TIENDA ."p_images/".$p->url_imagen;
		}
		else{
			$src = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
			//$src = TIENDA ."p_images/".$p->url_imagen;
		}
		echo "
			<div class='catego-left'>
				<div class='contenedor-imagen'>
					<a href='". $url_p . "'>";																	
						echo "<img src='" . $src. "' />";																
		echo "		</a>
				</div>				
				<div class='titulo-categoria-back titulo-categoria'>
					".$p->nombre."						
				</div>
				<div class='descripcion-promocion-back descripcion-promocion'>
					".$p->descripcion."						
				</div>									    		
				<div class='precio-promocion-back'>".$p->terminoVc."</div>	      			     		      	
      		</div>
      			      	
		</li>";  	
	}
?>
		</ul>
		<a id='prev' class='prev' href='#'></a>
		<a id='next' class='next' href='#'></a>	
	</div>
</div>
<?php
	echo "total:".count($promociones_hijas);
	echo "<br />:filtado".count($dist_promo); 
?>
