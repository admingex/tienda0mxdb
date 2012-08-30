<?php
    require('./templates/header.php');
?>

		<div class="titulo-proceso">
		Renovaci&oacute;n gratuita para lectores calificados en M&eacute;xico.	
		</div>
		<br>
		<p class="label_izq">Con el fin de ofrecerle un servicio eficiente, rapido y seguro, es muy importante que proporcione correctamente sus datos. SuscribeteHoy le garantiza absoluta confidencialidad en la informacion proporcionada.</p>
		</section>
		<div id="pleca-punteada"></div>
		<section class="contenedor">	
		<div class="contenedor-gris">
<form ACTION="gc_reno_paso.php" name=frmcaja METHOD="post" onSubmit="return checkFields_GC(this)">
<table width="100%">

 
<tr>
      <td  class="instrucciones" colspan="2">
        Paso 2 de 2 <br>Conteste completamente el siguiente cuestionario:</td>
    </tr>


	<tr>
	
      <td  class="label_izq" colspan="2">
        1. Por favor indique el &aacute;rea en el cual se desempe&ntilde;a:</td>
    </tr>
	
    <tr>
      
      <td class="label_izq" colspan="2">
        <input type="radio" value="1. Dirección General" name="cargo1" id="cargo1" checked="checked" />
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
      Operaciones</td>
    </tr>
	
	
    <tr>
      
      <td class="label_izq" colspan="2">
        <input type="radio" value="4. Compras" name="cargo4" id="cargo4" />
		<div id="radio4" class="radio_no_selected">&nbsp;					
		  </div>		
Compras</td>
    </tr>

	
	
    <tr>
    
      <td class="label_izq" colspan="2">
        <input type="radio" value="5. Ingeniería" name="cargo5" id="cargo5"  />
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
      <td colspan="2" class="label_izq">
        2. Su empresa:</td>
    </tr>
	
    <tr>
      
      <td class="label_izq" colspan="2">
        <input type="radio" value="21. Administra" name="actividad1"   ID="actividad1" checked="checked" />
		<div id="radio2_1" class="radio_selected">&nbsp;					
		  </div>	
        Administra</td>
    </tr>
	
	
    <tr>
      
      <td colspan="2" class="label_izq">
        <input type="radio" value="22. Diseña" name="actividad2"  ID="actividad2" />
		<div id="radio2_2" class="radio_no_selected">&nbsp;					
		  </div>
        Dise&ntilde;a</td>
    </tr>
    
    <tr>
      
      <td colspan="2" class="label_izq">
        <input type="radio" value="23. Construye" name="actividad3" ID="actividad3"/>
		<div id="radio2_3" class="radio_no_selected">&nbsp;					
		  </div>
        Construye</td>
    </tr>
	
