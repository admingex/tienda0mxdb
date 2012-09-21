$(document).ready(function() {
/*-PARA CARGAR LOS MX AL CARGAR LA PAGINA -*/
fmx=$('tr.MX:first').attr("id");
$("tr.USD").hide();
cambia_boton(fmx);


	$("#sel_pais").change(function(){
	//alert(id_ant);
	fusd=$('tr.USD:first').attr("id");
	fmx=$('tr.MX:first').attr("id");
		opcion=$(this).val();
		allfilas=$('#table_promociones >tbody >tr').length;
		//alert(allfilas);
		switch (opcion){
			case 'MX':
				$("tr.MX").show();
				$("tr.USD").hide();
				//alert(fmx);
				if ($('#table_promociones >tbody >tr.MX').length == 0){
				//alert("sin filas");
				no_hacer_nada();
				}
				else{
				cambia_boton(fmx);
				}
				break;
			case 'USD':
				$("tr.USD").show();
				$("tr.MX").hide();
				//alert(fusd);			
				if ($('#table_promociones >tbody >tr.USD').length == 0){
				//alert("sin filas");
				no_hacer_nada();
				}				
				else{
				cambia_boton(fusd);
				}				
				break;
			case 'ALL':
				$("tr.USD").show();
				$("tr.MX").show()
				cambia_boton(id_ant);
				break;		
		}
	
	});
	
});
