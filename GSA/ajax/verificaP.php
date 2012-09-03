<?php
include ('../core/db_accessDos.php');

$nom=$_REQUEST['nompub'];

$ob= new AccesoDB();
$sql="SELECT * FROM TND_CatPublicacion WHERE nombreVC='$nom'";

$res = $ob->cSQL($sql);
/*
echo "<pre>";
print_r($res);
echo "</pre>";
echo $res['estatusBi'];
*/
if(!empty($res['id_publicacionSi'])){
	if($res['estatusBi']==0){
		echo("0");
		echo $res['id_publicacionSi'];
		echo "La publicación ya existe. \n¿Desea activarla? \n Esto activara todas las relaciones hacia la misma";
	}
	else {
		echo("1");
		echo $res['id_publicacionSi'];
		echo "La publicación ya existe. \n por favor cambie el nombre";
		//echo "<br> La publicacion esta activa";
	}
}
else{
	//echo "<br>array vacio";
}
?>