<link href='<?php echo TIENDA ?>css/viewlet-login.css' rel='stylesheet' type="text/css" />
<div id="viewlet-login">
	<div class="titulo">
		<span style="padding-left: 20px;"><?php if (isset($proceso)) echo $proceso; ?></span>
	</div>	
	<div class="pleca-superior"></div>	
	<section class="contenedor-tienda">	
		<!--div class="contenedor-gris"-->
		<?php								
			switch ($accion) {
				case 'enviado':	//Viene del método enviar()					
					include ('password/password_enviado.html');
					break;
				
				case 'verificar':
					echo '<div class="instrucciones">Esta es la clave que recibiste en tu correo electr&oacute;nico junto con la liga a esta p&aacute;gina</div>';					
					include ('password/verificar.html');
					break;
				
				case 'cambiar':
					echo '<div class="instrucciones">Escribe una nueva contrase&ntilde;a y confírmala. La contrase&ntilde;a debe tener al menos 8 caracteres y contener letras mayúsculas, minúsculas y al menos un número</div>';					
					include ('password/cambiar.html');
					break;
					
				default:	//recordar
					echo '<div class="instrucciones">Para recuperar tu contrase&ntilde;a, escribe tu correo electr&oacute;nico. Te enviaremos un correo con las instrucciones que debes seguir</div>';
					include ('password/recordar.html');
					break;
					
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
</div>