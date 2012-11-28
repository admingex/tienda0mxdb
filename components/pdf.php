<link href='<?php echo TIENDA ?>css/viewlet-detalle-suscripcion.css' rel='stylesheet' type="text/css" />
<?php	
	//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
	//if (file_exists("./r_images/".$detalle_promocion->url_imagen)){
		$src_imagen = TIENDA ."r_images/".$detalle_promocion->url_imagen;
		$logo = TIENDA."l_images/".$detalle_promocion->url_imagen;		
	//} else {
	//	$src_imagen = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
	//	$logo = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
	//}
?>

<div id="viewlet-detalle-suscripcion">
	<?php
		$action_pagos = ECOMMERCE."api/". $detalle_promocion->id_sitio . "/" . $detalle_promocion->id_canal . "/" . $detalle_promocion->id_promocion . "/pago";
		//para agregar la promoción al carrito:
		$carrito = "'comprar_promocion',".$detalle_promocion->id_sitio.", ".$detalle_promocion->id_canal.", ".$detalle_promocion->id_promocion;			
		?>
		<form id='comprar_promocion<?php echo $detalle_promocion->id_promocion;?>' name='comprar_promocion<?php echo $detalle_promocion->id_promocion;?>' action='<?php echo $action_pagos;?>' method='post'>
		<?php
		echo		
			"<input type='hidden' name='guidx' value='".API::GUIDX."'/>\n" . 
			"<input type='hidden' name='guidz' value='".API::guid()."'/>\n". 
		    "<input type='hidden' name='imagen' value='".$src_imagen."' />\n" .
		    "<input type='hidden' name='descripcion' value='". $detalle_promocion->descripcion_issue."' />\n" .
		    "<input type='hidden' name='precio' value='".$detalle_promocion->costo."' />\n" .
		    "<input type='hidden' name='moneda' value='".$detalle_promocion->moneda."' />\n" .
		    "<input type='hidden' name='iva' value='".$detalle_promocion->taxable."' />\n" .
		    "<input type='hidden' name='cantidad' value='1' />\n";
	?>
			<div class="bloque-left">
				<img src="<?php echo $logo; ?>" />
				
				<!--<div class="back-rayado" style="padding: 10px">enviar a un amigo</div>-->
				<div class="back-rayado">
					<input type="button" id="btn_agregar_carrito" name="btn_agregar_carrito" value="añadir al carrito" class="boton-anadir-carrito" onclick="anadir_carrito(<?php echo $carrito ;?>)"/>
				</div>
			</div>
			<div class="bloque-middle">
				<img src="<?php echo $src_imagen;?>" />
			</div>	
			<div class="bloque-right">
				<div id='precio_promo' class="precio">
					<?php echo "$". number_format($detalle_promocion->costo, 2, '.', ',')."&nbsp;".$detalle_promocion->moneda;?>
				</div>
				<div id='descripcion-promo' class="descripcion-promocion">
					<?php echo $detalle_promocion->descripcion_issue; ?>	
				</div>
				<div class="back-rayado" style="margin-top: 60px">				
			    		<input type="submit" id="btn_comprar_ahora" name="btn_comprar_ahora" value="Comprar ahora" class="boton-comprar-ahora"/>
			    </div>				
			</div>	
	</form>			
</div>	
	<?php
	/*
	//si hay secciones y existe información asociada con la promoción
		if (isset($secciones) AND array_key_exists($detalle_promocion->id_promocion, $secciones) && count($secciones[$detalle_promocion->id_promocion]) > 0) {
			//se obtiene la información de la sección
			$seccion_promocion = $secciones[$detalle_promocion->id_promocion];
			foreach($seccion_promocion as $value) {
	?>
	<div class="space-pleca"></div>	
	<div class="banner-descripcion">
		<div class="triangulo-negro-der"></div><?php echo $value->titulo_seccion; ?>
	</div>	
	<div class="descripcion">				
		<?php echo $value->descripcion_seccion ;?>
	</div>
	<?php
			}
		} 
	 * 
	 */
	?>
</div>


	