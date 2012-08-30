<?php
    require('./templates/header.php');
?>
		<div class="titulo-proceso">
		Suscripción gratuita para lectores calificados en M&eacute;xico.	
		</div>
		<br>
		<p class="label_izq">Con el fin de ofrecerle un servicio eficiente, rápido y seguro, es muy importante que proporcione correctamente sus datos. 
			SuscribeteHoy le garantiza absoluta confidencialidad en la información proporcionada.</p>
		</section>
		<div id="pleca-punteada"></div>
		<section class="contenedor">	
		<div class="contenedor-gris">
		
<form ACTION="ointeriores_nuevo_paso.php" name=frmcaja METHOD="post" onSubmit="return checkFieldSiete(this)">
<table width="100%">
	<tr>
      <td colspan="2" class="instrucciones">
       Paso 2 de 2 <br>Conteste completamente el siguiente cuestionario:
	  </td>
    </tr>
	

<!-- 2 -->
<tr>
      <td class="label_izq" colspan="2">
       1. Indique el rango de edad en que se encuentra:</td>
    </tr>
    <tr>
      <td colspan="2">
        <select name="edad" id="edad" > 
          <option value="A	25-29">25-29 </option>          
          <option value="B	30-34">30-34</option>          
          <option value="C	35-39">35-39</option>          
          <option value="D	40-44">40-44</option>          
          <option value="E	45-49">45-49</option>          
		  <option value="F	50 a mas">50 a mas</option>          
        </select>
	  </td>
  </tr>
<!-- 3 -->
<tr>
      <td class="label_izq" colspan="2">
        2. Indique su sexo:</td>
    </tr>
    
    <tr>
      <td class="label_izq">
		<input type="radio" value="Femenino" name="sexo1" id="sexo1"  checked="checked" />
		  <div id="radio_femenino" class="radio_selected">&nbsp;					
		</div>	Femenino
	  </td>
	  
	  <td class="label_izq">
		<input type="radio" value="Masculino" name="sexo2" id="sexo2" />
		  <div id="radio_masculino" class="radio_no_selected">&nbsp;					
		</div>	
		Masculino
      </td>
  </tr>
<!-- 4 -->
<tr>
      <td class="label_izq" colspan="2"> 
        3. Por favor indique su profesi&oacute;n:</td>
    </tr>
    <tr>
      <td  colspan="2" class="label_izq" >
        <select name="trabaja_como" onChange="validaInter(this)">
          <option value="A	Arquitecto">Arquitecto </option>          
          <option value="B	Arquitecto paisajista">Arquitecto paisajista</option>          
          <option value="C	Decorador">Decorador</option>          
          <option value="D	Diseñador Industrial">Diseñador Industrial</option>          
          <option value="E	Urbanista">Urbanista</option>          
		  <option value="F  Ingenieria">Ingenier&iacute;a</option>          
		  <option value="G">Otro (especifique)</option>          
        </select>
	  </td>
  </tr>
      <tr>
      <td class="label_izq" colspan="2">
        <input type="radio" value="20." name="trabaja_comorad" id="trabaja_comorad"  />
        <div id="trabaja_comodiv" class="radio_no_selected">&nbsp;					
		</div>	
        Otro (describa):
        <input type="text" name="trabaja_comotxt" id="trabaja_comotxt" class="text" size="15" maxlength="64" value=""  disabled></td>
    </tr>
<!-- 5 -->
<tr>
      <td class="label_izq" colspan="2">
        4. Indique en que tipolog&iacute;a se especializa:</td>
    </tr>
    <tr>
      <td  colspan="2"   class="label_izq">
        <select name="construye" onChange="validaInter(this)">
          <option value="A	Residencial">Residencial </option>          
          <option value="B	Corporativo">Corporativo</option>          
          <option value="C	Comercial">Comercial</option>          
          <option value="D	Servicios (Restaurantes y Bares)">Servicios (Restaurantes y Bares)</option>          
          <option value="E	Salud">Salud</option>          
		  <option value="F	Restauraci�n">Restauraci&oacute;n</option>          
		  <option value="G	Educaci�n, Cultura">Educaci&oacute;n, Cultura</option>          
		  <option value="H	Turismo (Hospitality)">Turismo (Hospitality)</option>          
		  <option value="I	Gobierno">Gobierno</option>          
		  <option value="J">Otro (especifique)</option>          
		 </select>
	  </td>
  </tr>
  
      <tr>
      <td class="label_izq" colspan="2" >
        <input type="radio" value="20." name="construyerad" id="construyerad"  />
         <div id="construyediv" class="radio_no_selected">&nbsp;					
		</div>	
        Otro (describa):
        <input type="text" name="construyetxt" size="15" maxlength="64"  disabled></td>
    </tr>

