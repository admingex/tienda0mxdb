<?php /* Smarty version 2.6.20, created on 2012-09-13 14:33:30
         compiled from aoc.html.tpl */ ?>

<div class="contenedor-gris">

<form name="aoc" id="aoc" method="post" action="guardarOC.php">
	<input type="button" name="cancel" id="cancel" value="" class="boton-cancel-menu-blanco" onclick="mimensaje()" style='font-size: 13px;'/>
	<input type="submit" name="enviar" id="enviar" value="" class="boton-agregar-oc-blanco" style='font-size: 13px;' />		
	<div class="contenedor-gris-blanco">
		<div id="buss">
		<table>
			<tr class="label_izq">
				<td>Nombre:</td>
				<td><input type="text" class="text" name="nombre" id="nombre" value="" /></td>
				<td><input type="button" name="bus" id="bus" value="" class="boton-buscar" onclick="buscador(form.nombre.value)" /></td>
				<input type="hidden" class="text" name="idp" id="idp" value="<?php echo $this->_tpl_vars['id']; ?>
" />
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
    		<?php unset($this->_sections['catf']);
$this->_sections['catf']['name'] = 'catf';
$this->_sections['catf']['loop'] = is_array($_loop=$this->_tpl_vars['cf']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['catf']['show'] = true;
$this->_sections['catf']['max'] = $this->_sections['catf']['loop'];
$this->_sections['catf']['step'] = 1;
$this->_sections['catf']['start'] = $this->_sections['catf']['step'] > 0 ? 0 : $this->_sections['catf']['loop']-1;
if ($this->_sections['catf']['show']) {
    $this->_sections['catf']['total'] = $this->_sections['catf']['loop'];
    if ($this->_sections['catf']['total'] == 0)
        $this->_sections['catf']['show'] = false;
} else
    $this->_sections['catf']['total'] = 0;
if ($this->_sections['catf']['show']):

            for ($this->_sections['catf']['index'] = $this->_sections['catf']['start'], $this->_sections['catf']['iteration'] = 1;
                 $this->_sections['catf']['iteration'] <= $this->_sections['catf']['total'];
                 $this->_sections['catf']['index'] += $this->_sections['catf']['step'], $this->_sections['catf']['iteration']++):
$this->_sections['catf']['rownum'] = $this->_sections['catf']['iteration'];
$this->_sections['catf']['index_prev'] = $this->_sections['catf']['index'] - $this->_sections['catf']['step'];
$this->_sections['catf']['index_next'] = $this->_sections['catf']['index'] + $this->_sections['catf']['step'];
$this->_sections['catf']['first']      = ($this->_sections['catf']['iteration'] == 1);
$this->_sections['catf']['last']       = ($this->_sections['catf']['iteration'] == $this->_sections['catf']['total']);
?> 
    		<option value="<?php echo $this->_tpl_vars['cf'][$this->_sections['catf']['index']]['id_formatoSi']; ?>
"><?php echo $this->_tpl_vars['cf'][$this->_sections['catf']['index']]['formatoVc']; ?>
</option> 
    		<?php endfor; endif; ?>
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
	<input type="button" name="cancel" id="cancel" value="" class="boton-cancel-menu-blanco" onclick="mimensaje()" style='font-size: 13px;' />
	<input type="submit" name="enviar" id="enviar" value="" class="boton-agregar-oc-blanco" style='font-size: 13px;'/>		
</form>
</div>		