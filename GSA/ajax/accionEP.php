<?php
require_once dirname(__FILE__) ."/../include/database.php";
$db=getDb();

$idp=$_POST['id'];

$sql="UPDATE TND_CatPublicacion SET estatusBi=0 WHERE id_publicacionSi=$idp";
$db -> Execute($sql);

//header('location:../publicaciones.php')

?>