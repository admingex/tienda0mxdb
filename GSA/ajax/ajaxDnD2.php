<?php
include ('../core/db_access.php');
$ob= new AccesoDB();
$id=$_REQUEST['id'];

$sql="SELECT TND_RelPromoSitioCanalCategoria.id_promocionIn, TND_RelPromoSitioCanalCategoria.id_canalSi, TND_RelPromoSitioCanalCategoria.id_categoriaSi, 
TND_RelPromoSitioCanalCategoria.publicadoBi, 
CMS_IntPromocion.id_promocionIn, CMS_IntPromocion.descripcionVc, CMS_IntPromocion.inicio_promocionDt, CMS_IntPromocion.fin_promocionDt
FROM TND_RelPromoSitioCanalCategoria , CMS_IntPromocion
WHERE TND_RelPromoSitioCanalCategoria.id_promocionIn=CMS_IntPromocion.id_promocionIn AND CMS_IntPromocion.fin_promocionDt >= NOW() 
AND TND_RelPromoSitioCanalCategoria.id_canalSi=22 AND TND_RelPromoSitioCanalCategoria.id_categoriaSi=$id";


$res = $ob->sSQL($sql);
/*
echo "<pre>";
print_r($res);
echo "</pre>";
*/
/*
echo $res[0]['publicadoBi'];
echo "<br>";
echo $res[1]['publicadoBi'];
*/
$sql2="SELECT TND_RelPublicacionOC.id_publicacionSi,TND_RelPublicacionOC.oc_id,TND_RelPublicacionOC.id_tipoRelacionSi,TND_CatOCThink.oc_id, TND_CatOCThink.nombreVc
FROM TND_RelPublicacionOC
INNER JOIN TND_CatOCThink ON TND_CatOCThink.oc_id=TND_RelPublicacionOC.oc_id
WHERE TND_RelPublicacionOC.id_tipoRelacionSi=3 AND TND_RelPublicacionOC.id_publicacionSi=14";

$sql3="SELECT * FROM TND_CatOCThink";
$res2 = $ob->sSQL($sql3);
echo $res2[0]['oc'];

echo "<br>";


echo "<pre>";
print_r($res2);
echo "</pre>";


/*
$result = $_REQUEST["table-3"];
foreach($result as $value) {
	echo "$value<br/>";
}

$sql2="SELECT * FROM TND_RelPromoSitioCanalCategoria";

$res2 = $ob->cSQL($sql2);
echo "<pre>";
print_r($res2);
echo "</pre>";
*/
?>