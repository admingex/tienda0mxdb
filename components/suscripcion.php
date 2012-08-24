<?php
	//promoción inicial
	$promo_inicial = $detalles_promociones[0];	//siempre viene
	//para pasar a pagar en la plataforma de pagos, es la acción por defecto:
	$action_pagos_inicial = ECOMMERCE."api/". $promo_inicial->id_sitio . "/" . $promo_inicial->id_canal . "/" . $promo_inicial->id_promocion . "/pago";
	$onclick_action_pagos_inicial = "document.comprar_promocion" . $promo_inicial->id_promocion . ".action='" . $action_pagos_inicial . "'; ";	
	
?>
<script type="text/javascript">
	var id_sit = <?php echo $promo_inicial->id_sitio; ?>;
	var id_can = <?php echo $promo_inicial->id_canal; ?>;
	var id_ant = <?php echo $promo_inicial->id_promocion; ?>;
	var form_submit = "document.comprar_promocion" + id_ant;
	//iniciales
	
	//var url_carrito = "<?php //echo $action_carrito_inicial; ?>";
	
	function cambia_boton(id) {
		if (document.getElementById(id_ant)) {
			//limpia la selección anterior
			//document.getElementById(id_ant).innerHTML = '';
			document.getElementById('div_promocion' + id_ant).className = 'radio_no_selected';
			document.getElementById('radio' + id_ant).checked = '';  									 			
		}
		
		//document.getElementById(id).innerHTML = '<input type="submit" id="usar_tarjeta" name="usar_tarjeta" value="&nbsp;" class="usar_tarjeta"/>';
		document.getElementById('div_promocion' + id).className = 'radio_selected';
		document.getElementById('radio' + id).checked = 'checked';						
		
		//actuaclización de eventos;
		var submit_pagos = "submit_to_pagos(" + id + ");";
		var submit_carrito = "submit_to_carrito(" + id + ");";
		
		$("#btn_comprar_ahora").attr("onclick", submit_pagos);
		$("#btn_agregar_carrito").attr("onclick", submit_carrito);
		
		//alert($("#btn_comprar_ahora").attr("onclick"));
		//alert($("#btn_agregar_carrito").attr("onclick"));
		
		//indica cuál es el que está selceccionado
		id_ant = id;
	}
	/*envía el formulario a la plataforma de pagos*/
	function submit_to_pagos(id_promo) {
		//simplemente se envía la forma como está
		var forma = $("form[name='comprar_promocion" + id_promo + "']");
		forma.submit();
	}
		
	/*envía el formulario al carrito*/
	function submit_to_carrito(id_promo) {
		
		//se cambia el action del formulario y se envía		 			
		//forma = $("form[id='comprar_promocion" + id_promo + "']");
		anadir_carrito('comprar_promocion', id_sit, id_can, id_promo)												
		
	}
</script>

<link href='<?php echo TIENDA ?>css/viewlet-detalle-suscripcion.css' rel='stylesheet' type="text/css" />
<?php	
	//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
	if(@GetImageSize(TIENDA."p_images/".$promo_inicial->url_imagen)){
		$src = TIENDA ."p_images/".$promo_inicial->url_imagen;
	}
	else{
		$src = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
		//$src = TIENDA ."p_images/".$p->url_imagen;
	}
