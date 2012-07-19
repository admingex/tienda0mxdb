<?php
	foreach ($data->publicaciones as $p) {
		if($p->formatos > 0) {
			#### TO DO Armar la URL para que se vaya a la lista de promociones y se pueda filtrar por formatos
		} else {
			//Si no trae omás de un formato, ir al detalle de la promoción/suscripción /producto
			##### TO DO
		}	
		
		echo "
			<div class='promo-left'>
		    	<a href=''><img src='".TIENDA."images/img1.jpg' /></a>
		      	<div class='descripcion'>".$p->nombre_publicacion."</div>
		      	<div class='descripcion'>".$p->desc_publicacion."</div>
		      	<div class='descripcion'>".$p->formatos."-".strlen($p->desc_publicacion)."</div>
      		</div>
	      ";
	}
?>
