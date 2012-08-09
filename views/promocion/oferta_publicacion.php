<?php
	////////////////Encabezado_Cstegoría
	if (isset($info_publicacion)) {
		//es un objeto
		echo "<div>
				<h3>$info_publicacion->nombreVc</h3>
				<p>$info_publicacion->descripcionVc</p>
			</div>";
			/*echo "<pre>info_publicacion";
			print_r($info_publicacion);
			echo "</pre>";
			exit;*/
	} 
		echo $pubs_m."<br/>";	
?>
<div class="contenedor-promo">
<?php
/*
	$id = isset($id_categoria) ? $id_categoria : 0;
	$path_categorias = "./json/categorias/publicaciones_categoria_".$id.".json";
	
	///////////////revisar si hay promoción destacada
	$path_promo_destacada= "./json/promociones_destacadas/promo_destacada_categoria_".$id.".json";
	
	if (file_exists($path_promo_destacada)) {
		$json = file_get_contents($path_promo_destacada);
		$pd = json_decode($json);
		
		if (count($pd->promocion_especial_destacada) > 0) {
			include_once('./components/promocion_destacada.php');
		}
	}
	
	///////////////revisar si hay publicaciones en la categoría
	if (file_exists($path_categorias)) {
		$json = file_get_contents($path_categorias);
		$data = json_decode($json);
		
		if (count($data->publicaciones) > 0) {
			include_once('./components/categorias.php');
		}
	}
 
 */
?>
</div>