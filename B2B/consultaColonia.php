<?php
header("Content-type: text/xml");
$pa=$_REQUEST['items'];
$pa2=$_REQUEST['items2'];
if($pa=='09'){
$pa2s = explode(" ",$pa2,2);
$pa2=$pa2s[1];
}
$i=1;
$items[0]="Selecciona";
$host="10.177.73.120";
$usuario="ecommerce_user";
$password="ecommerce";
$conectar=mysql_connect($host,$usuario,$password);
mysql_select_db("cms0mxdb",$conectar);
$consulta="SELECT * FROM CMS_CatMunicipio WHERE CVE_ESTADO=$pa AND MUNICIPIO='$pa2'";
$query=mysql_query($consulta,$conectar);
while ($reg=mysql_fetch_array($query))
{
$cc=$reg[0];
}
$cc1=$cc;

$consulta2="SELECT  DISTINCT CVE_CIUDAD, CVE_ESTADO, COLONIA FROM CMS_CatCodigoPostal WHERE CVE_MUNICIPIO=$cc1 AND CVE_ESTADO=$pa ORDER BY COLONIA";
$query2=mysql_query($consulta2,$conectar);
while ($reg2=mysql_fetch_array($query2))
{
$e=$reg2[2];
$items[$i]=$e;
$i++;
}
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