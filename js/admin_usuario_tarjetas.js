function editar_tc(id_tarjeta , id_tipo ){	
	$.ajax({   
		cache: false,		 		           
        url:   ecommerce + "administrador_usuario/editar_tc/" + id_tarjeta + "/" + id_tipo + "/" + id_cliente_js,
        type:  'POST',                                      
        beforeSend: function () {                    	     	
			$("#result_informacion").html("Procesando, espere por favor..." );
        },
  		success:  function (response) {              			  			      			
  			$("#result_informacion").html(response);  		  			            			          			    			             			     				      				   			      				          																		             
        }
    }); 	
    
}

function enviar_tc(id_tc, id_tipo){		
	var txt_nombre = $('#txt_nombre').val();
	var txt_apellidoPaterno = $('#txt_apellidoPaterno').val();
	var txt_apellidoMaterno = $('#txt_apellidoMaterno').val();		
	var sel_mes_expira = $('#sel_mes_expira').val();
	var sel_anio_expira = $('#sel_anio_expira').val();
	
	
			
	if($("#chk_default").is(':checked')){
		var chk_default = 1;	
	}
	else{
		var chk_default = 0;
	}
	
	var parametros = {
		"txt_nombre"  			: txt_nombre,
		"txt_apellidoPaterno"  	: txt_apellidoPaterno,
		"txt_apellidoMaterno"  	: txt_apellidoMaterno,
		"sel_mes_expira"		: sel_mes_expira,
		"sel_anio_expira"		: sel_anio_expira,
		"chk_default"			: chk_default		 
	}	
	
	$.ajax({	
		cache: false,  
		data: parametros,    
	    url:   ecommerce + "administrador_usuario/editar_tc/"+ id_tc + "/"+ id_tipo + "/" + id_cliente_js,
	    type:  'post',
	    beforeSend: function () {
			$("#result_informacion").html("Procesando, espere por favor...");
	    },
		success:  function (response) {          			
			$("#result_informacion").html(response);  
			if($("#actualizar_tarjeta").text()== 1){
				$("#result_informacion").html('<div class="encabezado-descripcion">Informacion de tarjeta actualizada correctamente.</div>');
				setTimeout('$("#boton_medios").click()', 2500);
			}			                                            
	    }
    });	
}

function eliminar_tc(id_tarjeta){
	var conf = confirm("¿Estas seguro?");
	if(conf){
		$.ajax({   
			cache: false,		 		           
        	url:   ecommerce + "administrador_usuario/eliminar_tc/" + id_tarjeta + "/" + id_cliente_js,
        	type:  'POST',                                      
        	beforeSend: function () {                    	     	
				$("#result_informacion").html("Procesando, espere por favor..." );
        	},
  			success:  function (response) {              			  			      			
  				$("#result_informacion").html(response);  	
  				if($("#eliminar_tarjeta").text()== 1){
					$("#result_informacion").html('<div class="encabezado-descripcion">Se elimino la información de tarjeta.</div>');
					setTimeout('$("#boton_medios").click()', 2500);	
				}                                      	  			            			          			    			             			     				      				   			      				          																		             
        	}
    	});
   }    
     	
}