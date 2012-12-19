<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-historial-compras.css" rel="stylesheet" />
<script type="text/javascript" src="<?php TIENDA;?>js/admin_usuario_facturacion.js"></script>
<script type="text/javascript" src="<?php TIENDA;?>js/admin_usuario_compras.js"></script>
<script type="text/javascript" src="<?php TIENDA;?>js/admin_usuario_dir_envio.js"></script>
<script type="text/javascript" src="<?php TIENDA;?>js/admin_usuario_tarjetas.js"></script>

<script type="text/javascript">
var administrador = 'http://localhost/tienda/';
 
	// se agrega la variable id_cliente_js con el valor del id de cliente para poderla utilizar con javascript
var id_cliente_js =<?php echo $_SESSION['id_cliente']; ?>

var parametros = {
	"id_cliente"  : id_cliente_js			
}

$(document).ready(function() {	
		
	$("li#boton_historial").click(function(e) {	
		
		$('#boton_historial').css('color', '#8DC540');		               		
		$('#boton_medios').css('color', '');
		$('#boton_datos').css('color', '');
		$('#boton_configuracion').css('color', '');
																									
        $("#result_errores").html("" );	
        $.ajax({
        		cache: false,
                data:  parametros,                
                url:   administrador + "administrador_usuario.php?accion=compras_cliente",
                type:  'post',
                beforeSend: function () {
					$("#result_informacion").html("<div class='procesando'>Procesando, espere por favor...</div>");
                },
          		success:  function (response) {          			
					$("#result_informacion").html(response);                                                
                }
        });         
	});
	
	$("#boton_medios").click(function(e) {
		
		$('#boton_medios').css('color', '#8DC540');
		$('#boton_historial').css('color', '');
		$('#boton_datos').css('color', '');
		$('#boton_configuracion').css('color', '');
		
		$("#result_errores").html("" );	
		$.ajax({  
				cache: false, 		 		           
                url:   administrador + "administrador_usuario.php?accion=listar_tarjetas",
                type:  'POST', 
                dataType: "json",
                data: {"id_cliente": id_cliente_js},                               
                beforeSend: function () {                    	     	
					$("#result_informacion").html("<div class='procesando'>Procesando, espere por favor...</div>" );
                },
          		success:  function (data) {                  			          			  			
          			$("#result_informacion").html("<div class='pleca-titulo'></div>" +
												  "<table id='tarjetas' cellspacing='0' cellpadding='0'><thead><tr><th>Tarjetas guardadas</th><th>Nombre</th><th>Expira</th><th>&nbsp;</th></tr></thead></table> ");
          			$.each(data.tarjetas, function(k,v){
          				var pe= ' ';
          				if(v.id_estatusSi == 3){
          					pe = "<div style='color: #D81830; height: 20px; font-size: 11px; font-family: italic; font-weight: bold'>pago express</div>";
          				}
          				var param = ","+ v.id_tipo_tarjetaSi; 
          				$("#tarjetas").append("<tr><td>" + v.descripcionVc + " terminación" + v.terminacion_tarjetaVc  + pe + "</td>" +
          										  "<td>" + v.nombre_titularVc + ' ' + v.apellidoP_titularVc + ' ' + v.apellidoM_titularVc + "</td>" +
          										  "<td>" + v.mes_expiracionVc + '/' + v.anio_expiracionVc + "</td>" +
          										  "<td><div onclick=\"editar_tc('"+ v.id_TCSi+ "', '"+v.id_tipo_tarjetaSi+ "')\" ><a href='#'>editar</a></div><div onclick=\"eliminar_tc('"+ v.id_TCSi+ "')\" ><a href='#'>eliminar</a></div></td>" +          										  
          										  "</tr>");          				          				          				          				 
          			});          			                   			          			    			             			     				      				   			      				          																		             
                }
        }); 	           		            				
	});	
	
	$("#boton_datos").click(function(e) {
		
		$('#boton_datos').css('color', '#8DC540');
		$('#boton_historial').css('color', '');               		
		$('#boton_medios').css('color', '');		
		$('#boton_configuracion').css('color', '');
		
		$("#result_errores").html("" );	
		$.ajax({   	
			cache: false,	 		           
                url:   administrador + "administrador_usuario.php?accion=listar_razon_social",
                type:  'POST', 
                data: {"id_cliente": id_cliente_js},
                dataType: "json",   
                beforeSend: function () {                    	     	
					$("#result_informacion").html("<div class='procesando'>Procesando, espere por favor...</div>" );
                },                                                           
          		success:  function (data) {          	
          			$("#result_informacion").html(data);
          				
          			$("#result_informacion").html("<div class='pleca-titulo'></div>" +
												  "<div class='encabezado-descripcion'>Datos de facturación</div>" +
												  "<table id='rfcs' cellspacing='0' cellpadding='0'><thead><tr><th>Razón Social</th><th>R.F.C.</th><th>Email</th><th>&nbsp;</th></tr></thead></table> ");
          			$.each(data.rs, function(k,v){
          				var pe= ' ';
          				if(v.id_estatusSi == 3){
          					pe = "<div style='color: #D81830; height: 20px; font-size: 11px; font-family: italic; font-weight: bold'>pago express</div>";
          				}
          				$("#rfcs").append('<tr><td>'+ v.company + pe +
          				                  '</td><td>' + v.tax_id_number  + 
          				                  '</td><td>' +  v.email + '</td>' +
          				                  '<td><div onclick=\"editar_rs('+ v.id_razonSocialIn +')\"><a href="#">editar</a></div><div onclick=\"eliminar_rs('+ v.id_razonSocialIn +')\"><a href="#">eliminar</a></div></td>'+
          				                  '</tr>');          				          				          				          				 
          			});
          			                   			          			    			             			     				      				   			      				          																		             
                }
        });        
        $('#boton_datos').attr('disabled','disabled');
        setTimeout('listar_dir_facturacion()', 500);        
        setTimeout('listar_dir_envio()', 1000);
                							
	});	
	
	$("#boton_configuracion").click(function(e) {	
		
		$('#boton_configuracion').css('color', '#8DC540');
		$('#boton_historial').css('color', '');               		
		$('#boton_medios').css('color', '');
		$('#boton_datos').css('color', '');	
				
		$("#result_errores").html("" );	
		$.ajax({   	
		 		cache: false,	 		           
                url:   administrador + "administrador_usuario.php",
                type:  'GET',
                data: {"accion": "cliente_id", "id_cliente": id_cliente_js},                            
                beforeSend: function () {                    	            					
					$("#result_informacion").html("<div class='procesando'>Procesando, espere por favor...</div>" );                                                
                },
          		success:  function (data) {             			       			            		
           			$("#result_informacion").html(data);           			       			            			     				      				      																		            
                }
        });					
	});						
	
	$("#boton_historial").click();
									
});	

function actualizar(){
	
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
		"log_data"			: log_data,			
		"id_cliente"		: id_cliente_js
	}							
	
	$.ajax({  
			cache: false,
			data: parametros, 		 		           
            url:   administrador + "administrador_usuario.php?accion=actualizar_cliente",
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
  						setTimeout('$("#boton_configuracion").click()', 3500);						      					         					      					          									          				          				          				          				
					}); 
      				
      			}         
      			else{		
      				$("#result_errores").html("" );			      				
      				$("#result_informacion").html('<div class="encabezado-descripcion">Tus datos se han actualizado correctamente.</div>');
      				setTimeout('$("#boton_configuracion").click()', 2500);
      				
      			}	      			
      			  			      								      			                   			          			    			             			     				      				   			      				          																		             
            }
    });
}

function view_pass(){
	$('#cambiar_password').toggle();	
	$('#view_pass_link').hide();
}

</script>

<div class="banner_compras">
	<ul>
		<li id="boton_historial">historial de compras</li>
		<li id="boton_medios">medios de pago</li>
		<li id="boton_datos">datos de envío y facturación</li>
		<li id="boton_configuracion" >configurar cuenta</li>
	</ul>			
</div>	

<div id="result_errores"></div>
<div id="result_informacion"></div>		