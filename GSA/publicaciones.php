<?php
session_start();
if(isset($_SESSION['login']))
{
require_once dirname(__FILE__) ."/include/smarty.php";
require_once dirname(__FILE__) ."/include/database.php";
$db=getDb();
//Carusel de promociones
$sql = "SELECT * FROM TND_CatPublicacion WHERE estatusBi=1 ORDER BY posicionSi ASC";
$aCategorias = $db -> GetAll($sql);

$title = "Administrador de Sitio";
$lm = "Administrar publicaciones";
//para poner el titulo a la primera celda de la tabla
$tituloCelda="Publicación";
//Variable para determinar si estamos en categorias o publicaciones 
$modo="publicaciones";
$oSmarty -> assign ("adminCategorias",$aCategorias);
$oSmarty -> assign ("tituloPagina",$title);
$oSmarty -> assign ("lugarMenu",$lm);
$oSmarty -> assign ("tituloCelda",$tituloCelda);
$oSmarty -> assign ("modo",$modo);
$oSmarty -> assign ("contenido","admincategorias.html.tpl");

$oSmarty -> display ("layout.html.tpl");
}
else{
	die("Error::no ha iniciado sesión");
}
?>