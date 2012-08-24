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
		print_r((array)$formatos_publicacion);
		echo "</pre>";*/
		
		echo 
		"<div class='cuenta_promociones'>M&aacute;s de " . MAX_PROMOS_PAGINA . " promociones para " . $nombre_pub ."</div>".
		 	"<div class='leyenda_formato'>".
		 		"<form id='form_filtro_formatos' method='post' action=''>Formato ";
	
		//mostrar el filtro de los formatoa
		$i = 0;
		foreach ($formatos->formatos as $f) {
			$id_f = $f->id_formato;	//$f->id_formato;
			$nombre_f = $f->nombre_formato;
			
			//formato de la publicación
			$id_fp = property_exists($formatos_publicacion, $id_f) ? $formatos_publicacion->$id_f : -1;
			
			
			
			if ($id_f == $id_fp) {
				$url_f = TIENDA . "filtro/" . $f->id_formato;
		      	echo "<input type='checkbox' id='chk_formato" . $id_f . "' name='chk_formato" . $id_f . "' value='". $id_f . "'><label for='chk_formato" . $id_f . "'>" . $nombre_f. "</label> ";
			}
		}
		echo 
				"<span class='label-right'>Ordenar por: 
					 <select name='filtro'>
					     <option value='precio'>Precio</option>
					     <option value='soldest'>Más vendido</option>
					 </select>
				 </span>
				 </form>	
			</div>";
	}
?>
</div>
