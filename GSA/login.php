<?php
require_once dirname(__FILE__) ."/include/smarty.php";

$title = "Administrador de Sitio";
$lm = "Login";


$oSmarty -> assign ("tituloPagina",$title);
$oSmarty -> assign ("lugarMenu",$lm);
//$oSmarty -> assign ("contenido","login.html.tpl");

$oSmarty -> display ("login.html.tpl");
?>