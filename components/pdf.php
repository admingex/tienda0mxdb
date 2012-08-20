<div class="contenedor-promo" style="background-color: #800">
	<div style="float: left; width: 20%;">
		<img src="<?php echo site_url('images/img1.jpg')?>" />
	</div>
	<div style="float: left; margin-left: 20px; width: 70%;">
		<div class="titulo-proceso">
			<?php echo $detalle_promocion->descripcion_promocion; ?>
		</div>
		<div class="blank_section"></div>
		
		<div class="titulo-proceso">
		 	Precio: <?php echo $detalle_promocion->costo;?>
		</div>
		<div class="blank_section"></div>
		<?php
			$action_pagos = ECOMMERCE."api/". $detalle_promocion->id_sitio . "/" . $detalle_promocion->id_canal . "/" . $detalle_promocion->id_promocion . "/pago";
			//para agregar la promoción al carrito:
			$carrito = "'comprar_promocion',".$detalle_promocion->id_sitio.", ".$detalle_promocion->id_canal.", ".$detalle_promocion->id_promocion;
			//TIENDA . "carrito.php?id_sitio=" . $detalle_promocion->id_sitio . "&id_canal=" . $detalle_promocion->id_canal . "&id_promocion=" . $detalle_promocion->id_promocion;
			//$onclick_action_carrito = "document.comprar_promocion" . $detalle_promocion->id_promocion . ".action='" . $action_carrito . "'; ";
			//submit
			//$onclick_submit = "document.comprar_promocion". $detalle_promocion->id_promocion . ".submit();";
		?>
		<form id='comprar_promocion<?php echo $detalle_promocion->id_promocion;?>' name='comprar_promocion<?php echo $detalle_promocion->id_promocion;?>' action='<?php echo $action_pagos;?>' method='post'>
		<?php
		echo		
			"<input type='hidden' name='guidx' value='".API::GUIDX."'/>\n" . 
			"<input type='hidden' name='guidz' value='".API::guid()."'/>\n". 
		    "<input type='hidden' name='imagen' value='".TIENDA."images/img3.jpg' />\n" .
		    "<input type='hidden' name='descripcion' value='". $detalle_promocion->descripcion_promocion."' />\n" .
		    "<input type='hidden' name='precio' value='".$detalle_promocion->costo."' />\n" .
		    "<input type='hidden' name='cantidad' value='1' />\n";
		?>
			<div style="float: right; background-color: #CCCCCC">
				<div style="padding: 10px">
					<input type="submit" id="btn_comprar_ahora" name="btn_comprar_ahora" value=" " class="boton_continuar_compra" />
				</div>
				<div style="padding: 10px; background-color: #DDD">
					<input type="button" id="btn_agregar_carrito" name="btn_agregar_carrito" value="Añadir al Carrito" onclick="anadir_carrito(<?php echo $carrito ;?>)"/>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="blank_section"></div>
<div class="contenedor-promo">
	<div class="blank_section"></div>
</div>

<div class="contenedor-promo">
	<div style="background-color: #CCC; color: #000; height: 20px">
		<div class="titulo-proceso-img">&nbsp;</div>			
		<div class="titulo-proceso">Sobre este reporte</div>
	</div>	
	<div>
		<br/>
		<p>
		Descripción del material web.
		
		</p>
		<br/>
	</div>
	<div style="background-color: #CCC; color: #000; height: 20px">
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			Lista de contenido
		</div>
	</div>
	<div>
		<br/>
		<ol>
			<li>Introducción</li>
			<li>
				<ol><li>Sobre IDC</li></ol>
			</li>
		</ol>		
	</div>
</div>

	