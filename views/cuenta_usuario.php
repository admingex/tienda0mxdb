<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-historial-compras.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function() {
	$("#boton_historial").click(function(e) {
		var ecommerce = 'http://localhost/ecommerce/reporte/';		
														
		var parametros = {
			"id_cliente"  : "<?php echo $_SESSION['id_cliente']; ?>",
			"user"        : "aespinosa",
			"pass" 		  : "Aesp1n0_20120618"
		}		
        
        $.ajax({
                data:  parametros,
                url:   ecommerce + "compra_cliente",
                type:  'post',
                beforeSend: function () {
					$("#result_informacion").html("Procesando, espere por favor...");
                },
          		success:  function (response) {          			
					$("#result_informacion").html(response);                                                
                }
        }); 
               
	});
	
	$("#boton_medios").click(function(e) {
		alert('medios');
	});	
	
	$("#boton_datos").click(function(e) {
		alert('datos');
	});	
	
	$("#boton_configuracion").click(function(e) {
		alert('configuracion');
	});		
});		
</script>
<div id="historial-compras">
	<div>	
		<input type="button" id="boton_historial" value="" class="boton-historial" />
		<input type="button" id="boton_medios" value="" class="boton-medios"/>
		<input type="button" id="boton_datos" value="" class="boton-datos"/>
		<input type="button" id="boton_configuracion" value="" class="boton-configuracion" />
	</div>
	<div id="result_informacion">						
	</div>			
</div>		