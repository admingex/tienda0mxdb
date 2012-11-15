$(document).ready(function() {
/*-PARA CARGAR LOS MX AL CARGAR LA PAGINA -*/
fmx=$('option.MX:first').attr("id");
$("option.USD").hide();
cambia_boton(fmx);


	$("#sel_pais").change(function(){
			
	//alert(id_ant);
	fusd=$('option.USD:first').attr("id");
	fmx=$('option.MX:first').attr("id");	
		opcion=$(this).val();						
		switch (opcion){
			case 'MX':
					$("option.MX").show();
					$("option.USD").hide();				
					cambia_boton(fmx);				
					break;
			case 'USD':
					$("option.USD").show();
					$("option.MX").hide();				
					cambia_boton(fusd);								
					break;
			case 'ALL':
					$("option.USD").show();
					$("option.MX").show()
					cambia_boton(id_ant);
					break;		
		}
	
	});
	
});
