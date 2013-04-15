<?php
echo "<link type='text/css' href='".TIENDA."css/viewlet-slide-idc.css' rel='stylesheet' />";
?>		
<div id='contenedor_slide'>	
	<div class='list_carousel responsive'>
		<ul id='slider'>
<?php	
	echo "<div id='relevancia' style='color:#CCC; font-size:16px; padding-bottom:10px;'> Resultado de busqueda <span style='color:#dd154b; text-transform: uppercase'>".$s."</span></div>";
	echo "<div id='pleca-punteada' style='height: 1px; background-color: #CCC; margin: 10px 0px ;'> &nbsp;	</div>";
	foreach($ofertas_publicacion->promociones as $p){
		
		//creación de la URL para mostrar el detalle final de la promoción
		$url_detalle_promo = '';
		//los ids se recuperan desde el front controller: "publicaciones.php"
		$url_detalle_promo = site_url((isset($id_categoria) ? 'categoria/' . $id_categoria.'/' : '') . (isset($id_publicacion) ? 'publicacion/' . $id_publicacion. '/' : '') .'promocion/' . $p->detalle->id_promocion);
				
		//para pasar a pagar en la plataforma de pagos, es la acción por defecto:
		$action_pagos = ECOMMERCE."api/". $p->detalle->id_sitio . "/" . $p->detalle->id_canal . "/" . $p->detalle->id_promocion . "/pago";
		
		//para agregar la promoción al carrito:
		$carrito='';
		$carrito = "'comprar_promocion', ".$p->detalle->id_sitio.", ".$p->detalle->id_canal.", ".$p->detalle->id_promocion;
		
		$descripcion_promocion = !empty($p->detalle->descripcion_issue) ? $p->detalle->descripcion_issue : $p->detalle->descripcion_promocion; 
		//$action_carrito = TIENDA . "carrito.php?id_sitio=" . $p->detalle->id_sitio . "&id_canal=" . $p->detalle->id_canal . "&id_promocion=" . $p->detalle->id_promocion;
		//$onclick_action = "document.comprar_promocion" . $p->detalle->id_promocion . ".action='" . $action_carrito . "'; ";
		//$onclick_event = "document.comprar_promocion".$p->detalle->id_promocion.".submit()";
		
		//formulario para la promoción
		//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
		if (file_exists("./l_images/".$p->detalle->url_imagen)){
			$src = TIENDA ."l_images/".$p->detalle->url_imagen;
		} else {
			//$src = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
			$src = TIENDA ."l_images/".$p->detalle->url_imagen;
		}
		//carga el primer valor en la columna derecha
		$inides=$descripcion_promocion;
		$initit=$p->detalle->nombre_publicacion;
		
		 $fecha = $p->detalle->fecha_inicio_promo;
		 $d = substr($fecha, 0,2);
		 $m = substr($fecha, 3,2);
		 $a = substr($fecha, 6,4);
		 
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
		  
		echo "	
				<form id='comprar_promocion".$p->detalle->id_promocion."' name='comprar_promocion".$p->detalle->id_promocion."' action='". $action_pagos ."' method='post'>
				<input type='hidden' name='guidx' value='".API::GUIDX."' />
			    <input type='hidden' name='guidz' value='".API::guid()."' />
			    <input type='hidden' name='imagen' value='".$src."' />
			    <input type='hidden' name='descripcion' value='".$descripcion_promocion."' />
			    <input type='hidden' name='precio' value='".$p->detalle->costo."'/>
			    <input type='hidden' name='moneda' value='".$p->detalle->moneda."'/>
			    <input type='hidden' name='iva' value='".$p->detalle->taxable."' />
			    <input type='hidden' name='cantidad' value='1' />		
			    
			    	    		    
		    	<a href='". $url_detalle_promo . "'>
		    		<img src='".$src."'>
		    	</a>
		    	
			    <div id='nombre".$p->detalle->id_promocion."' style='color:white; padding-bottom:10px; padding-top:8px; font-size:14px; margin-left:45px;'>			    			    	
		      		".$p->detalle->descripcion_promocion."   						
				</div>	
				
				
				
				 <div id='descripcion".$p->detalle->id_promocion."' style='color:white; margin-left:45px;'>			    			    	
		      		".$p->detalle->descripcion_publicacion."&nbsp;
		      		".$p->detalle->descripcion_issue."&nbsp;<span style='color:#dd154b;'>
		      		".$d." de ".$nombreMes." del ".$a."	</span>			
				</div>	
		    	
		    	<div id='pleca-punteada' style='height: 1px; background-color: #CCC; margin: 10px 0px ;'> &nbsp;	</div>
		    		    	
												
				<div id='titulo".$p->detalle->id_promocion."' style='display: none'>".$p->detalle->nombre_publicacion."</div>
	          	
	          	<input type='submit' name='btn_comprar_ahora' value=' ' style='display: none'  />";
		 ?>		      	
		      		<input type="button" id="btn_agregar_carrito" name="btn_agregar_carrito" value=" " onclick="anadir_carrito(<?php echo $carrito ;?>)" style='display: none' />
		 <?php     	
	      echo "		      	
		    </form>  
		    	
	  		
	  	";
		 
		 
		 
	}
	echo "

	  </div>";
?>
</div>
