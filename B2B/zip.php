﻿<html>
<head>
<title>
C.P
</title>
<link href='css/style.css' rel='stylesheet' />
<!--LIMPIAR-->
<script language ="javascript">
function limpiar(seccion){
if(seccion=='est'){
document.getElementById('ciu').options.length = 1;
document.getElementById('col').options.length = 1;
document.getElementById('zip').value='';
}
if(seccion=='zip'){
document.getElementById('col').options.length = 1;
}
else{
document.getElementById('col').options.length = 1;
document.getElementById('zip').value='';
}
}

//validacion de campos para solo numeros 
function ValidaNum(e){
	tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 
    patron =/[0-9\s]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}
</script>
<!--FIN LIMPIAR -->
<!-- aqui empieza ajax-->
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

function getproductos1()
{
var ss=document.getElementById('est').value;
//alert('est'+ss);
if(XMLHttpRequestObject)
{
XMLHttpRequestObject.open("GET", "consultaCiudad.php?items=" +ss);
XMLHttpRequestObject.onreadystatechange = function()
{
if(XMLHttpRequestObject.readyState==4 &&
XMLHttpRequestObject.status==200){
var xmlDocument = XMLHttpRequestObject.responseXML;
products=xmlDocument.getElementsByTagName("item");
listproducts();
}
}
XMLHttpRequestObject.send(null);
}
}


function getproductos2()
{
var ss=document.getElementById('est').value;
//alert(ss);
var es=products[document.getElementById('ciu').selectedIndex].firstChild.data;
//alert(es);

if(XMLHttpRequestObject)
{
XMLHttpRequestObject.open("GET", "consultaColonia.php?items="+ss+"&items2="+es);
XMLHttpRequestObject.onreadystatechange = function()
{
if(XMLHttpRequestObject.readyState==4 &&
XMLHttpRequestObject.status==200){
var xmlDocument = XMLHttpRequestObject.responseXML;
products2=xmlDocument.getElementsByTagName("item");
listproducts2();
}
}
XMLHttpRequestObject.send(null);
}
}


function listproducts()
{
var i;
selectControl=document.getElementById('ciu');
//selectControl.options[0]= new Option(document.getElementById('pais').value;);
for(i=0; i<products.length;i++)
{
selectControl.options[i]= new Option(products[i].firstChild.data)
//new Option(products[i].firstChild.data,i)
}
}

function setproducts()
{
var ss=document.getElementById('ciu').value;
alert(ss);
}



function listproducts2()
{
var i;
var selectControl=document.getElementById('col');
for(i=0; i<products2.length;i++)
{
selectControl.options[i]= new Option(products2[i].firstChild.data)
new Option(products2[i].firstChild.data,i)
//alert(selectControl.options[i]);
}
}


function getproductos3()
{
var ss=document.getElementById('est').value;
//alert(ss);
var es=products[document.getElementById('ciu').selectedIndex].firstChild.data;
//alert(es);
var ci=products2[document.getElementById('col').selectedIndex].firstChild.data;
//alert(ci);
if(XMLHttpRequestObject)
{
XMLHttpRequestObject.open("GET", "cpfinal.php?items="+ss+"&items2="+es+"&items3="+ci);
XMLHttpRequestObject.onreadystatechange = function()
{
if(XMLHttpRequestObject.readyState==4 &&
XMLHttpRequestObject.status==200){
var xmlDocument = XMLHttpRequestObject.responseXML;
products3=xmlDocument.getElementsByTagName("item");
listproducts3();
}
}
XMLHttpRequestObject.send(null);
}
}

function listproducts3()
{
//alert(products3[0].firstChild.data);
//alert(products3[1].firstChild.data);
document.tblupdate.carlos.value=products3[1].firstChild.data;
document.tblupdate.zip.value=products3[0].firstChild.data;

//alert(products[0].firstChild.data);
}

