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
		
<form ACTION="energia360_nuevo_ip1.php" name="frmcaja" id="frmcaja" METHOD="post" onSubmit="return checkPasodos(this)">
<table width="100%">


	 <tr>
      <td colspan="2" class="instrucciones">
         Paso 2 de 2:<br>Conteste
        completamente el siguiente cuestionario:</td>
    </tr>

<tr>
      <td colspan="2" class="label_izq"> 
        1. Seleccione la opcion que describa su nivel jerarquico:
	  </td>
	  
</tr> 
<tr>
<td colspan="2" >
        <select name="actividad" id="actividad" onChange="validaOtro(this)">
          <option value="A	Presidencia">Presidencia </option>          
          <option value="B	Direccion">Direccion</option>          
          <option value="C	Alta Gerencia">Alta Gerencia</option>          
          <option value="D	Gerencial">Gerencial</option>          
          <option value="E	Jefatura">Jefatura</option>          
		  <option value="F	Analista">Analista</option>          
		  <option value="G	Coordinacion">Coordinacion</option>          
		  <option value="H	Supervision">Supervision</option>          
		  <option value="I  Operacion">Operacion</option>          
          <option value="J">Otro (describa)</option>
        </select>
</td>
</tr>
<tr>  
      <td class="label_izq">
        <input type="radio" value="20." name="actividadrad" id="actividadrad"  >
		<div id="divtipo_inicio2" class="radio_no_selected"></div>				

        Otro (describa):


        <input type="text" class="text" name="actividadtxt" id="actividadtxt" size="15" maxlength="64" value=""  disabled="disabled" ></td>
    </tr>
<!-- 3 -->
    <tr>
      <td colspan="2" class="label_izq"> 
        2. Marque la opcion que mejor describa su área:</td>
    </tr>
    <tr>
      <td colspan="2">
        <select name="cargo" onChange="validaOtro(this)">
          <option value="A	Direccion General">Direccion General</option>
          <option value="B	Administracion/Finanzas/Legal/Comercial">Administracion/Finanzas/Legal/Comercial</option>
          <option value="C	Compras">Compras</option>
          <option value="D	Produccion">Produccion</option>
          <option value="E	Mantenimiento">Mantenimiento</option>
          <option value="F	Operaciones">Operaciones</option>
          <option value="G	Sistemas">Sistemas</option>
          <option value="H	Ingenieria">Ingenieria</option>
          <option value="I	Consultoria">Consultoria</option>
          <option value="J	Academicos">Academicos</option>
          <option value="K">Otro, especifique por favor</option>
        </select>
	</td>
    </tr>
      <tr>
       <td class="label_izq">
        <input type="radio" value="20." name="cargorad" />
		<div id="divtipo_inicio3" class="radio_no_selected"></div>
        Otro (describa):
		
        <input type="text" name="cargotxt" id="cargotxt" size="15" maxlength="64" value="" class="text" disabled /></td>
    </tr>
<!-- 4 -->    
	<tr>
      <td colspan="2" class="label_izq" > 
        3. Indique el principal ramo de actividad de su empresa: </td>
    </tr>

    <tr>
      <td colspan="2">
        <select name="ramo" onChange="validaOtro(this)">
          <option value="A	Alimentos y Bebidas">Alimentos y Bebidas</option>
          <option value="B	Automotriz">Automotriz</option>
          <option value="C	Cadenas de Autoservicios">Cadenas de Autoservicios</option>
          <option value="D	Revendedor/Distribuidor/Comercializadora">Revendedor/Distribuidor/Comercializadora</option>
          <option value="E	Construccion">Construccion</option>
          <option value="F	Educacion">Educacion</option>
          <option value="G	Electricidad">Electricidad</option>
          <option value="H	Electronica">Electronica</option>
          <option value="I	Farmaceutica">Farmaceutica</option>
          <option value="J	Financieras">Financieras</option>
		  <option value="K	Gobierno/Organismos/Administracion Publica">Gobierno/Organismos/Administracion Publica</option>
		  <option value="L	Madera">Madera</option>
		  <option value="M	Maquinaria y Equipo">Maquinaria y Equipo</option>
		  <option value="N	Metalmecanica">Metalmecanica</option>
		  <option value="O	Mineria">Mineria</option>
		  <option value="P	Papel">Papel</option>
		  <option value="Q	Petroleo">Petroleo</option>
		  <option value="R	Quimica">Quimica</option>
		  <option value="S	Telecomunicaciones">Telecomunicaciones</option>
		  <option value="T	Textil">Textil</option>
		  <option value="U	Hospitales">Hospitales</option>
		  <option value="V	Hoteles">Hoteles</option>
		  <option value="W	Restaurantes">Restaurantes</option>
		  <option value="X	Servicios de Telecomunicaciones">Servicios de Telecomunicaciones</option>
		  <option value="Y	Transportistas">Transportistas</option>
          <option value="Z">Otro tipo de Actividad/Industria: (describa)</option>
        </select>
	</td>
    </tr>

    <tr>
       <td class="label_izq">
        <input type="radio" value="20." name="ramorad" readonly>
		<div id="divtipo_inicio4" class="radio_no_selected"></div>
       Otro (describa):
	   
        <input type="text" class="text" name="ramotxt" id="ramotxt" size="15" maxlength="64" value="" disabled></td>
    </tr>
<!-- 5 -->
   <tr>
      <td colspan="2" class="label_izq">4. 
        Por favor indique de que manera esta involucrado en la selección de productos 
        y proveedores para su planta</td>
    </tr>
    <tr>
      <td colspan="2"  >
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
    <tr>
      <td colspan="2" class="label_izq"> 
        5. Número de empleados en su empresa:</td>
    </tr>
   <tr>
      <td colspan="2" >
        <select name="empleados">
          <option value="A	1-9">1-9</option>
		  <option value="B	10-19">10-19</option>
		  <option value="C	20-49">20-49</option>
		  <option value="D	50-99">50-99</option>
		  <option value="E	100-249">100-249</option>
		  <option value="F	250-499">250-499</option>
		  <option value="G	500-999">500-999</option>
		  <option value="H	1000-2499">1000-2499</option>
		  <option value="I	2500+">2500+</option>
        </select>
	</td>
    </tr>


    <tr>
      <td   colspan="2" class="label_izq"> 
     <sup class="tilde">*</sup>
	 6. Para procesar su solicitud, es necesario nos indique el mes de su nacimiento:</td>
    </tr>
    <tr >
      <td colspan="2">
        <input class="text" type="text" name="mes" size="16" maxlength="16" value="" /></td>
    </tr>
	
    <tr>
      <td colspan="2" class="instrucciones">
        Los editores se reservan el derecho de incluir en la<br>
        lista de circulación solo a suscriptores calificados</td>
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