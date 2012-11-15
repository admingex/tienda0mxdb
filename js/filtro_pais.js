$(document).ready(function() {
/*-PARA CARGAR LOS MX AL CARGAR LA PAGINA -*/
fmx=$('option.MX:first').attr("id");
$("#selusd").hide();
cambia_boton(fmx);

	
	$("#sel_pais").change(function(){
			
	//alert(id_ant);
	fusd=$('option.USD:first').attr("id");
	fmx=$('option.MX:first').attr("id");	
		opcion=$(this).val();						
		switch (opcion){
			case 'MX':
					$("#selmx").show();
					$("#selusd").hide();				
					cambia_boton(fmx);				
					break;
			case 'USD':
					$("#selusd").show();
					$("#selmx").hide();				
					cambia_boton(fusd);								
					break;
			case 'ALL':
					$("#selmx").show();
					$("#sel").show()
					cambia_boton(id_ant);
					break;		
		}
	
	});
	
	$("#sel_b2b").change(function(){
		document.enviar_tipo_suscripcion.submit()
	});	
	
	$("#promosmx").change(function(){		
		cambia_boton(this.val());
	});
	
	$("#promosusd").change(function(){		
		cambia_boton(this.val());
	});					
});
