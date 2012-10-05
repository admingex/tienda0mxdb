function detalle_compra(compra, cliente){	
	$.ajax({
	    data:  parametros,
	    url:   ecommerce + "/administrador_usuario/detalle_compra/" + compra + "/" + cliente,
	    type:  'post',
	    beforeSend: function () {
			$("#result_informacion").html("Procesando, espere por favor...");
	    },
		success:  function (response) {          			
			$("#result_informacion").html(response);                                                
	    }
    });	
}