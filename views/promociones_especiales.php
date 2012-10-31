<link type="text/css" href="<?php echo TIENDA;?>css/promociones.css" rel="stylesheet" />
<link type="text/css" href="<?php echo TIENDA;?>css/viewlet-slide.css" rel="stylesheet" />
<?php
	/*Vista que lista las "Promociones Especiales"*/
		
	if (isset($promociones_especiales) && !empty($promociones_especiales)){
		include('./components/promociones_especiales.php');
	}
?>
