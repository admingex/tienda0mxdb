<?php
require_once dirname(__FILE__) ."/../include/database.php";
$db=getDb();
$idp=$_REQUEST['nidp'];
$idoc=$_REQUEST['nidoc'];
$sql="DELETE FROM TND_RelPublicacionOC WHERE id_publicacionSi=$idp AND oc_id=$idoc AND id_tipoRelacionSi=1";
$db -> Execute($sql);
?>