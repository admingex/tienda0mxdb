<?php
require_once dirname(__FILE__). "/../libs/adodb/adodb.inc.php";
require_once dirname(__FILE__). "/database_confdos.php";
function getDBdos(){
static $dbdos;

if(!isset($dbdos)){
$dbdos= ADONewConnection(DATABASE_DRIVER_DOS);
$dbdos-> Connect(DATABASE_HOST_DOS, DATABASE_USER_DOS, DATABASE_PASSWD_DOS, DATABASE_NAME_DOS);
$dbdos-> Execute("SET NAMES 'utf8'");
//$db-> debug = true;
}
return $dbdos;
}
?>