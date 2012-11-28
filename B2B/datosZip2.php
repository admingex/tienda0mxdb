<?php
header("Content-type: text/xml");
$pa=$_REQUEST['items'];
$i=0;


$host="10.43.29.196";
$usuario="cms_user";
$password="3xp4n5i0n";
$conectar=mysql_connect($host,$usuario,$password);
mysql_select_db("cms0mxdb",$conectar);

$consulta="SELECT DISTINCT
    CMS_CatEstado.CVE_ESTADO as clave_estado,
    CMS_CatEstado.ESTADO as estado,
    CMS_CatCodigoPostal.ZIP as codigo_postal,
    CMS_CatCodigoPostal.COLONIA AS colonia,
    CMS_CatCodigoPostal.CVE_MUNICIPIO AS cve_municipio,
    CMS_CatCodigoPostal.ZIP AS zip,
    CMS_CatCodigoPostal.LADA AS lada,

    CMS_CatMunicipio.CVE_MUNICIPIO AS cve_m,
    CMS_CatMunicipio.CVE_ESTADO AS cve_em,
    CMS_CatMunicipio.MUNICIPIO AS municipio

FROM    CMS_CatCodigoPostal
    JOIN CMS_CatEstado ON CMS_CatEstado.cve_estado = CMS_CatCodigoPostal.cve_estado
    JOIN CMS_CatMunicipio ON CMS_CatMunicipio.CVE_MUNICIPIO = CMS_CatCodigoPostal.CVE_MUNICIPIO
WHERE
    CMS_CatMunicipio.CVE_ESTADO=CMS_CatEstado.CVE_ESTADO AND
    CMS_CatCodigoPostal.ZIP = $pa";
	
	
$query=mysql_query($consulta,$conectar);
while ($reg=mysql_fetch_array($query))
{
$c1=$reg[9];//ciudad
$c2=$reg[6];//lada
$c3=$reg[0];//clave estado
$c4=$reg[3];//colonias
$items2[$i]=$c4;
$i++;
}
$lada=$c2;
$estado=$c3;
if($estado=='09'){
$ciudad="MEXICO ".$c1;
}
else{
$ciudad=$c1;
}
$items=array($ciudad,$estado,$lada);
echo '<?xml version="1.0" encoding="iso-8859-1"?>';
echo '<items>';
foreach($items as $value)
{
echo'<item>';
echo $value;
echo '</item>';
}
//seccion dos

foreach($items2 as $value2)
{
echo'<item2>';
echo $value2;
echo '</item2>';
}
echo '</items>';
?>