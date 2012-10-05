function editar_rs(id_rs){	
	$.ajax({	  
		cache: false,  
	    url:   ecommerce + "administrador_usuario/editar_rs/"+ id_rs,
	    type:  'post',
	    beforeSend: function () {
			$("#result_informacion").html("Procesando, espere por favor...");
	    },
		success:  function (response) {          			
			$("#result_informacion").html(response);                                                
	    }
    });		
}

function eliminar_rs(id_rs){	
	var conf = confirm("¿Estas seguro?");
	if(conf){
		$.ajax({	  
			cache: false,  
		    url:   ecommerce + "administrador_usuario/eliminar_rs/"+ id_rs,
		    type:  'post',
		    beforeSend: function () {
				$("#result_informacion").html("Procesando, espere por favor...");
		    },
			success:  function (response) {          			
				$("#result_informacion").html(response);  
				if($("#eliminar_correcto").text()== 1){
					$("#result_informacion").html('<div class="encabezado-descripcion">Se elimino la información.</div>');
					setTimeout('$("#boton_datos").click()', 2500);	
				}                                              
		    }
	    });		
   }   
}
function enviar_rs(id_rs){	
	var txt_razon_social = $('#txt_razon_social').val();
	var txt_rfc = $('#txt_rfc').val();
	var txt_email = $('#txt_email').val();	
	if($("#chk_default").is(':checked')){
		var chk_default = 1;	
	}
	else{
		var chk_default = 0;
	}
	
	var parametros = {
		"txt_razon_social"  : txt_razon_social,
		"txt_rfc"  			: txt_rfc,
		"txt_email"  		: txt_email,
		"chk_default"		: chk_default,
		"id_cliente"		: id_cliente_js
	}	
	
	$.ajax({	
		cache: false,  
		data: parametros,    
	    url:   ecommerce + "administrador_usuario/editar_rs/"+ id_rs,
	    type:  'post',
	    beforeSend: function () {
			$("#result_informacion").html("Procesando, espere por favor...");
	    },
		success:  function (response) {          			
			$("#result_informacion").html(response);  
			if($("#update_correcto").text()== 1){
				$("#result_informacion").html('<div class="encabezado-descripcion">Tus datos se han actualizado correctamente.</div>');
				setTimeout('$("#boton_datos").click()', 2500);
			}			                                            
	    }
    });	
}
