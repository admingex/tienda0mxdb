<div class="contenedor-gris-blanco">
	<p class="instrucciones_cursivas">Formatos</p>
	<form name="formatos" id="formatos">
	<table class="css3" cellspacing="0" id="grilla">
		<thead>
			<tr class="label_izq">
				<td>Nombre:<input type="text" name="nf" id="nf" class="text" onkeypress="tenterf(event)" /></td>
				<td><input type="button" name="adp" id="adp" value="Agregar" onclick="javascript: fn_agregar();" /></td>
			</tr>
		</thead>
		<tbody>
			{section name=cf loop=$cformatos}
			<tr class="label_izq">
				<td>{$cformatos[cf].formatoVc}</td>
				<td><a href="#" class="elimina">Eliminar</a></td>
			</tr>
			{/section}
		</tbody>
	</table>
	</form>
</div>