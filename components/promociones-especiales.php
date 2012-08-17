<?php
	$json = file_get_contents('json/promociones-especiales.js');
	$data = json_decode($json);
	
	if (count($data->promocion_especial_destacada) != 0)
	
	foreach ($data->promocion_especial_destacada as $j) {
?>
<div class="contenedor-promo">
	<div id="images">
	    <?php
		echo "
			<form name='comprar_promocion_destacada' action='".ECOMMERCE."api/". $j->id_sitioSi."/".$j->id_canalSi."/".$j->id_promocionIn."/pago' method='post'>
			  	<div class='promo-left'>
			      	<input type='hidden' name='guidx' value='".API::GUIDX."'/>
			      	<input type='hidden' name='guidz' value='".API::guid()."'/>
			      	<a href=''><img src='".TIENDA.$j->url_imagenVc."'/></a>
			      	<div class='descripcion'>".$j->descripcionVc."</div>
			      	<div class='descripcion'>".$j->tarifaDc."</div>
			      	<div class='descripcion'>
			          	<input type='submit' name='comprar_ahora' value=''/>
			      	</div>
	    		</div>
	      	</form>
      		<img src='".TIENDA.$j->url_imagenVc."' onclick='document.comprar_promocion_destacada.submit();'/>";
		?>
	</div>
</div>
<?php
	}
?>

<div class="contenedor-promo">
	<?php		
		$total=count($data->promociones_especiales);	
				
		if(isset($_GET['page'])){
			$pg = $_GET['page'];	
		}
		else{
			$pg=0;
		}
		$cantidad = 6; //Cantidad de registros que se desea mostrar por pagina
		//Para probar solo le coloque 3
	
		$paginacion = new paginacion($cantidad, $pg);
		$desde = $paginacion->getFrom();		
			
		$recorrer = $data->promociones_especiales;
		
		$limite = ($desde+$cantidad);
		if($limite>$total){
			$limite = $total;
		}
		
		for($i=$desde; $i<($limite); $i++){
			//echo "<br />->".$i."<-";
				/*
				echo "<pre>";
					print_r($recorrer[$i]);
				echo "</pre>";
				*/
				$v = $recorrer[$i];
				//**
				
				echo "
					<div class='promo-left'>
					<form id='comprar_promocion_especial".$v->id_promocionIn."' name='comprar_promocion_especial".$v->id_promocionIn."' action='".ECOMMERCE."api/". $v->id_sitioSi."/".$v->id_canalSi."/".$v->id_promocionIn."/pago' method='post'>
					
						    <input type='hidden' name='guidx' value='".API::GUIDX."' />
					     	<input type='hidden' name='guidz' value='".API::guid()."' />
					     	<input type='hidden' name='imagen' value='".TIENDA.$v->url_imagenVc."' />
					     	<input type='hidden' name='descripcion' value='".$v->descripcionVc."' />
					     	<input type='hidden' name='precio' value='".$v->tarifaDc."' />
					     	<input type='hidden' name='cantidad' value='1' />
					     	
					     	<img src='".TIENDA.$v->url_imagenVc."' />
					      	<div class='descripcion' style='height: 40px'>".$v->id_promocionIn."-".$v->descripcionVc."<br />
					      	".$v->tarifaDc."</div>";
							if(isset($_SESSION['datos_login'])){
								if(isset($_SESSION['datos_login'])){
									$datos_login=$_SESSION['datos_login'];
									echo "<textarea name='datos_login' style='display: none'>".$datos_login."</textarea>";	
								}
							}			      	
				echo "     	<div>
				          		<input type='submit' name='comprar_ahora' value=' ' class='boton_continuar_compra' />
					      	</div>
					      	<div>
				          		<input type='button' name='carrito' id='carrito".$v->id_promocionIn."' value='Añadir al Carrito' onclick='anadir_carrito(".$v->id_promocionIn.", ".$v->id_sitioSi.", ".$v->id_canalSi." ,".$v->id_promocionIn.")'/>
					      	</div>	      	
			      	</form>
			      	</div>";
				
				//**
				
		}
	?>
</div>
<div class="paginacion" style="clear: both; margin-left: auto; margin-right: auto; width: 250px ">
		<?php
			### obtener la url mapeada por el htacces y poder envoar el numero de pagina por GET
			//echo site_url();				
			if(stristr(basename($_SERVER['REQUEST_URI']), '?')){
				$mp=explode('?',basename($_SERVER['REQUEST_URI']));				
				$url=$mp[0]."?";				
			}
			else{
				$url = basename($_SERVER['REQUEST_URI'])."?";
			}
			#####			 																	
			
			$classCss = "numPages";
			#$classCss = "actualPage";
			
			//Clase CSS que queremos asignarle a los links 
			
			$back = "Atras";
			$next = "Siguiente";
			
			$paginacion->generaPaginacion($total, $back, $next, $url, $classCss);
		?>
</div>
<script type="text/javascript">
	function anadir_carrito(id, sitio, canal, promocion){				
		alert("sitio"+sitio+"canal"+canal+"promocion"+promocion);							
		var parametros = {
			"guidx" 	  : $("#comprar_promocion_especial"+ id +" input[name=guidx]").val(),
			'guidz'   	  : $("#comprar_promocion_especial"+ id +" input[name=guidz]").val(),
			'imagen'  	  : $("#comprar_promocion_especial"+ id +" input[name=imagen]").val(),
			'descripcion' : $("#comprar_promocion_especial"+ id +" input[name=descripcion]").val(),
			'precio'	  : $("#comprar_promocion_especial"+ id +" input[name=precio]").val(),
			'cantidad'    : $("#comprar_promocion_especial"+ id +" input[name=cantidad]").val(), 
		}		
				
		//document.comprar_promocion_especial".$v->id_promocionIn.".action ='".TIENDA."carrito.php?id_sitio=". $v->id_sitioSi."&id_canal=". $v->id_canalSi."&id_promocion=". $v->id_promocionIn."'; document.comprar_promocion_especial".$v->id_promocionIn.".submit()
		var url_carrito = '<?php echo TIENDA."carrito.php?id_sitio="?>'+sitio+'&id_canal='+canal+'&id_promocion='+promocion+'&ajax=1';
		//$("#comprar_promocion_especial"+ id).attr('action', url_carrito);
        //alert($("#comprar_promocion_especial"+ id).attr('action'));
        
        $.ajax({
                data:  parametros,
                url:   url_carrito,
                type:  'post',
                beforeSend: function () {
                      $("#vista_carrito").html("Procesando, espere por favor...");
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

</script>
<div id='dialog-modal'></div>

