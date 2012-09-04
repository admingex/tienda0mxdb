<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-historial-compras.css" rel="stylesheet" />
<script type="text/javascript">
var ecommerce = 'http://localhost/ecommerce/reporte/';
var parametros = {
			"id_cliente"  : "<?php echo $_SESSION['id_cliente']; ?>",
			"user"        : "aespinosa",
			"pass" 		  : "Aesp1n0_20120618"
		}

$(document).ready(function() {	
		
	$("#boton_historial").click(function(e) {																						
        
        $.ajax({
                data:  parametros,
                url:   ecommerce + "compras_cliente",
                type:  'post',
                beforeSend: function () {
					$("#result_informacion").html("Procesando, espere por favor...");
                },
          		success:  function (response) {          			
					$("#result_informacion").html(response);                                                
                }
        }); 
		$('#boton_historial').removeClass('boton-historial').addClass('boton-historial-sel');               		
		$('#boton_medios').removeClass('boton-medios-sel').addClass('boton-medios');
		$('#boton_datos').removeClass('boton-datos-sel').addClass('boton-datos');
		$('#boton_configuracion').removeClass('boton-configuracion-sel').addClass('boton-configuracion');
	});
	
	$("#boton_medios").click(function(e) {
		$("#result_informacion").html("medios");		               		
		$('#boton_medios').removeClass('boton-medios').addClass('boton-medios-sel');
		$('#boton_historial').removeClass('boton-historial-sel').addClass('boton-historial');
		$('#boton_datos').removeClass('boton-datos-sel').addClass('boton-datos');
		$('#boton_configuracion').removeClass('boton-configuracion-sel').addClass('boton-configuracion');
	});	
	
	$("#boton_datos").click(function(e) {
		$("#result_informacion").html("datos");
		$('#boton_datos').removeClass('boton-datos').addClass('boton-datos-sel');
		$('#boton_historial').removeClass('boton-historial-sel').addClass('boton-historial');               		
		$('#boton_medios').removeClass('boton-medios-sel').addClass('boton-medios');		
		$('#boton_configuracion').removeClass('boton-configuracion-sel').addClass('boton-configuracion');
	});	
	
	$("#boton_configuracion").click(function(e) {
		$("#result_informacion").html("configuracion");
		$('#boton_configuracion').removeClass('boton-configuracion').addClass('boton-configuracion-sel');
		$('#boton_historial').removeClass('boton-historial-sel').addClass('boton-historial');               		
		$('#boton_medios').removeClass('boton-medios-sel').addClass('boton-medios');
		$('#boton_datos').removeClass('boton-datos-sel').addClass('boton-datos');		
	});	
	
	$("#boton_historial").click();	
				
});	

function detalle_compra(compra, cliente){
	$.ajax({
                data:  parametros,
                url:   ecommerce + "detalle_compra/" + compra + "/" + cliente,
                type:  'post',
                beforeSend: function () {
					$("#result_informacion").html("Procesando, espere por favor...");
                },
          		success:  function (response) {          			
					$("#result_informacion").html(response);                                                
                }
    });	
}	
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