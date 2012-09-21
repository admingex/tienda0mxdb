<link href='<?php echo TIENDA ?>css/viewlet-seminario.css' rel='stylesheet' type="text/css" />
<?php
	#### TODO Ajustar para video
	//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
	if (file_exists("./p_images/".$detalle_promocion->url_imagen)){
		$src_video = TIENDA ."p_images/".$detalle_promocion->url_imagen;
	} else {
		$src_video = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
		//$src = TIENDA ."p_images/".$p->url_imagen;
	}
?>

<meta charset="utf-8">
<div id="viewlet-seminario">

	<div class="video">
		<iframe width="320px" height="240px" src="http://www.youtube.com/embed/ptO63I9jzZ0" frameborder="0" allowfullscreen></iframe>
	</div>

	<div class="basic" >

		<div class="titulo">
			<?php echo $detalle_promocion->descripcion_promocion;?>
		</div>

		<!--<div class="pleca">&nbsp;</div>-->
		<div class="descripcion-corta">
			<p>
				<div class="img-flecha">&nbsp;</div>
				Precio <span>$ <?php echo number_format($detalle_promocion->costo, 2, ".", ","), " ", $detalle_promocion->moneda;?></span> por persona
			</p>
			<p>
				<div class="img-flecha"></div>
				N&uacute;mero de lugares:
			</p>
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
		<!--div class="datos-importantes">
			<div class="img-flecha-negra"></div>
			Datos Importantes
		</div-->

		<div class="texto">
			<?php echo $detalle_promocion->texto_oferta;?>
		</div>
		<?php
			$temario_seminario = "Sobre el seminario.";
			$cv_expositores = "Contenido del seminario";
			
			//si hay secciones y existe información asociada con la promoción 
			if (isset($secciones) && array_key_exists($detalle_promocion->id_promocion, $secciones) && count($secciones[$detalle_promocion->id_promocion]) > 0) {
				//se obtiene la información de la sección 
				$seccion_promocion = $secciones[$detalle_promocion->id_promocion];
				//los detalles para mostrar
				$temario_seminario = $seccion_promocion[0]->titulo_seccion;
				$cv_expositores = $seccion_promocion[0]->descripcion_seccion; 
			}
		?>
		<div style="padding-bottom:23px;"></div>
		<div class="datos-importantes">
			<div class="img-flecha-negra"></div>
			Temario
		</div>
		<div class="lista">
			<?php echo $temario_seminario;?>
			<!--
			<ol>
				<li>
					<span>Introducci&oacute;n</span>
				</li>
				<ol class="foo">
					<li>
						<span>Sobre Grupo Expansi&oacute;n</span>
					</li>
				</ol>
				<li>
					<span>Ahorro</span>
				</li>
				<li>
					<span>Empleo</span>
				</li>
			</ol>
			-->
		</div>

		<div style="padding-bottom:23px;"></div>
		<div class="datos-importantes">
			<div class="img-flecha-negra"></div>
			CV de expositores
		</div>
		<div class="texto-final">
			<?php echo $cv_expositores;?>
		</div>
		<!--
		<div class="nexpositor">
			<div class="img-flecha-roja"></div>
			JOHN DOE
		</div>
		<div class="texto-final">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
			Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
			Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
		-->
	</div>

</div>
<br />
<br />
<br />
