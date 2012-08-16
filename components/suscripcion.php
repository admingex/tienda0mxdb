<div class="contenedor-promo" style="background-color: #800">
	<div style="float: left; width: 20%;">
		<img src="<?php echo site_url('images/img1.jpg')?>" />
	</div>
	<div style="float: left; margin-left: 20px; width: 70%;">
		<div class="titulo-promo-rojo-deposito">
			<?php echo $info_publicacion->nombreVc."\n";?>
		</div>
		<div id="pleca-gris">		
		</div>
	
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			<?php echo $info_publicacion->descripcionVc; ?>
		</div>
		<div class="blank_section"></div>
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			Fecha de portada del primer ejemplar/ Inicio de la promoción:
		 	<?php echo $detalles_promociones[0]->fecha_inicio_promo;?>
		</div>
		<div class="blank_section"></div>
		<div style="float: right; background-color: #CCCCCC">
			<div style="padding: 10px">
				<input type="button" name="carrito" value=" " class="boton_continuar_compra" />	
			</div>
			<div style="padding: 10px; background-color: #DDD">
				<input type="button" name="pago_express" value=" " class="boton_login" />
			</div>
		</div>
	</div>
</div>
<div class="blank_section"></div>
<div class="contenedor-promo">
	<div class="titulo-proceso-img">&nbsp;
	</div>			
	<div class="titulo-proceso">
		Selecciona el país de envío para ver los precios y promociones aplicables.
	</div>	
	<select name="pais">
			<option value="mexico">México</option>
	</select>
	<div class="blank_section"></div>
	<form method="post" action="carrito.php ">
		<table width="95%">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Promoción</th>
					<th>Descripción</th>
					<th>Precio</th>
				</tr>	
			</thead>
			<tbody>
			<?php
				foreach ($detalles_promociones as $detalle) {
			?>
				<tr>
					<td>
						<input type="radio" id="radio" name="promocion" value="<?php echo $detalle->id_promocion; ?>"/>
						<div id="promocion" class="radio_selected">&nbsp;</div>					
					</td>
					<td><?php echo $detalle->descripcion_promocion; ?></td>
					<td><?php echo $detalle->texto_oferta; //Contenido de la promocion(ejemplares, suplementos, regalos, etc.)?></td>
					<td>Precio: <?php echo $detalle->costo; //Precio y descuento aplicado sobre precio de portada?></td>
				</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</form>
</div>
<div id="pleca-gris"></div>
<div class="contenedor-promo">
	<div style="background-color: #CCC; color: #000; height: 20px">
		<div class="titulo-proceso-img">&nbsp;</div>			
		<div class="titulo-proceso"><?php echo $info_publicacion->nombreVc."\n";?>: <?php echo $info_publicacion->descripcionVc; ?></div>
	</div>	
	<div>
		<br/>
		<p>
		Descripción larga de la publicación.	
		
		
		Falta en BD.
		</p>
		<br/>
	</div>
	<div style="background-color: #CCC; color: #000; height: 20px">
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			Secciones de la revista
		</div>
	</div>
	<div>
		<br/>En <?php echo $info_publicacion->nombreVc; ?> encontra&aacute;s:
		<br/><br/>
		<div class="titulo-proceso-img">&nbsp;</div>			
		<div class="titulo-proceso">Seccion1</div>
		<br/>
		<div class="titulo-proceso-img">&nbsp;</div>			
		<div class="titulo-proceso">Seccion2</div>
		<br/>
		Vienene del admin.
	</div>
</div>



	
