<link href='css/viewlet-carrito.css' rel='stylesheet' type="text/css" />
<?php
echo "<div id='viewlet-carrito'>";
if(isset($_SESSION['carrito'])){
	$in='width: inherit';
	if(isset($_SESSION['ult_elem']) ){
		$ind=$_SESSION['ult_elem'];
		echo "<div>Producto agregado al carrito:</div>";
		echo "<div style='float: left; width: 25%; height: 100%; text-align: center'>";
		echo "    <img src='".$_SESSION['carrito'][$ind]['imagenVc']."' />";
		echo "		<br />".$_SESSION['carrito'][$ind]['descripcion'];
		echo "		<br />Precio: ".$_SESSION['carrito'][$ind]['precio'];
		echo "</div>";
		$in='width: 400px';	
		
	}	
	
	$na=count($_SESSION['carrito']);
	if($na>0){
		echo "<div style=' float: left; $in' >";
		
		$total=0;		
		foreach($_SESSION['carrito'] as $item){
			$total+=($item['cantidad']*$item['precio']);
		}
		
		## quitamos informacion que no es necesaria para procesar el pedido solo necesitamos id_sitio, id_canal, id_promocion  
		$promos_env=$_SESSION['carrito'];
		foreach ($promos_env as $key => $value) {
			unset($promos_env[$key]['descripcion']);
			unset($promos_env[$key]['imagenVc']);
			unset($promos_env[$key]['precio']);
		}		
		##############
		
		$datos_encrypt = API::encrypt(serialize($promos_env), API::API_KEY);
		$datos_encrypt_url=rtrim(strtr(base64_encode($datos_encrypt), '+/', '-_'), '=');
		echo "<div class=titulo-pag>
		<div class='img'>&nbsp;</div>
		<span>Carrito de compras</span></div>";
		echo "<div class='pleca'></div>";
		echo "
		<form name='' action='".ECOMMERCE."api/carrito/".$datos_encrypt_url."' method='post'>
		<div class='all-cont'>
		
			<div class='carrito-pag'>
				<p>Total del carrito: <span>$".number_format($total,2,'.',',')."</span><input type='submit' name='tienda_carrito' value='' class='pagar-carrito' /></p>
			</div>";
			
		
		foreach($_SESSION['carrito'] as $k => $v){
		
			echo "<div class='lista-articulos'>
					   <div class='imgp'>
					   		<img src='".$v['imagenVc']."'  />
						</div>								    	     
		        	   <div>
		        	   		<div class='datos'> <span class='titulo'>
		        	   			".$v['descripcion']."</span>
								<div class='pleca'></div>
								<br /><span class='descripcion'>
		        	   			".$v['descripcion']."</span><br />";
			echo " 	   			<a href='".site_url("carrito.php?eliminar_item=".$k)."'>Eliminar</a>";		        	   			
		    echo " 	   		</div>
		        	   		<div style='float: right'><span class='precio'>$".$v['precio']."</span></div>		        	   		
		        	   </div>
		        	   
		          </div>";
		}
			
		echo "			  			  	
			  	  <input type='hidden' name='guidx' value='".API::GUIDX."' style='display: none' />
			  	  <input type='hidden' name='guidz' value='".API::guid()."' style='display: none' />";
				  	if(isset($_SESSION['datos_login'])){
						$datos_login=$_SESSION['datos_login'];
					  	echo "<textarea name='datos_login' style='display: none'>".$datos_login."</textarea>";	
					}
		echo "<div style='clear: both;'><div style='float: right'>".number_format($total,2,'.',',')."</div></div>";	
echo"<div class='calculo'>
			Sub-total
			<br />
			IVA
			<br />
			Total
			</div>";		
		echo "<div class='continuar' style='background-color: #CCC; clear: both;'><input type='button'  class='continuar-carrito'/></div>	
				  <div style='background-color: #CCC; clear: both;' class='fin-pagar'><input type='submit' name='tienda_carrito' value='' class='pagar-carrito'/></div>
		</div>
		</form>
		</div>";	  
	}	
	else{
		echo "<p class='titulo-promo-rojo-deposito'>No hay productos en el carrito</p>";
	}		
}
else{
	echo "<p class='titulo-promo-rojo-deposito'>No hay productos en el carrito</p>";
}

echo "</div>";
?>