<?php
require_once dirname(__FILE__). "/../libs/adodb/adodb.inc.php";
require_once dirname(__FILE__). "/database_conf.php";
function getDB(){
static $db;

if(!isset($db)){
$db= ADONewConnection(DATABASE_DRIVER);
$db-> Connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWD, DATABASE_NAME);
$db-> Execute("SET NAMES 'utf8'");
//$db-> debug = true;
}
return $db;
}
?>