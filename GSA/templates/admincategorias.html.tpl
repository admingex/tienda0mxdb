<div class="contenedor-gris-blanco">
	<table class="css3" cellspacing="0" id="grilla_publicaciones">
		<thead>
			<tr class="label_izq">
				<td>{$tituloCelda}</td>
				<td>Descripción</td>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody id="0">
		{section name=adCat loop=$adminCategorias}					
			<tr class="label_izq">
				<td>{$adminCategorias[adCat].nombreVc}</td>
				<td>{$adminCategorias[adCat].descripcionVc}</td>
				{if $modo eq "publicaciones"}
				<td><a href="editpublic.php?id={$adminCategorias[adCat].id_publicacionSi}">Editar</a></td>
				<td><a href="#" id="{$adminCategorias[adCat].id_publicacionSi}" class="elimina_pub">ELiminar</a></td>
				{else}
				<td><a href="editcat.php?id={$adminCategorias[adCat].id_categoriaSi}">Editar</a></td>
				{/if}
			</tr>
		{/section}
		</tbody>
	</table>
	{if $modo eq "publicaciones"}
	<br />
	<div id="plus"><button onclick="nueva_publicacion()">Agregar publicación</button></div>
	{/if}
</div>