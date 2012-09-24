<meta charset="utf-8" />
<link href='css/style.css' rel='stylesheet' type="text/css" />
<link href='css/admin.css' rel='stylesheet' type="text/css" />
<script type='text/javascript' src='js/checks.js'></script>
<script type='text/javascript' src='js/funciones.js'></script>
<div class="contenedor-gris">

<form name="aoc" id="aoc" method="post" action="cambiosOc.php ">
	<input type="button" name="cancel" id="cancel" value="" class="boton-cancel-menu" onclick="mimensaje()" style='font-size: 13px;'/>
	<input type="submit" name="enviar" id="enviar" value="" class="boton-guardar-oc" style='font-size: 13px;' />		
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Datos Generales</p>
		<div id="formato2"style="font-size: 13px;">
			<div id="datos2" >
				<p style="font-size:13px;">OC_ID: <strong>{$id}</strong></p>
    			<p style="font-size:13px;">Descripción: <strong>{$desc}</strong></p>
    			<input type="hidden" name="ocid" id="ocid" value="{$id}"/>
    			<input type="hidden" name="idp" id="idp" value="{$idp}"/>
			</div>
			Formato
			<select name="tf" id="tf">
    		{section name=catf loop=$cf} 
    		<option 
    		{section name=datos}
    		{if $forma[datos].id_formatoSi==$cf[catf].id_formatoSi}
    		selected="selected"
    		{/if}
    		{/section}
    		value="{$cf[catf].id_formatoSi}"
    		>{$cf[catf].formatoVc}</option> 
    		{/section}
    		</select>
    		<div id="promo" style="margin-top: 5px;">
    		<table >
    			{section name=pm loop=$promo}
    			<tr>
    				<td>{$promo[pm].descripcionVc}</td>
    		<td>
    			<input type="checkbox" name="c{$promo[pm].id_promocionIn}" id="c{$promo[pm].id_promocionIn}" 
    			{if $promo[pm].publicadoBi == '1'}
                 checked
                 {else}                
                 {/if}
                 />
				<div id="d{$promo[pm].id_promocionIn}" 
				{if  $promo[pm].publicadoBi == '1'}
								 class="checkbox_selected"
								 {else}
								 class="checkbox_no_selected"
								 {/if}
				>&nbsp;</div>
				<input type="hidden" name="pe[]" id="pe[]" value="{$promo[pm].id_promocionIn}">
			</td>
			</tr>
			{/section}
			</table>
			</div>
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
				<td><input type="text" name="ts[]" id="ts[]" value="{$aThink[0].tituloVc}" /></td>
				<td><textarea name="cont[]" id="cont[]">{$aThink[0].descripcionVc}</textarea></td>
			</tr>
			
			<tr class="label_izq">
				<td></td>
				<td></td>
			</tr>
			
			<tr class="label_izq">
				<td><input type="text" name="ts[]" id="ts[]" value="{$aThink[1].tituloVc}" /></td>
				<td><textarea name="cont[]" id="cont[]">{$aThink[1].descripcionVc}</textarea></td>
			</tr>
			
			<tr class="label_izq">
				<td></td>
				<td></td>
			</tr>
			
			<tr class="label_izq">
				<td><input type="text" name="ts[]" id="ts[]" value="{$aThink[2].tituloVc}" /></td>
				<td><textarea name="cont[]" id="cont[]">{$aThink[2].descripcionVc}</textarea></td>
			</tr>
			
		</table>
	</div>
	<input type="button" name="cancel" id="cancel" value="" class="boton-cancel-menu" onclick="mimensaje()" style='font-size: 13px;' />
	<input type="submit" name="enviar" id="enviar" value="" class="boton-guardar-oc"  style='font-size: 13px;'/>		
</form>
</div>		
