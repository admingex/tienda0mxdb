<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-historial-compras.css" rel="stylesheet" />
<script type="text/javascript">
var ecommerce = 'http://localhost/ecommerce/';
var parametros = {
			"id_cliente"  : "<?php echo $_SESSION['id_cliente']; ?>",
			"user"        : "aespinosa",
			"pass" 		  : "Aesp1n0_20120618"
		}

$(document).ready(function() {	
		
	$("#boton_historial").click(function(e) {																						
        
        $.ajax({
                data:  parametros,
                url:   ecommerce + "reporte/compras_cliente",
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
		
		$.ajax({   		 		           
                url:   ecommerce + "administrador_usuario/listar_razon_social/" + "<?php echo $_SESSION['id_cliente']; ?>",
                type:  'POST', 
                dataType: "json",                               
                beforeSend: function () {                    	     	
					$("#result_informacion").html("Procesando, espere por favor..." );
                },
          		success:  function (data) {          			
          			$("#result_informacion").html("<table id='rfcs'><tr><td>R.F.C.</td><td>Razón Social</td><td>Email</td></tr></table> ");
          			$.each(data.rs, function(k,v){
          				$("#rfcs").append('<tr><td>'+ v.tax_id_number + '</td><td>' + v.company  + '</td><td>' +  v.email + '</td></tr>');          				          				          				          				 
          			});                   			          			    			             			     				      				   			      				          																		             
                }
        });        
        		
		$.ajax({   		 		           
                url:   ecommerce + "administrador_usuario/listar_direccion_envio/" + "<?php echo $_SESSION['id_cliente']; ?>",
                type:  'POST', 
                dataType: "json",                               
                beforeSend: function () {                    	     	
					$("#result_informacion").html("Procesando, espere por favor..." );
                },
          		success:  function (data) {            
          			  			      			
          			$("#result_informacion").append("<br /><br /><table id='direcciones'><tr><td>Dirección</td><td>Colonia</td><td>Codigo Postal</td><td>Ciudad</td><td>Estado</td></tr></table> ");
          			$.each(data.direccion_envio, function(k,v){          				
          				$("#direcciones").append('<tr><td>'+ v.calle + ' ' + v.num_ext + ' ' + v.num_int + '</td><td>' + v.colonia  + '</td><td>' + v.cp  + '</td><td>' +  v.ciudad + '</td><td>' + v.estado  + '</td></tr>');          				          				          				          				 
          			});                   			          			    			             			     				      				   			      				          																		             
                }
        });  
		
		$('#boton_datos').removeClass('boton-datos').addClass('boton-datos-sel');
		$('#boton_historial').removeClass('boton-historial-sel').addClass('boton-historial');               		
		$('#boton_medios').removeClass('boton-medios-sel').addClass('boton-medios');		
		$('#boton_configuracion').removeClass('boton-configuracion-sel').addClass('boton-configuracion');
	});	
	
	$("#boton_configuracion").click(function(e) {
		 
		 $.ajax({   		 		           
                url:   ecommerce + "login/cliente_id/" + <?php echo $_SESSION['id_cliente']; ?>,
                type:  'GET',
                dataType: "json",                
                beforeSend: function () {                	
					$("#result_informacion").html("Procesando, espere por favor..." );
                },
          		success:  function (data) {             			            			     				
      				var form = <?php include ('cuenta_usuario/formulario_usuario.html'); ?>   				
      				$("#result_informacion").html(form);          																		             
                }
        });	
		
		$('#boton_configuracion').removeClass('boton-configuracion').addClass('boton-configuracion-sel');
		$('#boton_historial').removeClass('boton-historial-sel').addClass('boton-historial');               		
		$('#boton_medios').removeClass('boton-medios-sel').addClass('boton-medios');
		$('#boton_datos').removeClass('boton-datos-sel').addClass('boton-datos');		
	});	
	
	$("#boton_historial").click();	
				
});	

function view_pass(){
	$('#cambiar_password').toggle();	
	$('#view_pass_link').hide();
}

function detalle_compra(compra, cliente){	
	$.ajax({
                data:  parametros,
                url:   ecommerce + "/reporte/detalle_compra/" + compra + "/" + cliente,
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