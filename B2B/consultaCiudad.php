<?php
header("Content-type: text/xml");
$pa=$_REQUEST['items'];
$i=1;
$items[0]="Seleccione";
$host="10.43.29.196";
$usuario="cms_user";
$password="3xp4n5i0n";
$conectar=mysql_connect($host,$usuario,$password);
mysql_select_db("cms0mxdb",$conectar);
$consulta="SELECT * FROM CMS_CatMunicipio WHERE CVE_ESTADO=$pa AND CVE_MUNICIPIO !=0 ORDER BY MUNICIPIO";
$query=mysql_query($consulta,$conectar);
while ($reg=mysql_fetch_array($query))
{
$e=$reg[2];
$items[$i]=$e;
$i++;
}
echo '<?xml version="1.0" encoding="iso-8859-1"?>';
echo '<items>';
foreach($items as $value)
{
echo'<item>';
if($pa=='09'){//solo si es D.F
echo "MEXICO ".$value;
}
else{
echo $value;
}
echo '</item>';
}
echo '</items>';

?>