<!-- 6 -->
    <tr>
      <td colspan="2" class="label_izq"> 
 5. Marque la opci&oacute;n que mejor describa su &aacute;rea (observe los cargos que incluye cada opci&oacute;n):</td>
    </tr>
    <tr>
      <td colspan="2" class="label_izq">
        <select name="cargo" onChange="validaInter(this)">
          <option value="A	Direcci�n General (Propietario, Presidente, Vicepresidente, Director General, Director)">Direcci&oacute;n General (Propietario, Presidente, Vicepresidente, Director General, Director)</option>
          <option value="B	Gerencial (Gerente General, Gerente, Gerente de área,Gerente de Diseño,Jefatura)">Gerencial (Gerente General, Gerente, Gerente de &Aacute;rea,Gerente de Diseño,Jefatura)</option>
          <option value="C	Comercial (Director/Gerente Comercial, Compras, Adquisiciones, Especificador, Suministros)">Comercial (Director/Gerente Comercial, Compras, Adquisiciones, Especificador, Suministros)</option>
          <option value="D	Acad�mico, Investigador (Director/Coordinador de carrera, Investigación y Desarrollo)">Acad&eacute;mico, Investigador (Director/Coordinador de carrera, Investigaci&oacute;n y Desarrollo)</option>
		  <option value="E">Otro, especifique por favor</option>
        </select>
	</td>
    </tr>
      <tr>
       <td class="label_izq" colspan="2">
        <input type="radio" value="20." name="cargorad" id="cargorad"  />
        <div id="cargodiv" class="radio_no_selected">&nbsp;					
		</div>	
        Otro (describa):
        <input type="text" name="cargotxt" id="cargotxt" size="15" maxlength="64" disabled></td>
    </tr>

<!-- 7 -->
<tr>
      <td  class="label_izq" colspan="2"> 
       6. Principal actividad de su empresa:</td>
    </tr>
    <tr>
      <td colspan="2"  class="label_izq">
        <select name="actividad" onChange="validaInter(this)">
          <option value="A	Fabricante">Fabricante </option>          
          <option value="B	Distribuidor">Distribuidor</option>          
          <option value="C	Construcci�n">Construcci&oacute;n</option>          
          <option value="D	Prestador de Servicios">Prestador de Servicios</option>          
          <option value="E">Otro (especifique)</option>
        </select>
	  </td>
  </tr>
      <tr>
      <td colspan="2" class="label_izq">
        <input type="radio" value="20." name="actividadrad" id="actividadrad"  />
        <div id="actividaddiv" class="radio_no_selected">&nbsp;					
		</div>	
        Otro (describa):
        <input type="text" name="actividadtxt" size="15" maxlength="64" 
              disabled></td>
    </tr>
