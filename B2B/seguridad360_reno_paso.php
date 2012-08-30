<?php
$p=$_POST['paso'];
if($p==1){
//insertamos en la base de datos de paso 1
//redireccionamos al siguiente paso
header('location:seguridad360_reno_paso2.php');
}
if($p==2){
//insertamos en la base de datos de paso 1
//redireccionamos a la pantalla de listo
//echo "insercion lista";
header('location:Sendmail.php');
}
?>