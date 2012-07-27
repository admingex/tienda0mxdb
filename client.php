<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once "SOAP/Client.php"; 

// SOAP/WSDL 
$sw = new SOAP_WSDL ("http://localhost/interfase_cctc/server.php?wsdl"); 

// Proxy-Obj. 
$proxy = $sw->getProxy (); 

// servicemthod 
$erg = $proxy->now("H:i:s"); 

// return 
print $erg."\n"; 

?>