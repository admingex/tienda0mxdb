<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-formatos.css" rel="stylesheet" />
<div id="viewlet-formatos">
<?php 

		$nombre_pub = isset($info_publicacion) ? $info_publicacion->nombreVc : "";
		
		
		/*echo "formatos_pp<pre>";
		print_r((array)$formatos_publicacion);
		echo "</pre>";*/
		
		echo 
		//"<div class='cuenta_promociones'>Resultados de su busqueda</div>".
		"<div class='leyenda_formato'>".
			"<form id='form_filtro_formatos' method='post' action='".TIENDA."buscador.php?fb=".$fb."&s=".$s."'>";
	
		//select de ordenación
		//if (isset($criterios_ordenacion) && !empty($criterios_ordenacion)) {
			echo 
				"<span class='label-right'>Ordenar por:<select name='sel_ordenar_dos' id='sel_ordenar_dos'>
					<option value='' >Seleccionar</option>";
			foreach($criterios_ordenacion as $c) {
				//si viene el select:
				$sel_opcion = (array_key_exists('sel_ordenar', $_POST) && $_POST['sel_ordenar'] == $c->valor_criterio) ? "selected='true'" : "";
				echo "	<option value='" . $c->valor_criterio ."' ". $sel_opcion .">" . $c->nombre_criterio . "</option>\n";
			}
			
			echo "
					</select>\n
				</span>\n";
		//}
		echo
			"</form>
		</div>";
		echo "&nbsp;";
	
	
                              
?>
</div>
