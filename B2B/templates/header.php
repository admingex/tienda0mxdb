
<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="utf-8" />
    
    <!--meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/-->    
    <title><?php if (isset($title)) echo $title; else echo "Portal"; ?> - Tienda GEX</title>
	
	<!-- PARA LAS SUBCRIPCIONES MIO -->
	<link href='css/style.css' rel='stylesheet' />
	<link href='css/default.css' rel='stylesheet' />
	<script language="JavaScript" src="js/validaciones.js"></script>
	<script src='js/vemail.js' language='JavaScript'></script>
	<script src='js/funciones.js' language='JavaScript'></script>
	<script src='js/ajax.js' language='JavaScript'></script>
	
	<!-- PARA LOS DATOS -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"> </script>
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"> </script>
	<script type='text/javascript' src='js/botones.js'></script>	

    <!-- aqui empieza ajax-->
    <!--LIMPIAR-->
<script language ="javascript">
function limpiar(seccion){
	/*
if(seccion=='estado'){
document.getElementById('ciudad').options.length = 1;
document.getElementById('colonias').options.length = 1;
document.getElementById('cp').value='';
}
*/
if(seccion=='cp'){
document.getElementById('colonias').options.length = 1;
}
/*
else{
document.getElementById('col').options.length = 1;
document.getElementById('zip').value='';
}
*/
}
</script>
<script language ="javascript">
var products;
var products2;
bE=true;
var XMLHttpRequestObject= false;
if(window.XMLHttpRequest){
XMLHttpRequestObject = new XMLHttpRequest();
}
else
if(window.ActiveXObject){
XMLHttpRequestObject = new ActiveXObject ("MSXML2.XMLHTTP");
}
//PARA MOSTRAR LOS DATOS SEGUN EL ZIP
function getproductos4()
{
var ss=document.getElementById('cp').value;
//alert(ss);
if(XMLHttpRequestObject)
{
XMLHttpRequestObject.open("GET", "datosZip2.php?items="+ss);
XMLHttpRequestObject.onreadystatechange = function()
{
if(XMLHttpRequestObject.readyState==4 &&
XMLHttpRequestObject.status==200){
var xmlDocument = XMLHttpRequestObject.responseXML;
products4=xmlDocument.getElementsByTagName("item");
products5=xmlDocument.getElementsByTagName("item2");
listproducts4();
}
}
XMLHttpRequestObject.send(null);
}
}
function listproducts4()
{
//alert("llego");
var i;
var selectControl=document.getElementById('colonias');
for(i=0; i<products5.length;i++)
{
selectControl.options[i] = new Option(products5[i].firstChild.data)
selectControl.options[i].value =products5[i].firstChild.data
new Option(products5[i].firstChild.data,i)
//alert(products5[i].firstChild.data);
}

document.getElementById('ciudad').value=products4[0].firstChild.data;
document.getElementById('estado').selectedIndex=products4[1].firstChild.data;
document.getElementById('lada').value=products4[2].firstChild.data;

//alert("fin");
}

</script>
</head>
<body>  
    
    <div id="main"><!--div main-->
        <section id="descripcion-proceso">
		
