<section class="contenedor-tienda">	
	<div class="contenedor-gris">
		<?php		
		include ('registro/registro.html');		
		?>
	</div>		
	<?php
	if (!empty($mensaje)) {
	?>
		<div id="dialog" title="Mensaje" >
			<p><?php echo $mensaje?></p>
		</div>
	<?php
	}
	?>
	<div id="scripts">
		<script type="text/javascript">
			/*mensaje y redirección*/
			$(function() {
				$( "#dialog:ui-dialog" ).dialog( "destroy" );
				
				$( "#dialog" ).dialog({
					resizable: false,
					//height:140,
					modal: true,
					buttons: {
						"Ok": function() {
							$( this ).dialog( "close" );
							//$url_redirect = site_url('direccion_envio');
						}
					}
				});
			});
		</script>
	</div>	
<section>