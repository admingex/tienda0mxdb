<?php
	/*Vista que lista las publicaciones de una categoría*/
	if (isset($info_categoria)) {
		// el breadcrum
		$url_breadcum = site_url("categoria/".$info_categoria->id_categoriaSi);
		
		//breadcrum
		echo "<div><a href='".site_url("home")."'> Home </a> > <b>".ucwords(strtolower($info_categoria->nombreVc))."<b> </div>";
	}
?>
<link type="text/css" href="<?php echo TIENDA;?>css/promociones.css" rel="stylesheet" />

<?php
	//viene en el data del controlador
	$id = isset($id_categoria) ? $id_categoria : 0;
	
	//ruta del archivo de la categoría en cuestión
	$path_categorias = "./json/categorias/publicaciones_categoria_".$id.".json";
	
	// revisar si hay promoción destacada por categoría
	$path_promo_destacada = "./json/promociones_destacadas/promo_destacada_categoria_".$id.".json";
	if (file_exists($path_promo_destacada)) {
		$json = file_get_contents($path_promo_destacada);
		$pd = json_decode($json);
		
		if (count($pd->promo_destacada) > 0) {
			include_once('./components/promocion_destacada.php');
		}
	}
	
	//revisar si hay publicaciones en la categoría y mostrarlas
	if (file_exists($path_categorias)) {
		$json = file_get_contents($path_categorias);
		$categoria = json_decode($json);
		
		if (count($categoria->publicaciones) > 0) {
			include_once('./components/categoria_publicaciones.php');
		}
	}
?>