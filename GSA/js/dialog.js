 var tienda = 'http://10.177.78.54/subir_tienda/GSA/';
function miDialog(){
 var elid=$("#idpublicacion").val();
  
	var url_carrito = tienda+'aoc.php?id='+elid;
	 $.ajax({                
                url:   url_carrito,
                type:  'post',
                beforeSend: function () {
                      $("#dialogo").html("Procesando, espere por favor...");
                },
          		success:  function (response) {
          				$( "#dialogo" ).dialog( "open" );
                        $("#dialogo").html(response);
                }
        });
        
      $("#dialogo").dialog({
      modal: true,
      title: "Agregar Order Class",
      width: 1000,
      height:810,
      autoOpen: false,
      resizable:true,
      position:['top', 50],
      minWidth: 400,
      maxWidth: 650,
      show: "fold",
      hide: "scale"				
   });
     
}
/*---------------------------------*/

function fn_editar_oc(){
              $("a.editar_oc").live("click", function(){   
              var elid=$("#idpublicacion").val();           
              var idoc = this.id;
              var descrip= $(this).parents("tr").find("td").eq(1).html();
              var formato= $(this).parents("tr").find("td").eq(2).html();
                           
              
			   
				var url_carrito = tienda+'aocEdit.php?id='+idoc+'&des='+descrip+'&forma='+formato+'&idp='+elid;
				 $.ajax({                
			                url:   url_carrito,
			                type:  'post',
			                beforeSend: function () {
			                      $("#dialogo").html("Procesando, espere por favor...");
			                },
			          		success:  function (response) {
			          				$( "#dialogo" ).dialog( "open" );
			                        $("#dialogo").html(response);
			                }
			        });
			        
			      $("#dialogo").dialog({
			      modal: true,
			      title: "Agregar Order Class",
			      width: 1000,
			      height:810,
			      autoOpen: false,
			      resizable:true,
			      position:['top', 50],
			      minWidth: 400,
			      maxWidth: 650,
			      show: "fold",
			      hide: "scale"				
			   });
              
             
          });
}

/*---------------------------------*/
function mimensaje(){
	$( "#dialogo" ).dialog( "close" );
}
function buscador(nom){
	$("#resulbus").show();
	
	var url_carrito = tienda+'consultar_oc.php?id='+nom;
	$.ajax({            
		url:   url_carrito,
		       type:  'post',
		       beforeSend: function () {
			       $("#resulbus").html("Procesando, espere por favor...");
		       },
          		success:  function (response) {
         			
			        $("#resulbus").html(response);
			   }
	});
	//
}

function usar_oc(){
	//var nom_formato=$("#idp").val();
	
	alert("Guarde primero la publicación para poder agregar un Order Class");
	
    
}

