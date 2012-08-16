<?php
echo "<div style='width: 580px; padding-right: 10px'>";
if(isset($_SESSION['carrito'])){
	if(isset($_SESSION['ult_elem']) ){
		$ind=$_SESSION['ult_elem'];
		echo "<div>Producto agregado al carrito:</div>";
		echo "<div style='float: left; background-color: #DDD; width: 25%; height: 100%; text-align: center'>";
		echo "    <img src='".$_SESSION['carrito'][$ind]['imagenVc']."' />";
		echo "		<br />".$_SESSION['carrito'][$ind]['descripcion'];
		echo "		<br />Precio: ".$_SESSION['carrito'][$ind]['precio'];
		echo "</div>";	
	}	
	
	$na=count($_SESSION['carrito']);
	if($na>0){
		echo "<div style='background-color: #CCC; height: 100%;'>";
		
		$total=0;		
		foreach($_SESSION['carrito'] as $item){
			$total+=($item['cantidad']*$item['precio']);
		}
		echo "total del carrito: ".$total;
		echo "Numero de articulos en el carrito: ".$na;
		foreach($_SESSION['carrito'] as $k => $v){
			echo "<div>sitio: ".$v['id_sitio'].
		    	     "  canal: ".$v['id_canal'].
		        	 "  promocion:".$v['id_promocion'].
		        	 "  cantidad:".$v['cantidad'].
		         	 "  <a href='carrito.php?eliminar_item=".$k."'>borrar articulo:'".$k."'</a></div>";
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
		
					
		echo "</div>
			  
			  <form name='' action='".ECOMMERCE."api/carrito/".$datos_encrypt_url."' method='post'>	
			  	  <input type='text' name='guidx' value='".API::GUIDX."' style='display: none' />
			  	  <input type='text' name='guidz' value='".API::guid()."' style='display: none' />";
				  	if(isset($_SESSION['datos_login'])){
						$datos_login=$_SESSION['datos_login'];
					  	echo "<textarea name='datos_login' style='display: none'>".$datos_login."</textarea>";	
					}		  				  			  	  
		echo "	  <input type='submit' name='tienda_carrito' value='pagar' />
			  </form>			  
			  ";
		echo "<a href='".site_url('promociones-especiales.php')."'>Seguir comprando</a>";	  
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