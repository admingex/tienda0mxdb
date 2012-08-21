<div id="contenedor-promo">
<?php
	/*Despliega las publicaciones de una categoría*/
	/*
	echo "<pre>";
		print_r($categoria->publicaciones);
	echo "</pre>";
	*/
	$j=0;
	foreach ($categoria->publicaciones as $p) {
		//url de la puclicación
		$url_p = '';
		if($p->formatos > 1) {
			//URL para que se vaya a la lista de promociones y se pueda filtrar por formatos y precios
			$url_p = site_url('categoria/'.$p->id_categoria.'/publicacion/ofertas/') . $p->id_publicacion;
		} else {
			//Si no trae más de un formato, ir al detalle de la promoción: suscripción / producto / PDF
			$url_p = site_url('categoria/'.$p->id_categoria.'/publicacion/detalle/') . $p->id_publicacion;
		}
		
		echo "
			<div class='catego-left'>
				<div class='contenedor-imagen'>
					<a href='". $url_p . "'>
						<img src='" . TIENDA . "images/css_sprite_PortadaCaja.jpg' />
					</a>
				</div>
				<div class='titulo-categoria-back titulo-categoria'>
					".$p->nombre_publicacion."	
				</div>
				<div class='descripcion-categoria-back descripcion-promocion'>
					".$p->desc_publicacion."	
				</div>						    			      			      
		      	<!--<div>".$p->formatos./*."-".strlen($p->desc_publicacion).*/"</div>-->
      		</div>
	      ";
		//pinta un espacio en blanco que sirve de margen						
		if (($j == 0) || ($j == 1) || ($j == 3) || ($j == 4) ){
			echo "<div class='catego-space'></div>";				
		}
		$j++; 
	}
?>
</div>