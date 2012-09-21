<?php
session_start();
if(isset($_SESSION['login']))
{
require_once dirname(__FILE__) ."/core/db_access.php";
require_once dirname(__FILE__) ."/include/smarty.php";

$ob= new AccesoDB();
$ob2= new AccesoDB();
$ob3= new AccesoDB();
$ob4= new AccesoDB();
$ob5= new AccesoDB();
$ob6= new AccesoDB();
$ob7= new AccesoDB();


$id=$_REQUEST['id'];

/* PARA LAS PUBLICACIONES SUGERIDAS */
$sql = "SELECT * FROM TND_CatOCThink";
$cPublicaciones = $ob->sSQL($sql);

/* Consulta que regresa los datos basicos de la publicacion  */
$sql2="SELECT * FROM TND_CatPublicacion WHERE id_publicacionSi=$id";
$infoPublicaciones = $ob2->sSQL($sql2);

/*CONSULTA PARA LA PROMOCION DESTACADA*/
$sql3="SELECT TND_RelPromoSitioCanalPublicacion.id_promocionIn, TND_RelPromoSitioCanalPublicacion.id_canalSi, TND_RelPromoSitioCanalPublicacion.id_publicacionSi, 
TND_RelPromoSitioCanalPublicacion.publicadoBi,
CMS_IntPromocion.id_promocionIn, CMS_IntPromocion.descripcionVc, CMS_IntPromocion.inicio_promocionDt, CMS_IntPromocion.fin_promocionDt
FROM TND_RelPromoSitioCanalPublicacion , CMS_IntPromocion
WHERE TND_RelPromoSitioCanalPublicacion.id_promocionIn=CMS_IntPromocion.id_promocionIn AND CMS_IntPromocion.fin_promocionDt >= NOW() AND 
TND_RelPromoSitioCanalPublicacion.id_canalSi=27 AND TND_RelPromoSitioCanalPublicacion.id_publicacionSi=$id";
$promoDest = $ob3->sSQL($sql3);
/*------------------------------------------------------*/
/*para conocer cantidad de relacionadas*/
$sql4="SELECT COUNT(id_publicacionSi) cantidad FROM TND_RelPublicacionOC WHERE id_tipoRelacionSi=2 AND id_publicacionSi=$id";
$cPR = $ob4->sSQL($sql4);

$sql5="SELECT TND_RelPublicacionOC.id_publicacionSi,TND_RelPublicacionOC.oc_id,TND_RelPublicacionOC.id_tipoRelacionSi,TND_CatOCThink.oc_id, TND_CatOCThink.nombreVc
FROM TND_RelPublicacionOC
INNER JOIN TND_CatOCThink ON TND_CatOCThink.oc_id=TND_RelPublicacionOC.oc_id
WHERE TND_RelPublicacionOC.id_tipoRelacionSi=2 AND TND_RelPublicacionOC.id_publicacionSi=$id";
$cPRT = $ob5->sSQL($sql5);
/*------------------------------------------------------*/
/*para conocer cantidad de sugeridas*/
$sql6="SELECT COUNT(id_publicacionSi) cantidad FROM TND_RelPublicacionOC WHERE id_tipoRelacionSi=3 AND id_publicacionSi=$id";
$cPS = $ob6->sSQL($sql6);

$sql7="SELECT TND_RelPublicacionOC.id_publicacionSi,TND_RelPublicacionOC.oc_id,TND_RelPublicacionOC.id_tipoRelacionSi,TND_CatOCThink.oc_id, TND_CatOCThink.nombreVc
FROM TND_RelPublicacionOC
INNER JOIN TND_CatOCThink ON TND_CatOCThink.oc_id=TND_RelPublicacionOC.oc_id
WHERE TND_RelPublicacionOC.id_tipoRelacionSi=3 AND TND_RelPublicacionOC.id_publicacionSi=$id";
$cPST = $ob7->sSQL($sql7);
/*------------------------------------------------------*/
/*PARA EL ORDER CLASS*/
$sql="SELECT * FROM TND_RelPublicacionOC RPOC
INNER JOIN TND_CatOCThink COC ON RPOC.oc_id=COC.oc_id INNER JOIN TND_CatFormato CF ON CF.id_formatoSi=COC.id_formatoSi
WHERE RPOC.id_publicacionSi=$id AND RPOC.id_tipoRelacionSi=1 ORDER BY RPOC.posicionIn";
$allocf = $ob->sSQL($sql);
/*------------------------------------------------------*/

$title = "Administrador de Sitio: Editar Categoria";
$lm = "Nueva publicación";
$modo="Editar";
$boton="Guardar publicacion";

$oSmarty -> assign ("tituloPagina",$title);
$oSmarty -> assign ("lugarMenu",$lm);

$oSmarty -> assign ("modo",$modo);
$oSmarty -> assign ("boton",$boton);

$oSmarty -> assign ("catpubli",$cPublicaciones);
$oSmarty -> assign ("infopublic",$infoPublicaciones);

$oSmarty -> assign ("pDest",$promoDest);
/*-SUGERIDAS*/
$oSmarty -> assign ("cPST",$cPST);
/*-RELACIONADAS*/
$oSmarty -> assign ("cPRT",$cPRT);
/*ORDER CLASS*/
$oSmarty -> assign ("allocf",$allocf); 

$oSmarty -> assign ("contenido","editpublicacion.html.tpl");
$oSmarty -> display ("layout.html.tpl");
}
else{
	die("Error::no ha iniciado sesi&oacute;n");
}
?>