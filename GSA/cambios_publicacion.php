<?php
require_once dirname(__FILE__) ."/include/database.php";
$db=getDb();

$id_pub=$_POST['idpublicacion'];
$nom_pub=$_POST['nombre'];
$descrip_pub=$_POST['descripcion'];
$pala_clave_pub=$_POST['pclave'];

$prom_destac=0;
foreach ($_POST['r'] as $value){
	if(!empty($_POST[$value])){
		$prom_destac=$_POST[$value];
		//echo $prom_destac;
	}
}
/**********************************************************************************************/
/*PRIMERO SE HACE LA ACTUALIZACION DE NOMBRE DE CATEGORIA, LA DESCRIPCION Y LAS PALABRAS CLAVE*/

$sql="UPDATE TND_CatPublicacion SET nombreVc='$nom_pub', descripcionVc='$descrip_pub', palabras_claveVc='$pala_clave_pub' WHERE id_publicacionSi=$id_pub";
$db -> Execute($sql);

/*---------------------------------------------------------------------------------------------*/
/*SEGUNDO LA PROMOCION DESTACADA*/
if($prom_destac != 0){
	//desactivamos
	$sql4="UPDATE TND_RelPromoSitioCanalPublicacion SET publicadoBi=0 WHERE id_promocionIn != $prom_destac AND id_publicacionSi=$id_pub AND id_canalSi=27";
	$db -> Execute($sql4);
	//activamos la correcta
	$sql5="UPDATE TND_RelPromoSitioCanalPublicacion SET publicadoBi=1 WHERE id_promocionIn = $prom_destac AND id_publicacionSi=$id_pub AND id_canalSi=27";
	$db -> Execute($sql5);
}
//si es = 0 quiere decir que no hay promocion destacada por lo tanto desactivamos todas
else{
	$sql4="UPDATE TND_RelPromoSitioCanalPublicacion SET publicadoBi=NULL WHERE id_publicacionSi=$id_pub AND id_canalSi=27";
	$db -> Execute($sql4);
}
/*---------------------------------------------------------------------------------------------*/
/*TERCERO PUBLICACIONES SUGERIDAS Y RELACIONADAS */
//LAS ELIMINAMOS PRIMERO 
$sql2="DELETE FROM TND_RelPublicacionOC WHERE id_publicacionSi=$id_pub AND id_tipoRelacionSi=3";
$db -> Execute($sql2);
$sql2="DELETE FROM TND_RelPublicacionOC WHERE id_publicacionSi=$id_pub AND id_tipoRelacionSi=2";
$db -> Execute($sql2);
//LAS INSERTAMOS LAS NUEVAS 
$mconS=1;
$mconR=1;
if($_POST['Er1'] != 0){
		$pr1=$_POST['Er1'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($id_pub,$pr1,2,$mconR)";
		$db -> Execute($sql);
}
if($_POST['Er2'] != 0){
		$mconR++;
		$pr2=$_POST['Er2'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($id_pub,$pr2,2.$mconR)";
		$db -> Execute($sql);
}
if($_POST['Er3'] != 0){
		$mconR++;
		$pr3=$_POST['Er3'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($id_pub,$pr3,2,$mconR)";
		$db -> Execute($sql);
}

if($_POST['Es1'] != 0){
		$ps1=$_POST['Es1'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($id_pub,$ps1,3,$mconS)";
		$db -> Execute($sql);
}
if($_POST['Es2'] != 0){
	$mconS++;
		$ps2=$_POST['Es2'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($id_pub,$ps2,3,$mconS)";
		$db -> Execute($sql);
}
if($_POST['Es3'] != 0){
	$mconS++;
		$ps3=$_POST['Es3'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($id_pub,$ps3,3,$mconS)";
		$db -> Execute($sql);
}

/*------------------------------------------------------------------------------------------------*/

echo"<script language='javascript' type='text/javascript'>
alert('Actualizaci'+'\u00F3'+'n Lista');
window.location.href='publicaciones.php';
</script>
";
?>