<!-- 8 -->    
	<tr>
      <td  class="label_izq" colspan="2">
       7. Su empresa se especializa en: </td>
    </tr>

    <tr>
      <td colspan="2" class="label_izq">
        <select name="ramo" onChange="validaInter(this)">
          <option value="1	Acabados en pisos">Acabados en pisos</option>
          <option value="2	Acabados en muro">Acabados en muro</option>
          <option value="3	Iluminaci�n y accesorios">Iluminaci&oacute;n y accesorios</option>
          <option value="4	Baños y Cocinas">Baños y Cocinas</option>
          <option value="5	Aire acondicionado y calefacci�n">Aire acondicionado y calefacci&oacute;n</option>
          <option value="6	Instalaciones especiales (aplicaciones)">Instalaciones especiales (aplicaciones)</option>
          <option value="7	Instalaciones (Hidr�ulicas, Hidrosanitarias, Dom�tica)">Instalaciones (Hidr&aacute;ulicas, Hidrosanitarias, Dom&oacute;tica)</option>
          <option value="8	Mobiliario y equipo de oficina">Mobiliario y equipo de oficina</option>
          <option value="9	Mobiliario residencial">Mobiliario residencial</option>
          <option value="10	Mantenimiento">Mantenimiento</option>
		  <option value="11	Puertas y ventanas">Puertas y ventanas</option>
		  <option value="12	Investigaci�n y desarrollo">Investigaci&oacute;n y desarrollo</option>
		  <option value="E">Otro (especifique)</option>
        </select>
	</td>
    </tr>

    <tr>
       <td colspan="2" class="label_izq">
        <input type="radio" value="20." name="ramorad"   />
        <div id="ramodiv" class="radio_no_selected">&nbsp;					
		</div>	
        Otro (describa):        
        <input type="text" name="ramotxt" size="15" maxlength="64" disabled></td>
    </tr>

<!-- 9 -->
   <tr>
      <td class="label_izq" colspan="2">8. 
        Indique su participaci&oacute;n dentro de la empresa en el proceso de compra</td>
    </tr>
    <tr>
      <td colspan="2"  class="label_izq">
        <select size="1" name="decision" >
          <option value="A. Toma de Decision Final">Toma de Decisi&oacute;n 
          Final</option>
          <option value="B. Comparte Decision Final">Comparte Decisi&oacute;n 
          Final</option>
          <option value="C. Evalua Productos y Proveedores">Eval&uacute;a 
          Productos y Proveedores</option>
          <option value="D. Recomienda Productos y Proveedores">Recomienda Productos 
          y Proveedores</option>
          <option value="E. Desarrolla Especificaciones">Desarrolla Especificaciones</option>
          <option value="F. No Se Involucra">No Se Involucra</option>
        </select></td>
    </tr>
<!-- 10 -->
    <tr>
      <td colspan="2" class="label_izq"> 
        9. ¿Cu&aacute;ntos metros cuadrados ha desarrollado en un año?</td>
    </tr>
   <tr>
      <td  colspan="2" class="label_izq">
		<input type="text" name="med" size="15" maxlength="64" class="text"/></td>
	</td>
    </tr>

<!-- 11 -->
    <tr>
      <td colspan="2" class="label_izq"> 
      10. ¿Cu&aacute;l es el monto aproximado que su empresa factura al año?</td>
    </tr>
   <tr>
      <td colspan="2" class="label_izq">
		<input type="text" name="proyecto" size="15" maxlength="64" class="text" /></td>
	</td>
    </tr>

<!-- 12 -->
    <tr>
      <td class="label_izq" colspan="2"> 
      11. Mencione las Exposiciones/Ferias a las que ha asistido en el &uacute;ltimo año</td>
    </tr>
   <tr>
      <td colspan="2" class="label_izq">
		<input type="text" name="expo12m" size="60" maxlength="200"class="text" /></td>
	</td>
    </tr>
<!--  -->
    <tr>
      <td  colspan="2" class="label_izq"> 
        12. Para procesar su solicitud, es necesario nos indique el mes de su nacimiento:</td>
    </tr>
    <tr>
      <td colspan="2" class="label_izq">
        <input type="text" name="mes" size="16" maxlength="16" class="text" /></td>
    </tr>

	<!---->
	    <tr>
      <td colspan="2" class="instrucciones">
        Los editores se reservan el derecho de incluir en la<br>
        lista de circulacion solo a suscriptores calificados</td>
    </tr>
<input type="hidden" name="paso" id="paso" value="2" />
    <tr>
      <td colspan="2" >
        <input class="crear_cuenta" TYPE="submit" VALUE="" id=submit1 name=submit1>
        <input type="reset" value="Limpiar" id=reset1 name=reset1></td>
		
    </tr>
    <tr>
      <td colspan="2" class="label">
      	<sup class="tilde">*</sup>Campos
      	Requeridos</td>
    </tr>
  </table>
  </form>
<?php
    require('templates/footer.php');
?>

