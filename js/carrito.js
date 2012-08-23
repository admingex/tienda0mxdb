function anadir_carrito(nameform, sitio, canal, promocion){
		 					
		var tienda = 'http://localhost/tienda/';		
		
		var formid = document.getElementById(nameform+promocion);											
		var parametros = {
			"guidx" 	  : formid.guidx.value,
			'guidz'   	  : formid.guidz.value,
			'imagen'  	  : formid.imagen.value,
			'descripcion' : formid.descripcion.value,
			'precio'	  : formid.precio.value,
			'cantidad'    : formid.cantidad.value 
		}		
				
		//document.comprar_promocion_especial".$v->id_promocionIn.".action ='".TIENDA."carrito.php?id_sitio=". $v->id_sitioSi."&id_canal=". $v->id_canalSi."&id_promocion=". $v->id_promocionIn."'; document.comprar_promocion_especial".$v->id_promocionIn.".submit()
		var url_carrito = tienda+'carrito.php?id_sitio='+sitio+'&id_canal='+canal+'&id_promocion='+promocion+'&ajax=1';
		//$("#comprar_promocion_especial"+ id).attr('action', url_carrito);
        //alert($("#comprar_promocion_especial"+ id).attr('action'));
        
        $.ajax({
                data:  parametros,
                url:   url_carrito,
                type:  'post',
                beforeSend: function () {
                      $("#dialog-modal").html("Procesando, espere por favor...");
                },
          		success:  function (response) {
          				$( "#dialog-modal" ).dialog( "open" );
                        $("#dialog-modal").html(response);
                }
        });
        
	}
	
	$(function(){
		$('#dialog-modal').dialog({
			position:['top', 120],
			modal: true,
			show: 'slide',
			width:'635px',
			stack: true,
			autoOpen: false,
			draggable: false,
			//esta parte hace que se cierre el popup al dar click en cualquier parte fuera del mismo
			open: function(event, ui){
				$('body').css('overflow','hidden');
				$('.ui-widget-overlay').css('width','100%');
				$('.ui-widget-overlay').css('height','100%');				
				$('.ui-widget-overlay').bind('click',function(){
                	$('#dialog-modal').dialog('close');
            	}) 
			}, 
    		close: function(event, ui){
    			$('body').css('overflow','auto');
    		} 				
																
		});																								
	});