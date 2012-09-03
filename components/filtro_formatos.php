<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-formatos.css" rel="stylesheet" />
<div id="viewlet-formatos">
<?php 
	if (isset($ofertas_publicacion) && isset($total_promociones) && $total_promociones > MAX_PROMOS_PAGINA) {
		$nombre_pub = isset($info_publicacion) ? $info_publicacion->nombreVc : "";
		
		$formatos_publicacion = array();
		
		//recuperar los formatos de la publicación
		if (isset($formatos_pp)) {
			$formatos_publicacion = $formatos_pp;
		}
		/*echo "formatos_pp<pre>";
		print_r((array)$formatos_publicacion);
		echo "</pre>";*/
		
		echo 
		"<div class='cuenta_promociones'>M&aacute;s de " . MAX_PROMOS_PAGINA . " promociones para " . $nombre_pub ."</div>".
		"<div class='leyenda_formato'>".
			"<form id='form_filtro_formatos' method='post' action='/tienda/publicacion/ofertas/".$id_publicacion."'>Formato ";
	
		//mostrar el filtro de los formatos
		foreach ($formatos->formatos as $f) {
			$id_f = $f->id_formato;	//$f->id_formato;
			$nombre_f = $f->nombre_formato;
			
			//formato de la publicación
			$id_fp = property_exists($formatos_publicacion, $id_f) ? $formatos_publicacion->$id_f : -1;
			
			if ($id_f == $id_fp) {
				$url_f = TIENDA . "filtro/" . $f->id_formato;
				$checked = (isset($_POST['chk_formato'.$id_f])) ? "checked='checked'" : "";
		      	echo "<input type='checkbox' id='chk_formato" . $id_f . "' name='chk_formato" . $id_f . "' value='". $id_f . "' " . $checked . "><label for='chk_formato" . $id_f . "'>" . $nombre_f. "</label> ";
			}
		}
		
		//select de ordenación
		if (isset($criterios_ordenacion) && !empty($criterios_ordenacion)) {
			echo 
				"<span class='label-right'>Ordenar por:<select name='sel_ordenar' id='sel_ordenar'>
					<option value='' >Seleccionar</option>";
			foreach($criterios_ordenacion as $c) {
				//si viene el select:
				$sel_opcion = (array_key_exists('sel_ordenar', $_POST) && $_POST['sel_ordenar'] == $c->valor_criterio) ? "selected='true'" : "";
				echo "	<option value='" . $c->valor_criterio ."' ". $sel_opcion .">" . $c->nombre_criterio . "</option>\n";
			}
			
			echo "
					</select>\n
				</span>\n";
		}
		echo
			"</form>
		</div>";
	}
?>
</div>
