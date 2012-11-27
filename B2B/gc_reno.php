<?php
    require('./templates/header.php');
?>
		<div class="titulo-proceso">
		Renovaci&oacute;n gratuita para lectores calificados en M&eacute;xico.	
		</div>
		<p style="margin-left: 25px;">Con el fin de ofrecerle un servicio eficiente, rápido y seguro, es muy importante que proporcione 
			correctamente sus datos. Kiosco le garantiza absoluta confidencialidad en la información proporcionada.</p>
		</section>
		<div id="pleca-punteada"></div>
		<section class="contenedor">	
		
		
<form ACTION="gc_reno_paso.php" name=frmcaja METHOD="post" onSubmit="return checkFieldsTres(this)">
<table width="100%">
<tr>
      <td colspan="2" class="instrucciones">
       Datos personales <span class="indicador">1/2</span>
	  </td>
</tr>
      
<tr>
<td colspan="2" CLASS="instrucciones-paso">
			Instrucciones para renovar su suscripci&oacute;n:<br />
        	<b>A.</b> Si usted ya recibe Gu&iacute;a de Compras  gratuitamente por favor
        	vea la etiqueta de correo de su &uacute;ltimo ejemplar y 
        	proporcione los 7 d&iacute;gitos de su n&uacute;mero de cliente.<br>
        	<b>B.</b> El n&uacute;mero de cliente aparece en la parte superior izquierda de su etiqueta de correo como a<br>
        	continuaci&oacute;n se indica.<br>
        	<img border="0" src="images/etiqueta.gif" align="center"><br>
        	<b>C.</b> En este ejemplo el número de cliente es:<b><br>
        	8081838</b>.
        </td>
</tr>

<tr>
  	<td width="250px;">&nbsp;</td>
   <td class="label_izq">
          <input type="radio"  name="autorizar" value='S' checked >
		  		  <div id="divtipo_inicio2" class="radio_selected">&nbsp;					
		  </div>
          Renovar mi suscripci&oacute;n a la revista Guía de compras
      </td>
 </tr>
	
	<tr>
      <td class="label">
        <sup class="tilde">*</sup>N&uacute;mero
        de Cliente:</td>
      <td >
        <input type="text" name="cliente" size="5" maxlength="8" 
             class="text-short" onkeypress="return ValidaNum(event)"></td>
    </tr>
    
<tr>
<td class="label">
        <sup class="tilde">*</sup>Nombre:
</td>

      <td>
        <input type="text" name="nombre" size="30" maxlength="15" 
              class="text-long" /></td>
</tr>

