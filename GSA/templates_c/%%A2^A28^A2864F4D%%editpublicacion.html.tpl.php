<?php /* Smarty version 2.6.20, created on 2012-08-24 10:29:30
         compiled from editpublicacion.html.tpl */ ?>
<?php unset($this->_sections['ipub']);
$this->_sections['ipub']['name'] = 'ipub';
$this->_sections['ipub']['show'] = true;
$this->_sections['ipub']['loop'] = 1;
$this->_sections['ipub']['max'] = $this->_sections['ipub']['loop'];
$this->_sections['ipub']['step'] = 1;
$this->_sections['ipub']['start'] = $this->_sections['ipub']['step'] > 0 ? 0 : $this->_sections['ipub']['loop']-1;
if ($this->_sections['ipub']['show']) {
    $this->_sections['ipub']['total'] = $this->_sections['ipub']['loop'];
    if ($this->_sections['ipub']['total'] == 0)
        $this->_sections['ipub']['show'] = false;
} else
    $this->_sections['ipub']['total'] = 0;
if ($this->_sections['ipub']['show']):

            for ($this->_sections['ipub']['index'] = $this->_sections['ipub']['start'], $this->_sections['ipub']['iteration'] = 1;
                 $this->_sections['ipub']['iteration'] <= $this->_sections['ipub']['total'];
                 $this->_sections['ipub']['index'] += $this->_sections['ipub']['step'], $this->_sections['ipub']['iteration']++):
$this->_sections['ipub']['rownum'] = $this->_sections['ipub']['iteration'];
$this->_sections['ipub']['index_prev'] = $this->_sections['ipub']['index'] - $this->_sections['ipub']['step'];
$this->_sections['ipub']['index_next'] = $this->_sections['ipub']['index'] + $this->_sections['ipub']['step'];
$this->_sections['ipub']['first']      = ($this->_sections['ipub']['iteration'] == 1);
$this->_sections['ipub']['last']       = ($this->_sections['ipub']['iteration'] == $this->_sections['ipub']['total']);
?>
<form name="edit_pub" id="edit_pub" method="post" action="cambios_publicacion.php" onSubmit="return checkFields(this)">
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
					<input type="text" class="text" name="nombre" id="nombre" value="<?php echo $this->_tpl_vars['infopublic'][$this->_sections['ipub']['index']]['nombreVc']; ?>
" />
				</td>
			</tr>
			<tr class="label_izq">
				<td>Descripción:</td>
				<td><textarea name="descripcion" id="descripcion" class="text"><?php echo $this->_tpl_vars['infopublic'][$this->_sections['ipub']['index']]['descripcionVc']; ?>
</textarea></td>				
			</tr>
		</table>
		<input type="hidden" class="text" name="idpublicacion" id="idpublicacion" value="<?php echo $this->_tpl_vars['infopublic'][$this->_sections['ipub']['index']]['id_publicacionSi']; ?>
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
					<td colspan="2">&nbsp;</td>
				</tr>
			</thead>			
			<tbody>
				<?php unset($this->_sections['aocf']);
