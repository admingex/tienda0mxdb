<form name="new_pub" id="new_pub" method="post" action="guardar_publicacion.php" onSubmit="return checkFields(this)">
	<input type="button" name="cancel" id="cancel" value="" class="boton-cancel-menu" onclick="cancelacion2()" />
	<input type="button" name="vp" id="vp" value="" class="boton-vp-menu" />	
	<input type="submit" name="enviar" id="enviar" value="" class="boton-agregar-publicacion-menu" />	
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Datos generales</p>
		<table>
			<tr class="label_izq">
				<td>Nombre:</td>
				<td>
					<input type="text" class="text" name="nombre" id="nombre" value="" onblur="veri_publi(this.value)"/>
				</td>
			</tr>
			<tr class="label_izq">
				<td>Descripción:</td>
				<td><textarea name="descripcion" id="descripcion" class="text"></textarea></td>				
			</tr>
		</table>		
		<input type="hidden" class="text" name="idpublicacion" id="idpublicacion" value="{$idfantasma}" />
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
					<td>&nbsp;</td>
				</tr>
			</thead>			
			<tbody>
				<tr class="label_izq">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<br />
		<button type="button" onclick="usar_oc()" class="boton-agregar-oc" >&nbsp;</button>
		<div id="dialogo">
   		
		</div>
	</div>
	
<!--*****************************      PUBLICACIONES A SUGERIR            ************************************-->
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Publicaciones a sugerir (Precio especial al agregar al carrito)</p>
		<div id="new_sele2">
			<select name="s1" id="s1">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
			<br id="bs2"/>
			<select name="s2" id="s2">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
			<br id="bs3"/>
			<select name="s3" id="s3">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
		</div>
		<br />
		<button type="button" name="plusr" id="plusr" onclick="select_nuevo_ps()" class="boton-guardar-mas">&nbsp;</button>
	</div>	
	
<!--**********************************   PUBLICACION RELACIONADAS   ********************************************************-->
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Publicaciones relacionadas (Sugerir al finalizar la compra)</p>
		<div id="new_sele">
			<select name="r1" id="r1">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
			<br id="br2"/>
			<select name="r2" id="r2">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
			<br id="br3"/>
			<select name="r3" id="r3">
				<option value="0">Seleccione uno</option>
				{section name=cp loop=$catpubli}
				<option value="{$catpubli[cp].oc_id}">{$catpubli[cp].nombreVc}</option>
				{/section}
			</select>
		</div>
		<br />
		<button type="button" name="pluss" id="pluss" class="pr" onclick="select_nuevo_pr()">&nbsp;</button>
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
						<input type="radio" name="m{$pDest[promoDesta].id_promocionIn}" id="m{$pDest[promoDesta].id_promocionIn}" value="" />
						<div id="d{$pDest[promoDesta].id_promocionIn}" class="radio_no_selected">&nbsp;</div>
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
		<textarea name="pclave" id="pclave"></textarea>
	</div>
	<input type="button" name="cancel" id="cancel" value="" class="boton-cancel-menu" onclick="cancelacion2()" />
	<input type="button" name="vp" id="vp" value="" class="boton-vp-menu" />	
	<input type="submit" name="enviar" id="enviar" value="" class="boton-agregar-publicacion-menu" />	
</form>