
<div class="contenedor-gris">

<form name="aoc" id="aoc" method="post" action="guardarOC.php">
	<input type="button" name="cancel" id="cancel" value="Cancelar" onclick="mimensaje()" style='font-size: 13px;'/>
	<input type="submit" name="enviar" id="enviar" value="Agregar order class" style='font-size: 13px;' />		
	<div class="contenedor-gris-blanco">
		<div id="buss">
		<table>
			<tr class="label_izq">
				<td>Nombre:</td>
				<td><input type="text" class="text" name="nombre" id="nombre" value="" /></td>
				<td><input type="button" name="bus" id="bus" value="Buscar" onclick="buscador(form.nombre.value)" /></td>
				<input type="hidden" class="text" name="idp" id="idp" value="{$id}" />
			</tr>
		</table>
		</div>
		<br />
		
		<div id="resulbus">
			
		</div>
		<div id="formato"style="font-size: 13px; display: none;">
			<div id="datos" >&nbsp;</div>
			Formato
			<select name="tf" id="tf">
    		{section name=catf loop=$cf} 
    		<option value="{$cf[catf].id_formatoSi}">{$cf[catf].formatoVc}</option> 
    		{/section}
    		</select>
		</div>
		
	</div>
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Secciones descriptivas</p>
		<table>
			<tr class="label_izq">
				<td>Titulo de sección</td>
				<td>Contenido</td>
			</tr>
			<tr class="label_izq">
				<td><input type="text" name="ts[]" id="ts[]" /></td>
				<td><textarea name="cont[]" id="cont[]">&nbsp;</textarea></td>
			</tr>
			<tr class="label_izq">
				<td></td>
				<td></td>
			</tr>
			<tr class="label_izq">
				<td><input type="text" name="ts[]" id="ts[]" /></td>
				<td><textarea name="cont[]" id="cont[]">&nbsp;</textarea></td>
			</tr>
			<tr class="label_izq">
				<td></td>
				<td></td>
			</tr>
			<tr class="label_izq">
				<td><input type="text" name="ts[]" id="ts[]" /></td>
				<td><textarea name="cont[]" id="cont[]">&nbsp;</textarea></td>
			</tr>
		</table>
	</div>
	<input type="button" name="cancel" id="cancel" value="Cancelar" onclick="mimensaje()" style='font-size: 13px;' />
	<input type="submit" name="enviar" id="enviar" value="Agregar order class"  style='font-size: 13px;'/>		
</form>
</div>		
