<?php
	$total = count($promociones_hijas);	
	//if($total > 6){
//		echo "<script type='text/javascript' src='".TIENDA."js/filtro_formato.js'></script>";
			//include_once('./components/filtro_orden_dos.php');
	//}	
	echo "<div id='relevancia' style='color:#CCC; font-size:16px; padding-bottom:10px;'> Resultado de busqueda: <span style='color:#dd154b;'>".$s."</span></div>";
	echo "<div id='pleca-punteada' style='height: 1px; background-color: #CCC; margin: 10px 0px ;'> &nbsp;	</div>";
?>
<link type="text/css" href="<?php echo TIENDA;?>css/promociones.css" rel="stylesheet" />
<div id="contenedor-promo">
	
<?php
	//echo "promo_padre".$id_promo_padre;
	if(empty($promociones_hijas)){
		echo "<span style:'color:white;'>No se encontraron resultados en la búsqueda</span>";
	}

	
	/*Despliega las publicaciones de una categoría*/
	
	/*echo "<pre>";
		print_r($promociones_hijas);
	echo "</pre>";
	/**/

	
	if (isset($_GET['page'])) {
		$pg = $_GET['page'];	
	} else {
		$pg = 0;
	}
	
	//echo "get pag: " . $_GET['page'];
	$cantidad = 100; //Cantidad de registros que se desea mostrar por pagina
	
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
			
		$fecha = $p->fin_promocionDt;
    	$pieces = explode("-", $fecha);
	    $d = $pieces[2];
		$m = $pieces[1];
		$a = $pieces[0];

		 switch ($m) {
			 Case 1:
	            $nombreMes = "Enero";
	            break;
	        Case 2:
	            $nombreMes = "Febrero";
	            break;
	        Case 3:
	            $nombreMes = "Marzo";
	            break;
	        Case 4:
	            $nombreMes = "Abril";
	            break;
	        Case 5:
	            $nombreMes = "Mayo";
	            break;
	        Case 6:
	            $nombreMes = "Junio";
	            break;
	        Case 7:
	            $nombreMes = "Julio";
	            break;
	        Case 8:
	            $nombreMes = "Agosto";
	            break;
	        Case 9:
	            $nombreMes = "Septiembre";
	            break;
	        Case 10:
	            $nombreMes = "Octubre";
	            break;
	        Case 11:
	            $nombreMes = "Noviembre";
	            break;
	        Case 12:
	            $nombreMes = "Diciembre";
	            break;
		 }
		//url de la publicación
		$url_p = '';
		
		//Si no trae más de un formato, ir al detalle de la promoción: suscripción / producto / PDF
		$url_p = site_url('promocion/'. $p->id_promocion);
		
		//revisar que exista la imagen en caso contrario ponemos el cuadro negro						
		if(file_exists("./l_images/".$p->url_imagen)){
			$src = TIENDA ."l_images/".$p->url_imagen;
		}
		else{
			$src = TIENDA ."l_images/css_sprite_PortadaCaja.jpg";
			//$src = TIENDA ."p_images/".$p->url_imagen;
		}
		echo "
				<div class='contenedor-imagen'>
					<a href='". $url_p . "'>";																	
						echo "<img src='" . $src. "' /></a>
				</div>		";																
		echo "						
				  <div id='nombre".$p->nombre."' style='color:white; padding-bottom:10px; padding-top:8px; font-size:14px; margin-left:45px;'>			    			    	
		      		".$p->descripcion."&nbsp;  						
				</div>	
				
				 <div id='descripcion".$p->nombre."' style='color:white; margin-left:45px;'>			    			    	
		      		".$p->descripcion_cortaVc."&nbsp;<span style='color:#dd154b;'>
		      		".$d." de ".$nombreMes." del ".$a."	</span>		
				</div>	
		    	
		    	<div id='pleca-punteada' style='height: 1px; background-color: #CCC; margin: 10px 0px ;'> &nbsp;	</div>    			     		      	
      		
	      ";
		//pinta un espacio en blanco que sirve de margen						
		if (($j == 0) || ($j == 1) || ($j == 3) || ($j == 4) ){
			echo "<div class='catego-space'></div>";				
		}
		$j++; 
	}
?>
</div>