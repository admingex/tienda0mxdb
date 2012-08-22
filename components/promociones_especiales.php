<link type="text/css" href="<?php echo TIENDA;?>css/promociones.css" rel="stylesheet" />
<div id="contenedor-promo">
<?php		
	//paginador	
	$total = count($promociones_especiales);	
			
	if (isset($_GET['page'])) {
		$pg = $_GET['page'];
	} else {
		$pg = 0;
	}
	$cantidad = 6; //Cantidad de registros que se desea mostrar por pagina
	
	//echo "get: " . $_GET['page'];
	//Para probar solo le coloque 3
	
	$paginacion = new paginacion($cantidad, $pg);
	$desde = $paginacion->getFrom();		
		
	$recorrer = $promociones_especiales;
	
	$limite = ($desde + $cantidad);
	if ($limite > $total) {
		$limite = $total;
	}
	$j=0;
	for ($i = $desde; $i < $limite ; $i++) {
		//echo "<br />->".$i."<-";
		
		/*echo "<pre>";
			print_r($recorrer[$i]);
		echo "</pre>";*/
		
		$pe = $recorrer[$i];
		
		echo "
		<div class='catego-left'>
			<form id='comprar_promocion_especial".$pe->id_promocion."' name='comprar_promocion_especial".$pe->id_promocion."' action='".ECOMMERCE."api/". $pe->id_sitio."/".$pe->id_canal."/".$pe->id_promocion."/pago' method='post'>
			    <input type='hidden' name='guidx' value='".API::GUIDX."' />
		     	<input type='hidden' name='guidz' value='".API::guid()."' />
		     	<input type='hidden' name='imagen' value='".TIENDA.$pe->imagen_tumb."' />
		     	<input type='hidden' name='descripcion' value='".$pe->descripcion_promocion."' />
		     	<input type='hidden' name='precio' value='".$pe->costo."' />
		     	<input type='hidden' name='cantidad' value='1' />
		     	<div class='contenedor-imagen'>
		     		<img src='" . TIENDA . "p_".$pe->imagen_tumb."' />		     		
		     	</div>	
		      	<div class='titulo-promocion-back titulo-promocion'>".$pe->id_promocion."-".$pe->descripcion_promocion."<br />".$pe->costo.
		      	"</div>";
		      	
				if (isset($_SESSION['datos_login'])) {
					if (isset($_SESSION['datos_login'])) {
						$datos_login = $_SESSION['datos_login'];
						echo "<textarea name='datos_login' style='display: none'>".$datos_login."</textarea>";	
					}
				}			      	
		echo "
				<div class='boton'>
	          		<input type='submit' name='comprar_ahora' value=' ' class='boton-comprar-ahora' />		      	
	          		<input type='button' name='carrito' id='carrito".$pe->id_promocion."' value='' onclick='anadir_carrito(\"comprar_promocion_especial\", ".$pe->id_sitio.", ".$pe->id_canal. " ," .$pe->id_promocion . ")' class='boton-anadir-carrito'/>
		      	</div>
	  		</form>
	  	</div>";
		
		//pinta un espacio en blanco que sirve de margen						
		if (($j == 0) || ($j == 1) || ($j == 3) || ($j == 4) ){
			echo "<div class='catego-space'></div>";				
		}
		$j++;
	}
?>
</div>
<div class="paginacion" style="clear: both; margin-left: auto; margin-right: auto; width: 250px ">
<?php
								
	$url = TIENDA."categoria/6/";
	
	$classCss = "numPages";
	#$classCss = "actualPage";
	
	//Clase CSS que queremos asignarle a los links 
	
	$back = "Atras";
	$next = "Siguiente";
	
	$paginacion->generaPaginacion($total, $back, $next, $url, $classCss);
?>
</div>

