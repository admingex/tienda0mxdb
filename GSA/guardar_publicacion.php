<?php
require_once dirname(__FILE__) ."/include/database.php";
$db=getDb();

/*OBTENEMOS LA ULTMIA POSICION*/
$sql="SELECT MAX(posicionSi) FROM TND_CatPublicacion";
$res= $db -> GetOne($sql);
$npos=$res+1;

/*OBTENEMOS EL ID DE LA ULTIMA PUBLICACION Y SE SUMAMOS 1*/
$sql="SELECT MAX(id_publicacionSi) FROM TND_CatPublicacion";
$nid= $db -> GetOne($sql);
$vnid=$nid+1;

$nom_pub=$_POST['nombre'];
$descrip_pub=$_POST['descripcion'];
$pala_clave_pub=$_POST['pclave'];

/*HACEMOS LA INCERCION DE LA PUBLICACION */
$sql="INSERT INTO TND_CatPublicacion(id_publicacionSi,nombreVc,descripcionVc,palabras_claveVc,posicionSi,estatusBi) VALUES ($vnid,'$nom_pub','$descrip_pub','$pala_clave_pub',$npos,1)";
$res= $db -> Execute($sql);

/*PROMO DESTACADA*/
$prom_destac=0; //si es 0 no hay promo destacada 
if(!empty($_POST['r'])){//si el arreglo es diferente de 0 entrara y cambiara el valor de la promo destacada
	foreach ($_POST['r'] as $value){
		if(!empty($_POST[$value])){
			$prom_destac=$_POST[$value];		
		}
	}
}

/*PUBLICACIONES SUGERIDAS Y RELACIONADAS*/
//Relacionada 2    sugerida 3
$mconS=1;
$mconR=1;
if($_POST['r1'] != 0){
		$pr1=$_POST['r1'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($vnid,$pr1,2,$mconR)";
		$db -> Execute($sql);
}
if($_POST['r2'] != 0){
	$mconR++;
		$pr2=$_POST['r2'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($vnid,$pr2,2,$mconR)";
		$db -> Execute($sql);
}
if($_POST['r3'] != 0){
	$mconR++;
		$pr3=$_POST['r3'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($vnid,$pr3,2,$mconR)";
		$db -> Execute($sql);
}

if($_POST['s1'] != 0){
		$ps1=$_POST['s1'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($vnid,$ps1,3,$mconS)";
		$db -> Execute($sql);
}
if($_POST['s2'] != 0){
	$mconS++;
		$ps2=$_POST['s2'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($vnid,$ps2,3,$mconS)";
		$db -> Execute($sql);
}
if($_POST['s3'] != 0){
	$mconS;
		$ps3=$_POST['s3'];
		$sql="INSERT INTO TND_RelPublicacionOC(id_publicacionSi,oc_id,id_tipoRelacionSi,posicionIn) VALUES ($vnid,$ps3,3,$mconS)";
		$db -> Execute($sql);
}

/* INSERTAMOS O ACTUALIZAMOS LA PUBLICACION DESTACADA  */
if($prom_destac != 0){
	//como es nuevo solo insertamos la publicacion si es que se escoje alguna
	$sql5="INSERT INTO TND_RelPromoSitioCanalPublicacion(id_promocionIn,id_sitioSi,id_canalSi,id_publicacionSi,publicadoBi) VALUES ($prom_destac,3,27,$vnid,1)";
	$db -> Execute($sql5);
}
//si es = 0 quiere decir que no hay promocion destacada por lo tanto desactivamos todas
else{
	$sql4="UPDATE TND_RelPromoSitioCanalPublicacion SET publicadoBi=0 WHERE id_publicacionSi=$vnid AND id_canalSi=27";
	$db -> Execute($sql4);
}
 
/**********************************************************************************************/

echo"
<script language='javascript' type='text/javascript'>
alert('Publicacion guardada. Puede agregar el Order Class');
window.location.href='editpublic.php?id=".$vnid."';
</script>
";
?>
