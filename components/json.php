<div class="contenedor-promo">	
	
<?php

	$jc = new Json_Creator();
	
	//obtener el id_ del sitio la tienda y generar el archivo json correspondiente 
	$id_tienda = $jc->get_id_tienda();
	
	//obtener categorías y generar el json que las contenga
	$cats = $jc->get_categorias();
	//generar el json que las contenga las publicaciones por categoría
	$publicaciones = $jc->generar_json_por_categorias();
	/*
	echo "<pre>";
	//echo json_decode($publicaciones);
	echo print_r($publicaciones);
	echo "</pre>";*/
	exit;
?>
		
</div>