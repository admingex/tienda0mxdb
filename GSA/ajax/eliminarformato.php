<?php
require_once dirname(__FILE__) ."/../include/database.php";
$db=getDb();
$nom_form=$_REQUEST['nform'];
$sql="UPDATE TND_CatFormato SET estatusBi=0 WHERE formatoVc='$nom_form'";
$db -> Execute($sql);
?>