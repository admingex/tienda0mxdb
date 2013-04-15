function listar_dir_envio(){	

	$.ajax({   
		cache: false,		 		           
        url:   administrador + "administrador_usuario.php?accion=listar_direccion_envio",
        type:  'POST',
        data: {"id_cliente": id_cliente_js}, 
        dataType: "json",                               
        beforeSend: function () {                    	     	
			//$("#result_informacion").html("Procesando, espere por favor..." );
        },
  		success:  function (data) {              			
  			  			      			
  			$("#result_informacion").append("<div class='pleca-titulo space10'></div><div class='encabezado-descripcion'>Datos de envío</div>" +
  											"<table id='direcciones' cellspacing='0'><thead><tr><th>Dirección</th><th>Colonia</th><th>Codigo Postal</th><th>Ciudad</th><th>Estado</th><th>&nbsp;</th></tr></thead></table>");
  			$.each(data.direccion_envio, function(k,v){
  				var inter = '';  
  				if(v.num_int){
  					inter = v.num_int;		
  				}        			
  				var pe= ' ';
          		if(v.id_estatusSi == 3){
          			pe = "<div style='color: #D81830; height: 20px; font-size: 11px; font-family: italic; font-weight: bold'>pago express</div>";
          		}	
  				$("#direcciones").append('<tr><td>'+ v.calle + ' ' + 
  													 v.num_ext + ' ' + 
  													 inter + pe +'</td><td>' + 
  													 v.colonia  + '</td><td>' + 
  													 v.cp  + '</td><td>' +  
  													 v.ciudad + '</td><td>' + 
  													 v.estado  + '</td>'+
  													 '<td valign="top"><div onclick=\"editar_dir_envio('+ v.id_consecutivoSi +')\"><a href="#">editar</a></div><div onclick=\"eliminar_dir_envio('+ v.id_consecutivoSi +')\"><a href="#">eliminar</a></div></td>'+
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
        	url:   administrador + "administrador_usuario.php?accion=eliminar_direccion",
        	type:  'POST',                                      
        	data: {"id_dir": id_env, "id_cliente": id_cliente_js},                                      
        	beforeSend: function () {                    	     	
				$("#result_informacion").html("<div class='procesando'>Procesando, espere por favor...</div>" );
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


function editar_dir_envio(id_dir){
	
	$.ajax({   
		cache: false,		 		           
    	url:   administrador + "administrador_usuario.php?accion=editar_dir_envio",
    	type:  'GET',                                      
    	data: {"id_dir": id_dir, "id_cliente": id_cliente_js},
    	beforeSend: function () {                    	     	
			$("#result_informacion").html("<div class='procesando'>Procesando, espere por favor...</div>" );
    	},
		success:  function (response) {              			  			      			
			$("#result_informacion").html(response);  							
/*			
			var forms = $("form[id*='registro']");				
			
			var reg_cp = /^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/;
			var reg_email = /^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;
			var reg_nombres = /^[A-ZáéíóúÁÉÍÓÚÑñ \'.-]{1,30}$/i;
			var reg_numeros = /^[A-Z0-9 -.#\/]{1,50}$/i;
			var reg_direccion = /^[A-Z0-9 \'.,-áéíóúÁÉÍÓÚÑñ]{1,50}$/i;
			var reg_telefono = /^[0-9 ()+-]{10,20}$/
			
			var calle	= $("#txt_calle");
			var num_ext	= $("#txt_numero");
			var cp		= $("#txt_cp");
			var pais 	= $("#sel_pais");
			var estado_t 	= $("#txt_estado");
			var ciudad_t 	= $("#txt_ciudad");
			var colonia_t	= $("#txt_colonia");
			var estado_s 	= $("#sel_estados");
			var ciudad_s 	= $("#sel_ciudades");
			var colonia_s	= $("#sel_colonias");
			var telefono= $("#txt_telefono");
			var estado, ciudad, colonia;
			
			$('.div_otro_pais').hide();		
			
			//onChange:
			$('#sel_pais').change(function() {
				//hacer un toggle si es necesario
				var es_mx = false; 
				$.getJSON(ecommerce + "direccion_envio/es_mexico/" + $(this).val(),
					function(data) {
						if (!data.result) {	//no es México
							$('.div_mexico').hide();
							$('.div_otro_pais').show();
						} else {
							$('.div_mexico').show();
							$('.div_otro_pais').hide();
						}
					}
				);
			}).change();	//se lanza al inicio de la carga para verificar al inicio
			
			$('#sel_estados').change(function() {
				//actualizar ciudad y colonia
				var clave_estado = $("#sel_estados option:selected").val();
				//alert('change estado ' + clave_estado);
				actualizar_ciudades(clave_estado);
				
				//limpiar las colonias
				$("#sel_colonias").empty();
				$("<option></option>").attr("value", '').html('Selecionar').appendTo("#sel_colonias");
			});
			
			$('#sel_ciudades').change(function() {
				//actualizar ciudad y colonia
				var clave_estado = $("#sel_estados option:selected").val();
				var ciudad = $("#sel_ciudades option:selected").val();
				
				//alert('change estado ' + clave_estado + '' + 'change ciudad ' + ciudad + '');
				actualizar_colonias(clave_estado, ciudad);
			});
			
			$('#sel_colonias').change(function() {
				//actualizar cp en base a la colonia seleccionada
				var clave_estado = $("#sel_estados option:selected").val();
				var ciudad = $("#sel_ciudades option:selected").val();
				var colonia = $("#sel_colonias option:selected").val();
				
				actualizar_cp(clave_estado, ciudad, colonia);
			});
			
			//con el botón de llenar sólo se recupera y selecciona edo. y ciudad
			$("#btn_cp").click(function() {
				var text_selected = $("#sel_pais option:selected").text();
				var val_selected = $("#sel_pais option:selected").val();
				
				var cp = $.trim($("#txt_cp").val());	//.val();
				
				//validar cp
				if (!cp || !reg_cp.test($.trim(cp))) {
					alert('Por favor ingresa un código válido');
					return false
				}
				
				//var sel_estados = $("#sel_estados");
				
				$.ajax({
					type: "POST",
					data: {'codigo_postal' : cp},
					url: ecommerce + "direccion_envio/get_info_sepomex",
					dataType: "json",				
					async: false,
					success: function(data) {
						//alert("success: " + data.msg);
						if (typeof data.sepomex != null && data.sepomex.length != 0)	{	//regresa un array con las colonias
							//alert('data is ok, tipo: ' + typeof(data));
							var sepomex = data.sepomex;			//colonias
							var codigo_postal = sepomex[0].codigo_postal;
							var clave_estado = sepomex[0].clave_estado;
							
							var estado = sepomex[0].estado;
							var ciudad = sepomex[0].ciudad;
													
							$("#sel_estados").val(clave_estado);
							
							//alert("Estado: " + estado + ", ciudad: " + ciudad + ", cp: " + codigo_postal);
							//$("#sel_estados").trigger('change');
							
							
							//carga del catálogo ciudades y selección
							$.post( ecommerce + 'direccion_envio/get_ciudades',
								// when the Web server responds to the request
								{ 'estado': clave_estado},
								function(datos) {
									var ciudades = datos.ciudades;
									
									$("#sel_ciudades").empty();
									$("<option></option>").attr("value", '').html('Selecionar').appendTo("#sel_ciudades");
									
									if (ciudades.length == undefined) {	//DF sólo devuelve un obj de ciudad.
										$("<option></option>").attr("value", ciudades.clave_ciudad).html(ciudades.ciudad).appendTo("#sel_ciudades");
										$("#sel_ciudades").trigger('change');	//trigger cities' change event
									} else {							//ciudades.length == 'undefined'
										
										$.each(ciudades, function(indice, ciudad) {
											if (ciudad.clave_ciudad != '') {
											
												$("<option></option>").attr("value", ciudad.clave_ciudad).html(ciudad.ciudad).appendTo("#sel_ciudades");
											}
										});
									}
									//select choosen city
									$("#sel_ciudades").val(ciudad);
									
									//trigger ciudades change 
									//$("#sel_ciudades").trigger('change');
									
									//Cargar las colonias
									$("#sel_colonias").empty();
									if (sepomex.length > 1)
										$("<option></option>").attr("value", '').html('Selecionar').appendTo("#sel_colonias");
									$.each(sepomex, function(indice, colonia) {
										if (colonia.colonia != '') {
											$("<option></option>").attr("value", colonia.colonia).html(colonia.colonia).appendTo("#sel_colonias");
										}
									});
								}, 
								"json"
							);
						} else if (data.sepomex.length == 0) {
							$("#sel_estados").val('');
							$('#sel_estados').trigger('change');
							alert("El código no devolvió resultados");
							//Remover información del formulario
						}						
					},
					error: function(data) {
						alert("error: " + data.error);
					},
					complete: function(data) {
					},
					//async: false,
					cache: false
				});
			});	        
			*/                              	  			            			          			    			             			     				      				   			      				          																		             
    	}
	});
}

function enviar_dir_envio(id_dir){
	
	var txt_calle = $('#txt_calle').val();
	var txt_numero = $('#txt_numero').val();
	var txt_num_int = $('#txt_num_int').val();
	var txt_cp = $('#txt_cp').val();
	var sel_pais = $('#sel_pais').val();		
	var txt_estado = $('#txt_estado').val();
	var txt_ciudad = $('#txt_ciudad').val();
	var txt_colonia = $('#txt_colonia').val();	
	var sel_estados = $('#sel_estados').val();
	var sel_ciudades = $('#sel_ciudades').val();
	var sel_colonias = $('#sel_colonias').val();	
	var txt_telefono = $('#txt_telefono').val();
	var txt_referencia = $('#txt_referencia').val();
		
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
		"sel_estados"		: sel_estados,
		"sel_ciudades"		: sel_ciudades,
		"sel_colonias"		: sel_colonias,
		"txt_telefono"		: txt_telefono,
		"txt_referencia"	: txt_referencia,
		"chk_default"		: chk_default			
	}
	
	$.ajax({	  
		cache: false,
		data: parametros,  
		url:   administrador + "administrador_usuario.php?accion=editar_dir_envio&id_dir=" + id_dir + "&id_cliente=" + id_cliente_js,	    	    
	    type:  'POST',
	    beforeSend: function () {
			$("#result_informacion").html("<div class='procesando'>Procesando, espere por favor...</div>");
	    },
		success:  function (response) {          			
			$("#result_informacion").html(response);   
			if($("#update_correcto").text()== 1){
				alert('llega');
				$("#result_informacion").html('<div class="encabezado-descripcion">Tus datos se han actualizado correctamente.</div>');
				setTimeout('$("#boton_datos").click()', 2500);
			}                                             
	    }
    });	
}



function actualizar_ciudades(clave_estado) {
	// var ecommerce = "http://localhost/ecommerce/";
	$.post( ecommerce + 'direccion_envio/get_ciudades',
		// when the Web server responds to the request
		{ 'estado': clave_estado},
		function(datos) {
			var ciudades = datos.ciudades;
			
			$("#sel_ciudades").empty();
			$("<option></option>").attr("value", '').html('Selecionar').appendTo("#sel_ciudades");
			
			if (ciudades != null) {
				if (ciudades.length == undefined) {	//DF sólo devuelve un obj de ciudad.
					$("<option></option>").attr("value", ciudades.clave_ciudad).html(ciudades.ciudad).appendTo("#sel_ciudades");
					$("#sel_ciudades").trigger('change');	//trigger cities' change event
				} else {							//ciudades.length == 'undefined'
					$.each(ciudades, function(indice, ciudad) {
						if (ciudad.clave_ciudad != '') {
							$("<option></option>").attr("value", ciudad.clave_ciudad).html(ciudad.ciudad).appendTo("#sel_ciudades");
						}
					});
				}
			}
		}, 
		"json"
	);
}

function actualizar_colonias(clave_estado, ciudad) {
	//var ecommerce = "http://localhost/ecommerce/";
	$.post( ecommerce + 'direccion_envio/get_colonias',
		// when the Web server responds to the request
		{ 'estado': clave_estado, 'ciudad': ciudad },
		function(datos) {
			var colonias = datos.colonias;
			
			$("#sel_colonias").empty();
			$("<option></option>").attr("value", '').html('Selecionar').appendTo("#sel_colonias");
			
			if (colonias != null) {
				$.each(colonias, function(indice, colonia) {
					$("<option></option>").attr("value", colonia.colonia).html(colonia.colonia).appendTo("#sel_colonias");
				});
			}
		}, 
		"json"
	);
}

function actualizar_cp(clave_estado, ciudad, colonia) {
	//var ecommerce = "http://localhost/ecommerce/";
	$.post( ecommerce + 'direccion_envio/get_colonias',
		// when the Web server responds to the request
		{ 'estado': clave_estado, 'ciudad': ciudad},
		function(datos) {
			var colonias = datos.colonias;
			
			$.each(colonias, function(indice, col) {
				if (colonia == col.colonia)
					$("#txt_cp").val(col.codigo_postal);
					//$("<option></option>").attr("value", colonia.colonia).html(colonia.colonia).appendTo("#sel_colonias");
			});
		}, 
		"json"
	);
}

