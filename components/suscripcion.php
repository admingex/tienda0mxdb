<?php
	//promoción inicial
	$promo_inicial = $detalles_promociones[0];	//siempre viene
	//para pasar a pagar en la plataforma de pagos, es la acción por defecto:
	$action_pagos_inicial = ECOMMERCE."api/". $promo_inicial->id_sitio . "/" . $promo_inicial->id_canal . "/" . $promo_inicial->id_promocion . "/pago";
	$onclick_action_pagos_inicial = "document.comprar_promocion" . $promo_inicial->id_promocion . ".action='" . $action_pagos_inicial . "'; ";
	/*			
	echo "<pre>";
		    print_r($detalles_promociones);
	echo "</pre>";	
	*/
	
?>
<script type="text/javascript">
	var id_sit = <?php echo $promo_inicial->id_sitio; ?>;
	var id_can = <?php echo $promo_inicial->id_canal; ?>;
	var id_ant = <?php echo $promo_inicial->id_promocion; ?>;
	
	var form_submit = "document.comprar_promocion" + id_ant;			
	//iniciales
		
	function cambia_boton(id) {		
		//if (document.getElementById(id_ant)) {
			//limpia la selección anterior
			//document.getElementById(id_ant).innerHTML = '';
			//document.getElementById('div_promocion' + id_ant).className = 'radio_no_selected';
			//document.getElementById('radio' + id_ant).checked = '';  									 			
		//}
		
		//document.getElementById(id).innerHTML = '<input type="submit" id="usar_tarjeta" name="usar_tarjeta" value="&nbsp;" class="usar_tarjeta"/>';
		//document.getElementById('div_promocion' + id).className = 'radio_selected';
		//document.getElementById('radio' + id).checked = 'checked';						
		
		//actuaclización de eventos;
		var submit_pagos = "submit_to_pagos(" + id + ");";
		var submit_carrito = "submit_to_carrito(" + id + ");";
		
		$("#btn_comprar_ahora").attr("onclick", submit_pagos);
		$("#btn_agregar_carrito").attr("onclick", submit_carrito);	
		  					
		$('#precio_promo').text('$'+$('#precio'+id).text());
		$('#descripcion-promo').text($('#descripcion'+id).text());		
		$('#ejemplares-promo').text($('#ejemplares'+id).text());		
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
		//alert(id_promo);
		//se cambia el action del formulario y se envía		 			
		//forma = $("form[id='comprar_promocion" + id_promo + "']");
		anadir_carrito('comprar_promocion', id_sit, id_can, id_promo)												
		
	}
	function no_hacer_nada(){
		//alert("No tienes filas no puedes enviar algo");
		submit_carrito="''";
		submit_pagos="''";
		$("#btn_agregar_carrito").attr("onclick", submit_carrito);
		$("#btn_comprar_ahora").attr("onclick", submit_pagos);
	}
</script>

<link href='<?php echo TIENDA ?>css/viewlet-detalle-suscripcion.css' rel='stylesheet' type="text/css" />
<?php	
	//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
	if (file_exists("./r_images/".$promo_inicial->url_imagen)){
		$src = TIENDA ."r_images/".$promo_inicial->url_imagen;
		$logo = TIENDA."l_images/".$promo_inicial->url_imagen;		
	} else {
		$src = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
		$logo = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
	}
