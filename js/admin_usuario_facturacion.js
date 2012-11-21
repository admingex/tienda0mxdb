function editar_rs(id_rs){	
	$.ajax({	  
		cache: false,  
	    url:   administrador + "administrador_usuario.php?accion=editar_rs",
	    type:  'GET',
	    data: {"id_rs": id_rs},
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
		    url:   administrador + "administrador_usuario.php?accion=eliminar_rs",
		    type:  'post',
		    data: {"id_rs":id_rs},
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
	    url:   administrador + "administrador_usuario.php?accion=editar_rs&id_rs="+ id_rs,
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

function listar_dir_facturacion(){
	$.ajax({   	
			cache: false,	 		           
                url:   administrador + "administrador_usuario.php?accion=listar_direccion_facturacion",
                type:  'POST', 
                data: {"id_cliente": id_cliente_js},
                dataType: "json",                                                         
          		success:  function (data) {         					
					    			 			
          			$("#result_informacion").append("<div class='encabezado-descripcion'>Direcciones de facturación</div>" +
												  "<table id='direcciones_facturacion' cellspacing='0'><thead><tr><th>Dirección</th><th>Colonia</th><th>Codigo Postal</th><th>Ciudad</th><th>Estado</th><th colspan='2'>&nbsp;</th></tr></thead></table>");
											  
          			$.each(data.direccion_facturacion, function(k,v){
          				var inter = '';  
  						if(v.num_int){
  							inter = v.num_int;		
  						}
          				var pe= ' ';
          				if(v.id_estatusSi == 3){
          					pe = "<div style='color: #D81830; height: 20px; font-size: 11px; font-family: italic; font-weight: bold'>pago express</div>";
          				}
          				$("#direcciones_facturacion").append('<tr><td>'+ v.calle + ' ' + 
  													 v.num_ext + ' ' + 
  													 inter + '</td><td>' + 
  													 v.colonia  + '</td><td>' + 
  													 v.cp  + '</td><td>' +  
  													 v.ciudad + '</td><td>' + 
  													 v.estado  + '</td>'+
  													 '<td onclick=\"editar_dir_facturacion('+ v.id_consecutivoSi +')\" valign="top"><a href="#">editar</a></td>'+
  													 '<td onclick=\"eliminar_dir_facturacion('+ v.id_consecutivoSi +')\" valign="top"><a href="#">eliminar</a></td>'+
  													 '</tr>');          				          				          				          				 
          			});  
          			
          			               			          			    			             			     				      				   			      				          																		             
                }
        });        
}

function editar_dir_facturacion(id_dir){
	
	$.ajax({	  
		cache: false,  
	    url:   ecommerce + "administrador_usuario/editar_direccion_facturacion/" + id_dir + "/" + id_cliente_js,
	    type:  'post',
	    beforeSend: function () {
			$("#result_informacion").html("Procesando, espere por favor...");
	    },
		success:  function (response) {          			
			$("#result_informacion").html(response);                                                
	    }
    });	
}

function enviar_dir_facturacion(id_dir){
	var txt_calle = $('#txt_calle').val();
	var txt_numero = $('#txt_numero').val();
	var txt_num_int = $('#txt_num_int').val();
	var txt_cp = $('#txt_cp').val();
	var sel_pais = $('#sel_pais').val();	
	var txt_estado = $('#txt_estado').val();
	var txt_ciudad = $('#txt_ciudad').val();
	var txt_colonia = $('#txt_colonia').val();
	if($("#chk_default").is(':checked')){
		var chk_default = 1;	
	}
	else{
		var chk_default = 0;
	}
	
	var parametros = {
		"txt_calle"  		: txt_calle,
		"txt_numero" 		: txt_numero,
		"txt_num_int"  		: txt_num_int,
		"txt_cp"			: txt_cp,
		"sel_pais"			: sel_pais,
		"txt_estado"		: txt_estado,
		"txt_ciudad"		: txt_ciudad,
		"txt_colonia"		: txt_colonia,
		"chk_default"		: chk_default			
	}
	
	$.ajax({	  
		cache: false,
		data: parametros,  
	    url:   ecommerce + "administrador_usuario/editar_direccion_facturacion/" + id_dir + "/" + id_cliente_js,
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

function eliminar_dir_facturacion(id_dir){	
	
	var conf = confirm("¿Estas seguro?");
	if(conf){
		$.ajax({   
			cache: false,		 		           
        	url:   administrador + "administrador_usuario.php?accion=eliminar_direccion",
        	type:  'POST',                                      
        	data: {"id_dir": id_dir, "id_cliente": id_cliente_js},
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