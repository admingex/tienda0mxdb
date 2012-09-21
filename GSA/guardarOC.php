<?php
session_start();
if(isset($_SESSION['login']))
{
require_once dirname(__FILE__) ."/include/database.php";
$db=getDb();

$idp=$_REQUEST['idp'];
$id_oc=$_REQUEST['ocid'];
$idf=$_REQUEST['tf'];
$palabra=$_REQUEST['nombre'];

//primero hacemos la consulta para ver si existe, el servicio si no abra que insertarlo si si solo hacemos el update del formato 
$sql="SELECT count(*) AS t FROM TND_CatOCThink WHERE oc_id=$id_oc";
$oc_validacion=$db -> GetOne($sql);

if($oc_validacion !=0){
	$sql="UPDATE TND_CatOCThink SET id_formatoSi=$idf WHERE oc_id=$id_oc";
	$db -> Execute($sql);
	//existe y por lo tanto solo actualizo el formato
}
else{
	//NO existe y por lo tanto se inserta y hay que consultar el servicio primero 
	
	
	/*--SERVICIO--*/
	$cliente = new SoapClient("http://10.177.73.45/TNDWebSvc/Service.asmx?WSDL");		
	$parameter = array(	'descriptionOc' => $palabra);	//debe ser null	
	$obj_result = $cliente->getOcThink ($parameter);
	$simple_result = $obj_result->getOcThinkResult ;		
	$arrayFinal =$simple_result->informacion_oc;
	foreach($arrayFinal as $indice => $valor) {
		if($id_oc==$arrayFinal[$indice] -> oc_id){
			$noc=$arrayFinal[$indice] -> oc;
			$ndes=$arrayFinal[$indice] -> description;
			break;
		}
	}
	/*--INSERT--*/
	$sql="INSERT INTO TND_CatOCThink (oc_id,nombreVc,oc,id_formatoSi) VALUES ($id_oc,'$ndes','$noc',$idf)";
	$db -> Execute($sql);
}

 
/*-VALIDACION-*/
$vtpr=0;
$sql="SELECT count(*) AS t FROM TND_RelPublicacionOC WHERE id_publicacionSi=$idp AND oc_id=$id_oc";
$vtrp=$db -> GetOne($sql);
if($vtpr==0){
	//sacamos la posicion
	$sql="SELECT count(PosicionIn) AS t FROM TND_RelPublicacionOC WHERE id_publicacionSi=$idp";
	$npos=$db -> GetOne($sql);
	$npos++;
	$sql="INSERT INTO TND_RelPublicacionOC (id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($idp,$id_oc,1,$npos)";
	$db -> Execute($sql);
}

//echo "<br>".$idp;
//echo "<br>".$id_oc;
//echo "<br>".$idf;
$texto=array();
$descripcion=array();
$i=0;
$y=0;
foreach ($_POST['ts'] as $value){
	$texto[$i]=$value;	
	$i++;	
			 //echo $value;
			//echo "<br>";			
}

foreach ($_POST['cont'] as $value){
	$descripcion[$y]=$value;
	$y++;			
		//echo $value;
		//echo "<br>";	
}

if($i>$y)
	$y=$i;

$sql="SELECT count(id_seccionIn) FROM TND_IntOCSeccion";
$cont=$db->GetOne($sql);
$cont++;
for($i=0; $i<=$y-1; $i++){
	$sql="INSERT INTO TND_IntOCSeccion (id_seccionIn,oc_id,tituloVc,descripcionVc) VALUES ($cont,$id_oc,'$texto[$i]','$descripcion[$i]')";
	$db -> Execute($sql);
	$cont++;
}
//$sql="SELECT * FROM TND_IntOCSeccion t";//para las secciones
// la consulta en donde se agrega el formato y se valida si no esta en la lista se inserta y esto se hace primero
//SELECT * FROM TND_CatOCThink t;
header('location: editpublic.php?id='.$idp);
}
else{
	die("Error::no ha iniciado sesi&oacute;n");
}
?>