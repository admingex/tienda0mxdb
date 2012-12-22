<link href='<?php echo TIENDA ?>css/viewlet-detalle-suscripcion.css' rel='stylesheet' type="text/css" />
<?php
	#### TODO Ajustar para video
	//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
	if (file_exists("./r_images/".$detalle_promocion->url_imagen)){
		$src_video = TIENDA ."r_images/".$detalle_promocion->url_imagen;	
		$logo = TIENDA."l_images/".$detalle_promocion->url_imagen;		
	} else {
		//$src = TIENDA ."p_images/".$p->url_imagen;
		$src_video = TIENDA ."r_images/coIDCEDIG.png";
		$logo = TIENDA."l_images/".$detalle_promocion->url_imagen;
		$logo = str_replace(".jpg", ".png", $logo);		
	}
?>

<meta charset="utf-8">
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
		    "<input type='hidden' name='imagen' value='".$detalle_promocion->url_imagen."' />\n" .
		    "<input type='hidden' name='descripcion' value='". $detalle_promocion->descripcion_promocion."' />\n" .
		    "<input type='hidden' name='precio' value='".$detalle_promocion->costo."' />\n" .
		    "<input type='hidden' name='moneda' value='".$detalle_promocion->moneda."' />\n" .
		    "<input type='hidden' name='iva' value='".$detalle_promocion->taxable."' />\n";
			if (isset($_SESSION['datos_login'])) {
				$datos_login = $_SESSION['datos_login'];
				echo "<textarea name='datos_login' style='display: none'>".$datos_login."</textarea>";	
			}			    
	?>
		<div class="bloque-left">
			<img src="<?php echo $logo; ?>" />
	<?php
		if(strstr($detalle_promocion->nombre_formato,'Seminario')){
	?>		
			<div class='selects'>
				<div class="indicaciones">Numero de lugares</div>
				<div class="styled-select">					
					<div class="#cont-select"> 
						<select name="cantidad" class="styled" >
							<?php 
							for ($in=1; $in<=10; $in++)
								echo "<option value='$in'>$in</option>";
							?>					
						</select>
					</div>	
				</div>
			</div>
	<?php
		}
	?>		
			<div class="back-rayado">			
				<input type="button" id="btn_agregar_carrito" name="btn_agregar_carrito" value="añadir al carrito" class="boton-anadir-carrito" onclick="anadir_carrito(<?php echo $carrito ;?>)" class="boton_continuar_compra" />
			</div>
			<div class="back-rayado">			
				<input type="submit" id="btn_comprar_ahora" name="btn_comprar_ahora" value="Comprar ahora" class="boton-comprar-ahora"/>
			</div>	
		</div>
		<div class="bloque-middle" style="width: 280px; text-align: center">
			<?php
				echo "<img src ='".$src_video."' />"; 
			?>				
		</div>
		<div class="bloque-right" style="width: 300px">
			<div id='descripcion-promo' class="descripcion3">
				<?php echo $detalle_promocion->descripcion_promocion;?>
				<?php echo "<br />".$detalle_promocion->texto_oferta;?>	
			</div>		
		    <div id='precio_promo' class="precio">
		    	$<?php echo number_format($detalle_promocion->costo, 2, ".", ","), " ", $detalle_promocion->moneda;?>
		    	<div class="descripcion1">precio por persona</div>
		    </div>	 
		    <div class="descripcion3" >
		    	<?php echo $detalle_promocion->descripcion_publicacion?>		    	
		    </div>   		
		</div>
	</form>	
</div>
