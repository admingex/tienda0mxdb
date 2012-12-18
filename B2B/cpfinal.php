<?php
header("Content-type: text/xml");
$pa=$_REQUEST['items'];
$pa2=$_REQUEST['items2'];
if($pa=='09'){
$pa2s = explode(" ",$pa2,2);
$pa2=$pa2s[1];
}
$pa3=$_REQUEST['items3'];

$host="10.43.29.196";
$usuario="cms_user";
$password="3xp4n5i0n";
$conectar=mysql_connect($host,$usuario,$password);
mysql_select_db("cms0mxdb",$conectar);
$consulta="SELECT * FROM CMS_CatMunicipio WHERE CVE_ESTADO=$pa AND MUNICIPIO='$pa2'";
$query=mysql_query($consulta,$conectar);
while ($reg=mysql_fetch_array($query))
{
$cc=$reg[0];
}
$cc1=$cc;

$consulta2="SELECT  DISTINCT CVE_CIUDAD, CVE_ESTADO, COLONIA, ZIP, LADA FROM CMS_CatCodigoPostal WHERE CVE_MUNICIPIO=$cc1 AND CVE_ESTADO=$pa AND COLONIA='$pa3'";
$query2=mysql_query($consulta2,$conectar);
while ($reg2=mysql_fetch_array($query2))
{
$zip=$reg2['3'];
$lada=$reg2['4'];
}
$items=array($zip,$lada);
echo '<?xml version="1.0" encoding="iso-8859-1"?>';
echo '<items>';
foreach($items as $value)
{
echo'<item>';
echo $value;
echo '</item>';
}
echo '</items>';
?>