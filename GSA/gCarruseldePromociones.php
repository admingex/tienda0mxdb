<?php
session_start();
if(isset($_SESSION['login']))
{
	require_once dirname(__FILE__) ."/include/database.php";
	/*JSON*/
	include ('controllers/json_creator.php');
	$jc = new Json_Creator();
	/*----*/
	
	$db=getDb();	
	//TRAE LOS ID´S
	foreach ($_POST['cp'] as $value){
		$estado=$_POST[''.$value];	
		//echo $estado;//trae el bit para ver si es fijo, variable o no mostrar
		$sql="UPDATE CMS_RelPromocionSitioCanal SET fijoBi=$estado WHERE id_promocionIn=$value AND id_canalSi=20";
		$db -> Execute($sql);
	}
	/*JSON*/
	$promos_carrusel = $jc->generar_json_carrusel_promos();
	//echo "Promociones para el carrusel..................</br><br/>";
	/*---*/
	header('location: home.php');
}
else{
	die("Error::no ha iniciado sesi&oacute;n");
}
?>