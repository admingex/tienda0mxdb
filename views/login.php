
<link href='<?php echo TIENDA ?>css/viewlet-login.css' rel='stylesheet' type="text/css" />
<?php		
include ('login/login.html');		
?>		
<?php
if (!empty($mensaje)) {
?>
	<div id="dialog" title="Resultado" >
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
