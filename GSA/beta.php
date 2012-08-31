<?php
require_once dirname(__FILE__) ."/core/db_accessDos.php";
require_once dirname(__FILE__) ."/include/smarty.php";

//include ('core/db_access.php');
$ob= new AccesoDB();
$ob2= new AccesoDB();
$id=$_REQUEST['id'];

/*CONSULTA QUE DA LAS PUBLICACIONES PERTENECIENTES A LA CATEGORIA SELECCIONADA*/
$sql2="SELECT TND_CatPublicacion.id_publicacionSi, TND_CatPublicacion.nombreVc, 
TND_RelCategoriaPublicacion.id_categoriaSi, TND_RelCategoriaPublicacion.id_publicacionSi, 
TND_RelCategoriaPublicacion.posicionSi FROM TND_CatPublicacion INNER JOIN TND_RelCategoriaPublicacion ON 
TND_CatPublicacion.id_publicacionSi=TND_RelCategoriaPublicacion.id_publicacionSi AND TND_RelCategoriaPublicacion.id_categoriaSi=$id ORDER BY posicionSi ASC";
$listPublic = $ob->sSQL($sql2);

/*CONSULTA QUE DA TODAS LAS PUBLICACIONES QUE NO SE ENCUENTRAN EN LA CATEGORIA*/
$sql4="SELECT id_publicacionSi, nombreVc,posicionSi
FROM TND_CatPublicacion ORDER BY posicionSi ASC";
$allPublicaciones = $ob2->sSQL($sql4);


$title = "Administrador de Sitio";
$lm = "Administrar promociones home";

$oSmarty -> assign ("lpublica",$listPublic);
$oSmarty -> assign ("allPubli",$allPublicaciones);

$oSmarty -> assign ("tituloPagina",$title);
$oSmarty -> assign ("lugarMenu",$lm);
//$oSmarty -> assign ("contenido","beta.html.tpl");

$oSmarty -> display ("beta.html.tpl");


/*



echo "<pre>";
print_r($res);
echo "</pre>";

echo $res[0]['publicadoBi'];
echo "<br>";
echo $res[1]['publicadoBi'];

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