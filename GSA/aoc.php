<?php
session_start();
if(isset($_SESSION['login']))
{
require_once dirname(__FILE__) ."/core/db_access.php";
require_once dirname(__FILE__) ."/include/smarty.php";

$id=$_REQUEST['id'];

$ob= new AccesoDB();

$sql="SELECT * FROM TND_CatFormato";
$cf = $ob->sSQL($sql);

$oSmarty -> assign ("id",$id);
$oSmarty -> assign ("cf",$cf);
$oSmarty -> display ("aoc.html.tpl");
}
else{
	die("Error::no ha iniciado sesi&oacute;n");
}
?>