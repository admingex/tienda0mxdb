<link type="text/css" href="<?php echo TIENDA;?>css/promociones.css" rel="stylesheet" />
<div id="contenedor-promo">
<?php	
	/**
	 * Despliega las promociones de una publicación cuando se tienen más de un formato para dicha publicación
	 * $ofertas_publicacion: trae la descripción de la promoción y el detalle de la misma, lo cual incluye
	 * el precio y el order code type del primer produecto de la promoción, además del texto de la oferta
	 * y posibles descuentos de la promoción -esta información se trae del primer artículo de la promoción-,
	 * de aqu[i se mostrará el detalle final del contenido de la promoción. 
	 */
	$j=0;
	foreach ($ofertas_publicacion->promociones as $p) {
	/*
	 * //también se pueden ver los detalles por separado, es posible que esto cambie de acuerdo al funcionamiento final...
	 * foreach ($detalles_promociones as $detalle) {
		echo "<pre>";
		print_r((object)$detalle[0]);
		echo "</pre>";
		echo $detalle[0]->id_sitio."<br/>";
	}
	*/
		//creación de la URL para mostrar el detalle final de la promoción
		$url_detalle_promo = '';
		//los ids se recuperan desde el front controller: "publicaciones.php"
		$url_detalle_promo = site_url((isset($id_categoria) ? 'categoria/' . $id_categoria.'/' : '') . (isset($id_publicacion) ? 'publicacion/' . $id_publicacion. '/' : '') .'promocion/' . $p->detalle->id_promocion);
				
		//para pasar a pagar en la plataforma de pagos, es la acción por defecto:
		$action_pagos = ECOMMERCE."api/". $p->detalle->id_sitio . "/" . $p->detalle->id_canal . "/" . $p->detalle->id_promocion . "/pago";
		
		//para agregar la promoción al carrito:
		$carrito='';
		$carrito = "'comprar_promocion', ".$p->detalle->id_sitio.", ".$p->detalle->id_canal.", ".$p->detalle->id_promocion;
		
		//$action_carrito = TIENDA . "carrito.php?id_sitio=" . $p->detalle->id_sitio . "&id_canal=" . $p->detalle->id_canal . "&id_promocion=" . $p->detalle->id_promocion;
		//$onclick_action = "document.comprar_promocion" . $p->detalle->id_promocion . ".action='" . $action_carrito . "'; ";
		//$onclick_event = "document.comprar_promocion".$p->detalle->id_promocion.".submit()";
		
		//formulario para la promoción
		echo "		
			<div class='promo-left'>
			<form id='comprar_promocion".$p->detalle->id_promocion."' name='comprar_promocion".$p->detalle->id_promocion."' action='". $action_pagos ."' method='post'>
				<input type='hidden' name='guidx' value='".API::GUIDX."' />
			    <input type='hidden' name='guidz' value='".API::guid()."' />
			    <input type='hidden' name='imagen' value='".TIENDA."images/img3.jpg' />
			    <input type='hidden' name='descripcion' value='".$p->descripcion_promocion."' />
			    <input type='hidden' name='precio' value='".$p->detalle->costo."' />
			    <input type='hidden' name='cantidad' value='1' />
			    <div class='contenedor-imagen'>			    
		    		<a href='". $url_detalle_promo . "'>
		    			<img src='" . TIENDA . "images/css_sprite_PortadaCaja.jpg' />
		    		</a>
		    	</div>	
		      	<div class='titulo-publicacion-back descripcion-promocion'>
		      		".$p->descripcion_promocion."
		      	</div>
		      	<div class='descripcion-publicacion-back'>
					<span class='precio-promocion'> $ " . number_format($p->detalle->costo, 2, ".", "," )."</span>
				</div>		      	
		      	
		      	<div class='boton'>
	          		<input type='submit' name='btn_comprar_ahora' value=' ' class='boton-comprar-ahora' />";
		 ?>		      	
		      		<input type="button" id="btn_agregar_carrito" name="btn_agregar_carrito" value=" " onclick="anadir_carrito(<?php echo $carrito ;?>)" class='boton-anadir-carrito'/>
		 <?php     	
	      echo "
		      	</div>
		    </form>  	
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
