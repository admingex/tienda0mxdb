function detalle_compra(compra, cliente){	
	$.ajax({
	    data:  {"id_compra": compra, "id_cliente": cliente},
	    url:   administrador + "administrador_usuario.php?accion=detalle_compra",
	    type:  'POST',
	    beforeSend: function () {
			$("#result_informacion").html("Procesando, espere por favor...");
	    },
		success:  function (response) {          			
			$("#result_informacion").html(response);                                                
	    }
    });	
}