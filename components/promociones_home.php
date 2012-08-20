<div class="contenedor-promo">
<?php				    
	
	//Sacar la información de la categoría
	$path_promos_home = "./json/promociones_home.json";
	
	if (file_exists($path_promos_home)) {
		$json = file_get_contents($path_promos_home);
		$promos_home = json_decode($json);
		
		$total=count($promos_home->promos_home);	
				
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
			
		$recorrer = $promos_home->promos_home;
		
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
				$p = $recorrer[$i];
				
		//obtener la información de la categoría que se consulta
		//foreach ($promos_home->promos_home as $p) {
			$url_detalle_promo = TIENDA ."promocion/" . $p->id_promocion;
			
			echo "
				<form name='comprar_home' action='". ECOMMERCE . "api/". $p->id_sitio . "/" . $p->id_canal . "/" . $p->id_promocion ."/pago' method='post'>
					<div class='promo-left'>
		    	  		<input type='hidden' name='guidx' value='".API::GUIDX."' />
				      	<input type='hidden' name='guidz' value='".API::guid()."' />
				      	<a href='". $url_detalle_promo ."'>
				      		<img src='" . TIENDA . "images/promociones/" . $p->imagen_tumb . "' />
				      	</a>
				      	<a href='". $url_detalle_promo . "'>" . $p->descripcion_promocion  . "</a>
				      	<div class='descripcion'>" . $p->descripcion_corta_publicacion . "</div>
				      	<div class='descripcion'>" . $p->costo . " " . $p->descuento_promocion ."</div>
				      	<div class='descripcion'>
				          	<input type='submit' name='comprar_ahora' value=' ' class='boton_continuar_compra' />
				      	</div>
			      	</div>
		      	</form>";
		}
	}
?>
</div>
<div class="paginacion" style="clear: both; margin-left: auto; margin-right: auto; width: 250px ">
		<?php
			### obtener la url mapeada por el htacces y poder envoar el numero de pagina por GET
			//echo site_url();				
			if(stristr(basename($_SERVER['REQUEST_URI']), '?')){
				$mp=explode('?',basename($_SERVER['REQUEST_URI']));				
				$url=TIENDA.$mp[0]."?";				
			}
			else{
				$url = TIENDA."?";
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
