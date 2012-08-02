<div class="contenedor-promo">	
	
<?php
	echo "Inicio de la generación....</br>";
	echo "..................</br><br/>";

	$jc = new Json_Creator();
	
	//obtener el id_ del sitio la tienda y generar el archivo json correspondiente 
	$id_tienda = $jc->get_id_tienda();
	
	//obtener categorías y generar el json que las contenga
	$cats = $jc->get_categorias();
	//obtener publicaciones y generar el json que las contenga
	$pubs = $jc->get_publicaciones();
	
	#####
	//generar el json que las contenga las publicaciones por categoría
	$pubs_por_cat = $jc->generar_json_categoria_publicaciones();
	//generar el json que las contenga las promociones por publicación
	$promos_por_pub = $jc->generar_json_publicacion_promos();
	
	echo "Generación finalizada.";
	//echo "<pre>";
	//echo json_decode($publicaciones);
	/*
	echo print_r($pubs);
	echo "</pre>";
	exit;
	 
	} catch	(Exception $e) {
		echo "Error en la generación de archivos Json: " . $e->getMessage();
	}
	*/
?>
		
</div>