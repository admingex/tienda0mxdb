<?php
    require('./templates/header.php');
?>
		<div class="titulo-proceso">
		Renovación gratuita para lectores calificados en M&eacute;xico.	
		</div>
		<br>
		<p class="label_izq">Con el fin de ofrecerle un servicio eficiente, rápido y seguro, es muy importante que proporcione correctamente sus datos. 
			"Tienda GEx" le garantiza absoluta confidencialidad en la información proporcionada.</p>
		</section>
		<div id="pleca-punteada"></div>
		<section class="contenedor">	
		<div class="contenedor-gris">
<!-- INICIO -->
<form ACTION="obras_reno_paso.php" name=frmcaja METHOD="post" onSubmit="return checkFieldsSEIS(this)">
<table width="100%">


    <tr>
      <td colspan="2" class="instrucciones">
         Paso 2 de 2:<br>Conteste
        completamente el siguiente cuestionario:</td>
    </tr>

<tr>
      <td class="label_izq" colspan="2">
       1. Indique el sector en el que participa su empresa:</td>
    </tr>
    
    <tr>

      <td class="label_izq" colspan="2">
              <input type="radio" value="1. Privada" name="sector1"  >
              <div id="radio_privada" class="radio_selected">&nbsp;					
		</div>	
		Privada</td>
    </tr>
    <tr>
      <td class="label_izq" colspan="2">
              <input type="radio" value="2. Publica" name="sector2"  >
              <div id="radio_publica" class="radio_no_selected">&nbsp;					
		</div>	
		Publica</td>
    </tr>
    <tr>
      <td colspan="2" class="label_izq">2. Marque la opci&oacute;n que mejor describe su &aacute;rea:</td>
    </tr>
    
    
    <tr>
      
      <td class="label_izq" colspan="2">
        <input type="radio" value="1. Direcci�n General" name="cargo1" id="cargo1" checked="checked" />
		<div id="radio1" class="radio_selected">&nbsp;					
		</div>		
        Direcci&oacute;n General</td>
    </tr>
	
    <tr>
     
      <td class="label_izq" colspan="2">
	  <div id="radio2" class="radio_no_selected">&nbsp;					
		  </div>		
        <input type="radio" value="2. Gerencial" name="cargo2" id="cargo2" />
        Gerencial</td>
    </tr>
	
	
    <tr>
      
      <td class="label_izq" colspan="2">
        <input type="radio" value="3. Operaciones" name="cargo3" id="cargo3" />
		<div id="radio3" class="radio_no_selected">&nbsp;					
		  </div>
		<input type="radio" value="3. Finanzas, Econom&iacute;a, Legal, Comercial" name="cargo"  >
          Finanzas, Econom&iacute;a, Legal, Comercial</td>
    </tr>
	
	
    <tr>
      
      <td class="label_izq" colspan="2">
        <input type="radio" value="4. Compras" name="cargo4" id="cargo4" />
		<div id="radio4" class="radio_no_selected">&nbsp;					
		  </div>
		<font face="arial" size="2">Adquisiciones</font></td>
    </tr>

	
	
    <tr>
    
      <td class="label_izq" colspan="2">
        <input type="radio" value="5. Ingenier�a" name="cargo5" id="cargo5"  />
		<div id="radio5" class="radio_no_selected">&nbsp;					
		  </div>		
        Ingenier&iacute;a</td>
    </tr>
	
	
    <tr>
      
      <td class="label_izq">
        <input type="radio" value="20." name="cargo6" id="cargo6" />
		<div id="radio6" class="radio_no_selected">&nbsp;					
		  </div>	
        Otro (especifique):  <input  class="text" type="text" name="cargootro" id="cargootro" size="15" maxlength="64" disabled="disabled" /></td>
		
    </tr>

    <tr>
      <td class="label_izq" colspan="2">3. Indique por favor en qu&eacute; ramo de actividad:</td>
    </tr>    
	<tr>
       <td class="label_izq" colspan="2">
		<select size="1" name="ramo">


           <option value="35. Inmobiliaria">Inmobiliaria</option>
          <option value="36. Arquitectura">Arquitectura</option>
          <option value="39. Urbanismo">Urbanismo</option>
          <option value="44. Consultoría">Consultoría</option>
          <option value="45. Educación">Educación</option>
          <option value="46. Financiamiento">Financiamiento</option>
          <option value="47. Gobierno">Gobierno</option>
          <option value="48. Obra Pública">Obra Pública</option>
          <option value="49. Construcción">Construcción</option>
          <option value="50. Ingeniería">Ingeniería</option>          
          <option value="51. Infraestructura">Infraestructura</option>
