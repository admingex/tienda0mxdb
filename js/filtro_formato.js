$(document).ready(function() {
	var forma = $("#form_filtro_formatos");
	//enlaces del paginador
	var paginador_enlaces = $("#paginacion > a");
	
	//checkboxes
	var fs = $("#form_filtro_formatos > input[type='checkbox']");
	//agregar el evento a los checks
	fs.click(function(){
		//alert($(this).attr("id"));
		forma.submit();
	});
	
	$("#sel_ordenar").change(function(){
		//alert($(this).attr("id"));
		forma.submit();
	});
	
	paginador_enlaces.click(function(e){
		e.preventDefault();
		//alert("clic" + $(this).attr('href'));
		forma.attr("action", $(this).attr('href'));
		forma.submit();
	});
	
});
