<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-formatos.css" rel="stylesheet" />
<div id="viewlet-formatos">
<?php 
	if (isset($ofertas_publicacion) && count ($ofertas_publicacion->promociones) > MAX_PROMOS_PAGINA) {
		$nombre_pub = isset($info_publicacion) ? $info_publicacion->nombreVc : "";
		
		$formatos_publicacion = array();
		
		//recuperar los formatos de la publicación
		if (isset($formatos_pp)) {
			$formatos_publicacion = $formatos_pp;
		}
		/*echo "formatos_pp<pre>";
		print_r($formatos);
		echo "</pre>";*/
		
		echo 
		"<div class='cuenta_promociones'>M&aacute;s de " . MAX_PROMOS_PAGINA . " promociones para " . $nombre_pub ."</div>\n".
		 	"<div class='leyenda_formato'>Formato ";
	
		//mostrar el filtro de los formatoa
		$i = 0;
		foreach ($formatos_publicacion as $f => $value) {
			if ($formatos->formatos[$value]->id_formato == $value) {
			
			$id_f = $formatos->formatos[$value]->id_formato;	//$f->id_formato;
			$nombre_f = $formatos->formatos[$value]->nombre_formato;
			
			//if (array_key_exists($id_f, $formatos_publicacion)) {
			
				$url_f = TIENDA . "filtro/" . $f->id_formato;
		      	echo "<input type='checkbox' id='chk_formato" . $id_f . "' name='chk_formato" . $id_f . "'><label for='chk_formato" . $id_f . "'>" . $nombre_f. "</label> ";
			}
		}
		echo 
			"</div>
		</div>";
	}
?>

</div>