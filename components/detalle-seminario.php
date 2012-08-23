<?php		/*		    
	$json = file_get_contents('json/promociones-especiales.js');
	$data = json_decode($json);	
		
	if(count($data->promocion_especial_destacada)!=0)
		
	foreach($data->promocion_especial_destacada as $j){			
	}		*/			
?>	
<link href='<?php echo TIENDA ?>css/viewlet-seminario.css' rel='stylesheet' type="text/css" />
<meta charset="utf-8">
<div id="viewlet-seminario">
		
			<div class="video">
				<iframe width="320px" height="240px" src="http://www.youtube.com/embed/ptO63I9jzZ0" frameborder="0" allowfullscreen></iframe>
			</div>
			
			<div class="basic" >
			
				<div class="titulo">Seminario <br />Presencial 1</div>
				
				<!--<div class="pleca">&nbsp;</div>-->
				<div class="descripcion-corta">				
					<p> <div class="img-flecha"></div>Precio <span>$2,250.00</span> por persona</p>
					<p> <div class="img-flecha"></div>N&uacute;mero de lugares:	</p>
				</div>
				
				<div class="select"> 
					<select name="numero_lugares" >
						<option value="1">1</option>
					 </select>
				</div>
				
				
				<div class="botones">
					<div class="boton-ac"> 
						<input type="button" name="carrito" value=" " class="boton_continuar_compra" />	
					</div>
					<div class="boton-cce"> 
						<input type="button" name="pago_express" value=" " class="boton_login" />
					</div>
				</div>
				
				
			</div>
			
			<div class="contenido">
				<div class="pleca"></div>
				<div style="padding-bottom:19px;"></div>
				<div class="datos-importantes">
				<div class="img-flecha-negra"></div>Datos Importantes
				</div>
				
				<div class="texto">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
				Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
				Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.		
				</div>
				
				<div style="padding-bottom:23px;"></div>
				<div class="datos-importantes">
				<div class="img-flecha-negra"></div>Temario
				</div>
				
				<div class="lista">
					<ol>
						<li><span>Introducci&aocute;n</span></li>
						<ol class="foo">
						<li><span>Sobre Grupo Expansi&aocute;n</span></li>
						</ol>
						<li><span>Ahorro</span></li>
						<li><span>Empleo</span></li>						
					</ol>
				</div>
				
				<div style="padding-bottom:23px;"></div>
				<div class="datos-importantes">
				<div class="img-flecha-negra"></div>CV de expositores
				</div>
				<div class="nexpositor">
					<div class="img-flecha-roja"></div>JOHN DOE
				</div>
				<div class="texto-final">				
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
				Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
				Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.		
				</div>
				
			</div>

</div>
<br /><br /><br />