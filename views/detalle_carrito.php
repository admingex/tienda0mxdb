<link href='<?php echo TIENDA ?>css/viewlet-carrito.css' rel='stylesheet' type="text/css" />
<?php

echo "<div id='viewlet-carrito'>";
/*echo "<pre>";
print_r($_SESSION['carrito']);
echo "</pre>";*/
if (isset($_SESSION['carrito'])) {
	$in = 'width: 528px';
	$var = 0;
	if (isset($_SESSION['ult_elem'])) {
		$var = 1;
		$ind = $_SESSION['ult_elem'];
		echo "<div class='pac'>
				<div class='img'>&nbsp;</div>
					Producto agregado al carrito:
				</div>";
		echo "<div class='img-big'>";
		echo "  <img src='".$_SESSION['carrito'][$ind]['imagenVc']."' alt='".$_SESSION['carrito'][$ind]['imagenVc']."' width='127px' height='169px' />";
		echo "	<br/>
				<span class='titulo'>
					".$_SESSION['carrito'][$ind]['descripcion'];
		echo "	</span><br/>
				<span class='descripcion'>".$_SESSION['carrito'][$ind]['descripcion']."</span><br/>".		
				"<span class='precio' style='color: #a70002;'>$ ".number_format($_SESSION['carrito'][$ind]['precio'], 2  ,".", ",")."</span>";
		echo "</div>";
		
		$in = 'width: 400px';
	}
	
	$na = count($_SESSION['carrito']);
	if ($na > 0) {
		echo "<div style='float: left; $in' >";
		
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
		
		if ($var == 0) {
			echo "<div class=titulo-pag>
					<div class='img'>&nbsp;</div>
					<span>Carrito de compras</span>
				</div>";
			echo "<div class='pleca'></div>";
		}
		
		echo 	"<form name='' action='".ECOMMERCE."api/carrito/".$datos_encrypt_url."' method='post'>
					<div class='all-cont'>";
		
		if ($var == 0) {
			echo		"<div class='carrito-pag' style='text-align:right;'>";
		} else {
			echo 		"<div class='carrito-pag' style='text-align:left;'>";
		}
		echo 				"<p>Total del carrito: <span>$".number_format($total,2,'.',',')."</span><input type='submit' name='tienda_carrito' value='' class='pagar-carrito' /></p>".
						"</div>";
			
			echo 		"<div class='nproductos'>".
							"<p><label id='cuenta-detalle-carrito'>".$na."</label> productos en el carrito:</p>".
						"</div>";
				
		foreach ($_SESSION['carrito'] as $k => $v) {
			echo 		"<div class='lista-articulos'>".
							"<div class='imgp'>".
							"<img src='".$v['imagenVc']."' alt='".$v['imagenVc']."' />".
						"</div>";
			//listado de artículos en el carrito
			if ($var == 0) {
				echo 	"<div class='datos' style='width:350px;'>";
			} else {
				echo 	"<div class='datos' style='width: 230px;'>";
			}
			//descripción de la promoción
			echo 			"<span class='titulo'>".$v['descripcion']."</span>";
			if ($var == 0) {
				echo 		"<div class='pleca' style='width: 524px;'></div>";
			} else {
				echo		"<div class='pleca' style='width: 400px;'></div>";
			}
			echo			"<br/><span class='descripcion'>".$v['descripcion']."</span><br />";
			echo 			"<a href='".site_url("carrito.php?eliminar_item=".$k)."'>Eliminar</a>";		        	   			
			echo 		"</div>".
					"<div style='float:right; font-weight:bold ;'><span class='precio'>$".number_format($v['precio'],2,".",",")."</span></div>".   
				 "</div>";
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
				
		if ($var == 0) {
			echo	"<div style='margin-left:465px;'>";
		} else {
			echo 	"<div style='margin-left:340px;'>";
		}
				
		echo 			"<input type='submit' name='tienda_carrito' value='' class='pagar-carrito'/>".
					"</div>".
				"</div>	".
			"</div>".
		"</form>".
	"</div>";
	} else {
		echo "<p class='titulo-promo-rojo-deposito'>No hay productos en el carrito</p>";
	}		
} else {
	echo "<p class='titulo-promo-rojo-deposito'>No hay productos en el carrito</p>";
}
echo "</div>";
