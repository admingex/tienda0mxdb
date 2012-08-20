function anadir_carrito(nameform, sitio, canal, promocion){	
		
		var tienda = 'http://localhost/tienda/';											
		var parametros = {
			"guidx" 	  : $("#"+ nameform + promocion +" input[name=guidx]").val(),
			'guidz'   	  : $("#"+ nameform + promocion +" input[name=guidz]").val(),
			'imagen'  	  : $("#"+ nameform + promocion +" input[name=imagen]").val(),
			'descripcion' : $("#"+ nameform + promocion +" input[name=descripcion]").val(),
			'precio'	  : $("#"+ nameform + promocion +" input[name=precio]").val(),
			'cantidad'    : $("#"+ nameform + promocion +" input[name=cantidad]").val(), 
		}		
		alert($("#"+ nameform + promocion +" input[name=guidx]").val());		
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
			width:'620px',
			stack: true,
			autoOpen: false,
			draggable: false,
			//esta parte hace que se cierre el popup al dar click en cualquier parte fuera del mismo
			open: function(){
            	$('.ui-widget-overlay').bind('click',function(){
                	$('#dialog-modal').dialog('close');
            	})
        	}	
																
		});																								
	});