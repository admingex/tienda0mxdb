<?php					
		//breadcrum
		echo "<div id='breadcrumbs'><a href='".site_url("home")."'>Home</a><div class='triangulo-negro-der'></div><div class='noref'>".ucwords(strtolower('promociones especiales'))."</div> </div>";
	
?>

<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-slide.css" rel="stylesheet" />
<div id='contenedor_slide'>
	<div class='list_carousel responsive'>
				<ul id='slider'>
<?php			
	/*
	echo "<pre>";
		print_r($promociones_hijas);
	echo "</pre>";
	*/						
	
	foreach ($promociones_hijas as $p) {
		echo "<li>";			
		//url de la publicación
		$url_p = '';
		
		///sustituye espacios y & al nombre de la publicacion para que no haya problema en el GET		
		$pub = str_replace(' ', '_', $p->nombre);
		$pub = str_replace('&', '.', $pub);
		
		$url_p = site_url('promocion_h/'. $id_promo_padre.'/'.$pub);
		
		//revisar que exista la imagen en caso contrario ponemos el cuadro negro						
		if(file_exists("./r_images/".$p->url_imagen)){
			$src = TIENDA ."r_images/".$p->url_imagen;
		}
		else{
			$src = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
			//$src = TIENDA ."p_images/".$p->url_imagen;
		}
		echo "
			
					<a href='". $url_p . "'>";																	
						echo "<img src='" . $src. "' width='179px' height='217px' />
					</a>";
		/*																			
		echo "		
							
				<div class='titulo-categoria-back titulo-categoria' display='none'>
					".$p->nombre."						
				</div>
				<div class='descripcion-promocion-back descripcion-promocion' >
					".$p->descripcion."						
				</div>									    		
				<div class='precio-promocion-back'>".$p->terminoVc."</div>";
		*/			      			     		      	      		
      			      	
		echo "</li>";  	
	}
?>
		</ul>
		<a id='prev' class='prev' href='#'></a>
		<a id='next' class='next' href='#'></a>	
	</div>
</div>
