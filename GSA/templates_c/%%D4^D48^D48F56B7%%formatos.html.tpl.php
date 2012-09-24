<?php /* Smarty version 2.6.20, created on 2012-09-13 10:18:27
         compiled from formatos.html.tpl */ ?>
<div class="contenedor-gris-blanco">
	<p class="instrucciones_cursivas">Formatos</p>
	<form name="formatos" id="formatos">
	<table class="css3" cellspacing="0" id="grilla">
		<thead>
			<tr class="label_izq">
				<td>Nombre:<input type="text" name="nf" id="nf" class="text" onkeypress="tenterf(event)" /></td>
				<td><input type="button" name="adp" id="adp" value="" class="boton-agregar" onclick="javascript: fn_agregar();" /></td>
			</tr>
		</thead>
		<tbody>
			<?php unset($this->_sections['cf']);
$this->_sections['cf']['name'] = 'cf';
$this->_sections['cf']['loop'] = is_array($_loop=$this->_tpl_vars['cformatos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cf']['show'] = true;
$this->_sections['cf']['max'] = $this->_sections['cf']['loop'];
$this->_sections['cf']['step'] = 1;
$this->_sections['cf']['start'] = $this->_sections['cf']['step'] > 0 ? 0 : $this->_sections['cf']['loop']-1;
if ($this->_sections['cf']['show']) {
    $this->_sections['cf']['total'] = $this->_sections['cf']['loop'];
    if ($this->_sections['cf']['total'] == 0)
        $this->_sections['cf']['show'] = false;
} else
    $this->_sections['cf']['total'] = 0;
if ($this->_sections['cf']['show']):

            for ($this->_sections['cf']['index'] = $this->_sections['cf']['start'], $this->_sections['cf']['iteration'] = 1;
                 $this->_sections['cf']['iteration'] <= $this->_sections['cf']['total'];
                 $this->_sections['cf']['index'] += $this->_sections['cf']['step'], $this->_sections['cf']['iteration']++):
$this->_sections['cf']['rownum'] = $this->_sections['cf']['iteration'];
$this->_sections['cf']['index_prev'] = $this->_sections['cf']['index'] - $this->_sections['cf']['step'];
$this->_sections['cf']['index_next'] = $this->_sections['cf']['index'] + $this->_sections['cf']['step'];
$this->_sections['cf']['first']      = ($this->_sections['cf']['iteration'] == 1);
$this->_sections['cf']['last']       = ($this->_sections['cf']['iteration'] == $this->_sections['cf']['total']);
?>
			<tr class="label_izq">
				<td><?php echo $this->_tpl_vars['cformatos'][$this->_sections['cf']['index']]['formatoVc']; ?>
</td>
				<td><a href="#" class="elimina">Eliminar</a></td>
			</tr>
			<?php endfor; endif; ?>
		</tbody>
	</table>
	</form>
</div>