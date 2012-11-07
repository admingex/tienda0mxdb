<!--<link href='<?php echo TIENDA ?>css/viewlet-carrito.css' rel='stylesheet' type="text/css" />-->
<?php

echo "<div id='viewlet-carrito' style='border: solid 1px #800'>";
	/*echo "<pre>";
	print_r($_SESSION['carrito']);
	echo "</pre>";*/
	
	if (isset($_SESSION['carrito'])) {		
		$in = 'width: 100%';
		$var = 0;
		if (isset($_SESSION['ult_elem'])) {
			$var = 1;
			$ind = $_SESSION['ult_elem'];			
			echo "<div class='img-big'>";
			echo "    <img src='".$_SESSION['carrito'][$ind]['imagenVc']."' alt='".$_SESSION['carrito'][$ind]['imagenVc']."' width='175px' height='235px' />";
			echo "    <div style='color: #FFF; font-weight: bold;'>AQUI TEXTO de la otra imagen</div>";			
			echo "</div>
			      <div class='pleca_vertical'>
			      </div>";			
			$in = 'width: 354px';
		}
		
		$na = count($_SESSION['carrito']);
		if ($na > 0) {
				
			//total a pagar
			$total = 0;
			//total IVA
			$iva_compra = 0.0;
			foreach ($_SESSION['carrito'] as $item) {
				$total += ($item['cantidad'] * $item['precio']);
				if ($item['iva']) {
					$iva_compra += $item['precio'] * 0.16;
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
			
			echo "<div style='float: left; $in' >";
			echo 	"<form name='' action='".ECOMMERCE."api/carrito/".$datos_encrypt_url."' method='post'>";					
				
			foreach ($_SESSION['carrito'] as $k => $v) {
					echo "	<div style='margin-bottom: 15px'>
								<div>
									<img src='".$v['imagenVc']."' alt='".$v['imagenVc']."' height='155px' width='115px'/>
								</div>";									
				//descripción de la promoción
				echo 			"<span class='titulo'>".$v['descripcion']."</span><br />";						
				echo 			"<a href='".site_url("carrito.php?eliminar_item=".$k)."'>Eliminar</a>";		        	   			
				echo 		"    <div style='float:right; font-weight:bold ;'><span class='precio'>$".number_format($v['precio'],2,".",",")."</span></div>
							</div>";   
					 	
			}
			
			//información para sincronizar con la plataforma		
			echo 	"<input type='hidden' name='guidx' value='".API::GUIDX."' style='display: none' />".
					"<input type='hidden' name='guidz' value='".API::guid()."' style='display: none' />";
			if (isset($_SESSION['datos_login'])) {
				$datos_login = $_SESSION['datos_login'];
				echo "<textarea name='datos_login' style='display: none'>".$datos_login."</textarea>";	
			}
			
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
					"</form>".
				"</div>";
		} 
		else {
			echo "<p class='titulo-promo-rojo-deposito'>No hay productos en el carrito</p>";
		}
		
	} 
	else {
		echo "<p class='titulo-promo-rojo-deposito'>No hay productos en el carrito</p>";
	}

echo "</div>";
