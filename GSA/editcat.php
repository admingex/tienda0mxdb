<?php
require_once dirname(__FILE__) ."/core/db_access.php";
require_once dirname(__FILE__) ."/include/smarty.php";
require_once dirname(__FILE__) ."/include/database.php";


$db=getDb();
$ob= new AccesoDB();

$id=$_REQUEST['id'];


/*CONSULTA QUE DA EL NOMBRE Y DESCRIPCION DE CATEGORIA SELEECCIONADA Y LAS PALABRAS CLAVE*/
$sql="SELECT id_categoriaSi,nombreVc, descripcionVc, palabras_claveVc FROM TND_CatCategoria WHERE id_categoriaSi=$id";
$cDetalle = $db -> GetAll($sql);
/*CONSULTA QUE DA LAS PUBLICACIONES PERTENECIENTES A LA CATEGORIA SELECCIONADA*/
$sql2="SELECT TND_CatPublicacion.id_publicacionSi, TND_CatPublicacion.nombreVc, TND_RelCategoriaPublicacion.id_categoriaSi, TND_RelCategoriaPublicacion.id_publicacionSi, TND_RelCategoriaPublicacion.posicionSi
FROM TND_CatPublicacion INNER JOIN TND_RelCategoriaPublicacion ON TND_CatPublicacion.id_publicacionSi=TND_RelCategoriaPublicacion.id_publicacionSi AND TND_RelCategoriaPublicacion.id_categoriaSi=$id ORDER BY posicionSi ASC";
$listPublic = $db -> GetAll($sql2);

/*CONSULTA QUE DA TODAS LAS PUBLICACIONES QUE NO SE ENCUENTRAN EN LA CATEGORIA*/
$sql4="SELECT id_publicacionSi, nombreVc,posicionSi
FROM TND_CatPublicacion ORDER BY posicionSi ASC";
$allPublicaciones = $db -> GetAll($sql4);

/*CONSULTA PARA LA PROMOCION DESTACADA*/
$sql3="SELECT TND_RelPromoSitioCanalCategoria.id_promocionIn, TND_RelPromoSitioCanalCategoria.id_canalSi, TND_RelPromoSitioCanalCategoria.id_categoriaSi, TND_RelPromoSitioCanalCategoria.publicadoBi, 
CMS_IntPromocion.id_promocionIn, CMS_IntPromocion.descripcionVc, CMS_IntPromocion.inicio_promocionDt, CMS_IntPromocion.fin_promocionDt
FROM TND_RelPromoSitioCanalCategoria , CMS_IntPromocion
WHERE TND_RelPromoSitioCanalCategoria.id_promocionIn=CMS_IntPromocion.id_promocionIn AND CMS_IntPromocion.fin_promocionDt >= NOW() AND TND_RelPromoSitioCanalCategoria.id_canalSi=22 AND TND_RelPromoSitioCanalCategoria.id_categoriaSi=$id";
$promoDest = $ob->sSQL($sql3);


$title = "Administrador de Sitio: Editar Categoria";
$lm = "Editar categoria";

$oSmarty -> assign ("catDetalle",$cDetalle);
$oSmarty -> assign ("lpublica",$listPublic);
$oSmarty -> assign ("allPubli",$allPublicaciones);

$oSmarty -> assign ("pDest",$promoDest);


$oSmarty -> assign ("tituloPagina",$title);
$oSmarty -> assign ("lugarMenu",$lm);
$oSmarty -> assign ("contenido","editarcategoria.html.tpl");

$oSmarty -> display ("layout.html.tpl");

?>