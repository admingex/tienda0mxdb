/*--------------------------------------------------------------------------------------------------------------------------------*/
$(document).ready(function() {

//llamo la funcion eliminar para eliminar el formato
fn_dar_eliminar();
fn_dar_eliminar_formato();
fn_dar_eliminar_oc();
fn_editar_oc();
ocultar_ps();

//Si la publicacion es nueva no aparecera el combo de la publicacion sugerida


//PARA EL DnD		
//LIstado Home	
		$('#table-3').tableDnD({
		onDragClass: "myDragClass",
	    onDrop: function(table, row) {
	        //alert("tableDnD.serialise() is "+$.tableDnD.serialize());
		    //$('#AjaxResult').load("ajax/ajaxDnD.php?"+$.tableDnD.serialize());
			//alert("sad");
        }
	});
//lista promociones especiales 
		$('#table-4').tableDnD({
		onDragClass: "myDragClass",
	    onDrop: function(table, row) {
	        //alert("tableDnD.serialise() is "+$.tableDnD.serialize());
		    //$('#AjaxResult2').load("ajax/ajaxDnD.php?"+$.tableDnD.serialize());
        }
	});
//Publicaciones
		$('#table-5').tableDnD({
		onDragClass: "myDragClass",
	    onDrop: function(table, row) {
	        //alert("tableDnD.serialise() is "+$.tableDnD.serialize());
		   // $('#AjaxResult').load("ajax/ajaxDnD.php?"+$.tableDnD.serialize());
			//alert("sad");
        }
	});

/*--------------------------------------------------------------------------------------------------------------------------------*/	
//PARA OBTENER LOS CHECKS Y DIVS, Y LOS GUARDAMOS EN ARREGLOS 
    var ids;    
	var miArreglo= new Array(); //arreglo para los checks
	var arrayDos= new Array();
	var c=0;
    ids = $('input[type=checkbox]').map(function() {
	//alert($(this).attr('id'));
	miArreglo[c]=$(this).attr('id');
	c=c+1
        return $(this).attr('id');
		;
    }).get();
    //alert(c);
	
	for(var i=0; i<=c-1; i++){
	//alert(miArreglo[i]);
	arrayDos[i]='d' +miArreglo[i].substring(1);
	}
	for(var i=0; i<=c-1; i++){
	//alert(arrayDos[i]);
	}

/*------------------------------------------------------------------------------------------------------------------------------*/
$('a.on').live("click",function () {
	id=this.id;
	des = $(this).parents("tr").find("td").eq(1).html();
	$("#resulbus").hide();
	$("#buss").hide();
	$("#formato").show();
    $('#datos').append(
    	'<p style="font-size:13px;">OC_ID: <strong>'+ id +'</strong></p>',
    	'<p style="font-size:13px;">Descripción: <strong>'+ des +'</strong></p>',
    	'<input type="hidden" name="ocid" id="ocid" value="'+ id +'"/>'
    
    );
});
/*------------------------------------------------------------------------------------------------------------------------------*/
/*PARA CUANDO EL CHECK NO ESTE SELECCIONADO*/	
	
	$('div.checkbox_no_selected').click(function () {
      var valor = this.id;
      for(var i=0; i<=c-1; i++){
      	if(arrayDos[i]==valor){
      		if ($("#"+miArreglo[i]).attr("checked")){
				$("#"+arrayDos[i]).removeClass('checkbox_selected').addClass('checkbox_no_selected');
				document.getElementById(miArreglo[i]).checked='';
				$("#"+miArreglo[i]).removeAttr("checked");
		    }
			else{
				$("#"+arrayDos[i]).removeClass('checkbox_no_selected').addClass('checkbox_selected');
				document.getElementById(miArreglo[i]).checked='checked';
				$("#"+miArreglo[i]).attr("checked");
			}
      		i=c;   		
      	}
      }
    });
/*------------------------------------------------------------------------------------------------------------------------------*/
/*PARA CUANDO EL CHECK ESTE SELECCIONADO*/
    
	$('div.checkbox_selected').click(function () {
      var valor2 = this.id;
      for(var i=0; i<=c-1; i++){
      	if(arrayDos[i]==valor2){
      		if ($("#"+miArreglo[i]).attr("checked")){
				$("#"+arrayDos[i]).removeClass('checkbox_selected').addClass('checkbox_no_selected');
				document.getElementById(miArreglo[i]).checked='';
				$("#"+miArreglo[i]).removeAttr("checked");
		    }
			else{
				$("#"+arrayDos[i]).removeClass('checkbox_no_selected').addClass('checkbox_selected');
				document.getElementById(miArreglo[i]).checked='checked';
				$("#"+miArreglo[i]).attr("checked");
			}
			i=c;
      	}
      }
    });
	
/*--------------------------------------------------------------------------------------------------------------------------------*/
/*PARA ELIMINAR EL ELEMENTO DE LA TABLA*/
//$("div#footer").remove();
$('a.cpl').live("click", function() {
	var avalor = this.id;
	//alert(avalor);
	$("tr#"+avalor).remove();
});
/*--------------------------------------------------------------------------------------------------------------------------------*/	
//PARA OBTENER LOS RADISO Y DIVS, Y LOS GUARDAMOS EN ARREGLOS 
    var ids2;    
	var miArreglo2= new Array(); //arreglo para los checks
	var arrayDos2= new Array();
	var c2=0;
    ids2 = $('input[type=radio]').map(function() {
	//alert($(this).attr('id'));
	miArreglo2[c2]=$(this).attr('id');
	c2=c2+1
        return $(this).attr('id');
		;
    }).get();
    //alert(c);
	
	for(var i=0; i<=c2-1; i++){
	//alert(miArreglo2[i]);
	arrayDos2[i]='d' +miArreglo2[i].substring(1);
	}
	for(var i=0; i<=c2-1; i++){
	//alert(arrayDos2[i]);
	}
/*--------------------------------------------------------------------------------------------------------------------------------*/
//PARA LOS RADIOS 
	var s2=1;
	var n=0;
	$('div.radio_no_selected').click(function () {
		var valor2 = this.id;
		if(s2==valor2){
	      		$("#"+arrayDos2[n]).removeClass('radio_selected').addClass('radio_no_selected');		
				document.getElementById(miArreglo2[n]).checked='';
				$("#"+miArreglo2[n]).removeAttr("checked");
				document.getElementById(miArreglo2[n]).value='';
				s2=1;
		}
		else{
		for(var i=0; i<=c2-1; i++){
	      	if(arrayDos2[i]==valor2){
	      		$("#"+arrayDos2[i]).removeClass('radio_no_selected').addClass('radio_selected');		
				document.getElementById(miArreglo2[i]).checked='checked';
				$("#"+miArreglo2[i]).attr("checked");
				document.getElementById(miArreglo2[i]).value=miArreglo2[i].substring(1);
				s=2;//NO SE SI AFECTE EN LAS PRUEBAS QUE HICE NO REVISAR NUEVAMENTE
				s2=valor2;
				n=i;
	      	}
	      	else{
	      		$("#"+arrayDos2[i]).removeClass('radio_selected').addClass('radio_no_selected');		
				document.getElementById(miArreglo2[i]).checked='';
				$("#"+miArreglo2[i]).removeAttr("checked");
				document.getElementById(miArreglo2[i]).value='';
	      	}
	      }
	   }
    });
    var s=1;
    $('div.radio_selected').click(function () {
		var valor3 = this.id;	
		if(s==1){
			for(var i=0; i<=c2-1; i++){	
		      	if(arrayDos2[i]==valor3){
		      		$("#"+arrayDos2[i]).removeClass('radio_selected').addClass('radio_no_selected');		
					document.getElementById(miArreglo2[i]).checked='';
					$("#"+miArreglo2[i]).removeAttr("checked");
					document.getElementById(miArreglo2[i]).value='';
		      	}
	      	}
	      	s=2;
	      	s2=1;
	    }
	    else{
	      	for(var i=0; i<=c2-1; i++){	
	      		if(arrayDos2[i]==valor3){
					$("#"+arrayDos2[i]).removeClass('radio_no_selected').addClass('radio_selected');		
					document.getElementById(miArreglo2[i]).checked='checked';
					$("#"+miArreglo2[i]).attr("checked");
					document.getElementById(miArreglo2[i]).value=miArreglo2[i].substring(1);
		      	}
		      	else{
		      		$("#"+arrayDos2[i]).removeClass('radio_selected').addClass('radio_no_selected');		
					document.getElementById(miArreglo2[i]).checked='';
					$("#"+miArreglo2[i]).removeAttr("checked");
					document.getElementById(miArreglo2[i]).value='';
	      		}	
	      	}
	      	s=1;
	      	s2=1;
	      }
    });
/*--------------------------------------------------------------------------------------------------------------------------------*/
/*botone*/

/*--------------------------------------------------------------------------------------------------------------------------------*/
/*FORMULARIOS*/
$('#aph').submit(function() {
	alert('Guardando Carrusel de promociones....');			
});
			
$('#aph2').submit(function() {
	alert('Guardando Lista Home....');
});
			
$('#aph3').submit(function() {
	alert('Guardado Promociones Especiales....');			
});

//alert('IDS: \n' + ids.join('\n'));









});