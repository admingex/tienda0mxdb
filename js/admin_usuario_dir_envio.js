
function listar_dir_envio(){	

	$.ajax({   
		cache: false,		 		           
        url:   ecommerce + "administrador_usuario/listar_direccion_envio/" + id_cliente_js,
        type:  'POST', 
        dataType: "json",                               
        beforeSend: function () {                    	     	
			//$("#result_informacion").html("Procesando, espere por favor..." );
        },
  		success:  function (data) {            
  			  			      			
  			$("#result_informacion").append("<div style='margin-top:18px'></div><div class='encabezado-descripcion'>Datos de envío</div>" +
  											"<table id='direcciones' cellspacing='0'><thead><tr><th>Dirección</th><th>Colonia</th><th>Codigo Postal</th><th>Ciudad</th><th>Estado</th><th colspan='2'>&nbsp;</th></tr></thead></table>");
  			$.each(data.direccion_envio, function(k,v){
  				var inter = '';  
  				if(v.num_int){
  					inter = v.num_int;		
  				}        				
  				$("#direcciones").append('<tr><td>'+ v.calle + ' ' + 
  													 v.num_ext + ' ' + 
  													 inter + '</td><td>' + 
  													 v.colonia  + '</td><td>' + 
  													 v.cp  + '</td><td>' +  
  													 v.ciudad + '</td><td>' + 
  													 v.estado  + '</td>'+
  													 '<td onclick=\"editar_dir_envio('+ v.id_consecutivoSi +')\" valign="top"><a href="#">editar</a></td>'+
  													 '<td onclick=\"eliminar_dir_envio('+ v.id_consecutivoSi +')\" valign="top"><a href="#">eliminar</a></td>'+
  													 '</tr>');          				          				          				          				 
  			});   
  			$('#boton_datos').removeAttr('disabled');                			          			    			             			     				      				   			      				          																		             
        }
    });  
}

function eliminar_dir_envio(id_env){	
	
	var conf = confirm("¿Estas seguro?");
	if(conf){
		$.ajax({   
			cache: false,		 		           
        	url:   ecommerce + "administrador_usuario/eliminar_dir_envio/" + id_env + "/" + id_cliente_js,
        	type:  'POST',                                      
        	beforeSend: function () {                    	     	
				$("#result_informacion").html("Procesando, espere por favor..." );
        	},
  			success:  function (response) {              			  			      			
  				$("#result_informacion").html(response);  	
  				if($("#eliminar_direccion").text()== 1){
					$("#result_informacion").html('<div class="encabezado-descripcion">Se elimino la información.</div>');
					setTimeout('$("#boton_datos").click()', 2500);	
				}                                      	  			            			          			    			             			     				      				   			      				          																		             
        	}
    	});
   }  
}
	