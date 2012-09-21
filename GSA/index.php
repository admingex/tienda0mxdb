<?php
session_start();
if(isset($_SESSION['login']))
{
	header('location: home.php');
}
else{
	header('location: login.php');
}

?>