<?php
session_start();
if(isset($_SESSION['login']))
{
require_once dirname(__FILE__) ."/core/db_access.php";
require_once dirname(__FILE__) ."/include/smarty.php";

$ob= new AccesoDB();
$ob2= new AccesoDB();
$ob3= new AccesoDB();

//Carusel de promociones
$sql = "SELECT
		CMS_IntPromocion.id_promocionIn AS id_promo,
		CMS_IntPromocion.descripcionVc AS nombre,
		DATE_FORMAT(CMS_IntPromocion.inicio_promocionDt, '%d/%m/%Y') AS fecha_inicio,
		DATE_FORMAT(CMS_IntPromocion.fin_promocionDt, '%d/%m/%Y') AS fecha_termino,
		CMS_IntPromocion.texto_ofertaTx AS descripcion,
		CONCAT ('De ',COALESCE(DATE_FORMAT(CMS_IntPromocion.inicio_promocionDt, '%d/%m/%Y'), 'No Especifica'),' Al ',COALESCE(DATE_FORMAT(CMS_IntPromocion.fin_promocionDt, '%d/%m/%Y'),'No Especifica')) AS vigencia,
		CMS_RelPromocionSitioCanal.id_promocionIn AS id_promo2,
		CMS_RelPromocionSitioCanal.id_canalSi AS canal,
		CMS_RelPromocionSitioCanal.fijoBi AS bcarrusel,
		CMS_RelPromocionSitioCanal.publicadoBi AS hestado,
		CMS_RelPromocionSitioCanal.PosicionIn AS posicion
		FROM CMS_RelPromocionSitioCanal , CMS_IntPromocion
		WHERE CMS_IntPromocion.fin_promocionDt >= NOW() AND CMS_IntPromocion.id_promocionIn=CMS_RelPromocionSitioCanal.id_promocionIn AND CMS_RelPromocionSitioCanal.id_canalSi=20 ORDER BY CMS_RelPromocionSitioCanal.PosicionIn ASC";
$aCarrucel = $ob->sSQL($sql);
//Listado Home
$sql2 = "SELECT
		CMS_IntPromocion.id_promocionIn AS id_promo,
		CMS_IntPromocion.descripcionVc AS nombre,
		DATE_FORMAT(CMS_IntPromocion.inicio_promocionDt, '%d/%m/%Y') AS fecha_inicio,
		DATE_FORMAT(CMS_IntPromocion.fin_promocionDt, '%d/%m/%Y') AS fecha_termino,
		CMS_IntPromocion.texto_ofertaTx AS descripcion,
		CONCAT ('De ',COALESCE(DATE_FORMAT(CMS_IntPromocion.inicio_promocionDt, '%d/%m/%Y'), 'No Especifica'),' Al ',COALESCE(DATE_FORMAT(CMS_IntPromocion.fin_promocionDt, '%d/%m/%Y'),'No Especifica')) AS vigencia,
		CMS_RelPromocionSitioCanal.id_promocionIn AS id_promo2,
		CMS_RelPromocionSitioCanal.id_canalSi AS canal,
		CMS_RelPromocionSitioCanal.fijoBi AS bcarrusel,
		CMS_RelPromocionSitioCanal.publicadoBi AS hestado,
		CMS_RelPromocionSitioCanal.PosicionIn AS posicion,
		CMS_IntPromocion.id_promocion_padreIn AS promo_padre
		FROM CMS_RelPromocionSitioCanal , CMS_IntPromocion
		WHERE CMS_IntPromocion.fin_promocionDt>=NOW() AND CMS_IntPromocion.id_promocionIn=CMS_RelPromocionSitioCanal.id_promocionIn AND CMS_RelPromocionSitioCanal.id_canalSi=21
		AND CMS_IntPromocion.id_promocion_padreIn IS NULL 
		ORDER BY CMS_RelPromocionSitioCanal.PosicionIn ASC";
$aPromociones = $ob2->sSQL($sql2);
//Promociones Especiales
$sql3 = "SELECT
		CMS_IntPromocion.id_promocionIn AS id_promo,
		CMS_IntPromocion.descripcionVc AS nombre,
		DATE_FORMAT(CMS_IntPromocion.inicio_promocionDt, '%d/%m/%Y') AS fecha_inicio,
		DATE_FORMAT(CMS_IntPromocion.fin_promocionDt, '%d/%m/%Y') AS fecha_termino,
		CMS_IntPromocion.texto_ofertaTx AS descripcion,
		CONCAT ('De ',COALESCE(DATE_FORMAT(CMS_IntPromocion.inicio_promocionDt, '%d/%m/%Y'), 'No Especifica'),' Al ',COALESCE(DATE_FORMAT(CMS_IntPromocion.fin_promocionDt, '%d/%m/%Y'),'No Especifica')) AS vigencia,
		CMS_RelPromocionSitioCanal.id_promocionIn AS id_promo2,
		CMS_RelPromocionSitioCanal.id_canalSi AS canal,
		CMS_RelPromocionSitioCanal.fijoBi AS bcarrusel,
		CMS_RelPromocionSitioCanal.publicadoBi AS hestado,
		CMS_RelPromocionSitioCanal.PosicionIn AS posicion,
		CMS_IntPromocion.id_promocion_padreIn AS promo_padre
		FROM CMS_RelPromocionSitioCanal , CMS_IntPromocion
		WHERE CMS_IntPromocion.fin_promocionDt>=NOW() AND CMS_IntPromocion.id_promocionIn=CMS_RelPromocionSitioCanal.id_promocionIn AND 
		CMS_RelPromocionSitioCanal.id_canalSi=24 AND CMS_IntPromocion.id_promocion_padreIn IS NULL ORDER BY CMS_RelPromocionSitioCanal.PosicionIn ASC";
$aEspeciales = $ob3->sSQL($sql3);

$title = "Administrador de Sitio";
$lm = "Administrar promociones home";

$oSmarty -> assign ("promoCarrucel",$aCarrucel);
$oSmarty -> assign ("listaPromo",$aPromociones);
$oSmarty -> assign ("listaEspe",$aEspeciales);
$oSmarty -> assign ("tituloPagina",$title);
$oSmarty -> assign ("lugarMenu",$lm);
$oSmarty -> assign ("contenido","inicio.html.tpl");

$oSmarty -> display ("layout.html.tpl");
}
else{
	die("Error::no ha iniciado sesión");
}

?>