<?php
session_start();

$ip="https://tienda.grupoexpansion.mx/";

if(!isset($_REQUEST['tipo_suscripcion'])){
	//echo "nasdas";
	header('location:'.$ip.'categoria/5');
}
else{
	$publicacion=$_REQUEST['tipo_suscripcion'];
	if($publicacion==''){
		header('location:'.$ip.'categoria/5');
	}
	else{
		$publicacion=explode("_",$_REQUEST['tipo_suscripcion']);
		echo $publicacion[0]."<br>";
		echo $publicacion[1];
		$_SESSION['lugarTienda']=$publicacion[1];
		/*
		 * 7 - Energia 360
		 * 3 - Manufactura
		 * 4 - Obras
		 *   - Guía de Compras
		 *   - Logistica 360
		 *   - Ointeriores
		 *   - Seguridad 360
		 */
		switch ($publicacion[0]) {
			case "nva":
				echo "entro nva";
				header('location:'.$ip.'B2B/'.$publicacion[1].'_nva.php');
				break;
				
			case 'ren':
				echo "entro ren";
				header('location:'.$ip.'B2B/'.$publicacion[1].'_ren.php');
				break;
				
			case 'can':
				echo "entro can";
				header('location:'.$ip.'B2B/'.$publicacion[1].'_can.php');
				break;
			
			default:
				header('location:'.$ip.'categoria/5');
				break;
		}
	}
}

?>
