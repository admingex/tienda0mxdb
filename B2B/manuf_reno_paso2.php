<?php
    require('./templates/header.php');
?>
		<div class="titulo-proceso">
		Renovación gratuita para lectores calificados en M&eacute;xico.	
		</div>
	
		<p style="margin-left: 25px;">Con el fin de ofrecerle un servicio eficiente, rápido y seguro, es muy importante que proporcione correctamente sus datos.
			 Kiosco le garantiza absoluta confidencialidad en la información proporcionada.</p>
		</section>
		<div id="pleca-punteada"></div>
		<section class="contenedor">	
		
<!-- INICIO -->
<form ACTION="manuf_reno_paso.php" name=frmcaja METHOD="post" onSubmit="return checkFieldsSEIS(this)">
<table width="100%">
<tr>
      <td colspan="2" class="instrucciones">
      Completamente cuestionario <span class="indicador">2/2</span>
	  </td>
</tr>

<tr>
      <td colspan="2" class="label_izq"> 
  1. Usted toma decisiones desde el &aacute;rea de:</td>
    </tr>
    <tr>
		<td colspan="2" >
			<div class="styled-select">
				<div class='cont-select'>
		        <select name="actividad" id="actividad" class="styled" >
		          <option value="1. Dirección general">Dirección general</option>          
		          <option value="2. Planta/Operaciones">Planta/Operaciones </option>          
		          <option value="3. Producción">Producción</option>          
		          <option value="4. Mantenimiento">Mantenimiento</option>          
		          <option value="5. Control de calidad">Control de calidad</option>                    
		          <option value="6. Ingeniería">Ingeniería</option>          
		          <option value="7. Compras">Compras</option>          
		          <option value="8. Recursos humanos">Recursos humanos</option>
		          <option value="9. Finanzas">Finanzas</option>
		          <option value="J">Otro (describa)</option>
		        </select>
		        </div>
		        </div>
		</td>
	</tr>

    <tr>
      <td colspan="2" class="label_izq"> 
2. Indique el principal ramo de actividad 
        de su empresa:</td>
    </tr>
    <tr>
          <td colspan="2">
          <div class="styled-select">	
          <div class='cont-select'>
        <select name="cargo" onChange="validaOtro(this)" class="styled">
          <option value="311. Manufactura de Alimentos/Bebidas/Tabaco">Manufactura 
          de Alimentos/Bebidas/Tabaco</option>
          <option value="313. Manufactura de Textiles / Prendas de vestir">Manufactura 
          de Textiles / Prendas de vestir</option>
          <option value="316. Industria del Cuero">Industria del Cuero</option>
          <option value="321. Industria de la Madera y Productos de Madera">Industria 
          de la Madera y Productos de Madera</option>
          <option value="322. Manufactura de Papel/Productos de Papel">Manufactura 
          de Papel/Productos de Papel</option>
          <option value="323. Industria Editorial/Imprentas">Industria Editorial/Imprentas</option>
          <option value="325. Manufactura de Productos Qu&iacute;micos/Caucho/Pl&aacute;stico">Manufactura 
          de Productos Qu&iacute;micos/Caucho/Pl&aacute;stico</option>
          <option value="327. Manufactura de Productos de Minerales No Met&aacute;licos">Manufactura 
          de Productos de Minerales No Met&aacute;licos</option>
          <option value="331. Industria Met&aacute;lica B&aacute;sica">Industria 
          Met&aacute;lica B&aacute;sica</option>
          <option value="332. Manufactura de Productos Met&aacute;licos">Manufactura 
          de Productos Met&aacute;licos</option>
          <option value="333. Maquinaria y Equipo (excepto el&eacute;ctricos y electr&oacute;nico)">Maquinaria 
          y Equipo (excepto el&eacute;ctricos y electr&oacute;nico)</option>
          <option value="334. Manufactura de computadoras/Equipo/Aparatos/Componentes  Electr&oacute;nicos">Manufactura 
          de computadoras/Equipo/Aparatos/Componentes Electr&oacute;nicos</option>
          <option value="335. Manufactura de Maquinaria/Equipo/Aparatos/Componentes El&eacute;ctricos">Manufactura 
          de Maquinaria/Equipo/Aparatos/Componentes El&eacute;ctricos</option>
          <option value="336. Manufactura de Productos para Transporte/ Automotriz/ Aviaci&oacute;n">Manufactura 
          de Productos para Transporte/ Automotriz/ Aviaci&oacute;n</option>
          <option value="337. Manufactura de Muebles para Casa/Oficina">Manufactura 
          de Muebles para Casa/Oficina</option>
          <option value="399. Otro tipo de Manufactura/Industria (describa)">Otro 
          tipo de Manufactura/Industria (describa)</option>
          <option value="113. Agricultura/Forestal/Pesca">Agricultura/Forestal/Pesca</option>
          <option value="211. Extracci&oacute;n Petr&oacute;leo/Gas">Extracci&oacute;n 
          Petr&oacute;leo/Gas</option>
          <option value="212. Miner&iacute;a">Miner&iacute;a</option>
          <option value="221. Electricidad/Gas/Agua">Electricidad/Gas/Agua</option>
          <option value="233. Construcci&oacute;n">Construcci&oacute;n</option>
          <option value="44. Revendedor / Distribuidor">Revendedor / Distribuidor</option>
          <option value="48. Transportes / Almacenamiento">Transportes / Almacenamiento</option>
          <option value="61. Instituto de ense&ntilde;anza">Instituto de ense&ntilde;anza</option>
          <option value="921. Gobierno/ Organismos /Administraci&oacute;n P&uacute;blica">Gobierno/ 
          Organismos /Administraci&oacute;n P&uacute;blica</option>
          <option value="334. Fabricaci&oacute;n de equipo cient&iacute;fico de  medici&oacute;n y control">Fabricaci&oacute;n 
          de equipo cient&iacute;fico de medici&oacute;n y control</option>
          <option value="513. Servicios de telecomunicaciones">Servicios de telecomunicaciones</option>
          <option value="541. Servicios de Consultor&iacute;a / Servicios profesionales/ Investigaciones t&eacute;cnicas">Servicios 
          de Consultor&iacute;a / Servicios profesionales/ Investigaciones t&eacute;cnicas</option>
          <option value="624.  Servicios sociales y comunitarios"> Servicios sociales 
          y comunitarios</option>
          <option value="K">Otro tipo de Manufactura/Industria (describa)</option>
        </select>
        </div>
        </div>