</select>
</td>
</tr>

    <tr>
      <td colspan="2" class="label_izq">4. Indique de que manera est&aacute; involucrado en la selecci&oacute;n de productos y proveedores para su empresa</td>
    </tr>
    <tr>
      <td class="label_izq" colspan="2">
        <select size="1" name="decision" style="font-family: arial; font-size: 9pt">
          <option value="A. Decide estrategias empresariales">Decide estrategias empresariales</option>
          <option value="B. Elabora estrategias empresariales">Elabora estrategias empresariales</option>
          <option value="C. Toma decisi&oacute;n ejecutiva">Toma decisi&oacute;n ejecutiva</option>
          <option value="D. Comparte decisi&oacute;n final ejecutiva">Comparte decisi&oacute;n final ejecutiva</option>
          <option value="E. Eval&uacute;a productos y proveedores">Eval&uacute;a productos y proveedores</option>
          <option value="F. Recomienda productos y proveedores">Recomienda productos y proveedores</option>
          <option value="G. Desarrolla especificaciones">Desarrolla especificaciones</option>
          <option value="H. Ejecuta la compra">Ejecuta la compra</option>
          <option value="I. No se involucra">No se involucra</option>
        </select></td>
    </tr>
    <td colspan="2" class="label_izq">
        8. El n&uacute;mero aproximado de empleados con que cuenta su empresa es de:</td>
    </tr>
    <tr>
            <td colspan="2" class="label_izq">
        <input type="radio" value="1. 1-9" name="empleados1" id="empleados1 "checked="checked">
		<div id="radio8_1" class="radio_selected">&nbsp;					
		  </div>
       1-9</td>
    </tr>
	
    <tr>
      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="2. 10-19" name="empleados2" id="empleados2"/>
		<div id="radio8_2" class="radio_no_selected">&nbsp;					
		  </div>
       10-19</td>
    </tr>
	
         
      <td   colspan="2" class="label_izq">
        <input type="radio" value="3. 20-49" name="empleados3" id="empleados3"/>
		<div id="radio8_3" class="radio_no_selected">&nbsp;					
		  </div>
       20-49</td>
    </tr>
	
	      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="4. 50-99" name="empleados4" id="empleados4"/>
		<div id="radio8_4" class="radio_no_selected">&nbsp;					
		  </div>
       50-99</td>
    </tr>
	
	      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="5. 100-249" name="empleados5" id="empleados5"/>
		<div id="radio8_5" class="radio_no_selected">&nbsp;					
		  </div>
       100-249</td>
    </tr>
	
	      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="6. 250-499" name="empleados6" id="empleados6"/>
		<div id="radio8_6" class="radio_no_selected">&nbsp;					
		  </div>
       250-499</td>
    </tr>
	
  	      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="7. 500-999" name="empleados7" id="empleados7"/>
		<div id="radio8_7" class="radio_no_selected">&nbsp;					
		  </div>
       500-999</td>
    </tr>
	      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="8. 1000-2500" name="empleados8" id="empleados8"/>
		<div id="radio8_8" class="radio_no_selected">&nbsp;					
		  </div>
       1000-2500</td>
    </tr>
	
	      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="9. 2500 o mas" name="empleados9" id="empleados9"/>
		<div id="radio8_9" class="radio_no_selected">&nbsp;					
		  </div>
       2500 o m&aacute;s</td>
    </tr>
     <tr>
      <td colspan="2" class="label_izq">6. Si su empresa Financia, por favor indique la cantidad de activos gestionados anual (MDP):</td>
    </tr>
    <tr>

    <tr>
      <td class="label_izq" colspan="2"> Financiero,especif&Iacute;que por favor. Monto de Activos Gestionados: 
        <input type="text" class="text" name="activosgestionados" size="15" maxlength="100" 
             /></td>
    </tr>
    
    <tr>
      <td  colspan="2" class="label_izq">7. Por favor indique el nivel de
        inversi&oacute;n promedio por proyecto en su empresa (millones de pesos):</td>
    </tr>
