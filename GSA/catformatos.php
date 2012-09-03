<?php
require_once dirname(__FILE__) ."/include/smarty.php";
require_once dirname(__FILE__) ."/include/database.php";

$db=getDb();

$sql = "SELECT * FROM TND_CatFormato WHERE estatusBi =1";
$cformatos = $db -> GetAll($sql);

$title = "Administrador de Sitio";
$lm = "Administrar formatos";

$oSmarty -> assign ("cformatos",$cformatos);

$oSmarty -> assign ("tituloPagina",$title);
$oSmarty -> assign ("lugarMenu",$lm);
$oSmarty -> assign ("contenido","formatos.html.tpl");

$oSmarty -> display ("layout.html.tpl");

?>