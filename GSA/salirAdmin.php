<?php
session_start();
unset($_SESSION['login']);
session_destroy();
	/*JSON*/
	include ('controllers/json_creator.php');
	$jc = new Json_Creator();
	

	$pubs = $jc->get_catalogo_formatos();
	echo "Formatos..................</br><br/>";
	
	$promos_carrusel = $jc->generar_json_carrusel_promos();
	echo "Promociones para el carrusel..................</br><br/>";
	
	$promos_home = $jc->generar_json_home_promos();
	echo "Promociones para el home..................</br><br/>";
	
	$promos_home = $jc->generar_json_promos_especiales();
	echo "Promociones Especiales..................</br><br/>";
	
	$cats = $jc->get_categorias();
	echo "Categorías..................</br><br/>";
	
	//obtener publicaciones y generar el json que las contenga
	$pubs = $jc->get_publicaciones();
	echo "Publicaciones..................</br><br/>";
	
	//generar el json que las contenga las publicaciones por categoría
	$pubs_por_cat = $jc->generar_json_categoria_publicaciones();
	echo "Publicaciones por Categoría..................</br><br/>";
	
	//generar el json que las contenga las promociones por publicación incluídos los json con el detalle de las mismas
	$promos_por_pub = $jc->generar_json_publicacion_promos();
	echo "Promociones por publicación..................</br><br/>";
	
	$promos_destacadas_por_categorias = $jc->generar_json_promos_destacadas_por_categorias();
	echo "Promociones Destacadas Por Categorías ..................</br><br/>";

	$promos_destacadas_por_publicaciones = $jc->generar_json_promos_destacadas_por_publicaciones();
	echo "Promociones Destacadas Por Publicaciones ..................</br><br/>";
	
header('location:login.php')
?>