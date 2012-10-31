<link type="text/css" href="<?php echo TIENDA;?>css/promociones.css" rel="stylesheet" />
<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-paginador.css" rel="stylesheet" />
<div id="contenedor-promo">
<?php	
	/**
	 * Despliega las promociones de una publicación cuando se tienen más de un formato para dicha publicación
	 * $ofertas_publicacion: trae la descripción de la promoción y el detalle de la misma, lo cual incluye
	 * el precio y el order code type del primer produecto de la promoción, además del texto de la oferta
	 * y posibles descuentos de la promoción -esta información se trae del primer artículo de la promoción-,
	 * de aqu[i se mostrará el detalle final del contenido de la promoción. 
	 */
	 /*echo "<pre>";
	 print_r($ofertas_publicacion->promociones);
	 echo "<pre>";*/
	 
	$total = count($ofertas_publicacion->promociones);	
	if($total_promociones==0){
		echo "No se encontraron resultados en la búsqueda";
	}
			
	if (isset($_GET['page'])) {
		$pg = $_GET['page'];
	} else {
		$pg = 0;
	}
	
	$cantidad = MAX_PROMOS_PAGINA;//6; //Cantidad de registros que se desea mostrar por pagina
	
	//echo "get: " . $_GET['page'];
	//Para probar solo le coloque 3
	
	$paginacion = new paginacion($cantidad, $pg);
	$desde = $paginacion->getFrom();		
		
	$recorrer = $ofertas_publicacion->promociones;
	
	$limite = ($desde + $cantidad);
	if ($limite > $total) {
		$limite = $total;
	}
	
	$j = 0;
	/*echo "<pre>";	######ordenamientos
			print_r($recorrer[0]);
		echo "</pre>";*/
	for ($i = $desde; $i < $limite ; $i++) {
		//echo "<br />->".$i."<-";
		
		/*echo "<pre>";
			print_r($recorrer[$i]);
		echo "</pre>";*/
		
		$p = $recorrer[$i];	 		
		// $p trae la información general de la promoción,
		// $p->detalle trae información más granular 
		
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
		
		$descripcion_promocion = !empty($p->detalle->descripcion_issue) ? $p->detalle->descripcion_issue : $p->detalle->descripcion_promocion; 
		//$action_carrito = TIENDA . "carrito.php?id_sitio=" . $p->detalle->id_sitio . "&id_canal=" . $p->detalle->id_canal . "&id_promocion=" . $p->detalle->id_promocion;
		//$onclick_action = "document.comprar_promocion" . $p->detalle->id_promocion . ".action='" . $action_carrito . "'; ";
		//$onclick_event = "document.comprar_promocion".$p->detalle->id_promocion.".submit()";
		
		//formulario para la promoción
		//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
		if (file_exists("./p_images/".$p->detalle->url_imagen)){
			$src = TIENDA ."p_images/".$p->detalle->url_imagen;
		} else {
			//$src = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
			$src = TIENDA ."p_images/".$p->detalle->url_imagen;
		}
		echo "		
			<div class='promo-left'>
			<form id='comprar_promocion".$p->detalle->id_promocion."' name='comprar_promocion".$p->detalle->id_promocion."' action='". $action_pagos ."' method='post'>
				<input type='hidden' name='guidx' value='".API::GUIDX."' />
			    <input type='hidden' name='guidz' value='".API::guid()."' />
			    <input type='hidden' name='imagen' value='".$src."' />
			    <input type='hidden' name='descripcion' value='".$descripcion_promocion."' />
			    <input type='hidden' name='precio' value='".$p->detalle->costo."'/>
			    <input type='hidden' name='moneda' value='".$p->detalle->moneda."'/>
			    <input type='hidden' name='iva' value='".$p->detalle->taxable."' />
			    <input type='hidden' name='cantidad' value='1' />
			    <div class='contenedor-imagen'>			    
		    		<a href='". $url_detalle_promo . "'>
		    			<img src='" . $src . "' alt='".$src."' />
		    		</a>
		    	</div>	
		      	<div class='titulo-publicacion-back descripcion-promocion'>
		      		".$descripcion_promocion."
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

<?php 
	if($total > 6) {
?>		
<div id="paginacion">
<?php						
	
	if(!empty($buscador)){
		//echo "<br>".$s ."<br>".$fb."<br>".$buscador;
		$url = TIENDA."buscador.php?fb=".$fb."&s=".$s."&page=";
	}else{
		$url = TIENDA."publicacion/ofertas/".$id_publicacion."/";
	}
	
	
	$classCss = "numPages";
	#$classCss = "actualPage";
	
	//Clase CSS que queremos asignarle a los links 
	
	$back = "Atrás";
	$next = "Siguiente";
	
	$paginacion->generaPaginacion($total, $back, $next, $url, $classCss);
?>
</div>
<?php
	} 
?>
<div id="space-pleca"></div>