?>
<div id="viewlet-detalle-suscripcion">
	    <div class="bloque-left">	    	
			<img src="<?php echo $logo;?>" />
			<script type='text/javascript' src='<?php echo site_url("js/filtro_pais.js");?>'></script>		
		
			<?php			    
				$amoneda= array();
				$i=0;
				foreach ($detalles_promociones as $detalle) {
					$amoneda[$i]=$detalle->moneda;
					$i++;
				}
			?>			
			<div class='selects'>	
				<div class="styled-select">	
					<div class="cont-select">				
						<select name="sel_pais" id="sel_pais" >
						<?php 
						$antvalor='ads';
						foreach($amoneda as $valor){ 
					
							if($antvalor !=$valor){				
						?>
							<option value="<?php echo $valor;?>" <?php if($valor=='MX') echo "selected='selected'"; ?> >
							<?php 
							if($valor=='MX')
								echo 'México';
							else
								echo 'Internacional';
							?>
							</option>
						<?php
					 		}
					 		$antvalor = $valor;
						} ?>
						</select>
					</div>	
				</div>					
				<?php
					$sel='';
					$usd='';
					$mx = '';
					foreach ($detalles_promociones as $detalle) {
												
						if($detalle->id_promocion == $promo_inicial->id_promocion)
						    $sel = "selected='selected'";
						
						if($detalle->moneda=="MX")
							$mx.= "<option id=".$detalle->id_promocion." value=".$detalle->id_promocion." ".$sel." class=".$detalle->moneda.">".$detalle->descripcion_promocion."</option>";
												
						if($detalle->moneda=="USD")
							$usd.= "<option id=".$detalle->id_promocion." value=".$detalle->id_promocion." ".$sel." class=".$detalle->moneda.">".$detalle->descripcion_promocion."</option>";																			
					}
					echo "<div id='selmx' class='styled-select'>
					          <div class='cont-select'>
						      	<select name='promos' onchange=\"cambia_boton(this.value)\">	
						      		".$mx."
						      	</select>
						      </div>	
					      </div>";
					echo "<div id='selusd' class='styled-select'>
							<div class='cont-select'>
						      <select name='promos' onchange=\"cambia_boton(this.value)\" >		
						      	".$usd."
						      </select>
						    </div>  
					      </div>";	  
				?>	
				
				<?php
				//para B2B
				if (isset($info_publicacion) && $info_publicacion->auditableBi) {
				?>
				<div class="descripcion3">Si deseas recibir esta revista de forma gratuita, selecciona la opción de suscripción</div>
				<div class="styled-select"> 
					<div class="cont-select">								
						<form name="enviar_tipo_suscripcion" action="<?php echo site_url('B2B/ptienda.php') ?>" method="POST">
							<select name='tipo_suscripcion' class="styled" id='sel_b2b'>
								<option value=''>Selecciona opción</option>
								<option value='nva_<?php echo $info_publicacion->id_publicacionSi;?>'>Suscripción nueva</option>
								<option value='ren_<?php echo $info_publicacion->id_publicacionSi;?>'>Renovación</option>
								<option value='can_<?php echo $info_publicacion->id_publicacionSi;?>'>Cancelar</option>
							</select>
						</form>
					</div>								
				</div>
				<?php
				}
				?>	
			</div>	
			<div class="back-rayado" style="padding: 10px">enviar a un amigo</div>
			<div class="back-rayado">
				<input type="button" id="btn_agregar_carrito" name="btn_agregar_carrito" value="añadir al carrito" class="boton-anadir-carrito" onclick="submit_to_carrito(<?php echo $promo_inicial->id_promocion;?>)"/>
			</div>	
	    </div>
	    <div class="bloque-middle">
	    	<img src="<?php echo $src;?>" />
	    </div>
	    <div class="bloque-right">
	    	<div id='precio_promo' class="precio"> 
	    		$ <?php echo number_format($promo_inicial->costo,2 ,"." ,",")."&nbsp;".$promo_inicial->moneda?> 
	    	</div>
	    	<div id='descripcion-promo' class="descripcion-promocion">
	    		<?php echo $promo_inicial->descripcion_promocion?>
	    	</div>
	    	<div id='ejemplares-promo' class="descripcion3">
	    		<?php echo $promo_inicial->ejemplares?>
	    	</div>	    	
	    	<div id="descripcion-larga" class="descripcion3">
	    		<?php echo $promo_inicial->texto_oferta?>	    		
	    	</div>	    	
	    	<div class="back-rayado" style="position: relative; bottom: 0px;">
	    		<input type="button" id="btn_comprar_ahora" name="btn_comprar_ahora" value="Comprar ahora" class="boton-comprar-ahora" onclick="submit_to_pagos(<?php echo $promo_inicial->id_promocion;?>)"/>
	    	</div>
	    </div>
	    					
			<?php
				foreach ($detalles_promociones as $detalle) {
					//para pasar a pagar en la plataforma de pagos, es la acción por defecto:
					$action_pagos = ECOMMERCE."api/". $detalle->id_sitio . "/" . $detalle->id_canal . "/" . $detalle->id_promocion . "/pago";
										
					//datos para que se procese el pago en la plataforma 
					echo "
					<form id='comprar_promocion".$detalle->id_promocion."' name='comprar_promocion" . $detalle->id_promocion . "' action='" . $action_pagos . "' method='post'>".
						"<input type='hidden' name='guidx' value='".API::GUIDX."' />\n" . 
						"<input type='hidden' name='guidz' value='".API::guid()."' />\n". 
					    "<input type='hidden' name='imagen' value='".$src."' />\n" .
					    "<input type='hidden' name='descripcion' value='". $detalle->descripcion_promocion."' />\n" .
					    "<input type='hidden' name='precio' value='".$detalle->costo."' />\n" .
					    "<input type='hidden' name='moneda' value='".$detalle->moneda."' />\n" .
					    "<input type='hidden' name='iva' value='".$detalle->taxable."' />\n" .
					    "<input type='hidden' name='cantidad' value='1' />\n					     
					</form>";
					
					//promoción seleccionada inicialmente:
					$class_radio = "class='radio_no_selected'";
					/*
					echo "<pre>";
						print_r($detalle);
					echo "</pre>";
					*/
					if ($promo_inicial->id_promocion == $detalle->id_promocion)
						$class_radio = "class='radio_selected'";
			?>
									
					<div class="hidden" id='descripcion<?php echo $detalle->id_promocion ?>'><?php echo $detalle->descripcion_promocion; ?></div>
					<div class="hidden" ><?php echo $detalle->descripcion_publicacion_larga; ?></div>
					<div class="hidden" id='ejemplares<?php echo $detalle->id_promocion ?>'><?php echo $detalle->ejemplares; ?></div>
					<div class="hidden" id='texto-oferta<?php echo $detalle->id_promocion ?>'><?php echo $detalle->texto_oferta;?></div>
					<div class="hidden" id='precio<?php echo $detalle->id_promocion ?>'><?php echo number_format($detalle->costo,2, ".", ",")."&nbsp;".$detalle->moneda; //Precio y descuento aplicado sobre precio de portada?></div>				
				
			<?php
				}
			?>			
		<!--
		<div class="banner-descripcion">
			<div class="triangulo-negro-der"></div><?php echo $promo_inicial->nombre_publicacion;?>: <?php echo $promo_inicial->descripcion_publicacion; ?>
		</div>
		<div class="descripcion">
			<?php echo $promo_inicial->descripcion_publicacion_larga; ?>	
		</div>	
			<?php
				if (isset($secciones) AND array_key_exists($detalle->id_promocion, $secciones) && count($secciones[$detalle->id_promocion]) > 0) { 
					//se obtiene la información de la sección
					$seccion_promocion = $secciones[$detalle->id_promocion];		
			?>
			<!--En <?php //echo $promo_inicial->nombre_publicacion; ?> encontrar&aacute;s: 
				<?php 
					foreach($seccion_promocion as $value) { ?>
						<div class="space-pleca"></div>
						<div class="banner-descripcion">
							<div class="triangulo-negro-der"></div><?php echo $value->titulo_seccion; ?>
						</div>
						<div class="descripcion">
							<div class="texto-detalle">
								<div class="triangulo-rojo-der"></div><?php echo $value->descripcion_seccion ; ?>
							</div>
						</div>
			<?php
					}
				}
			?>
		-->
		
		
	</div>						
				

