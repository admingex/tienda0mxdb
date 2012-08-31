<?php /* Smarty version 2.6.20, created on 2012-08-30 16:51:34
         compiled from nuevapublicacion.html.tpl */ ?>
<form name="new_pub" id="new_pub" method="post" action="guardar_publicacion.php" onSubmit="return checkFields(this)">
	<input type="button" name="cancel" id="cancel" value="Cancelar" onclick="cancelacion2()" />
	<input type="button" name="vp" id="vp" value="Vista previa" />	
	<input type="submit" name="enviar" id="enviar" value="<?php echo $this->_tpl_vars['boton']; ?>
" />	
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
		<input type="hidden" class="text" name="idpublicacion" id="idpublicacion" value="<?php echo $this->_tpl_vars['idfantasma']; ?>
" />
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
		<button type="button" onclick="usar_oc()" >Agregar order class</button>
		<div id="dialogo">
   		
		</div>
	</div>
	
<!--*****************************      PUBLICACIONES A SUGERIR            ************************************-->
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Publicaciones a sugerir (Precio especial al agregar al carrito)</p>
		<div id="new_sele2">
			<select name="s1" id="s1">
				<option value="0">Seleccione uno</option>
				<?php unset($this->_sections['cp']);
$this->_sections['cp']['name'] = 'cp';
$this->_sections['cp']['loop'] = is_array($_loop=$this->_tpl_vars['catpubli']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cp']['show'] = true;
$this->_sections['cp']['max'] = $this->_sections['cp']['loop'];
$this->_sections['cp']['step'] = 1;
$this->_sections['cp']['start'] = $this->_sections['cp']['step'] > 0 ? 0 : $this->_sections['cp']['loop']-1;
if ($this->_sections['cp']['show']) {
    $this->_sections['cp']['total'] = $this->_sections['cp']['loop'];
    if ($this->_sections['cp']['total'] == 0)
        $this->_sections['cp']['show'] = false;
} else
    $this->_sections['cp']['total'] = 0;
if ($this->_sections['cp']['show']):

            for ($this->_sections['cp']['index'] = $this->_sections['cp']['start'], $this->_sections['cp']['iteration'] = 1;
                 $this->_sections['cp']['iteration'] <= $this->_sections['cp']['total'];
                 $this->_sections['cp']['index'] += $this->_sections['cp']['step'], $this->_sections['cp']['iteration']++):
$this->_sections['cp']['rownum'] = $this->_sections['cp']['iteration'];
$this->_sections['cp']['index_prev'] = $this->_sections['cp']['index'] - $this->_sections['cp']['step'];
$this->_sections['cp']['index_next'] = $this->_sections['cp']['index'] + $this->_sections['cp']['step'];
$this->_sections['cp']['first']      = ($this->_sections['cp']['iteration'] == 1);
$this->_sections['cp']['last']       = ($this->_sections['cp']['iteration'] == $this->_sections['cp']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
			<br id="bs2"/>
			<select name="s2" id="s2">
				<option value="0">Seleccione uno</option>
				<?php unset($this->_sections['cp']);
$this->_sections['cp']['name'] = 'cp';
$this->_sections['cp']['loop'] = is_array($_loop=$this->_tpl_vars['catpubli']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cp']['show'] = true;
$this->_sections['cp']['max'] = $this->_sections['cp']['loop'];
$this->_sections['cp']['step'] = 1;
$this->_sections['cp']['start'] = $this->_sections['cp']['step'] > 0 ? 0 : $this->_sections['cp']['loop']-1;
if ($this->_sections['cp']['show']) {
    $this->_sections['cp']['total'] = $this->_sections['cp']['loop'];
    if ($this->_sections['cp']['total'] == 0)
        $this->_sections['cp']['show'] = false;
} else
    $this->_sections['cp']['total'] = 0;
if ($this->_sections['cp']['show']):

            for ($this->_sections['cp']['index'] = $this->_sections['cp']['start'], $this->_sections['cp']['iteration'] = 1;
                 $this->_sections['cp']['iteration'] <= $this->_sections['cp']['total'];
                 $this->_sections['cp']['index'] += $this->_sections['cp']['step'], $this->_sections['cp']['iteration']++):
$this->_sections['cp']['rownum'] = $this->_sections['cp']['iteration'];
$this->_sections['cp']['index_prev'] = $this->_sections['cp']['index'] - $this->_sections['cp']['step'];
$this->_sections['cp']['index_next'] = $this->_sections['cp']['index'] + $this->_sections['cp']['step'];
$this->_sections['cp']['first']      = ($this->_sections['cp']['iteration'] == 1);
$this->_sections['cp']['last']       = ($this->_sections['cp']['iteration'] == $this->_sections['cp']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
			<br id="bs3"/>
			<select name="s3" id="s3">
				<option value="0">Seleccione uno</option>
				<?php unset($this->_sections['cp']);
$this->_sections['cp']['name'] = 'cp';
$this->_sections['cp']['loop'] = is_array($_loop=$this->_tpl_vars['catpubli']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cp']['show'] = true;
$this->_sections['cp']['max'] = $this->_sections['cp']['loop'];
$this->_sections['cp']['step'] = 1;
$this->_sections['cp']['start'] = $this->_sections['cp']['step'] > 0 ? 0 : $this->_sections['cp']['loop']-1;
if ($this->_sections['cp']['show']) {
    $this->_sections['cp']['total'] = $this->_sections['cp']['loop'];
    if ($this->_sections['cp']['total'] == 0)
        $this->_sections['cp']['show'] = false;
} else
    $this->_sections['cp']['total'] = 0;
if ($this->_sections['cp']['show']):

            for ($this->_sections['cp']['index'] = $this->_sections['cp']['start'], $this->_sections['cp']['iteration'] = 1;
                 $this->_sections['cp']['iteration'] <= $this->_sections['cp']['total'];
                 $this->_sections['cp']['index'] += $this->_sections['cp']['step'], $this->_sections['cp']['iteration']++):
$this->_sections['cp']['rownum'] = $this->_sections['cp']['iteration'];
$this->_sections['cp']['index_prev'] = $this->_sections['cp']['index'] - $this->_sections['cp']['step'];
$this->_sections['cp']['index_next'] = $this->_sections['cp']['index'] + $this->_sections['cp']['step'];
$this->_sections['cp']['first']      = ($this->_sections['cp']['iteration'] == 1);
$this->_sections['cp']['last']       = ($this->_sections['cp']['iteration'] == $this->_sections['cp']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
		</div>
		<br />
		<button type="button" name="plusr" id="plusr" onclick="select_nuevo_ps()">Agregar publicación</button>
	</div>	
	
<!--**********************************   PUBLICACION RELACIONADAS   ********************************************************-->
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Publicaciones relacionadas (Sugerir al finalizar la compra)</p>
		<div id="new_sele">
			<select name="r1" id="r1">
				<option value="0">Seleccione uno</option>
				<?php unset($this->_sections['cp']);
$this->_sections['cp']['name'] = 'cp';
$this->_sections['cp']['loop'] = is_array($_loop=$this->_tpl_vars['catpubli']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cp']['show'] = true;
$this->_sections['cp']['max'] = $this->_sections['cp']['loop'];
$this->_sections['cp']['step'] = 1;
$this->_sections['cp']['start'] = $this->_sections['cp']['step'] > 0 ? 0 : $this->_sections['cp']['loop']-1;
if ($this->_sections['cp']['show']) {
    $this->_sections['cp']['total'] = $this->_sections['cp']['loop'];
    if ($this->_sections['cp']['total'] == 0)
        $this->_sections['cp']['show'] = false;
} else
    $this->_sections['cp']['total'] = 0;
if ($this->_sections['cp']['show']):

            for ($this->_sections['cp']['index'] = $this->_sections['cp']['start'], $this->_sections['cp']['iteration'] = 1;
                 $this->_sections['cp']['iteration'] <= $this->_sections['cp']['total'];
                 $this->_sections['cp']['index'] += $this->_sections['cp']['step'], $this->_sections['cp']['iteration']++):
$this->_sections['cp']['rownum'] = $this->_sections['cp']['iteration'];
$this->_sections['cp']['index_prev'] = $this->_sections['cp']['index'] - $this->_sections['cp']['step'];
$this->_sections['cp']['index_next'] = $this->_sections['cp']['index'] + $this->_sections['cp']['step'];
$this->_sections['cp']['first']      = ($this->_sections['cp']['iteration'] == 1);
$this->_sections['cp']['last']       = ($this->_sections['cp']['iteration'] == $this->_sections['cp']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
			<br id="br2"/>
			<select name="r2" id="r2">
				<option value="0">Seleccione uno</option>
				<?php unset($this->_sections['cp']);
$this->_sections['cp']['name'] = 'cp';
$this->_sections['cp']['loop'] = is_array($_loop=$this->_tpl_vars['catpubli']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cp']['show'] = true;
$this->_sections['cp']['max'] = $this->_sections['cp']['loop'];
$this->_sections['cp']['step'] = 1;
$this->_sections['cp']['start'] = $this->_sections['cp']['step'] > 0 ? 0 : $this->_sections['cp']['loop']-1;
if ($this->_sections['cp']['show']) {
    $this->_sections['cp']['total'] = $this->_sections['cp']['loop'];
    if ($this->_sections['cp']['total'] == 0)
        $this->_sections['cp']['show'] = false;
} else
    $this->_sections['cp']['total'] = 0;
if ($this->_sections['cp']['show']):

            for ($this->_sections['cp']['index'] = $this->_sections['cp']['start'], $this->_sections['cp']['iteration'] = 1;
                 $this->_sections['cp']['iteration'] <= $this->_sections['cp']['total'];
                 $this->_sections['cp']['index'] += $this->_sections['cp']['step'], $this->_sections['cp']['iteration']++):
$this->_sections['cp']['rownum'] = $this->_sections['cp']['iteration'];
$this->_sections['cp']['index_prev'] = $this->_sections['cp']['index'] - $this->_sections['cp']['step'];
$this->_sections['cp']['index_next'] = $this->_sections['cp']['index'] + $this->_sections['cp']['step'];
$this->_sections['cp']['first']      = ($this->_sections['cp']['iteration'] == 1);
$this->_sections['cp']['last']       = ($this->_sections['cp']['iteration'] == $this->_sections['cp']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
			<br id="br3"/>
			<select name="r3" id="r3">
				<option value="0">Seleccione uno</option>
				<?php unset($this->_sections['cp']);
$this->_sections['cp']['name'] = 'cp';
$this->_sections['cp']['loop'] = is_array($_loop=$this->_tpl_vars['catpubli']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cp']['show'] = true;
$this->_sections['cp']['max'] = $this->_sections['cp']['loop'];
$this->_sections['cp']['step'] = 1;
$this->_sections['cp']['start'] = $this->_sections['cp']['step'] > 0 ? 0 : $this->_sections['cp']['loop']-1;
if ($this->_sections['cp']['show']) {
    $this->_sections['cp']['total'] = $this->_sections['cp']['loop'];
    if ($this->_sections['cp']['total'] == 0)
        $this->_sections['cp']['show'] = false;
} else
    $this->_sections['cp']['total'] = 0;
if ($this->_sections['cp']['show']):

            for ($this->_sections['cp']['index'] = $this->_sections['cp']['start'], $this->_sections['cp']['iteration'] = 1;
                 $this->_sections['cp']['iteration'] <= $this->_sections['cp']['total'];
                 $this->_sections['cp']['index'] += $this->_sections['cp']['step'], $this->_sections['cp']['iteration']++):
$this->_sections['cp']['rownum'] = $this->_sections['cp']['iteration'];
$this->_sections['cp']['index_prev'] = $this->_sections['cp']['index'] - $this->_sections['cp']['step'];
$this->_sections['cp']['index_next'] = $this->_sections['cp']['index'] + $this->_sections['cp']['step'];
$this->_sections['cp']['first']      = ($this->_sections['cp']['iteration'] == 1);
$this->_sections['cp']['last']       = ($this->_sections['cp']['iteration'] == $this->_sections['cp']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
		</div>
		<br />
		<button type="button" name="pluss" id="pluss" class="pr" onclick="select_nuevo_pr()">Agregar publicación</button>
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
				<?php unset($this->_sections['promoDesta']);
$this->_sections['promoDesta']['name'] = 'promoDesta';
$this->_sections['promoDesta']['loop'] = is_array($_loop=$this->_tpl_vars['pDest']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['promoDesta']['show'] = true;
$this->_sections['promoDesta']['max'] = $this->_sections['promoDesta']['loop'];
$this->_sections['promoDesta']['step'] = 1;
$this->_sections['promoDesta']['start'] = $this->_sections['promoDesta']['step'] > 0 ? 0 : $this->_sections['promoDesta']['loop']-1;
if ($this->_sections['promoDesta']['show']) {
    $this->_sections['promoDesta']['total'] = $this->_sections['promoDesta']['loop'];
    if ($this->_sections['promoDesta']['total'] == 0)
        $this->_sections['promoDesta']['show'] = false;
} else
    $this->_sections['promoDesta']['total'] = 0;
if ($this->_sections['promoDesta']['show']):

            for ($this->_sections['promoDesta']['index'] = $this->_sections['promoDesta']['start'], $this->_sections['promoDesta']['iteration'] = 1;
                 $this->_sections['promoDesta']['iteration'] <= $this->_sections['promoDesta']['total'];
                 $this->_sections['promoDesta']['index'] += $this->_sections['promoDesta']['step'], $this->_sections['promoDesta']['iteration']++):
$this->_sections['promoDesta']['rownum'] = $this->_sections['promoDesta']['iteration'];
$this->_sections['promoDesta']['index_prev'] = $this->_sections['promoDesta']['index'] - $this->_sections['promoDesta']['step'];
$this->_sections['promoDesta']['index_next'] = $this->_sections['promoDesta']['index'] + $this->_sections['promoDesta']['step'];
$this->_sections['promoDesta']['first']      = ($this->_sections['promoDesta']['iteration'] == 1);
$this->_sections['promoDesta']['last']       = ($this->_sections['promoDesta']['iteration'] == $this->_sections['promoDesta']['total']);
?>
				<tr class="label_izq">
					<td><?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['descripcionVc']; ?>
</td>
					<td>
						<input type="radio" name="m<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
" id="m<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
" value="" />
						<div id="d<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
" class="radio_no_selected">&nbsp;</div>
						<input type="hidden" name="r[]" id="r[]" value="m<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
"/>
					</td>
				</tr>	
				<?php endfor; endif; ?>
			</tbody>
		</table>
	</div>
<!--***********************************************************************************************************************************-->	
	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Palabras clave</p>
		<p class="label_izq">Palabras clave de búsqueda (Separadas por comas): </p>
		<textarea name="pclave" id="pclave"></textarea>
	</div>
	<input type="button" name="cancel" id="cancel" value="Cancelar" onclick="cancelacion2()" />
	<input type="button" name="vp" id="vp" value="Vista previa" />	
	<input type="submit" name="enviar" id="enviar" value="<?php echo $this->_tpl_vars['boton']; ?>
" />	
</form>