<?php
	foreach ($categoria->publicaciones as $p) {
		//url de la puclicación
		$url_p = '';
		if($p->formatos > 1) {
			//URL para que se vaya a la lista de promociones y se pueda filtrar por formatos y precios
			$url_p = site_url('publicacion/ofertas/') . $p->id_publicacion;
		} else {
			//Si no trae más de un formato, ir al detalle de la promoción/suscripción / producto
			$url_p = site_url('publicacion/detalle/') . $p->id_publicacion;
		}
		
		echo "
			<div class='promo-left'>
		    	<a href='". $url_p . "'><img src='".TIENDA."images/img1.jpg' /></a>
		      	<div class='descripcion'>".$p->nombre_publicacion."</div>
		      	<div class='descripcion'>".$p->desc_publicacion."</div>
		      	<div class='descripcion'>".$p->formatos."-".strlen($p->desc_publicacion)."</div>
      		</div>
	      ";
	}
?>