<tr>
      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="1. De 0 a 10" name="proyecto1"  ID="proyecto1" checked="checked">
		<div id="radio3_1" class="radio_selected">&nbsp;					
		  </div>
        De 50 a 100 mdp</td>
    </tr>
    <tr>
      
      <td   class="label_izq" colspan="2">
        <input type="radio" value="2. De 11 a 50" name="proyecto2"   ID="proyecto2">
		<div id="radio3_2" class="radio_no_selected">&nbsp;					
		  </div>
        De 101 a 250 mdp</td>
    </tr>
    <tr>
      
      <td   class="label_izq" colspan="2">
        <input type="radio" value="3. De 51 a 100" name="proyecto3"  ID="proyecto3">
		<div id="radio3_3" class="radio_no_selected">&nbsp;					
		  </div>
        De251 a 500 mdp</td>
    </tr>
    <tr>
      
      <td  class="label_izq" colspan="2">
        <input type="radio" value="4. De 100 a m�s" name="proyecto4"  ID="proyecto4">
		<div id="radio3_4" class="radio_no_selected">&nbsp;					
		  </div>
        De 501 a m&aacute;s</td>
    </tr>
    <tr>
      
      <td  class="label_izq" colspan="2">
        <input type="radio" value="5. Menos de 1 mdp" name="proyecto5"   ID="proyecto5">
		<div id="radio3_5" class="radio_no_selected">&nbsp;					
		  </div>
        Menos de 50 mdp</td>
    </tr>
	
    <tr>
      <td  colspan="2" class="label_izq">8. Indique por favor el tipo de obra en el que construye:</td>
    </tr>

    
<tr>
      <td  colspan="2" class="label_izq">
        <select name="construye" id="construye" onchange="construyeOtro(this)"><!--seria construye-->
          <option value="-1">1. Edificaci&oacute;n (seleccione)</option>
          <option value="A. Vivienda unifamiliar">|--- 1.A Vivienda unifamiliar</option>
          <option value="B. Vivienda multifamiliar">|--- 1.B Vivienda multifamiliar</option>
          <option value="C. Escuelas">|--- 1.C Escuelas</option>
          <option value="D. Edificios para oficinas o similares">|--- 1.D Edificios para oficinas o similares</option>
          <option value="E. Edificaciones comerciales y de servicios">|--- 1.E Edificaciones comerciales y de servicios</option>
          <option value="F. Hospitales y cl&iacute;nicas">|--- 1.F Hospitales y cl&iacute;nicas</option>
          <option value="G. Edificaciones para recreaci&oacute;n y esparcimiento">|--- 1.G Edificaciones para recreaci&oacute;n y esparcimiento</option>
          <option value="H. Obras auxiliares">|--- 1.H Obras auxiliares</option>
          <option value="2. Agua, Riego y saneamiento">2. Agua, Riego y saneamiento</option>
          <option value="3. Electricidad y comunicaciones">3. Electricidad y comunicaciones</option>
          <option value="4. Transporte">4. Transporte</option>
          <option value="5. Petr&oacute;leo y petroqu&iacute;mica">5. Petr&oacute;leo y petroqu&iacute;mica</option>							
          <option value="J">6. Otras construcciones (especifique)</option>							  
        </select>
        </td>
</tr>

<!--nuevo campo otracons-->

<tr>
      <td class="label_izq" colspan="2">Otras Contrucciones:
      	<input class="text" type="text" name="construyetxt" id="actividadtxt"size="15" maxlength="64" disabled="disabled"/></td>
</tr>

<!-- fin nuevo campo otracons-->
	
    <tr>
      <td  colspan="2" class="label_izq" />
	  9. Para procesar su solicitud, es necesario que nos indique su a&ntilde;o de nacimiento:</td>
    </tr>
    <tr>
       <td  colspan="2" class="label_izq" />
        <input type="text" name="mes" size="16" maxlength="16" 
              class="text" /></td>
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