</td>
    </tr>
    
     <tr>
       <td class="label_izq" colspan="2">
        <input type="radio" value="20." name="cargorad" />
		<div id="divtipo_inicio3" class="radio_no_selected"></div>
        Otro (describa):
		
        <input type="text" name="cargotxt" id="cargotxt" size="15" maxlength="64" value="" class="text-short" disabled /></td>
    </tr>
    
	<tr>
     <td colspan="2" class="label_izq"> 
        3. Usted labora en:</td>
    </tr>
	
	
	<tr>
      
      <td class="label_izq" colspan="2">
        <input type="radio" value="1. Planta" name="actividad1"   ID="actividad1" checked="checked" />
		<div id="radio2_1" class="radio_selected">&nbsp;					
		  </div>	
        Planta</td>
    </tr>
	
	
    <tr>
      
      <td colspan="2" class="label_izq">
        <input type="radio" value="2. Corporativo" name="actividad2"  ID="actividad2" />
		<div id="radio2_2" class="radio_no_selected">&nbsp;					
		  </div>
        Corporativo</td>
    </tr>
    
    <tr>
      
      <td colspan="2" class="label_izq">
        <input type="radio" value="3. Oficina/Sucursal" name="actividad3" ID="actividad3"/>
		<div id="radio2_3" class="radio_no_selected">&nbsp;					
		  </div>
        Oficina/Sucursal</td>
    </tr>
	
