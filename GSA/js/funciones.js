function cancelacion(){
	window.location.href='categorias.php';
}
function cancelacion2(){
	window.location.href='publicaciones.php';
}
function nueva_publicacion(){
	window.location.href='newpublic.php';
}
function eliminar_publicacion(){
	alert("Eliminando....")
}

/* NUEVA PUBLICACION */
function ocultar_ps(){
	/* publicaciones sugeridas */
	$("#r1").hide();
	$("#r2").hide();
	$("#r3").hide();
	$("#br2").hide();
	$("#br3").hide();
	
	/* publicaciones relacionadas */
	$("#s1").hide();
	$("#s2").hide();
	$("#s3").hide();
	$("#bs2").hide();
	$("#bs3").hide();
	
	/*para el dialog de mi oc*/
	$("#resulbus").hide();
	$("#formato").hide();
}

var boton_numero=0;
var boton_numero2=0;
function select_nuevo_ps(){
	if(boton_numero <= 2){
		boton_numero +=1;
		$("#s"+boton_numero).show('slow');
		$("#bs"+boton_numero).show('slow');
	}
	else{
		alert("Limite de opciones alcanzadas")
	}	
}
function select_nuevo_pr(){	
	if(boton_numero2 <= 2){
		boton_numero2 +=1;
		$("#r"+boton_numero2).show('slow');
		$("#br"+boton_numero2).show('slow');
	}
	else{
		alert("Limite de opciones alcanzadas")
	}
}


function tenterf (e) {	
		tecla = (document.all) ? e.keyCode : e.which;
	  	if (tecla==13){
	  		if(document.formatos.nf.value != "" ){
	  			fn_agregar();
	  		}
	  		else{
				 alert("Error: Nombre de formato en blanco ");
				  document.getElementById('nf').focus();
				}
	  	}  
}
/*agregar formato */
function fn_agregar(){
	if(document.formatos.nf.value != "" ){
				var nom_formato=$("#nf").val();
				//alert(nom_formato);
                cadena = "<tr class='label_izq'>";
                cadena = cadena + "<td>" + $("#nf").val() + "</td>";
                cadena = cadena + "<td><a href='#' class='elimina' id="+$("#nf").val()+">Eliminar</a></td>";
                $("#grilla tbody").append(cadena);
                /* aqui puedes enviar un conunto de tados ajax para agregar al usuairo */
                    $.post("ajax/agregarformato.php", {nformato: nom_formato});
                //alert("Formato agregado");
                document.getElementById('nf').value='';
     }
     else{
	 	alert("Error: Nombre de formato en blanco ");
	 	 document.getElementById('nf').focus();
	 }
                
}

/* eliminar formato */
function fn_dar_eliminar_formato(){
              $("a.elimina").live("click", function(){
              id = $(this).parents("tr").find("td").eq(0).html();
              respuesta = confirm("Desea eliminar formato: " + id);
               if (respuesta){
                   $(this).parents("tr").fadeOut("normal", function(){
                   $(this).remove();
                    /* aqui puedes enviar un conjunto de datos por ajax */
                              $.post("ajax/eliminarformato.php", {nform: id});
                        //alert("Formato " + id + " eliminado");
                   })
               }
          });
}

/* eliminar Order class de la publicacion */
function fn_dar_eliminar_oc(){
              $("a.elimina_oc").live("click", function(){
              idp=$("#idpublicacion").val();
              var idoc = this.id;
              id = $(this).parents("tr").find("td").eq(0).html();
              respuesta = confirm("Desea eliminar el order class: " + id);
               if (respuesta){
                   $(this).parents("tr").fadeOut("normal", function(){
                   $(this).remove();
                    /* aqui puedes enviar un conjunto de datos por ajax */
                              $.post("ajax/eliminarOC.php", {nidp: idp, nidoc: idoc});
                        //alert("Formato " + id + " eliminado");
                   })
               }
          });
}
/*----------------------------------------------------------------------------------------------------------------*/




/* eliminar publicacion */
function fn_dar_eliminar(){
              $("a.elimina_pub").live("click", function(){
              var id_p = this.id;
              nombre_p = $(this).parents("tr").find("td").eq(0).html();
              respuesta = confirm("Desea eliminar la publicación: "+ nombre_p+"\nEsto eliminara toda la relacion hacia la misma");
               if (respuesta){
                   $(this).parents("tr").fadeOut("normal", function(){
                   $(this).remove();
                    /* aqui puedes enviar un conjunto de datos por ajax */
                              $.post("ajax/accionEP.php", {id: id_p});
                   })
               }
          });
}


/* En la parte de editar categoria */
function fn_agregar_public(id){
	var idp=id;
	var idc=$("#idcategoria").val();
	//alert($("#h"+idp).val());
	publicacion = "<tr class='label_izq' id='"+idp+"'  style='cursor: move; '>";
    publicacion = publicacion + "<td>" + $("#h"+idp).val() + "</td>";
    publicacion = publicacion + "<td ><a href='#' id='"+idp+"' class='cpl'>Eliminar</a></td>";
    $("#pgrilla tbody").append(publicacion);    
    /*  aqui puedes enviar un conunto de tados ajax para agregar al usuairo */
    $.post("ajax/ajaxDnD.php", {aidc: idc, aidp: idp}); 
}
/* verificar si existe la publicacion */
function veri_publi(nombre){
	$.post("ajax/verificaP.php",{nompub: nombre},
	function(data){
		//alert(data[0]);//bandera
		//alert(data[1]);//id publicacion 
		//alert(data[2]);//mensaje
		var idp_v=data[1];//guarda el id de la publicacion, este valor se regresa por ajax
		var resul_veripu=data; // guarda el mensaje para ver si existe o no ya la publicacion 
		if(resul_veripu != ''){
			if(data[0]==0){
	    		accion = confirm("La publicación ya existe, pero esta desactivada. \n¿Desea activarla? \n Esto activara todas las relaciones hacia la misma");
	    		if(accion){
	    			$.post("ajax/activarPublicacion.php",{id: idp_v},
	    			function(data2){
	    				//alert("Si va a activar  "+data2);
	    				window.location.href='publicaciones.php';
	    			});    			
	    		}
	    		else{
	    			alert("Debe cambiar el nombre de la publicación para poder guardarla");
	    			bloqueo_pub();
	    		}
	    	}
	    	else if(data[0]==1){
	    		alert("La publicación ya existe. \nPor favor cambie el nombre");
	    		bloqueo_pub();
	    	}
	    	//duda si va un else con la funcion de desbloqueo de boton
    	}
    	else{
    		//alert("ajax no regresa nada");
    		$('input[name=enviar]').removeAttr("disabled");
    		$('input[name=vp]').removeAttr("disabled");
    	}

   });
}
function bloqueo_pub(){
	$('input[name=enviar]').attr("disabled","disabled");
	$('input[name=vp]').attr("disabled","disabled");
	//$(":text:first").focus();
}
