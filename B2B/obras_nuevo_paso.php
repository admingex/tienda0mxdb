<?php
 require('./templates/db.php');
session_start();
//session_destroy();
$_SESSION['paso']=$_POST['paso'];
if($_SESSION['paso']==1){
	//recibimos datos metodo 1
	$_SESSION['numbers'][]=$_POST['bulk']; //vandera para ver la informacion
	$_SESSION['numbers'][]=$_POST['nombre'];
	$_SESSION['numbers'][]=$_POST['paterno'];
	$_SESSION['numbers'][]=$_POST['materno'];
	$_SESSION['numbers'][]=$_POST['empresa'];
	$_SESSION['numbers'][]=$_POST['puesto'];
	$_SESSION['numbers'][]=$_POST['departamento'];
	$_SESSION['numbers'][]=$_POST['direccion'];
	$_SESSION['numbers'][]=$_POST['numero'];
	$_SESSION['numbers'][]=$_POST['entre'];
	$_SESSION['numbers'][]=$_POST['cp'];
	$_SESSION['numbers'][]=$_POST['colonias'];
	$_SESSION['numbers'][]=$_POST['ciudad'];
	$_SESSION['numbers'][]=$_POST['estado'];
	$_SESSION['numbers'][]=$_POST['lada'];
	$_SESSION['numbers'][]=$_POST['telefono'];
	$_SESSION['numbers'][]=$_POST['fax'];
	$_SESSION['numbers'][]=$_POST['email'];
	$emailenvio=$_POST['email'];
	$_SESSION['numbers'][]=$_POST['b2bSourcecode'];
	
	/*echo "<pre>";
	print_r($_SESSION['numbers']);
	echo "</pre>";*/
header('location:obras_nuevo_paso2.php');
}
if($_SESSION['paso']==2){
//insertamos en la base de datos de paso 1
//redireccionamos a la pantalla de listo
//echo "insercion lista";
header('location:Sendmail.php');
}
if($_SESSION['paso']==3){
//insertamos en la base de datos de paso 1
//redireccionamos a la pantalla de listo
//echo "insercion lista";
header('location:Sendmail.php');
}

?>