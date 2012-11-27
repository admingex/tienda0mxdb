<link type="text/css" href="<?php echo TIENDA;?>css/orbit-1.2.3.css" rel="stylesheet" />
<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-paginador.css" rel="stylesheet" />
<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-home.css" rel="stylesheet" />
<?php				    
	
	
	//Sacar la información de la categoría
	$path_promos_home = "./json/promociones_home.json";
	
	if (file_exists($path_promos_home)) {
		$json = file_get_contents($path_promos_home);
		$promos_home = json_decode($json);
		
		$items = count($promos_home->promos_home);			
			
		// se añaden las promociones padre para incluirlas en las promociones
		$path_promo_padre_carrusel = "./json/promociones_padre/promos_padre.json";	
		if (file_exists($path_promo_padre_carrusel)) {
			$json = file_get_contents($path_promo_padre_carrusel);
			$promos_padre = json_decode($json);								
			foreach($promos_padre as $p ){
				if($p->descripcion_canal=="HOME PROMOCION"){						
					$promos_home->promos_home[($items)] = $p;
					$items++;
				}					
			} 								
		}	
					
		$total = count($promos_home->promos_home);	
				
		if (isset($_GET['page'])) {
			$pg = $_GET['page'];	
		} else {
			$pg = 0;
		}
		
		//echo "get pag: " . $_GET['page'];
		$cantidad = 15; //Cantidad de registros que se desea mostrar por pagina
		
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
echo "	<div id='list_carousel'>
			<ul>";
				for ($i = $desde; $i < $limite; $i++){		
					$p = $recorrer[$i];									
					//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
					if(file_exists("./p_images/".$p->url_imagen)){
						$src = TIENDA ."p_images/".$p->url_imagen;
					}
					else{
						$src = TIENDA ."p_images/".$p->url_imagen;				
					}
					
					# echo "<li><img src='$src' id='1' onmouseover=\"cambia_img(this.id)\" onmouseout=\"cambia_img(this.id)\" /></li>";
						
					if(isset($p->promo_padre)){
						//obtener la información de la categoría que se consulta
						$url_detalle_promo = TIENDA ."promocion_h.php?id_promo_padre=" .$p->id_promocionIn;
						//
						/*
						echo "	<li>									
							    	<a href='". $url_detalle_promo ."'>							
							      		<img src='" .$src."'/>
							      	</a>							      								      						      					      	
							    </li>";
						 * 
						 */
					} else{
							
						//obtener la información de la categoría que se consulta
						$url_detalle_promo = TIENDA ."promocion/" . $p->id_promocion;
						//
						/*
						echo "	<li>																											      	
									<a href='". $url_detalle_promo ."'>							
							      		<img src='" .$src."'/>
							      	</a>					      							      								      				     
						    	</li>";
						 * 
						 */
						
						echo "<li>
							      <a href='". $url_detalle_promo ."'>
			            	          <div style=\"background-image: url('".$src."')\" class='mycover'></div>	
			            	      </a>
			            	  </li>";							  
				      		  		
					 }   			  
							
				}				
echo "		</ul>										
		</div>";
	}
?>
<?php
	if($total>$cantidad){ 
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

