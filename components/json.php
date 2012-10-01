<div class="contenedor-promo">	
	
<?php
	echo "Inicio de la generación....</br>";
	echo "..................</br><br/>";

	$jc = new Json_Creator();
	
	//obtener el id_ del sitio la tienda y generar el archivo json correspondiente 
	$id_tienda = $jc->get_id_tienda();
	
	//obtener categorías y generar el json que las contenga
	$cats = $jc->get_categorias();
	echo "Categorías..................</br><br/>";
	//obtener publicaciones y generar el json que las contenga
	$pubs = $jc->get_publicaciones();
	echo "Publicaciones..................</br><br/>";
	//obtener publicaciones y generar el json que las contenga
	$pubs = $jc->get_catalogo_formatos();
	echo "Formatos..................</br><br/>";
	//generar el json que las contenga las publicaciones por categoría
	$pubs_por_cat = $jc->generar_json_categoria_publicaciones();
	echo "Publicaciones por Categoría..................</br><br/>";

	//generar el json que las contenga las promociones por publicación incluídos los json con el detalle de las mismas
	$promos_por_pub = $jc->generar_json_publicacion_promos();
	echo "Promociones por publicación..................</br><br/>";

	$promos_carrusel = $jc->generar_json_carrusel_promos();
	echo "Promociones para el carrusel..................</br><br/>";
	
	$promos_home = $jc->generar_json_home_promos();
	echo "Promociones para el home..................</br><br/>";
	
	$promos_home = $jc->generar_json_promos_especiales();
	echo "Promociones Especiales..................</br><br/>";
	
	$promos_destacadas_por_categorias = $jc->generar_json_promos_destacadas_por_categorias();
	echo "Promociones Destacadas Por Categorías ..................</br><br/>";

	$promos_destacadas_por_publicaciones = $jc->generar_json_promos_destacadas_por_publicaciones();
	echo "Promociones Destacadas Por Publicaciones ..................</br><br/>";

	$promos_padre =$jc->generar_json_promos_padre();
	echo "Promociones Padre ..................</br><br/>";
	
	$promos_hijas =$jc->generar_json_promos_hijas();
	echo "Promociones Hijas - Padre ..................</br><br/>";
	
	$detalle_promos_hijas =$jc->generar_json_detalle_promos_hijas();
	echo "Detalle Promociones Hijas ..................</br><br/>";
	
	echo "Generación finalizada exitosamente.";
	
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