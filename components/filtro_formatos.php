<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-formatos.css" rel="stylesheet" />
<div id="viewlet-formatos">
	<div class="cuenta_promociones">M&aacute;s de 10 promociones para <?echo $info_publicacion->nombreVc?></div>
	Formato | 
<?php
	//mostrar el filtro de los formatoa
	foreach ($formatos->formatos as $f) {
		$url_f = TIENDA . "filtro/" . $f->id_formato;
      	echo "<a href=''>" . $f->nombre_formato . "</a> | ";
	}
?>

</div>