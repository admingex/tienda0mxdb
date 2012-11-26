<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-slide.css" rel="stylesheet" />
<div id='contenedor_slide'>
<?php
	/*		
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
	*/	
	//$recorrer = $promociones_especiales;
	
	/*
	$limite = ($desde + $cantidad);
	if ($limite > $total) {
		$limite = $total;
	}
		
	for ($i = $desde; $i < $limite ; $i++) {
	 */ 
	echo "<div class='list_carousel responsive'>
				<ul id='slider'>"; 
	foreach($promociones_especiales as $pe){ 
		//echo "<br />->".$i."<-";
		
		/*echo "<pre>";
			print_r($recorrer[$i]);
		echo "</pre>";*/
		
		//$pe = $recorrer[$i];
		echo "<li>";
		if(isset($pe->promo_padre)){
			echo "	<a href='".TIENDA ."promocion_h.php?id_promo_padre=" .$pe->id_promocionIn."'>
						<img src='" . TIENDA . "p_images/".$pe->url_imagen."' width='179px' height='210px'/>
					</a>		     		
		     		<div style='display: none'>".$pe->descripcionVc. 
		      		"</div>";
		}
		else{
		echo "
		<div class='catego-left'>
			<form id='comprar_promocion_especial".$pe->id_promocion."' name='comprar_promocion_especial".$pe->id_promocion."' action='".ECOMMERCE."api/". $pe->id_sitio."/".$pe->id_canal."/".$pe->id_promocion."/pago' method='post'>
			    <input type='hidden' name='guidx' value='".API::GUIDX."' />
		     	<input type='hidden' name='guidz' value='".API::guid()."' />
		     	<input type='hidden' name='imagen' value='".TIENDA."p_images/".$pe->url_imagen."' />
		     	<input type='hidden' name='descripcion' value='".$pe->descripcion_promocion."' />
		     	<input type='hidden' name='precio' value='".$pe->costo."' />
		     	<input type='hidden' name='iva' value='".$pe->taxable."' />
		     	<input type='hidden' name='cantidad' value='1' />
		     	<div class='contenedor-imagen'>
		     		<img src='" . TIENDA . "p_images/".$pe->url_imagen."' />		     		
		     	</div>	
		      	<div class='titulo-promocion-back titulo-promocion'>".$pe->descripcion_promocion."<br /> $ ".number_format($pe->costo, 2, ".", ","). 
		      	"</div>";
		      	
				if (isset($_SESSION['datos_login'])) {
					if (isset($_SESSION['datos_login'])) {
						$datos_login = $_SESSION['datos_login'];
						echo "<textarea name='datos_login' style='display: none'>".$datos_login."</textarea>";	
					}
				}			      	
		echo "
				<div class='boton' style='display: none'>
	          		<input type='submit' name='comprar_ahora' value=' ' class='boton-comprar-ahora' />		      	
	          		<input type='button' name='carrito' id='carrito".$pe->id_promocion."' value='' onclick='anadir_carrito(\"comprar_promocion_especial\", ".$pe->id_sitio.", ".$pe->id_canal. " ," .$pe->id_promocion . ")' class='boton-anadir-carrito'/>
		      	</div>
	  		</form>
	  	</div>";
		}
		echo "</li>";
		
	}
	echo "	</ul>
				<a id='prev' class='prev' href='#'>&lt;</a>
				<a id='next' class='next' href='#'>&gt;</a>
			</div>";
?>
</div>