<tr>
      <td class="label"><sup class="tilde">*</sup>
	  A. Paterno:
	  </td>
     <td>
        <input type="text" class="text-long" name="paterno" size="30" maxlength="32" value="" />
	</td>
    </tr>
	
    <tr>
      <td class="label">&nbsp;A. Materno:</td>
      <td>
        <input type="text" class="text-long" name="materno" size="30" maxlength="32" value="" /></td>
    </tr>

      
    <tr>
      <td class="label">
        <sup class="tilde">*</sup>Empresa:</td>
      <td>
        <input type="text" class="text-long" name="empresa" size="30" maxlength="80" value="" /></td>
    </tr>
	
    <tr>
      <td class="label">
        <sup class="tilde">*</sup>Cargo:</td>
      <td>
        <input type="text" class="text-long" name="puesto" size="30" maxlength="40" value="" /></td>
    </tr>
	<tr>
      <td class="label">
       <sup class="tilde">*</sup>
	   Departamento:</td>
      <td >
        <input type="text" class="text-long" name="departamento" size="30" maxlength="40" value="" /></td>
    </tr>
    <tr>
      <td class="label"> 
        <sup class="tilde">*</sup>Calle:</td>
      <td>
        <input type="text" class="text-long" name="direccion" size="30" maxlength="74" value="" /></td>
    </tr>
	
	  <tr>
      <td class="label"> 
        <sup class="tilde">*</sup>Número:</td>
      <td>
        <input type="text" class="text-short" name="numero" size="5" maxlength="10" value="" /></td>
    </tr>
	
	 <tr>
      <td class="label">
        Entre:</td>
      <td>
        <input type="text" class="text-long" name="entre" size="30" maxlength="64" value="" /></td>
    </tr>
	
	
	<tr>
	<td colspan="2" class="label">
	En México: con base al c&oacute;digo postal proporcionado, se recuperar&aacute; 
        su Estado, Ciudad y posibles Colonias.
		 
	</td>
	</tr>
	
	 <tr>
      <td class="label">
        <sup class="tilde">*</sup>C.P.:
		</td>
      <td>
      
        <input type="text" class="text-short" name="cp" id="cp" size="5" maxlength="5" value="" onblur="limpiar(this.id),getproductos4()" onkeypress="return ValidaNum(event)"  />
    <a href="#" title="" onClick="javascript:zip('zip.php','POP')" >Ingresar 
        C&oacute;digo Postal
		</a></td>
		</tr>	
    <tr>
      <td class="label">
        <sup class="tilde">*</sup>Estado:</td>
      <td>
      	<div class="styled-select">
      		<div class='cont-select'>
        <select size="1" name="estado" id="estado">
          <!--pongo un selected por default-->
		  <option selected="selected" value="">Seleccione uno</option>
          <option  value="AGS">Aguascalientes</option>
          <option  value="BCN">Baja California Norte</option>
          <option  value="BCS">Baja California Sur</option>
          <option  value="CAMP">Campeche</option>
          <option  value="COAH">Coahuila</option>
          <option  value="COL">Colima</option>
          <option  value="CHIS">Chiapas</option>
          <option  value="CHIH">Chihuahua</option>
          <option  value="09">Distrito Federal</option>
          <option  value="DGO">Durango</option>
          <option  value="GTO">Guanajuato</option>
          <option  value="GRO">Guerrero</option>
          <option value="HGO">Hidalgo</option>
          <option Value="JAL">Jalisco</option>
		  <option  value="EDO MEX">Estado de Mexico</option>
          <option  value="MICH">Michoacan</option>
          <option  value="MOR">Morelos</option>
          <option  value="NAY">Nayarit</option>
          <option  value="NL">Nuevo Leon</option>
          <option  value="OAX">Oaxaca</option>
          <option  value="PUE">Puebla</option>
          <option  value="QRO">Queretaro</option>
          <option  value="Q ROO">Quintana
          Roo</option>
          <option  value="SLP">San
          Luis Potosi</option>
          <option  value="SIN">Sinaloa</option>
          <option  value="SON">Sonora</option>
          <option  value="TAB">Tabasco</option>
          <option  value="TAMPS">Tamaulipas</option>
          <option  value="TLAX">Tlaxcala</option>
          <option  value="VER">Veracruz</option>
          <option  value="YUC">Yucatan</option>
          <option  value="ZAC">Zacatecas</option>
          <option value="INTL">Internacional</option>
        </select></div></div>
		</td>
    </tr>
        <tr>
      <td class="label">
        <sup class="tilde">*</sup>Ciudad:</td>
      <td>
        <input class="text-short" type="text" name="ciudad" id="ciudad" size="30" maxlength="36" value="" /></td>
    </tr>
  <tr>
      <td class="label">
        <sup class="tilde">*</sup>Colonia:</td>
      <td>
      	<div class="styled-select">
      		<div class='cont-select'>
      	<select size="1" name="colonias" id="colonias">
      		<option value="0">Seleccione uno</option>
      		
      	</select>
      	</div></div>
        <input class="text-short" type="hidden" name="colonia" id="colonia" size="30" maxlength="38" value="" /></td>
    </tr>
    <tr>
      <td class="label"> 
        <sup class="tilde">*</sup>Lada y Teléfono:</td>
      <td>
        <input class="text-short" type="text" size="4" maxlength="5" id="lada" name="lada" value="" onkeypress="return ValidaNum(event)" /> 
		<input class="text-short" type="text" name="telefono" size="16" maxlength="16" value="" onkeypress="return ValidaNum(event)" />
        </td>
    </tr>
	
    <tr>
      <td class="label">
        Fax:</td>
      <td>
        <input class="text-short" type="text" name="fax" size="30" maxlength="16" value="" onkeypress="return ValidaNum(event)" /></td>
    </tr>
	
    <tr>
      <td class="label">
        <sup class="tilde">*</sup>Correo
        Electronico:</td>
      <td>
        <input class="text-short" type="text" name="email" size="30" maxlength="80" value="" onblur="vemail(this.value,1,'frmcaja.email')"  /></td>
    </tr>


<!--agregado de promo-->
<tr>
      <td class="label">
        Clave de Promocion Gu&iacutea de compras:
        </td>
    <td>
        <input class="text-short" type="text" name="b2bSourcecode" size="30" maxlength="255" value=""/>
	</td>
</tr>
<!--fin agregado de promo-->

<tr><td colspan=2>
<!--hidden-->
</td></tr>

   
<input type="hidden" name="paso" id="paso" value="1" />
    <tr>
	   <td colspan="2" class="label" style="padding-right: 50%; padding-top: 20px; padding-bottom: 10px;">
      <sup class="tilde">*</sup>Campos
      	Requeridos
	</td>
</tr>

    <tr>
      <td colspan="2" align="center" style="padding-right: 10%;">
        <input class="crear_cuenta" TYPE="submit" VALUE="crear cuenta y continuar" id="submit1" name="submit1">		
    </tr>
    
  </table>
</form>

<?php
    require('templates/footer.php');
?>