$this->_sections['aocf']['name'] = 'aocf';
$this->_sections['aocf']['loop'] = is_array($_loop=$this->_tpl_vars['allocf']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['aocf']['show'] = true;
$this->_sections['aocf']['max'] = $this->_sections['aocf']['loop'];
$this->_sections['aocf']['step'] = 1;
$this->_sections['aocf']['start'] = $this->_sections['aocf']['step'] > 0 ? 0 : $this->_sections['aocf']['loop']-1;
if ($this->_sections['aocf']['show']) {
    $this->_sections['aocf']['total'] = $this->_sections['aocf']['loop'];
    if ($this->_sections['aocf']['total'] == 0)
        $this->_sections['aocf']['show'] = false;
} else
    $this->_sections['aocf']['total'] = 0;
if ($this->_sections['aocf']['show']):

            for ($this->_sections['aocf']['index'] = $this->_sections['aocf']['start'], $this->_sections['aocf']['iteration'] = 1;
                 $this->_sections['aocf']['iteration'] <= $this->_sections['aocf']['total'];
                 $this->_sections['aocf']['index'] += $this->_sections['aocf']['step'], $this->_sections['aocf']['iteration']++):
$this->_sections['aocf']['rownum'] = $this->_sections['aocf']['iteration'];
$this->_sections['aocf']['index_prev'] = $this->_sections['aocf']['index'] - $this->_sections['aocf']['step'];
$this->_sections['aocf']['index_next'] = $this->_sections['aocf']['index'] + $this->_sections['aocf']['step'];
$this->_sections['aocf']['first']      = ($this->_sections['aocf']['iteration'] == 1);
$this->_sections['aocf']['last']       = ($this->_sections['aocf']['iteration'] == $this->_sections['aocf']['total']);
?>
				<tr class="label_izq">
					<td><?php echo $this->_tpl_vars['allocf'][$this->_sections['aocf']['index']]['oc']; ?>
</td>
					<td><?php echo $this->_tpl_vars['allocf'][$this->_sections['aocf']['index']]['nombreVc']; ?>
</td>
					<td><?php echo $this->_tpl_vars['allocf'][$this->_sections['aocf']['index']]['formatoVc']; ?>
</td>
					<td><a class="editar_oc" id="<?php echo $this->_tpl_vars['allocf'][$this->_sections['aocf']['index']]['oc_id']; ?>
" href="#">Editar</a></td>
					<td><a class="elimina_oc" href="#" id="<?php echo $this->_tpl_vars['allocf'][$this->_sections['aocf']['index']]['oc_id']; ?>
">Eliminar</a></td>
				</tr>
				<?php endfor; endif; ?>
			</tbody>
		</table>
		<br />
		<button type="button" onclick="miDialog()"  >Agregar order class</button>
		<div id="dialogo">
   		
		</div>
	</div>
<!--*****************************      PUBLICACIONES A SUGERIR            ************************************-->

	<div class="contenedor-gris-blanco">
		<p class="instrucciones_cursivas">Publicaciones a sugerir (Precio especial al agregar al carrito)</p>
		<div id="new_sele2">
			
			<select name="Es1" id="Es1">
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
				<option 
				<?php if ($this->_tpl_vars['cPST'][0]['oc_id'] == $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']): ?>
				selected="selected" 
				<?php endif; ?>				
				value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>

			<br id="Ebs2"/>
			<select name="Es2" id="Es2">
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
				<option
				<?php if ($this->_tpl_vars['cPST'][1]['oc_id'] == $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']): ?>
				selected="selected" 
				<?php endif; ?>				
				value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
			
			<br id="Ebs3"/>
			<select name="Es3" id="Es3">
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
				<option
				<?php if ($this->_tpl_vars['cPST'][2]['oc_id'] == $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']): ?>
				selected="selected" 
				<?php endif; ?> 
				value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
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
				<option
				<?php if ($this->_tpl_vars['cPRT'][0]['oc_id'] == $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']): ?>
				selected="selected" 
				<?php endif; ?>	 
				value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
			
			<br id="Ebr2"/>
			<select name="Er2" id="Er2">
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
				<option 
				<?php if ($this->_tpl_vars['cPRT'][1]['oc_id'] == $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']): ?>
				selected="selected" 
				<?php endif; ?>	 
				value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
			
			<br id="Ebr3"/>
			<select name="Er3" id="Er3">
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
				<option 
				<?php if ($this->_tpl_vars['cPRT'][2]['oc_id'] == $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']): ?>
				selected="selected" 
				<?php endif; ?>	 
				value="<?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['oc_id']; ?>
"><?php echo $this->_tpl_vars['catpubli'][$this->_sections['cp']['index']]['nombreVc']; ?>
</option>
				<?php endfor; endif; ?>
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
						<?php if ($this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['publicadoBi'] == 1): ?>
						<input type="radio" name="m<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
" id="m<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
" value="<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
"
						checked="checked"
						 />
						<div id="d<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
" class="radio_selected">&nbsp;</div>
						<?php else: ?>
						<input type="radio" name="m<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
" id="m<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
" value="" />
						<div id="d<?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['id_promocionIn']; ?>
" class="radio_no_selected">&nbsp;</div>
						<?php endif; ?>
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
		<textarea name="pclave" id="pclave"><?php echo $this->_tpl_vars['infopublic'][$this->_sections['ipub']['index']]['palabras_claveVc']; ?>
</textarea>
	</div>
	<input type="button" name="cancel" id="cancel" value="Cancelar" onclick="cancelacion2()" />
	<input type="button" name="vp" id="vp" value="Vista previa" />	
	<input type="submit" name="enviar" id="enviar" value="<?php echo $this->_tpl_vars['boton']; ?>
" />	
</form>		
<?php endfor; endif; ?>