<?php
session_start();

$ip="https://Kiosco.grupoexpansion.mx/";

if(!isset($_POST['tipo_suscripcion'])){	
	//echo "nasdas";
	header('location:'.$ip.'categoria/5');
}
else{
	if(preg_match('/^[A-Z0-9_]{1,10}$/i', $_POST['tipo_suscripcion']) ){
		//echo "valido";
		//exit;		
		$publicacion=explode("_",$_POST['tipo_suscripcion']);		
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
				//echo "entro nva";
				header('location:'.$ip.'B2B/'.$publicacion[1].'_nva.php');
				break;
				
			case 'ren':
				//echo "entro ren";
				header('location:'.$ip.'B2B/'.$publicacion[1].'_ren.php');
				break;
				
			case 'can':
				//echo "entro can";
				header('location:'.$ip.'B2B/'.$publicacion[1].'_can.php');
				break;
			
			default:
				header('location:'.$ip.'categoria/5');
				break;
		}
		
	}
	else{
		//echo "no valido";
		//exit;		
		header('location:'.$ip.'categoria/5');
	}
	
}

?>
