function anadir_carrito(nameform, sitio, canal, promocion) {
		 					
	var tienda = 'http://localhost/tienda/';	//##c##		
	
	var formid = document.getElementById(nameform+promocion);											
	var parametros = {
		"guidx" 	  : formid.guidx.value,
		'guidz'   	  : formid.guidz.value,
		'imagen'  	  : formid.imagen.value,
		'descripcion' : formid.descripcion.value,
		'precio'	  : formid.precio.value,
		'cantidad'    : formid.cantidad.value,
		'moneda'      : formid.moneda.value,
		'iva'		  : formid.iva.value
	}		
			
	var url_carrito = tienda+'carrito.php?id_sitio='+sitio+'&id_canal='+canal+'&id_promocion='+promocion+'&ajax=1';
    
    $.ajax({
        data:  parametros,
        url:   url_carrito,
        type:  'post',
        beforeSend: function () {
              $("#dialog-modal").html("Procesando, espere por favor...");
        },
  		success:  function (response) {
  			$("#dialog-modal").dialog( "open" );  							
            $("#dialog-modal").html(response);
            //$("#cuenta-carrito").text($('#cuenta-detalle-carrito').text());
        }
    });
}
	
$(function() {
	$('#dialog-modal').dialog({
		position: ['top', 100],
		modal: true,
		show: 'slide',
		width:'750px',
		stack: true,
		autoOpen: false,
		draggable: false,
		//esta parte hace que se cierre el popup al dar click en cualquier parte fuera del mismo
		open: function(event, ui){
			//$('body').css('overflow','hidden');			 
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
	/**
	 * ajuste de revisión de moneda 
	 */
	$("#no-moneda").dialog({
		modal: true,
		title: "Error",
		width: 550,
		minWidth: 400,
		maxWidth: 650,
		show: "slide",
		autoOpen: false,
		draggable: false,
		open: function(event, ui){
			$('body').css('overflow','hidden');
			$('.ui-widget-overlay').css('width','100%');
			$('.ui-widget-overlay').css('height','100%');				
			$('.ui-widget-overlay').bind('click',function(){
				$('#no-moneda').dialog('close');
			}) 
		}, 
		close: function(event, ui){
			$('body').css('overflow','auto');
		} 	
   });
   
});