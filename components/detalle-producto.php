<?php		/*		    
	$json = file_get_contents('json/promociones-especiales.js');
	$data = json_decode($json);	
		
	if(count($data->promocion_especial_destacada)!=0)
		
	foreach($data->promocion_especial_destacada as $j){			
	}		*/			
?>	
<div class="contenedor-promo" style="background-color: #800">
	<div style="float: left; width: 20%;">
		<img src="<?php echo TIENDA?>images/img1.jpg" />
	</div>
	<div style="float: left; margin-left: 20px; width: 70%; border: solid; border-width: 1px; border-color: #ccc">							
		<div class="titulo-proceso">
			DESCRIPCION DE LA OFERTA
		</div>
		<br />
		<div class="instrucciones">
			Precio: $00.00
		</div>				
		<div class="blank_section"></div>
		<div style="background-color: #CCCCCC">
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
<div id="pleca-gris"></div>
<div class="contenedor-promo">
	<div style="background-color: #CCC; color: #000; height: 20px">
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			Sobre el producto
		</div>
	</div>	
	<div>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
		Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
		Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
		Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.		
	</div>
	<div class="blank_section"></div>
	<div style="background-color: #CCC; color: #000; height: 20px">
		<div class="titulo-proceso-img">&nbsp;
		</div>			
		<div class="titulo-proceso">
			Lista de contenido
		</div>
	</div>
	<div>		
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
