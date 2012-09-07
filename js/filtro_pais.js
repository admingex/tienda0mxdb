$(document).ready(function() {
	/*
	//form del filtro
	var forma = $("#form_filtro_formatos");
	
	//enlaces del paginador
	var paginador_enlaces = $("#paginacion > a");
	
	//checkboxes
	var fs = $("#form_filtro_formatos > input[type='checkbox']");
	
	//agregar el evento a los checks
	fs.click(function(){
		forma.submit();
	});
	*/
	$("#sel_pais").change(function(){
		//alert("valor para el filtro: " + $(this).val());
		$("#table_promociones > tbody").empty();
		$("#dialog-modal").html("Filtrando promoción, por favor espera ...");
		//forma.submit();
		
		//
		var url_filtro = "";
		var new_info = "";
		
		/*$.ajax({
            data:  parametros,
            url:   url_carrito,
            type:  'post',
	        beforeSend: function () {
	        	$("#dialog-modal").html("Filtrando promoción, por favor espera ...");
          	},
      		success:  function (response) {
  				$("#dialog-modal").dialog( "open" );
                $("#dialog-modal").html(response);                        
                $("#cuenta-carrito").text($('#cuenta-detalle-carrito').text());
           	}
             
		});*/
	});
});
