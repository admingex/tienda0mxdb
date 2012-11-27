<?php		
	
	
	/*Vista que lista las publicaciones de una categoría*/
	if (isset($info_categoria)) {
		// el breadcrum
		$url_breadcum = site_url("categoria/".$info_categoria->id_categoriaSi);
		
		//breadcrum
		echo "<div id='breadcrumbs'><a href='".site_url("home")."'>Home</a><div class='triangulo-negro-der'></div><div class='noref'>".ucwords(strtolower($info_categoria->nombreVc))."</div> </div>";
	}
?>


<?php
	/*Vista que lista las "Promociones Especiales"*/
		
	if (isset($promociones_especiales) && !empty($promociones_especiales)){
		include('./components/promociones_especiales.php');
	}
?>
