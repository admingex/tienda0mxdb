$(document).ready(function() {
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
	
	$("#sel_ordenar").change(function(){
		
		forma.submit();
	});
	
	paginador_enlaces.click(function(e){
		e.preventDefault();
		
		forma.attr("action", $(this).attr('href'));
		forma.submit();
	});
	
});
