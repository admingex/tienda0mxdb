<?php
require_once dirname(__FILE__) ."/core/db_access.php";
require_once dirname(__FILE__) ."/include/smarty.php";

$id=$_REQUEST['id'];//id del oc
$desc=$_REQUEST['des']; //descripcion oc
$formaVc=$_REQUEST['forma']; //nombre del formato
$idp=$_REQUEST['idp']; //id publicacion 

$ob= new AccesoDB();
$ob2= new AccesoDB();

$sql="SELECT * FROM TND_IntOCSeccion WHERE oc_id=$id";
$aThink = $ob->sSQL($sql);

$sql="SELECT * FROM TND_CatFormato";
$cf = $ob2->sSQL($sql);

$sql="SELECT id_formatoSi FROM TND_CatFormato WHERE formatoVC='$formaVc'";
$forma = $ob2->sSQL($sql);

$oSmarty -> assign ("id",$id);
$oSmarty -> assign ("idp",$idp);
$oSmarty -> assign ("desc",$desc);
$oSmarty -> assign ("forma",$forma);
$oSmarty -> assign ("aThink",$aThink);
$oSmarty -> assign ("cf",$cf);
$oSmarty -> display ("aocEdit.html.tpl");
?>