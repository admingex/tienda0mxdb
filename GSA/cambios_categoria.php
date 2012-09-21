<?php
session_start();
if(isset($_SESSION['login']))
{
require_once dirname(__FILE__) ."/include/database.php";
//require_once dirname(__FILE__) ."/include/databasedos.php";
$db=getDb();

$id_cat=$_POST['idcategoria'];
$nom_cat=$_POST['nombre'];
$descrip_cat=$_POST['descripcion'];
$pala_clave_cat=$_POST['pclave'];
$prom_destac=0;
if(!empty($_POST['r'])){
	foreach ($_POST['r'] as $value){
		if(!empty($_POST[$value])){
			$prom_destac=$_POST[$value];		
		}
	}
}

//echo $prom_destac;
/**********************************************************************************************/
/*PRIMERO SE HACE LA ACTUALIZACION DE NOMBRE DE CATEGORIA, LA DESCRIPCION Y LAS PALABRAS CLAVE*/

$sql="UPDATE TND_CatCategoria SET nombreVc='$nom_cat', descripcionVc='$descrip_cat', palabras_claveVc='$pala_clave_cat' WHERE id_categoriaSi=$id_cat";
$db -> Execute($sql);

/***********************************************************************************************/
/*SEGUNDO EL ORDENAMIENTO*/

$sql2="DELETE FROM TND_RelCategoriaPublicacion WHERE id_categoriaSi=$id_cat";
$db -> Execute($sql2);

$x=0;
if(!empty($_POST['pubid'])){
	foreach ($_POST['pubid'] as $value){
		$x+=1;
	    $sql3="INSERT INTO TND_RelCategoriaPublicacion (id_categoriaSi,id_publicacionSi,posicionSi) VALUES ($id_cat,$value,$x)";
		$db -> Execute($sql3);
	}
}

/***********************************************************************************************/
/*TERCERO LA PROMOCION DESTACADA*/
//$db2=getDbdos();
if($prom_destac != 0){
	//desactivamos
	$sql4="UPDATE TND_RelPromoSitioCanalCategoria SET publicadoBi=0 WHERE id_promocionIn != $prom_destac AND id_categoriaSi=$id_cat AND id_canalSi=22";
	$db -> Execute($sql4);
	//activamos la correcta
	$sql5="UPDATE TND_RelPromoSitioCanalCategoria SET publicadoBi=1 WHERE id_promocionIn = $prom_destac AND id_categoriaSi=$id_cat AND id_canalSi=22";
	$db -> Execute($sql5);
}
//si es = 0 quiere decir que no hay promocion destacada por lo tanto desactivamos todas
else{
	$sql4="UPDATE TND_RelPromoSitioCanalCategoria SET publicadoBi=0 WHERE id_categoriaSi=$id_cat AND id_canalSi=22";
	$db -> Execute($sql4);
}

/****************************************************************************************************/
/*MENSAJE FINAL*/

echo"<script language='javascript' type='text/javascript'>
alert('Actualizaci'+'\u00F3'+'n Lista');
window.location.href='categorias.php';
</script>
";
}
else{
	die("Error::no ha iniciado sesión");
}
?>