<tr>
      
      <td class="label_izq">
        <input type="radio" value="24." name="actividad4" />
		<div id="radio2_4" class="radio_no_selected">&nbsp;					
		  </div>
       Otro (especifique): <input  class="text" type="text" name="actividadotra" id="actividadotra" size="15" maxlength="64" disabled="disabled" /></td>
	
    </tr>
	
	
	<tr>
      <td  class="label_izq" colspan="2" >
       3. Por favor indique de qu&eacute; manera est&aacute; involucrado en la selecci&oacute;n de productos y
        proveedores para su planta</td>
    </tr>
	
    <tr>
      
      <td  colspan="2">
        <select size="1" name="decision"  ID="decision">
          <option value="A. Toma de Decisi&oacute;n Final">Toma de Decisi&oacute;n 
          Final</option>
          <option value="B. Comparte Decisi&oacute;n Final">Comparte Decisi&oacute;n 
          Final</option>
          <option value="C. Eval&uacute;a Productos y Proveedores">Eval&uacute;a 
          Productos y Proveedores</option>
          <option value="D. Recomienda Productos y Proveedores">Recomienda Productos 
          y Proveedores</option>
          <option value="E. Desarrolla Especificaciones">Desarrolla Especificaciones</option>
          <option value="F. Ejecuta la compra">Ejecuta la compra</option>
          <option value="G. No Se Involucra">No Se Involucra</option>
        </select></td>
    </tr>
	
	<tr>
      <td   colspan="2" class="label_izq">
        4. Por favor indique el monto aproximado en compras por proyecto (miles de pesos):</td>
    </tr>
	
	
    <tr>
      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="1. De 0 a 10" name="proyecto1"  ID="proyecto1" checked="checked">
		<div id="radio3_1" class="radio_selected">&nbsp;					
		  </div>
        De 0 a 10</td>
    </tr>
    <tr>
      
      <td   class="label_izq" colspan="2">
        <input type="radio" value="2. De 11 a 50" name="proyecto2"   ID="proyecto2">
		<div id="radio3_2" class="radio_no_selected">&nbsp;					
		  </div>
        De 11 a 50</td>
    </tr>
    <tr>
      
      <td   class="label_izq" colspan="2">
        <input type="radio" value="3. De 51 a 100" name="proyecto3"  ID="proyecto3">
		<div id="radio3_3" class="radio_no_selected">&nbsp;					
		  </div>
        De 51 a 100</td>
    </tr>
    <tr>
      
      <td  class="label_izq" colspan="2">
        <input type="radio" value="4. De 100 a más" name="proyecto4"  ID="proyecto4">
		<div id="radio3_4" class="radio_no_selected">&nbsp;					
		  </div>
        De 100 a m&aacute;s</td>
    </tr>
    <tr>
      
      <td  class="label_izq" colspan="2">
        <input type="radio" value="5. Menos de 1 mdp" name="proyecto5"   ID="proyecto5">
		<div id="radio3_5" class="radio_no_selected">&nbsp;					
		  </div>
        Menos de 1 mdp</td>
    </tr>
	
	
	
	<tr> 
      <td class="label_izq" colspan="2">
        5. Medio por el busca y encuentra productos/proveedores del sector
        (se&ntilde;ale las que apliquen)</td>
    </tr>
       
    <tr> 
      
      <td class="label_izq" colspan="2">
        <input type="checkbox" value="A. Revista" name="med1" ID="med1" checked="checked"> 
		<div id="radio5_1" class="checkbox_selected">&nbsp;					
		  </div>
		A. Revista </td>
    </tr>
	
     <tr> 
      
      <td class="label_izq" colspan="2">
        <input type="checkbox" value="B. Internet" name="med2" ID="med2"> 
		<div id="radio5_2" class="checkbox_no_selected">&nbsp;					
		  </div>
		B. Internet</td>
    </tr>
     <tr> 
      
      <td class="label_izq" colspan="2"> 
        <input type="checkbox" value="C. Directorios" name="med3" ID="med3">
		<div id="radio5_3" class="checkbox_no_selected">&nbsp;					
		  </div>
		C. Directorios</td>
    </tr>
     <tr> 
            <td COLSPAN="2" class="label_izq">
        <input type="checkbox" value="D. Recomendación" name="med4" ID="med4">
		<div id="radio5_4" class="checkbox_no_selected">&nbsp;					
		  </div>
		D. Recomendaci&oacute;n</td>
    </tr>
     
    <tr> 
      
      <td   CLASS="label_izq" colspan="2">Otro
	   <input type="text" name="medotro" id="medotro" size="15" maxlength="64" value="" class="text"/>
        </td>
    </tr>
 

<tr> 
      <td  colspan="2" class="label_izq">
       6. Mencione 5 marcas m&aacute;s empleadas, sin importar &aacute;rea de especializaci&oacute;n:</td>
    </tr>
	
    <tr> 
      <td  class="label_izq" colspan="2">
        <input type="text" class="text" name="mar" id="mar" size="7" maxlength="200" 
               ID="mar">
        </td>
    </tr>
	
<tr> 
      <td   class="label_izq" colspan="2" > 
       7. Indique 5 materiales m&aacute;s empleados por su empresa:</td>
    </tr>
    <tr> 
      <td colspan="2">
        <input type="text" name="mat" id="mat" size="7" maxlength="200" 
              class="text" />
        </td>
    </tr>

<!-- -->
 <tr>
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
      <td  colspan="2" class="label_izq" />
        9. Indique por favor el tipo de obra 
        en el que construye:</td>
    </tr>

    
<tr>
      <td  colspan="2" class="label_izq" />
        <select name="construye">
          <option value="-1">1. Edificaci&oacute;n (seleccione)</option>
		            <option value="1 Vivienda unifamiliar">|---   1.1 Vivienda unifamiliar</option>
		            <option value="2 Vivienda multifamiliar">|---   1.2 Vivienda multifamiliar</option>
					<option value="3 Escuelas">|---   1.3 Escuelas</option>
		            <option value="4 Edificios para oficinas y similares">|---   1.4 Edificios para oficinas y similares</option>
					<option value="5 Edificaciones comerciales y de servicios">|---   1.5 Edificaciones comerciales y de servicios</option>
		            <option value="6 Hospitales y clínicas">|---   1.6 Hospitales y clínicas</option>
					<option value="7 Edificaciones para recreación y esparcimiento">|---   1.7 Edificaciones para recreación y esparcimiento</option>
					<option value="8 Obras auxiliares">|---   1.8 Obras auxiliares</option>
          <option value="2. Agua, Riego y saneamiento">2. Agua, Riego y saneamiento</option>
          <option value="3. Electricidad y comunicaciones">3. Electricidad y comunicaciones</option>
          <option value="4. Transporte">4. Transporte</option>							
          <option value="5. Petróleo y petroquímica">5. Petróleo y petroquímica</option>							
          <option value="6. Otras construcciones">6. Otras construcciones (especifique)</option>							  
        </select>
</td>
</tr>


<!-- -->





    <tr>
      <td  colspan="2" class="label_izq" />
	  10. Para procesar su solicitud, es necesario que nos indique su a&ntilde;o de nacimiento:</td>
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
