<?php
require_once dirname(__FILE__) ."/../include/database.php";
$db=getDb();
$idp=$_REQUEST['id'];
$sql="UPDATE TND_CatPublicacion SET estatusBi=1 WHERE id_publicacionSi=$idp";
$db -> Execute($sql);
echo "La publicación ha sido activada";
?>