<tr>
      
      <td class="label_izq" colspan="2">
        <input type="radio" value="4. otro" name="actividad4" />
		<div id="radio2_4" class="radio_no_selected">&nbsp;					
		  </div>
       Otro (especifique): <input  class="text-short" type="text" name="actividadotra" id="actividadotra" size="15" maxlength="64" disabled="disabled" /></td>
	
    </tr>
	

    <tr>
      <td   colspan="2" class="label_izq">4. &iquest;C&oacute;mo describe a su empresa?</td>
    </tr>

	
	<tr>
      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="Fabricante" name="proyecto1"  ID="proyecto1" checked="checked">
		<div id="radio3_1" class="radio_selected">&nbsp;					
		  </div>
        Fabricante</td>
    </tr>
    
    <tr>
      
      <td   class="label_izq" colspan="2">
        <input type="radio" value="Prestador de servicio" name="proyecto3"  ID="proyecto3">
		<div id="radio3_3" class="radio_no_selected">&nbsp;					
		  </div>
        Prestador de servicio</td>
    </tr>
    <tr>
      
      <td  class="label_izq" colspan="2">
        <input type="radio" value="Maquilador" name="proyecto4"  ID="proyecto4">
		<div id="radio3_4" class="radio_no_selected">&nbsp;					
		  </div>
        Maquilador</td>
    </tr>
	
	

    <tr>
      <td   colspan="2" class="label_izq">5. 
        Por favor indique de qu&eacute; manera est&aacute; involucrado en la selecci&oacuten de productos 
        y proveedores para su planta</td>
    </tr>
    <tr>
 <td   colspan="2" class="label_izq">
 	<div class="styled-select">
 		<div class='cont-select'>
        <select size="1" name="decision" class="styled" >
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
        </select>
        </div>
        </div>
        </td>
        
    </tr>
	
    <tr>
       <td   colspan="2" class="label_izq">
        6. N&uacute;mero de empleados en su empresa:</td>
    </tr>
	
    <tr>
            <td colspan="2" class="label_izq">
        <input type="radio" value="1. 1-9" name="empleados1" id="empleados1 "checked="checked">
		<div id="radio8_1" class="radio_selected">&nbsp;					
		  </div>
       0-10</td>
    </tr>
	
    <tr>
      
      <td   colspan="2" class="label_izq">
        <input type="radio" value="2. 10-19" name="empleados2" id="empleados2"/>
		<div id="radio8_2" class="radio_no_selected">&nbsp;					
		  </div>
       11-50</td>
    </tr>
	
        <tr> 
      <td   colspan="2" class="label_izq">
        <input type="radio" value="3. 20-49" name="empleados3" id="empleados3"/>
		<div id="radio8_3" class="radio_no_selected">&nbsp;					
		  </div>
       51-250</td>
    </tr>
	
	     <tr> 
      <td   colspan="2" class="label_izq">
        <input type="radio" value="4. 50-99" name="empleados4" id="empleados4"/>
		<div id="radio8_4" class="radio_no_selected">&nbsp;					
		  </div>
       251+</td>
    </tr>

<tr>
       <td   colspan="2" class="label_izq">7. Indique la marca y modelo de autom&Oacute;vil  mas reciente que adquiri&Oacute;: (que no pertenezca a la empresa)
       	</td>
    </tr>
    <tr>
       <td class="label_izq" width="10">
       	Marca:
       </td>
       <td>
		<input type="text" name="marca" id="marca" size="10" maxlength="9" class="text-short">
		</td>
    </tr>
    <tr>
       <td class="label_izq" width="10">
       	Modelo:
       </td>
       <td>
		<input type="text" name="Modelo" id="modelo" size="10" maxlength="9" class="text-short">
		</td>
    </tr>
    <tr> 
      <td   colspan="2" class="label_izq">
        <input type="radio" value="sin auto" name="auto" id="auto"/>
		<div id="auto_manuf" class="radio_no_selected">&nbsp;					
		  </div>
       No tengo</td>
    </tr>

<tr>
       <td   colspan="2" class="label_izq">8. En los últimos 12 meses ¿Cuántas veces ha salido de vacaciones?
       	</td>
    </tr>
    
    <tr>
      
      <td class="label_izq" colspan="2">
        <input type="radio" value="1. Ninguna" name="vacaciones1"   ID="vacaciones1" checked="checked" />
		<div id="radio9_1" class="radio_selected">&nbsp;					
		  </div>	
        Ninguna</td>
    </tr>
	
	
    <tr>
      
      <td colspan="2" class="label_izq">
        <input type="radio" value="2. Una" name="vacaciones2"  ID="vacaciones2" />
		<div id="radio9_2" class="radio_no_selected">&nbsp;					
		  </div>
        Una</td>
    </tr>
    
    <tr>
      
      <td colspan="2" class="label_izq">
        <input type="radio" value="3. Dos" name="vacaciones3" ID="vacaciones3"/>
		<div id="radio9_3" class="radio_no_selected">&nbsp;					
		  </div>
       Dos</td>
    </tr>
    
    <tr>
      
      <td colspan="2" class="label_izq">
        <input type="radio" value="3.  Tres o mas" name="vacaciones4" ID="vacaciones4"/>
		<div id="radio9_4" class="radio_no_selected">&nbsp;					
		  </div>
       Tres o mas</td>
    </tr>
	
	
<tr>
      
      <td class="label_izq" colspan="2">
        
       ¿Cuál fue el destino?: <input  class="text-short" type="text" name="destino" id="destino" size="15" maxlength="64" disabled="disabled" /></td>
	
    </tr>
    <!--**************************************-->

    <tr>
       <td   colspan="2" class="label_izq">
	   9. Para procesar su solicitud, es necesario nos indique el mes de su nacimiento:</td>
    </tr>
    <tr>
       <td   colspan="2" class="label_izq">
        <input type="text" name="mes" size="16" maxlength="16" 
              class="text-short" /></td>
    </tr>
   <!---->
	    <tr>
      <td colspan="2" class="instrucciones-paso">
        Los editores se reservan el derecho de incluir en la
        lista de circulacion solo a suscriptores calificados</td>
    </tr>
<input type="hidden" name="paso" id="paso" value="2" />

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
