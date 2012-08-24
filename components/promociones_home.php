<link type="text/css" href="<?php echo TIENDA;?>css/orbit-1.2.3.css" rel="stylesheet" />
<link type="text/css" href="<?php echo TIENDA;?>css/promociones.css" rel="stylesheet" />

<div id="contenedor-promo">
<?php				    
	
	//Sacar la información de la categoría
	$path_promos_home = "./json/promociones_home.json";
	
	if (file_exists($path_promos_home)) {
		$json = file_get_contents($path_promos_home);
		$promos_home = json_decode($json);
		
		$total = count($promos_home->promos_home);	
				
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
		
		$recorrer = $promos_home->promos_home;
		
		$limite = ($desde + $cantidad);
		
		//revisión de límites
		if ($limite > $total) {
			$limite = $total;
		}
		$j = 0;
		for ($i = $desde; $i < $limite; $i++){			
			$p = $recorrer[$i];
				
			//obtener la información de la categoría que se consulta
			$url_detalle_promo = TIENDA ."promocion/" . $p->id_promocion;
			
			//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
			if(@GetImageSize(TIENDA."p_".$p->url_imagen)){
				$src = TIENDA ."p_images/".$p->url_imagen;
			}
			else{
				$src = TIENDA ."p_images/".$p->url_imagen;
				//$src = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
			}
						
			//
			echo "				
				<div class='promo-left'>					
					<form name='comprar_home' action='". ECOMMERCE . "api/". $p->id_sitio . "/" . $p->id_canal . "/" . $p->id_promocion ."/pago' method='post'>	
		    	  		<input type='hidden' name='guidx' value='".API::GUIDX."' />
				      	<input type='hidden' name='guidz' value='".API::guid()."' />
				      	<div class='contenedor-imagen'>
				      		<a href='". $url_detalle_promo ."'>							
				      			<img src='" .$src."'/>
				      		</a>
				      	</div>	
				      	<div class='titulo-promocion-back titulo-promocion'>
							" . $p->descripcion_promocion  . "
				      	</div>			      	
				      	
				      	<div class='descripcion-promocion-back descripcion-promocion'>
				      		" . $p->descripcion_corta_publicacion . "
				      	</div>
				      	<div class='precio-promocion-back'>
				      	    <span class='precio-promocion'> $ " . number_format($p->costo, 2, ".", "," ). " " . $p->descuento_promocion ."</span>
				      	</div>	
				      	<div class='boton'>			      
				        	<input type='submit' name='comprar_ahora' value=' ' class='boton-comprar-ahora' />
				        </div>					      	
				    </form>	
			    </div>";
			    
			//pinta un espacio en blanco que sirve de margen						
			if (($j == 0) || ($j == 1) || ($j == 3) || ($j == 4) ){
				echo "<div class='promo-space'></div>";				
			}
			$j++;   
		}
	}
?>
</div>
<div id="separacion"></div>
<?php
	if($total>6){ 
?>
<div id="paginacion">
<?php		 																	
	$url = TIENDA;
	
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
