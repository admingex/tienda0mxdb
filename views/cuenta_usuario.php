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
        $("#result_errores").html("" );	
        $.ajax({
        		cache: false,
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
		$("#result_errores").html("" );	
		$.ajax({  
				cache: false, 		 		           
                url:   ecommerce + "administrador_usuario/listar_tarjetas/" + "<?php echo $_SESSION['id_cliente']; ?>",
                type:  'POST', 
                dataType: "json",                               
                beforeSend: function () {                    	     	
					$("#result_informacion").html("Procesando, espere por favor..." );
                },
          		success:  function (data) {          			
          			$("#result_informacion").html("<div class='titulo-descripcion'>" +
												  "<div class='img-hoja'></div>Medios de pagos" +
												  "<div class='pleca-titulo'></div>" +
												  "</div><table id='tarjetas' cellspacing='0' cellpadding='0'><thead><tr><th>Tarjetas guardadas</th><th>Nombre</th><th>Expira</th></tr></thead></table> ");
          			$.each(data.tarjetas, function(k,v){
          				$("#tarjetas").append('<tr><td style="background-color: #F1F1F1">' + v.descripcionVc + ' terminación' + v.terminacion_tarjetaVc  + '</td>' +
          										  '<td style="background-color: #F1F1F1">' + v.nombre_titularVc + ' ' + v.apellidoP_titularVc + ' ' + v.apellidoM_titularVc + '</td>' +
          										  '<td style="background-color: #F1F1F1">' + v.mes_expiracionVc + '/' + v.anio_expiracionVc + '</td></tr>');          				          				          				          				 
          			});                   			          			    			             			     				      				   			      				          																		             
                }
        }); 	               		
		$('#boton_medios').removeClass('boton-medios').addClass('boton-medios-sel');
		$('#boton_historial').removeClass('boton-historial-sel').addClass('boton-historial');
		$('#boton_datos').removeClass('boton-datos-sel').addClass('boton-datos');
		$('#boton_configuracion').removeClass('boton-configuracion-sel').addClass('boton-configuracion');
	});	
	
	$("#boton_datos").click(function(e) {
		$("#result_errores").html("" );	
		$.ajax({   	
			cache: false,	 		           
                url:   ecommerce + "administrador_usuario/listar_razon_social/" + "<?php echo $_SESSION['id_cliente']; ?>",
                type:  'POST', 
                dataType: "json",                                               
          		success:  function (data) {          			
          			$("#result_informacion").html("<div class='titulo-descripcion'>" +
												  "<div class='img-hoja'></div>Datos de envío y facturación" +
												  "<div class='pleca-titulo'></div></div>" +
												  "<div class='encabezado-descripcion'>Datos de facturación</div>" +
												  "<table id='rfcs' cellspacing='0' cellpadding='0'><thead><tr><th>R.F.C.</th><th>Razón Social</th><th>Email</th></tr></thead></table> ");
          			$.each(data.rs, function(k,v){
          				$("#rfcs").append('<tr><td>'+ v.tax_id_number + '</td><td>' + v.company  + '</td><td>' +  v.email + '</td></tr>');          				          				          				          				 
          			});                   			          			    			             			     				      				   			      				          																		             
                }
        });        
        		
		$.ajax({   
				cache: false,		 		           
                url:   ecommerce + "administrador_usuario/listar_direccion_envio/" + "<?php echo $_SESSION['id_cliente']; ?>",
                type:  'POST', 
                dataType: "json",                               
                beforeSend: function () {                    	     	
					$("#result_informacion").html("Procesando, espere por favor..." );
                },
          		success:  function (data) {            
          			  			      			
          			$("#result_informacion").append("<div style='margin-top:18px'></div><div class='encabezado-descripcion'>Datos de envío</div>" +
          											"<table id='direcciones' cellspacing='0'><thead><tr><th>Dirección</th><th>Colonia</th><th>Codigo Postal</th><th>Ciudad</th><th>Estado</th></tr></thead></table>");
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
		 $("#result_errores").html("" );	
		 $.ajax({   	
		 		cache: false,	 		           
                url:   ecommerce + "administrador_usuario/cliente_id/" + <?php echo $_SESSION['id_cliente']; ?>,
                type:  'GET',
                dataType: "json",                
                beforeSend: function () {                	
					$("#result_informacion").html("Procesando, espere por favor..." );
                },
          		success:  function (data) {              			       			            			     				
      				var form = <?php include ('cuenta_usuario/formulario_usuario.html'); ?>   				
      				$("#result_informacion").html(form);
      				    
      				$("#boton_actualizar").click(function(e) {
      					var nombre = $('#nombre').val();
      					var apellido_paterno = $('#apellido_paterno').val();
      					var apellido_materno = $('#apellido_materno').val();
      					var email = $('#email').val();
      					var password_actual = $('#password_actual').val();
      					var nuevo_password = $('#nuevo_password').val();
      					var nuevo_password2 = $('#nuevo_password2').val();
      					var log_data = $('#log_data').val();
      					
      					var parametros = {
							"nombre"  			: nombre,
							"apellido_paterno"  : apellido_paterno,
							"apellido_materno"  : apellido_materno,
							"email"  			: email,
							"password_actual"  	: password_actual,
							"nuevo_password"  	: nuevo_password,
							"nuevo_password2" 	: nuevo_password2,
							"log_data"			: log_data
						}							
						
						$.ajax({  
								cache: false,
								data: parametros, 		 		           
					            url:   ecommerce + "administrador_usuario/actualizar_cliente/" + "<?php echo $_SESSION['id_cliente']; ?>",
					            type:  'POST', 
					            dataType: "json",                               
					            beforeSend: function () {                    	     	
									$("#result_informacion").html("Procesando, espere por favor..." );
					            },
					      		success:  function (data) {   
					      			if (data.error == 1){
					      									      									      				 	
					      				$("#boton_configuracion").click();
					      				$("#result_errores").html("<br />Por favor Revise la información siguiente<br />" );	
					      				
					      				$.each(data.errores, function(k,v){						      										      								      										      				
				      						$("#result_errores").append('<br />' + v);						      					         					      					          									          				          				          				          				
          								}); 
					      				
					      			}         
					      			else{		
					      				$("#result_errores").html("" );			      				
					      				$("#result_informacion").html('<div class="encabezado-descripcion">Tus datos se han actualizado correctamente.</div>');
					      				setTimeout('$("#boton_configuracion").click()', 2500);
					      				
					      			}
					      			  			      								      			                   			          			    			             			     				      				   			      				          																		             
					            }
					    });
						
					});      																		             
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
	<div id="result_errores">						
	</div>
	<div id="result_informacion">						
	</div>			
</div>		