<link href='<?php echo TIENDA ?>css/viewlet-detalle-pdf.css' rel='stylesheet' type="text/css" />
<?php	
	//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
	if (file_exists("./p_images/".$detalle_promocion->url_imagen)){
		$src_imagen = TIENDA ."p_images/".$detalle_promocion->url_imagen;
	} else {
		$src_imagen = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
		//$src_imagen = TIENDA ."p_images/".$p->url_imagen;
	}
?>
<div id="viewlet-detalle-pdf">
	<div>
		<img src="<?php echo $src_imagen; ?>" />
	</div>
	<div class="detalle">
		<div class="bloque-descripcion">
			<div class="titulo-detalle">
				<?php echo $detalle_promocion->descripcion_issue; ?>	
			</div>
			<div class="bloque-texto">
				<span class="texto-detalle">Precio:</span>
				<span class="precio-detalle"><?php echo "$". number_format($detalle_promocion->costo, 2, '.', ',')."&nbsp;".$detalle_promocion->moneda;?></span>
			</div>
		</div>
		<div class="botones">
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
			    "<input type='hidden' name='descripcion' value='". $detalle_promocion->descripcion_promocion."' />\n" .
			    "<input type='hidden' name='precio' value='".$detalle_promocion->costo."' />\n" .
			    "<input type='hidden' name='moneda' value='".$detalle_promocion->moneda."' />\n" .
			    "<input type='hidden' name='cantidad' value='1' />\n";
			?>
				<input type="submit" id="btn_comprar_ahora" name="btn_comprar_ahora" value=" " class="boton-pago-express"  />
				<input type="button" id="btn_agregar_carrito" name="btn_agregar_carrito" value="" onclick="anadir_carrito(<?php echo $carrito ;?>)" class="boton-anadir-carrito"/>				
			</form>									
		</div>
	</div>
	<div class="space-pleca"></div>
		<div class="pleca-separacion"></div>
	<?php
	
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
	?>
</div>


	