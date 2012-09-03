<?php
require_once dirname(__FILE__) ."/../include/database.php";
$db=getDb();
/*
if(isset($_REQUEST["table-3"])){
	$result = $_REQUEST["table-3"];
	foreach($result as $value) {
		//echo "$value<br/>";
	}
}
if(isset($_REQUEST["table-4"])){
	$result = $_REQUEST["table-4"];
	foreach($result as $value) {
		//echo "$value<br/>";
	}
}
if(isset($_REQUEST["table-5"])){
	$result = $_REQUEST["table-5"];
	foreach($result as $value) {
		//echo "$value<br/>";
	}
}
*/
$idc=$_POST['aidc'];
$idp=$_POST['aidp'];

//consulta para validar si ya existe la publicacion en la categoria 
$vsql="SELECT count(*) FROM TND_RelCategoriaPublicacion WHERE id_categoriaSi=$idc AND id_publicacionSi=$idp";
$valida= $db -> GetOne($vsql);
if($valida == 0){
	//consulta para obtener ultima posicion y asi poder agregar la nueva
	$sql="SELECT MAX(posicionSi) as p FROM TND_RelCategoriaPublicacion WHERE id_categoriaSi=$idc";
	$np= ($db -> GetOne($sql)) +1;
	//query que hace la insercion 
	$sql2="INSERT INTO TND_RelCategoriaPublicacion (id_categoriaSi,id_publicacionSi,posicionSi) VALUES ($idc,$idp,$np)";
	$db -> Execute($sql2);
	//echo "Publicación agregada a la categoria";
}
else{
	//echo "La publicación ya se encuentra en esta categoria";
}
?>