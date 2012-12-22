<!--<link href='<?php echo TIENDA ?>css/viewlet-carrito.css' rel='stylesheet' type="text/css" />-->
<?php


if (isset($_SESSION['carrito'])) {
	
		
		$na = count($_SESSION['carrito']);
		if ($na > 0) {					
				
			//total a pagar
			$total = 0;
			//total IVA
			$iva_compra = 0.0;
			foreach ($_SESSION['carrito'] as $item) {
				$total += ($item['cantidad'] * $item['precio']);
				if ($item['iva']) {
					$iva_compra += ($item['cantidad'] * $item['precio']) * 0.16;
				}
			}
			
			## quitamos informacion que no es necesaria para procesar el pedido solo necesitamos id_sitio, id_canal, id_promocion  
			$promos_env = $_SESSION['carrito'];
			foreach ($promos_env as $key => $value) {
				unset($promos_env[$key]['descripcion']);
				unset($promos_env[$key]['imagenVc']);
				unset($promos_env[$key]['precio']);
			}
			
			//encriptar lo que se enviará a la plataforma de pagos
			$datos_encrypt = API::encrypt(serialize($promos_env), API::API_KEY);
			$datos_encrypt_url = rtrim(strtr(base64_encode($datos_encrypt), '+/', '-_'), '=');
			
			
			echo "<div id='viewlet-carrito'>";
			echo 	"<form name='pagar_carrito' action='".ECOMMERCE."api/carrito/".$datos_encrypt_url."' method='post'>";
							
			####obtiene el ultimo elemento agregado al carrito y lo muestra
				$ultimo = end($_SESSION['carrito']);	
				// obtener imagen logo revista
				$img1 = str_replace("r_images", "l_images", $ultimo['imagenVc']);						
				
				echo "<div class='img-big'>";
				echo "    <img src='".TIENDA."r_images/".$ultimo['imagenVc']."' alt='".$ultimo['imagenVc']."' />";
				echo "    <img src='".TIENDA."l_images/".$img1."' alt 'logo'/>";			
				echo "</div>";	
			########		
															
				
			
			echo "<div class='plecas'  style='float: left; width: 435px' >";								
				
			foreach ($_SESSION['carrito'] as $k => $v) {
				    // obtener imagen logo revista
					//$img1 = str_replace("r_images", "l_images", $v['imagenVc']);					
					echo "	<div>
						        <ul>
						            <li>
						            	<div>
						            		<img src='".TIENDA."r_images/".$v['imagenVc']."' alt='".$v['imagenVc']."' height='155px' width='115px'/>
						            	</div>	
						            </li>
						            <li style='overflow: hidden; height: 165px; position: relative; display: block;'>						            	
						            	<div class='descripcion_producto'>
						            	    <img src='".TIENDA."l_images/".$v['imagenVc']."' alt 'logo'/>";
											if($v['cantidad']>1){
						            	    	echo "<div class='descripcion3'>".$v['cantidad']." lugares</div>";
											}
					echo "            	    <div class='precio'>$".number_format($v['precio'],2,".",",")."</div>
						            	    <div class='descripcion1'>".$v['descripcion']."</div>
						            	    <!--<div class='descripcion2'>".$v['descripcion']."</div>
						            	    <div class='descripcion3'>".$v['descripcion']."</div>-->
						            	    <a href='".site_url("carrito.php?eliminar_item=".$k)."'><div class='link-eliminar'></div></a> 
						            	</div>																	            
						            </li>
						            <li style='padding-top: 145px; color: #E0E0E0; bottom: 0px;'>						            	
						                <div class='precio_pagar'>pagar&nbsp;<span class='rojo'>$".number_format($v['cantidad']*$v['precio'],2,".",",")."</span></div>
						                						                
						            </li>
						        </ul>";						        							        						        															
				//echo 			"<a href='".site_url("carrito.php?eliminar_item=".$k)."'>Eliminar</a>";		        	   			
				
				echo "		</div>";   
					 	
			}
			
			//información para sincronizar con la plataforma		
			echo 	"<input type='hidden' name='guidx' value='".API::GUIDX."' style='display: none' />".
					"<input type='hidden' name='guidz' value='".API::guid()."' style='display: none' />";
			if (isset($_SESSION['datos_login'])) {
				$datos_login = $_SESSION['datos_login'];
				echo "<textarea name='datos_login' style='display: none'>".$datos_login."</textarea>";	
			}
					/*
					echo	"<div class='calculo'>".
								"Sub-total<span class='valor'>$".number_format($total, 2, '.', ',')."</span>".
								"<br />".
								"IVA<span class='valor'> $".number_format($iva_compra, 2, '.', ',')."</span>".
								"<br />".
								"Total<span class='valor'> $".number_format($total + $iva_compra, 2, '.', ',')."</span>".
							"</div>";
					
					echo 	"<div class='boton-final'>".
								"<a href='".site_url('home')."' class='continuar-carrito'></a>";										
					echo 		"<input type='submit' name='tienda_carrito' value='' class='pagar-carrito'/>".
							"</div>	".
					 */
			echo 	"</div>";
		echo "</div>
      		  <div id='totales'>
          	  	<div id='pleca_totales'>
              	</div>
              	<div id='total'>
              		<div class='total-right'>                  		
                  		<div class='blanco'>subtotal</div>
                  		<div class='rojo'>$".number_format($total,2,".",",")."</div>
              		</div>
              	</div>  
              	<div id='total'>
              		<div class='total-right'>                  		
                  		<div class='blanco'>IVA</div>
                  		<div class='rojo'>$".number_format($iva_compra,2,".",",")."</div>
              		</div>
              	</div>
              	<div id='total'>
              		<div class='total-right'>
                  		<div id='cuenta-detalle-carrito' class='carrito'>".$na."</div>
                  		<div class='blanco'>total</div>
                  		<div class='rojo'>$".number_format(($total+$iva_compra),2,".",",")."</div>
              		</div>
              	</div>   
              	<div id='botones'>
              	  	<a href='".site_url('home')."'>	
              	  		<div class='seguir-comprando'>
                      		Regresar a la tienda
              	  		</div>
              	  	</a>    
              	  	<div class='pagar'>               	  	          	  
                    	<input type='button' name='tienda_carrito' value='pagar' class='boton-pagar' onclick='document.pagar_carrito.submit()' />
                    </div>	              		
          	  	</div>          
      	      </div>
      	      </form>
      	      ";	
			  		
		} 
		else {
			echo "<p class='no-items'>No hay productos en el carrito</p>";
		}	
	 			
} 
else {
		echo "<p class='no-items'>No hay productos en el carrito</p>";
}