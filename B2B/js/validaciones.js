//validacion de espacios en blanco
function checkFields(forma)
	{ 

	if (forma.nombre.value=="") { alert('Ingrese su nombre'); return false; }
		if (forma.paterno.value=="") { alert('Ingrese su apellido '); return false; }
		if (forma.empresa.value=="") { alert('Ingrese su empresa '); return false; }
		if (forma.puesto.value=="") { alert('Ingrese su cargo '); return false; }
		if (forma.departamento.value=="") { alert('Ingrese su departamento '); return false; }
		if (forma.direccion.value=="") { alert('Ingrese su calle '); return false; }
		if (forma.numero.value=="") { alert('Ingrese su numero '); return false; }
		if (forma.cp.value=="") { alert('Ingrese su codigo postal '); return false; }
		if (forma.estado.value=="") { alert('Seleccione su estado '); return false; }
		//if (forma.colonia.value=="") { alert('Ingrese su colonia '); return false; }
		if (forma.ciudad.value=="") { alert('Ingrese su ciudad '); return false; }
		if (forma.colonias.value=="0") { alert('Seleccione su colonia'); return false; }
		if (forma.lada.value=="") { alert('Ingrese su lada '); return false; }
		if (forma.telefono.value=="") { alert('Ingrese su telefono '); return false; }
		if (forma.email.value=="") { alert('Ingrese su correo electronico '); return false; }
		

	}
//validacion de campos para solo numeros 
function ValidaNum(e){
	tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 
    patron =/[0-9\s]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}
//validacion correo
function checarCorreo(correo) {
	var email =correo;
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email.value)) {
		alert("correo electronico no valido");
		return false;
	}
}
function checkPasodos(forma)
{
if(forma.actividadrad.status && forma.actividadtxt.value=="") {alert('Especifique su nivel jerarquico '); return false; }
       	if(forma.actividad.value=="J" && forma.actividadtxt.value=="") {alert('Especifique su nivel jerarquico '); return false; }		
	if(forma.cargorad.status && forma.cargotxt.value=="") {alert('Especifique su nivel area '); return false; }
       	if(forma.cargo.value=="K" && forma.cargotxt.value=="") {alert('Especifique su area '); return false; }		
	if(forma.ramorad.status && forma.ramotxt.value=="") {alert('Especifique su ramo '); return false; }
       if(forma.ramo.value=="Z" && forma.ramotxt.value=="") {alert('Especifique su ramo '); return false; }		
    if (forma.mes.value=="") { alert('Responda la pregunta de verificacion '); return false; }
}
function validaOtro(campo){
	
	if (campo.name=="actividad") {
		if (campo.value=="J") {
			document.frmcaja.actividadrad.checked= true;
			document.frmcaja.actividadtxt.disabled = false;
            document.frmcaja.actividadrad.readonly=false;
			document.getElementById('divtipo_inicio2').className="radio_selected";
		}else{
			document.frmcaja.actividadrad.checked= false;
			document.frmcaja.actividadtxt.disabled = true;
			document.frmcaja.actividadtxt.text = "";
            document.frmcaja.actividadrad.readonly=true;
			document.getElementById('divtipo_inicio2').className="radio_no_selected";
		}
	}

	if (campo.name=="cargo") {
		if (campo.value=="K") {
			document.frmcaja.cargorad.checked= true;
			document.frmcaja.cargotxt.disabled = false;
			document.getElementById('divtipo_inicio3').className="radio_selected";
		}else{
			document.frmcaja.cargorad.checked= false;
			document.frmcaja.cargotxt.disabled = true;
			document.frmcaja.cargotxt.text = "";
			document.getElementById('divtipo_inicio3').className="radio_no_selected";
		}
	}

	if (campo.name=="ramo") {
		if (campo.value=="Z") {
			document.frmcaja.ramorad.checked= true;
			document.frmcaja.ramotxt.disabled = false;
			document.getElementById('divtipo_inicio4').className="radio_selected";
		}else{
			document.frmcaja.ramorad.checked= false;
			document.frmcaja.ramotxt.disabled = true;
			document.frmcaja.ramotxt.text = "";
			document.getElementById('divtipo_inicio4').className="radio_no_selected";
		}
	}

}
//validacion de espacios en blanco
function checkFieldsTres(forma)
	{ 
	if (forma.cliente.value=="") { alert('Ingrese su numero de cliente'); return false; }
	if (forma.nombre.value=="") { alert('Ingrese su nombre'); return false; }
		if (forma.paterno.value=="") { alert('Ingrese su apellido '); return false; }
		if (forma.empresa.value=="") { alert('Ingrese su empresa '); return false; }
		if (forma.puesto.value=="") { alert('Ingrese su cargo '); return false; }
		if (forma.departamento.value=="") { alert('Ingrese su departamento '); return false; }
		if (forma.direccion.value=="") { alert('Ingrese su calle '); return false; }
		if (forma.numero.value=="") { alert('Ingrese su numero '); return false; }
		if (forma.cp.value=="") { alert('Ingrese su codigo postal '); return false; }
		if (forma.colonia.value=="") { alert('Ingrese su colonia '); return false; }
		if (forma.ciudad.value=="") { alert('Ingrese su ciudad '); return false; }
		if (forma.estado.value=="") { alert('Ingrese su estado '); return false; }
		if (forma.lada.value=="") { alert('Ingrese su lada '); return false; }
		if (forma.telefono.value=="") { alert('Ingrese su telefono '); return false; }
		if (forma.email.value=="") { alert('Ingrese su correo electronico '); return false; }
		
		return false;
	}
	
	//para gia de compras paso dos 
