<form name="edit_cat" id="edit_cat" method="post" action="cambios_categoria.php" onSubmit="return checkFields(this)">	
	<input type="button" name="cancel" id="cancel" value="" onclick="cancelacion()" class="boton-cancel-menu" />
	<input type="submit" name="enviar" id="enviar" value="" class="boton-agregar-categoria-menu"/>		
	<div class="contenedor-gris-blanco">
		{section name=categoriaDet loop=$catDetalle}
		<p class="instrucciones_cursivas">Carrusel de promociones</p>
		<table>
			<tr class="label_izq">
				<td>Nombre:</td>
				<td><input type="text" class="text" name="nombre" id="nombre" value="{$catDetalle[categoriaDet].nombreVc}" /></td>
			</tr>
			<tr class="label_izq">
				<td>Descripción:</td>
				<td><textarea name="descripcion" id="descripcion" class="text">{$catDetalle[categoriaDet].descripcionVc}</textarea></td>				
			</tr>
		</table>
		<input type="hidden" name="idcategoria" id="idcategoria" value="{$catDetalle[categoriaDet].id_categoriaSi}" />
		{/section}
	</div>
<!--***********************************************************************************************************************************-->	
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Publicaciones</p>
			<table>
			<tr>
				<td>
					<table class="css3" cellspacing="0" id="pgrilla">
						<thead>
							<tr class="label_izq">								
								<td>Publicación</td>
								<td>&nbsp;</td>
							</tr>
						</thead>
						<tbody id="table-5">
							{section name=listPublicacionesCat loop=$lpublica}
							<tr id="{$lpublica[listPublicacionesCat].id_publicacionSi}" class="label_izq">
								
								<td>{$lpublica[listPublicacionesCat].nombreVc}</td>
								<td><a href="#" id="{$lpublica[listPublicacionesCat].id_publicacionSi}" class="cpl">Eliminar</a></td>
								<input type="hidden" name="pubid[]" id="pubid[]" value="{$lpublica[listPublicacionesCat].id_publicacionSi}" />
							</tr>
							{/section}	
						</tbody>
					</table>
				</td>
				<td>&nbsp;</td>
				<td>
					<table class="css3" cellspacing="0">
						<thead>
							<tr class="label_izq">
								<td>Publicaciones disponibles</td>
							</tr>
						</thead>
						<tbody>
							{section name=ap loop=$allPubli}
							<tr id="{$allPubli[ap].id_publicacionSi}" class="label_izq"  style="cursor: move; ">
								<td><a href="javascript: fn_agregar_public({$allPubli[ap].id_publicacionSi});">{$allPubli[ap].nombreVc}</a>
									<input type="hidden" name="h{$allPubli[ap].id_publicacionSi}" id="h{$allPubli[ap].id_publicacionSi}" value="{$allPubli[ap].nombreVc}" />
								</td>
							</tr>
							{/section}
						</tbody>
					</table>
				</td>
			</tr>
		</table>					
	</div>	
<!--***********************************************************************************************************************************-->
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Promoción destacada</p>
		<table class="css3" cellspacing="0">
			<thead>
				<tr class="label_izq">
					<td>Promoción</td>
					<td>Mostrar</td>
				</tr>
			</thead>
			<tbody>
				{section name=promoDesta loop=$pDest}
				<tr class="label_izq" >
					<td>{$pDest[promoDesta].descripcionVc}</td>
					<td>
						{if $pDest[promoDesta].publicadoBi == '1'}
						<input type="radio" name="m{$pDest[promoDesta].id_promocionIn}" id="m{$pDest[promoDesta].id_promocionIn}" value="{$pDest[promoDesta].id_promocionIn}"
						checked="checked"
						 />
						<div id="d{$pDest[promoDesta].id_promocionIn}" class="radio_selected">&nbsp;</div>
						{else}
						<input type="radio" name="m{$pDest[promoDesta].id_promocionIn}" id="m{$pDest[promoDesta].id_promocionIn}" value="" />
						<div id="d{$pDest[promoDesta].id_promocionIn}" class="radio_no_selected">&nbsp;</div>
						{/if}
						<input type="hidden" name="r[]" id="r[]" value="m{$pDest[promoDesta].id_promocionIn}"/>
					</td>
				</tr>	
				{/section}
			</tbody>
		</table>
	</div>
<!--***********************************************************************************************************************************-->	
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Palabras clave</p>
		<p class="label_izq">Palabras clave de búsqueda (Separadas por comas): </p>
		{section name=categoriaDet loop=$catDetalle}
		<textarea name="pclave" id="pclave">{$catDetalle[categoriaDet].palabras_claveVc}</textarea>
		{/section}
	</div>
<!--***********************************************************************************************************************************-->	
	<input type="button" name="cancel"  value="" onclick="cancelacion()" class="boton-cancel-menu"  />
	<input type="submit" name="enviar"  value="" class="boton-agregar-categoria-menu" />
</form>