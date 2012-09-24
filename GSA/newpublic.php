<?php
session_start();
if(isset($_SESSION['login']))
{
require_once dirname(__FILE__) ."/core/db_access.php";
require_once dirname(__FILE__) ."/include/smarty.php";
require_once dirname(__FILE__) ."/include/database.php";

$ob= new AccesoDB();
$ob2= new AccesoDB();
$ob3= new AccesoDB();
 
/* Publicaciones destacadas */
$sql="SELECT TND_RelPromoSitioCanalPublicacion.id_promocionIn, TND_RelPromoSitioCanalPublicacion.id_canalSi, TND_RelPromoSitioCanalPublicacion.id_publicacionSi,
TND_RelPromoSitioCanalPublicacion.publicadoBi,
CMS_IntPromocion.id_promocionIn, CMS_IntPromocion.descripcionVc, CMS_IntPromocion.inicio_promocionDt, CMS_IntPromocion.fin_promocionDt
FROM TND_RelPromoSitioCanalPublicacion , CMS_IntPromocion
WHERE TND_RelPromoSitioCanalPublicacion.id_promocionIn=CMS_IntPromocion.id_promocionIn AND CMS_IntPromocion.fin_promocionDt >= NOW() AND
TND_RelPromoSitioCanalPublicacion.id_canalSi=27";
$promoDest = $ob->sSQL($sql);
 	
$sql2 = "SELECT * FROM TND_CatOCThink";
$cPublicaciones = $ob2->sSQL($sql2);

/*------------------------------------------------------*/
/*OBTENEMOS EL ID DE LA ULTIMA PUBLICACION Y SE SUMAMOS 1 lo cual corresponderia al id que tendria la publicacion */
$db=getDb();
$sql="SELECT MAX(id_publicacionSi) FROM TND_CatPublicacion";
$nid= $db -> GetOne($sql);
$nid++;

/*------------------------------------------------------*/
/*PARA EL ORDER CLASS
$sql="SELECT * FROM TND_RelPublicacionOC RPOC
INNER JOIN TND_CatOCThink COC ON RPOC.oc_id=COC.oc_id INNER JOIN TND_CatFormato CF ON CF.id_formatoSi=COC.id_formatoSi
WHERE RPOC.id_publicacionSi=$id AND RPOC.id_tipoRelacionSi=1 ORDER BY RPOC.posicionIn ASC";
$allocf = $ob->sSQL($sql);
*/


/*-----------------------------------------------------*/
$title = "Administrador de Sitio: Editar Categoria";
$lm = "Nueva publicación";
$modo="Nuevo";
$boton="Agregar publicacion";

$oSmarty -> assign ("tituloPagina",$title);
$oSmarty -> assign ("lugarMenu",$lm);
$oSmarty -> assign ("modo",$modo);
$oSmarty -> assign ("boton",$boton);

$oSmarty -> assign ("idfantasma",$nid);

$oSmarty -> assign ("pDest",$promoDest);
$oSmarty -> assign ("catpubli",$cPublicaciones);

/*ORDER CLASS
$oSmarty -> assign ("allocf",$allocf); */

$oSmarty -> assign ("contenido","nuevapublicacion.html.tpl");

$oSmarty -> display ("layout.html.tpl");
}
else{
	die("Error::no ha iniciado sesi&oacute;n");
}
?>