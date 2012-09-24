<?php
session_start();
$nombre=$_REQUEST['email'];
$pass=$_REQUEST['pass'];

if($nombre=='clopez' && $pass=='clopez'){
	session_register('login');	
	$_SESSION['login']=$nombre;	
	header("location:home.php");
}
else {
	header("location:login.php");
}
?>