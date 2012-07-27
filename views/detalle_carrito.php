<?php
echo "<div style='width: 580px; padding-right: 10px'>";
if(isset($_SESSION['carrito'])){
	if(isset($_SESSION['ult_elem']) && $_SESSION['ult_elem']!=0){
		$ind=$_SESSION['ult_elem'];
		echo "<div style='float: left; background-color: #DDD; width: 25%; height: 100%;'>";
		echo "    <img src='".TIENDA.$_SESSION['carrito'][$ind]['imagenVc']."' />";
		echo "		<br />".$_SESSION['carrito'][$ind]['descripcion'];
		echo "		<br />".$_SESSION['carrito'][$ind]['precio'];
		echo "</div>";	
	}	
	
	$na=count($_SESSION['carrito']);
	if($na>0){
		echo "<div style='background-color: #CCC; height: 100%;'>";
		echo "Numero de articulos en el carrito: ".$na;
		foreach($_SESSION['carrito'] as $k => $v){
			echo "<div>sitio: ".$v['id_sitio'].
		    	     "  canal: ".$v['id_canal'].
		        	 "  promocion:".$v['id_promocion'].
		        	 "  cantidad:".$v['cantidad'].
		         	 "  <a href='carrito.php?eliminar_item=".$k."'>borrar articulo:'".$k."'</a></div>";
		}		
		
		$datos_encrypt = API::encrypt(serialize($_SESSION['carrito']), API::API_KEY);
		$datos_encrypt_url=rtrim(strtr(base64_encode($datos_encrypt), '+/', '-_'), '=');
					
		echo "</div>
			  
			  <form name='' action='".ECOMMERCE."api/carrito/".$datos_encrypt_url."' method='post'>	
			  	  <input type='text' name='guidx' value='".API::GUIDX."' />
			  	  <input type='text' name='guidz' value='".API::guid()."' />			      
			      <input type='submit' name='tienda_arrito' value='pagar' />
			  </form>
			  
			  ";
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