function checkFields_GC(forma)
	{ 	    
	   if(forma.mar.value=="") {alert('Especifique las marcas'); return false; }		
       if(forma.mat.value=="") {alert('Especifique los materiales'); return false; }
       if(forma.mes.value=="") { alert('Responda la pregunta de verificaci�n '); return false; }
	 return true;
	}
	
	
	function checkFieldsSEIS(forma)
	{ 
		

	   if (forma.mes.value=="") { alert('Responda la pregunta de verificacion '); return false; }

	 return true;
	}
	
		
	function checkFieldSiete(forma)
	{ 
		
		 if (forma.med.value=="") { alert('Responda la pregunta 9'); return false; }
		  if (forma.proyecto.value=="") { alert('Responda la pregunta 10 '); return false; }
		   if (forma.expo12m.value=="") { alert('Responda la pregunta 11'); return false; }
	   if (forma.mes.value=="") { alert('Responda la pregunta de verificacion '); return false; }

	 return true;
	}
	
function construyeOtro(cons)
{
	if(cons.value=='J'){
		document.frmcaja.construyetxt.disabled = false;
	}
	else{
		document.frmcaja.construyetxt.disabled = true;
	}
}


//para interiores paso 2
function validaInter(campo){
	
	if (campo.name=="trabaja_como") {
		if (campo.value=="G") {
			document.frmcaja.trabaja_comorad.checked= true;
			document.frmcaja.trabaja_comotxt.disabled = false;
            document.getElementById('trabaja_comodiv').className="radio_selected";
		}else{
			document.frmcaja.trabaja_comorad.checked= false;
			document.frmcaja.trabaja_comotxt.disabled = true;
			document.frmcaja.trabaja_comotxt.text = "";
           
			document.getElementById('trabaja_comorad').className="radio_no_selected";
		}
	}


	if (campo.name=="construye") {
		if (campo.value=="J") {
			document.frmcaja.construyerad.checked= true;
			document.frmcaja.construyetxt.disabled = false;
			document.getElementById('construyediv').className="radio_selected";
		}else{
			document.frmcaja.construyerad.checked= false;
			document.frmcaja.construyetxt.disabled = true;
			document.frmcaja.construyetxt.text = "";
			document.getElementById('construyediv').className="radio_no_selected";
		}
	}

	if (campo.name=="cargo") {
		if (campo.value=="E") {
			document.frmcaja.cargorad.checked= true;
			document.frmcaja.cargotxt.disabled = false;
			document.getElementById('cargodiv').className="radio_selected";
		}else{
			document.frmcaja.cargorad.checked= false;
			document.frmcaja.cargotxt.disabled = true;
			document.frmcaja.cargotxt.text = "";
			document.getElementById('cargodiv').className="radio_no_selected";
		}
	}
	
	if (campo.name=="actividad") {
		if (campo.value=="E") {
			document.frmcaja.actividadrad.checked= true;
			document.frmcaja.actividadtxt.disabled = false;
			document.getElementById('actividaddiv').className="radio_selected";
		}else{
			document.frmcaja.actividadrad.checked= false;
			document.frmcaja.actividadtxt.disabled = true;
			document.frmcaja.actividadtxt.text = "";
			document.getElementById('actividaddiv').className="radio_no_selected";
		}
	}
	
		if (campo.name=="ramo") {
		if (campo.value=="E") {
			document.frmcaja.ramorad.checked= true;
			document.frmcaja.ramotxt.disabled = false;
			document.getElementById('ramodiv').className="radio_selected";
		}else{
			document.frmcaja.ramorad.checked= false;
			document.frmcaja.ramotxt.disabled = true;
			document.frmcaja.ramotxt.text = "";
			document.getElementById('ramodiv').className="radio_no_selected";
		}
	}
}