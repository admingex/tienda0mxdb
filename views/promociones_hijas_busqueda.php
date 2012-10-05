<link type="text/css" href="<?php echo TIENDA;?>css/promociones.css" rel="stylesheet" />
<div id="contenedor-promo">
<?php
	//echo "promo_padre".$id_promo_padre;
	
	/*Despliega las publicaciones de una categoría*/
	/*
	echo "<pre>";
		print_r($promociones_hijas);
	echo "</pre>";
	*/
	$total = count($promociones_hijas);	
	
	if (isset($_GET['page'])) {
		$pg = $_GET['page'];	
	} else {
		$pg = 0;
	}
	
	//echo "get pag: " . $_GET['page'];
	$cantidad = 6; //Cantidad de registros que se desea mostrar por pagina
	
	//Para probar solo le coloqué 3
	//página actual
	$paginacion = new paginacion($cantidad, $pg);
	//página inicial
	$desde = $paginacion->getFrom();		
	
	$recorrer = $promociones_hijas;
	
	$limite = ($desde + $cantidad);
	
	//revisión de límites
	if ($limite > $total) {
		$limite = $total;
	}
	
	$j = 0;
	//foreach ($promociones_hijas as $p) {
	for ($i = $desde; $i < $limite; $i++){			
			$p = $recorrer[$i];	
		//url de la publicación
		$url_p = '';
		
		//Si no trae más de un formato, ir al detalle de la promoción: suscripción / producto / PDF
		$url_p = site_url('promocion/'. $p->id_promocion);
		
		//revisar que exista la imagen en caso contrario ponemos el cuadro negro						
		if(file_exists("./p_images/".$p->url_imagen)){
			$src = TIENDA ."p_images/".$p->url_imagen;
		}
		else{
			$src = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
			//$src = TIENDA ."p_images/".$p->url_imagen;
		}
		echo "
			<div class='catego-left'>
				<div class='contenedor-imagen'>
					<a href='". $url_p . "'>";																	
						echo "<img src='" . $src. "' />";																
		echo "		</a>
				</div>				
				<div class='titulo-categoria-back titulo-categoria'>
					".$p->nombre."						
				</div>
				<div class='descripcion-promocion-back descripcion-promocion'>
					".$p->descripcion."						
				</div>									    		
				<div class='precio-promocion-back'>".$p->terminoVc."</div>	      			     		      	
      		</div>
	      ";
		//pinta un espacio en blanco que sirve de margen						
		if (($j == 0) || ($j == 1) || ($j == 3) || ($j == 4) ){
			echo "<div class='catego-space'></div>";				
		}
		$j++; 
	}
?>
</div>

<div id="separacion"></div>
<?php
	if($total>6){ 
?>
<div id="paginacion">
<?php		 																	
	//$url = TIENDA."promocion_h.php?id_promo_padre=".$id_promo_padre."&page=";
	$url = TIENDA."buscador.php?fb=".$fb."&s=".$s."&page=";
		
	$classCss = "numPages";
	#$classCss = "actualPage";
	
	//Clase CSS que queremos asignarle a los links 
	$back = "Atrás";
	$next = "Siguiente";
	
	$paginacion->generaPaginacion($total, $back, $next, $url, $classCss);
?>
</div>
<?php
	} 
?>
<div id="separacion"></div>