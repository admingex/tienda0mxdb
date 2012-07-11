<section id="descripcion-proceso">
	<div class="titulo-proceso-img">&nbsp;</div>			
	<div class="titulo-proceso">
		<?php if (isset($proceso)) echo $proceso; ?>	
	</div>
</section>
<div id="pleca-punteada"></div>

<section class="contenedor-tienda">	
	<!--div class="contenedor-gris"-->
	<?php								
		switch ($accion) {
			case 'enviado':	//Viene del método enviar()
				echo '<div class="contenedor-gris">';
				include ('password/password_enviado.html');
				break;
			
			case 'verificar':
				echo '<div class="instrucciones_mensaje">Esta es la clave que recibiste en tu correo electr&oacute;nico junto con la liga a esta p&aacute;gina</div>';
				echo '<div class="contenedor-gris">';
				include ('password/verificar.html');
				break;
			
			case 'cambiar':
				echo '<div class="instrucciones_mensaje">Escribe una nueva contrase&ntilde;a y confírmala. La contrase&ntilde;a debe tener al menos 8 caracteres y contener letras mayúsculas, minúsculas y al menos un número</div>';
				echo '<div class="contenedor-gris">';
				include ('password/cambiar.html');
				break;
				
			default:	//recordar
				echo '<div class="instrucciones_mensaje">Para recuperar tu contrase&ntilde;a, escribe tu correo electr&oacute;nico. Te enviaremos un correo con las instrucciones que debes seguir</div>';
				echo '<div class="contenedor-gris">';
				include ('password/recordar.html');
				break;
				
		}
	?>
	</div>
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