?>
<div id="viewlet-detalle-suscripcion">
		<div>
			<img src="<?php echo $src;?>" />
		</div>	
		<div class="detalle">
			<div class="bloque-descripcion">
				<div class="titulo-detalle">
					<?php echo $promo_inicial->nombre_publicacion;?>
				</div>	
				<div class="pleca-separacion"></div>
				<div class="bloque-texto">
					<div class="texto-detalle">
						<div class="triangulo-rojo-der"></div><?php echo $promo_inicial->descripcion_publicacion; ?>
					</div>
					<div class="texto-detalle">
						<div class="triangulo-rojo-der"></div>Fecha de portada del primer ejemplar: <?php echo $promo_inicial->fecha_inicio_promo;?>
					</div>																								
				</div>																
			</div>
			<div class="botones">
				<input type="button" id="btn_comprar_ahora" name="btn_comprar_ahora" value=" " class="boton-pago-express" onclick="submit_to_pagos(<?php echo $promo_inicial->id_promocion;?>)"/>	
				<input type="button" id="btn_agregar_carrito" name="btn_agregar_carrito" value="" class="boton-anadir-carrito" onclick="submit_to_carrito(<?php echo $promo_inicial->id_promocion;?>)"/>			
			</div>	
		</div>
		<div class="space-pleca"></div>		
		<div class="banner-descripcion">
			<div class="triangulo-negro-der"></div>Selecciona el pa&iacute;s de env&iacute;o para ver los precios y promociones aplicables.
		</div>
		<div class="descripcion">
			<select name="pais">
				<option value="mexico">México</option>
			</select>	
		</div>
		<div class="space-pleca"></div>	
		<table width="100%" cellspacing="1">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Promoci&oacute;n</th>
					<th>Descripci&oacute;n</th>
					<th>Precio</th>
				</tr>	
			</thead>
			<tbody>
			<?php
				foreach ($detalles_promociones as $detalle) {
					//para pasar a pagar en la plataforma de pagos, es la acción por defecto:
					$action_pagos = ECOMMERCE."api/". $detalle->id_sitio . "/" . $detalle->id_canal . "/" . $detalle->id_promocion . "/pago";
					
					//para agregar la promoción al carrito:
					//$action_carrito = TIENDA . "carrito.php?id_sitio=" . $detalle->id_sitio . "&id_canal=" . $detalle->id_canal . "&id_promocion=" . $detalle->id_promocion;
					//$onclick_action_carrito = "document.comprar_promocion" . $detalle->id_promocion . ".action='" . $action_carrito . "'; ";
					//$onclick_submit = "document.comprar_promocion". $detalle->id_promocion . ".submit()";
					
					//datos para que se procese el pago en la plataforma 
					echo "
					<form id='comprar_promocion".$detalle->id_promocion."' name='comprar_promocion" . $detalle->id_promocion . "' action='" . $action_pagos . "' method='post'>".
						"<input type='hidden' name='guidx' value='".API::GUIDX."' />\n" . 
						"<input type='hidden' name='guidz' value='".API::guid()."' />\n". 
					    "<input type='hidden' name='imagen' value='".$src."' />\n" .
					    "<input type='hidden' name='descripcion' value='". $detalle->descripcion_promocion."' />\n" .
					    "<input type='hidden' name='precio' value='".$detalle->costo."' />\n" .
					    "<input type='hidden' name='cantidad' value='1' />\n					     
					</form>";
					
					//promoción seleccionada inicialmente:
					$class_radio = "class='radio_no_selected'";
					if ($promo_inicial->id_promocion == $detalle->id_promocion)
						$class_radio = "class='radio_selected'";
			?>
				<tr>
					<td id="<?php echo $detalle->id_promocion;?>">
						<input type="radio" id="radio<?php echo $detalle->id_promocion; ?>" name="promocion" value="<?php echo $detalle->id_promocion; ?>"/>
						<div id="div_promocion<?php echo $detalle->id_promocion; ?>" <?php echo $class_radio;?>  onclick="cambia_boton(<?php echo $detalle->id_promocion; ?>);" >&nbsp;</div>					
					</td>
					<td><?php echo $detalle->descripcion_promocion; ?></td>
					<td><?php echo $detalle->texto_oferta; //Contenido de la promocion(ejemplares, suplementos, regalos, etc.)?></td>
					<td>Precio: <?php echo number_format($detalle->costo,2, ".", ",")."&nbsp;".$detalle->moneda; //Precio y descuento aplicado sobre precio de portada?></td>
				</tr>
			<?php
				}
			?>
			</tbody>
		</table>
		<div class="space-pleca"></div>
		<div class="banner-descripcion">
			<div class="triangulo-negro-der"></div><?php echo $promo_inicial->nombre_publicacion;?>: <?php echo $promo_inicial->descripcion_publicacion; ?>
		</div>
		<div class="descripcion">
			<?php echo $promo_inicial->descripcion_publicacion_larga; ?>	
		</div>
		<div class="space-pleca"></div>
		<div class="banner-descripcion">
			<div class="triangulo-negro-der"></div>Secciones de la revista
		</div>
		<div class="descripcion">
			En <?php echo $promo_inicial->nombre_publicacion; ?> encontrar&aacute;s:
			<div class="texto-detalle">
				<div class="triangulo-rojo-der"></div> Seccion 1
			</div>
			<div class="texto-detalle">
				<div class="triangulo-rojo-der"></div> Seccion 2
			</div>		
			<div class="texto-detalle">
				<div class="triangulo-rojo-der"></div> Seccion 3
			</div>													
		</div>
		<div class="space-pleca"></div>
	</div>						
				

