{section name=ipub}
<form name="edit_pub" id="edit_pub" method="post" action="cambios_publicacion.php" onSubmit="return checkFields(this)">
	<input type="button" name="cancel" id="cancel" value="" onclick="cancelacion2()" class="boton-cancel-menu"/>
	<input type="button" name="vp" id="vp" value="" class="boton-vp-menu" />	
	<input type="submit" name="enviar" id="enviar" value="" class="boton-editar-publicacion-menu" />	
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Datos generales</p>
		<table>
			<tr class="label_izq">
				<td>Nombre:</td>
				<td>
					<input type="text" class="text" name="nombre" id="nombre" value="{$infopublic[ipub].nombreVc}" />
				</td>
			</tr>
			<tr class="label_izq">
				<td>Descripción:</td>
				<td><textarea name="descripcion" id="descripcion" class="text">{$infopublic[ipub].descripcionVc}</textarea></td>				
			</tr>
		</table>
		<input type="hidden" class="text" name="idpublicacion" id="idpublicacion" value="{$infopublic[ipub].id_publicacionSi}" />
	</div>
<!--***********************************************************************************************************************************-->
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Order classes/Formatos</p>
		<table class="css3" cellspacing="0">
			<thead>
				<tr class="label_izq">
					<td>Order class</td>
					<td>Descripción</td>
					<td>Formatos</td>
					<td colspan="2">&nbsp;</td>
				</tr>
			</thead>			
			<tbody>
				{section name=aocf loop=$allocf}
				<tr class="label_izq">
					<td>{$allocf[aocf].oc}</td>
					<td>{$allocf[aocf].nombreVc}</td>
					<td>{$allocf[aocf].formatoVc}</td>
					<td><a class="editar_oc" id="{$allocf[aocf].oc_id}" href="#">Editar</a></td>
					<td><a class="elimina_oc" href="#" id="{$allocf[aocf].oc_id}">Eliminar</a></td>
				</tr>
				{/section}
			</tbody>
		</table>
		<br />
		<button type="button" onclick="miDialog()" class="boton-agregar-oc" >&nbsp;</button>
		<div id="dialogo">
   		
		</div>
	</div>
<!--*****************************      PUBLICACIONES A SUGERIR            ************************************-->

	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Publicaciones a sugerir (Precio especial al agregar al carrito)</p>
		<div id="new_sele2">
			
			<select name="Es1" id="Es1">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option 
				{if $cPST[0].oc_id == $catpubli[cp].oc_id}
				selected="selected" 
				{/if}				
				value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>

			<br id="Ebs2"/>
			<select name="Es2" id="Es2">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option
				{if $cPST[1].oc_id == $catpubli[cp].oc_id}
				selected="selected" 
				{/if}				
				value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
			
			<br id="Ebs3"/>
			<select name="Es3" id="Es3">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option
				{if $cPST[2].oc_id == $catpubli[cp].oc_id}
				selected="selected" 
				{/if} 
				value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
			
		</div>
		<!--<br />
		<button type="button" name="plusr" id="plusr" onclick="select_nuevo_ps()">Agregar publicación</button>-->
	</div>	
	
<!--**********************************   PUBLICACION RELACIONADAS   ********************************************************-->
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Publicaciones relacionadas (Sugerir al finalizar la compra)</p>
		<div id="new_sele">
			
			<select name="Er1" id="Er1">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option
				{if $cPRT[0].oc_id == $catpubli[cp].oc_id}
				selected="selected" 
				{/if}	 
				value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
			
			<br id="Ebr2"/>
			<select name="Er2" id="Er2">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option 
				{if $cPRT[1].oc_id == $catpubli[cp].oc_id}
				selected="selected" 
				{/if}	 
				value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
			
			<br id="Ebr3"/>
			<select name="Er3" id="Er3">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option 
				{if $cPRT[2].oc_id == $catpubli[cp].oc_id}
				selected="selected" 
				{/if}	 
				value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
		</div>
		<!--<br />
		<button type="button" name="pluss" id="pluss" class="pr" onclick="select_nuevo_pr()">Agregar publicación</button>-->
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
				<tr class="label_izq">
					<td>{$pDest[promoDesta].descripcionVc}</td>
					<td>
						{if $pDest[promoDesta].publicadoBi eq 1}
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
		<textarea name="pclave" id="pclave">{$infopublic[ipub].palabras_claveVc}</textarea>
	</div>
	<input type="button" name="cancel" id="cancel" value="" onclick="cancelacion2()" class="boton-cancel-menu"/>
	<input type="button" name="vp" id="vp" value="" class="boton-vp-menu" />	
	<input type="submit" name="enviar" id="enviar" value="" class="boton-editar-publicacion-menu" />	
</form>		
{/section}