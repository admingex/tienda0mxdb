<?php
require_once dirname(__FILE__) ."/../include/database.php";
$db=getDb();
$nf=$_REQUEST['nformato'];

$vsql="SELECT * FROM TND_CatFormato WHERE formatoVc='$nf'";

$fr = $db->GetRow($vsql);
if(!empty($fr)){
	$idf= $fr['id_formatoSi'];
	$sql="UPDATE TND_CatFormato SET estatusBi=1 WHERE id_formatoSi=$idf";
	$db -> Execute($sql);
}
else{
	//echo "no existe";
	$sql="INSERT INTO TND_CatFormato(formatoVc,estatusBi) VALUE ('$nf',1)";
	$db -> Execute($sql);
}
?>