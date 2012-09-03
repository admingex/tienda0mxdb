<?php /* Smarty version 2.6.20, created on 2012-08-07 13:33:02
         compiled from admincategorias.html.tpl */ ?>
<div class="contenedor-gris-blanco">
	<table class="css3" cellspacing="0" id="grilla_publicaciones">
		<thead>
			<tr class="label_izq">
				<td><?php echo $this->_tpl_vars['tituloCelda']; ?>
</td>
				<td>Descripción</td>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody id="0">
		<?php unset($this->_sections['adCat']);
$this->_sections['adCat']['name'] = 'adCat';
$this->_sections['adCat']['loop'] = is_array($_loop=$this->_tpl_vars['adminCategorias']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['adCat']['show'] = true;
$this->_sections['adCat']['max'] = $this->_sections['adCat']['loop'];
$this->_sections['adCat']['step'] = 1;
$this->_sections['adCat']['start'] = $this->_sections['adCat']['step'] > 0 ? 0 : $this->_sections['adCat']['loop']-1;
if ($this->_sections['adCat']['show']) {
    $this->_sections['adCat']['total'] = $this->_sections['adCat']['loop'];
    if ($this->_sections['adCat']['total'] == 0)
        $this->_sections['adCat']['show'] = false;
} else
    $this->_sections['adCat']['total'] = 0;
if ($this->_sections['adCat']['show']):

            for ($this->_sections['adCat']['index'] = $this->_sections['adCat']['start'], $this->_sections['adCat']['iteration'] = 1;
                 $this->_sections['adCat']['iteration'] <= $this->_sections['adCat']['total'];
                 $this->_sections['adCat']['index'] += $this->_sections['adCat']['step'], $this->_sections['adCat']['iteration']++):
$this->_sections['adCat']['rownum'] = $this->_sections['adCat']['iteration'];
$this->_sections['adCat']['index_prev'] = $this->_sections['adCat']['index'] - $this->_sections['adCat']['step'];
$this->_sections['adCat']['index_next'] = $this->_sections['adCat']['index'] + $this->_sections['adCat']['step'];
$this->_sections['adCat']['first']      = ($this->_sections['adCat']['iteration'] == 1);
$this->_sections['adCat']['last']       = ($this->_sections['adCat']['iteration'] == $this->_sections['adCat']['total']);
?>					
			<tr class="label_izq">
				<td><?php echo $this->_tpl_vars['adminCategorias'][$this->_sections['adCat']['index']]['nombreVc']; ?>
</td>
				<td><?php echo $this->_tpl_vars['adminCategorias'][$this->_sections['adCat']['index']]['descripcionVc']; ?>
</td>
				<?php if ($this->_tpl_vars['modo'] == 'publicaciones'): ?>
				<td><a href="editpublic.php?id=<?php echo $this->_tpl_vars['adminCategorias'][$this->_sections['adCat']['index']]['id_publicacionSi']; ?>
">Editar</a></td>
				<td><a href="#" id="<?php echo $this->_tpl_vars['adminCategorias'][$this->_sections['adCat']['index']]['id_publicacionSi']; ?>
" class="elimina_pub">ELiminar</a></td>
				<?php else: ?>
				<td><a href="editcat.php?id=<?php echo $this->_tpl_vars['adminCategorias'][$this->_sections['adCat']['index']]['id_categoriaSi']; ?>
">Editar</a></td>
				<?php endif; ?>
			</tr>
		<?php endfor; endif; ?>
		</tbody>
	</table>
	<?php if ($this->_tpl_vars['modo'] == 'publicaciones'): ?>
	<br />
	<div id="plus"><button onclick="nueva_publicacion()">Agregar publicación</button></div>
	<?php endif; ?>
</div>