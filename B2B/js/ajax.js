//ajax
function xajaz()
{
var ss=document.getElementById('cp').value;
alert(ss);
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
alert("JAS");
}
}
XMLHttpRequestObject.send(null);
}
alert("fuera if");
}
function listproducts4()
{
alert("llego");
/*var i;
var selectControl=document.getElementById('col');
for(i=0; i<products5.length;i++)
{
selectControl.options[i]= new Option(products5[i].firstChild.data)
new Option(products5[i].firstChild.data,i)
//alert(selectControl.options[i]);
}*/
document.getElementById('ciudad').options[0]=new Option(products4[0].firstChild.data);
document.getElementById('estado').selectedIndex=products4[1].firstChild.data;//id estado
document.getElementById('lada').value=products4[2].firstChild.data;//lada
}