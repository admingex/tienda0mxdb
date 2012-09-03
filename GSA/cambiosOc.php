<?php
require_once dirname(__FILE__) ."/include/database.php";
$db=getDb();

$idp=$_REQUEST['idp'];
$oc_id=$_REQUEST['ocid'];
$nfid=$_REQUEST['tf'];

$sql="UPDATE TND_CatOCThink SET id_formatoSi=$nfid WHERE oc_id=$oc_id";
$db -> Execute($sql);

$sql="SELECT IFNULL(min(id_seccionIn),0) as minimo FROM TND_IntOCSeccion WHERE oc_id=$oc_id";
$valSeccion=$db -> GetOne($sql);

echo "<br>".$valSeccion."<br>";

$sql="SELECT count(id_seccionIn) FROM TND_IntOCSeccion";
$cont=$db->GetOne($sql);

if($valSeccion !=0){
	$cont=$valSeccion;
}
if($cont==0){
	$cont=1;
}
if($cont>=3){
	$cont++;
}
echo "<br>".$cont."<br>";

$texto=array();
$descripcion=array();
$i=0;
$y=0;
foreach ($_POST['ts'] as $value){
	$texto[$i]=$value;	
	$i++;	
	echo $value;
	echo "<br>";			
}

foreach ($_POST['cont'] as $value){
	$descripcion[$y]=$value;
	$y++;			
	echo $value;
	echo "<br>";	
}

if($i>$y){
	$y=$i;}
//Borramos todos los datos correspondientes a ese oc_id

echo "<br>".$y."<br>";
echo "<br>".$i."<br>";
	echo $oc_id;
$sql="DELETE FROM TND_IntOCSeccion WHERE oc_id=$oc_id";
$db->Execute($sql);

for($i=0; $i<=$y-1; $i++){
	echo $cont;
	$sql="INSERT INTO TND_IntOCSeccion (id_seccionIn,oc_id,tituloVc,descripcionVc) VALUES ($cont,$oc_id	,'$texto[$i]','$descripcion[$i]')";
	$cont++;
	$db -> Execute($sql);
}
header('location: editpublic.php?id='.$idp);
?>