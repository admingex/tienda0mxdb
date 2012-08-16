<?php
echo "<div style='width: 590px; padding-right: 10px; height: auto'>";
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
		echo "<div style=' float: left; $in'>";
		
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
		
		echo "
		<form name='' action='".ECOMMERCE."api/carrito/".$datos_encrypt_url."' method='post'>
			<div style='background-color: #CCC; padding: 10px 0px'><p>Total del carrito: ".number_format($total,2,'.',',')."<input type='submit' name='tienda_carrito' value='pagar' /></p></div>";
		echo "<p style='padding: 10px 0px'>Numero de articulos en el carrito: ".$na."</p>";
		foreach($_SESSION['carrito'] as $k => $v){
			echo "<div style='clear: both; padding: 5px 0px;'>
					   <div style='float: left'>
					   		<img src='".$v['imagenVc']."' style='height:50px; width: 35px;' /></div>								    	     
		        	   <div>
		        	   		<div style='float: left; padding-left: 10px; width: 290px;'>
		        	   			".$v['cantidad']."		        	   			
		        	   			".$v['descripcion']."<br />
		        	   			<a href='carrito.php?eliminar_item=".$k."'>Eliminar</a>		        	   			
		        	   		</div>
		        	   		<div style='float: right'>".$v['precio']."</div>		        	   		
		        	   </div>
		        	   
		          </div>";
		}										
		echo "			  			  	
			  	  <input type='text' name='guidx' value='".API::GUIDX."' style='display: none' />
			  	  <input type='text' name='guidz' value='".API::guid()."' style='display: none' />";
				  	if(isset($_SESSION['datos_login'])){
						$datos_login=$_SESSION['datos_login'];
					  	echo "<textarea name='datos_login' style='display: none'>".$datos_login."</textarea>";	
					}
		echo "<div style='clear: both;'><div style='float: right'>".$total."</div></div>";							  				  			  	  
		echo "<div style='background-color: #CCC; clear: both;'><a href='".site_url('promociones-especiales.php')."'>Seguir comprando</a>
				  <input type='submit' name='tienda_carrito' value='pagar' /></div>	
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