//PARA MOSTRAR LOS DATOS SEGUN EL ZIP
function getproductos4()
{
var ss=document.getElementById('zip').value;
//alert(ss);
if(XMLHttpRequestObject)
{
XMLHttpRequestObject.open("GET", "datosZip.php?items="+ss);
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
var selectControl=document.getElementById('col');
for(i=0; i<products5.length;i++)
{
selectControl.options[i]= new Option(products5[i].firstChild.data)
new Option(products5[i].firstChild.data,i)
//alert(selectControl.options[i]);
}
document.getElementById('ciu').options[0]=new Option(products4[0].firstChild.data);
document.getElementById('est').selectedIndex=products4[1].firstChild.data;
document.getElementById('carlos').value=products4[2].firstChild.data;
}

</script>
<!--FIN DE AJAX-->

</head>
<body bgcolor="#FFFFFF" leftmargin="5" topmargin="5" marginwidth="2" marginheight="2">

<form action="" method="post" name="tblupdate" id="tblupdate">
<input type="hidden" name="carlos" id="carlos" value="" />


<p class="instrucciones-paso">En base al c&oacute;digo postal proporcionado, 
  se recuperar&aacute; su Estado, Ciudad y posibles Colonias. de confirmar 
  la informaci&oacute;n y dar <i>Aceptar</i>.<br>
</p>  
<p class="label_izq">C.P.: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="zip" id="zip" value='' onblur="limpiar(this.id),getproductos4()" size="7"  onkeypress="return ValidaNum(event)" class="text-short" />&nbsp; 
<a href="#" style="color:#BC1010;" >&gt;&gt;</a> </p> 


<!-- ***************** ESTADO *******************-->
<table>
	<tr>
		<td class="label_izq">
			Estado:
		</td>
		<td>
			<div class="styled-select">
				<div class='cont-select'>
			<select name="est" id="est" tabindex="16" class="styled"  onChange="limpiar(this.id),getproductos1()">
			<option value=''>(seleccione una opción)</option>
			
			<script language="php">
			mysql_connect ("10.43.29.196","cms_user","3xp4n5i0n");
			@mysql_query("SET NAMES 'utf8'");
			$consulta=mysql_db_query("cms0mxdb","select * from CMS_CatEstado");
			while($arreglo=mysql_fetch_array($consulta))
			{
			echo "<option value=$arreglo[CVE_ESTADO]>$arreglo[ESTADO] </option>";
			}
			mysql_close();
			</script>
			      
			</select>
			</div>
			</div>
		</td>
	</tr>

<!-- ***************** CIUDAD *******************-->	
<tr>
	<td class="label_izq">
		Ciudad
	</td>
	<td>
		<div class="styled-select">
			<div class='cont-select'>
		  <select name="ciu" id="ciu" tabindex="17" onchange="limpiar(this.id),getproductos2()" class="styled">
			<option value="0">(seleccione una opción)</option>
			</select>
			</div>
		</div>
	</td>
</tr>
	  
<!-- ***************** COLONIA *******************-->
<tr>
	<td class="label_izq">
		Colonia
	</td>
	<td>
		<div class="styled-select">
			<div class='cont-select'>
		  <select name="col" id="col" tabindex="5" onchange="getproductos3()" class="styled">
			<option value=''>(seleccione una opción)</option>
			      
			    </select>
			    </div>
		</div>
	</td>
</tr>
<tr>
	<td style="padding-top: 15px;">
		 <input type="button" class="bn_aceptar" value=' Aceptar '
	onclick="
window.opener.document.frmcaja.colonia.value = document.tblupdate.col.value ,
window.opener.document.frmcaja.cp.value = document.tblupdate.zip.value,
window.opener.document.frmcaja.lada.value = document.tblupdate.carlos.value,
window.opener.document.frmcaja.ciudad.value = document.tblupdate.ciu.value,
window.opener.document.frmcaja.estado.selectedIndex = document.tblupdate.est.value,
window.opener.document.frmcaja.colonias.options[0].value = document.tblupdate.col.value,
window.opener.document.frmcaja.colonias.options[0].text = document.tblupdate.col.value,
window.close()
;"
	 name="button1" id="button1">
	</td>
	<td style="padding-top: 15px;">
		<input type="button" class="bn_cancelar" value='Cancelar' onclick="window.close()" >
	</td>
</tr>

</table>
  <p class="instrucciones-paso" ><b>*</b> En caso de tener dificultades, comuníquese 
    al (55)9177-4342 o escriba a <a href="mailto:servicioaclientes@expansion.com.mx">servicioaclientes@expansion.com.mx</a></form>
    
</body> 
</html>