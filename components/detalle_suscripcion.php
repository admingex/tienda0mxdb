<?php		/*		    
	$json = file_get_contents('json/promociones-especiales.js');
	$data = json_decode($json);	
		
	if(count($data->promocion_especial_destacada)!=0)
		
	foreach($data->promocion_especial_destacada as $j){			
	}		*/			
?>	
<div class="contenedor-promo" style="background-color: #800">
	<div style="float: left; width: 20%;">
		<img src="images/imagen1.jpg" />
	</div>
	<div style="float: left; margin-left: 20px; width: 70%;">
		<div class="titulo-promo-rojo-deposito">
			Titulo de Publicación
		</div>
		<div id="pleca-gris">		
		</div>
	
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			descripcion corta
		</div>
		<div class="blank_section"></div>
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			fecha de portada del primer ejemplar
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
		Selecciona el país de envio para ver los precios y promociones aplicables.
	</div>	
	<select name="pais">
			<option value="mexico">México</option>
	</select>
	<div class="blank_section"></div>
	<table width="95%">
		<thead>	
			<tr>											
				<th>
					&nbsp;
				</th>
				<th>
					Promoción	
				</th>
				<th>
					Descripción
				</th>
				<th>
					Precio
				</th>
			</tr>	
		</thead>
		<tbody>
			<tr>
				<td>
					<input type="radio" id="radio" name="promocion" value="id_promocion"/>
					<div id="promocion" class="radio_selected">&nbsp;</div>					
				</td>
				<td>
					Descripcion de la oferta
				</td>
				<td>
					Contenido de la promocion(ejemplares, suplementos, regalos, etc.)
				</td>
				<td>
					Precio y descuento aplicado sobre precio de portada
				</td>
			</tr>
		</tbody>
	</table>		
</div>
<div id="pleca-gris"></div>
<div class="contenedor-promo">
	<div style="background-color: #CCC; color: #000; height: 20px">
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			Quien
		</div>
	</div>	
	<div>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
		Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
		Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
		Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.		
	</div>
	<div style="background-color: #CCC; color: #000; height: 20px">
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			Secciones de la revista
		</div>
	</div>
	<div>
		Encontraras:<br /><br />
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			Seccion1
		</div>
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			Seccion2
		</div>
	</div>
		
</div>



	
