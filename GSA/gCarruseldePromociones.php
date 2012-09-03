<?php
require_once dirname(__FILE__) ."/include/database.php";
$db=getDb();

//TRAE LOS ID´S
foreach ($_POST['cp'] as $value){
	$estado=$_POST[''.$value];	
	echo $estado;//trae el bit para ver si es fijo, variable o no mostrar
	$sql="UPDATE CMS_RelPromocionSitioCanal SET fijoBi=$estado WHERE id_promocionIn=$value AND id_canalSi=20";
	$db -> Execute($sql);
}
header('location: home.php');

?>