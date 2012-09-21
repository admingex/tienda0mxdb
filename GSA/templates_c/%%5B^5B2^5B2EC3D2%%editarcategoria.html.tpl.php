<?php /* Smarty version 2.6.20, created on 2012-09-13 10:18:23
         compiled from editarcategoria.html.tpl */ ?>
<form name="edit_cat" id="edit_cat" method="post" action="cambios_categoria.php" onSubmit="return checkFields(this)">	
	<input type="button" name="cancel" id="cancel" value="" onclick="cancelacion()" class="boton-cancel-menu" />
	<input type="submit" name="enviar" id="enviar" value="" class="boton-agregar-categoria-menu"/>		
	<div class="contenedor-gris-blanco">
		<?php unset($this->_sections['categoriaDet']);
$this->_sections['categoriaDet']['name'] = 'categoriaDet';
$this->_sections['categoriaDet']['loop'] = is_array($_loop=$this->_tpl_vars['catDetalle']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['categoriaDet']['show'] = true;
$this->_sections['categoriaDet']['max'] = $this->_sections['categoriaDet']['loop'];
$this->_sections['categoriaDet']['step'] = 1;
$this->_sections['categoriaDet']['start'] = $this->_sections['categoriaDet']['step'] > 0 ? 0 : $this->_sections['categoriaDet']['loop']-1;
if ($this->_sections['categoriaDet']['show']) {
    $this->_sections['categoriaDet']['total'] = $this->_sections['categoriaDet']['loop'];
    if ($this->_sections['categoriaDet']['total'] == 0)
        $this->_sections['categoriaDet']['show'] = false;
} else
    $this->_sections['categoriaDet']['total'] = 0;
if ($this->_sections['categoriaDet']['show']):

            for ($this->_sections['categoriaDet']['index'] = $this->_sections['categoriaDet']['start'], $this->_sections['categoriaDet']['iteration'] = 1;
                 $this->_sections['categoriaDet']['iteration'] <= $this->_sections['categoriaDet']['total'];
                 $this->_sections['categoriaDet']['index'] += $this->_sections['categoriaDet']['step'], $this->_sections['categoriaDet']['iteration']++):
$this->_sections['categoriaDet']['rownum'] = $this->_sections['categoriaDet']['iteration'];
$this->_sections['categoriaDet']['index_prev'] = $this->_sections['categoriaDet']['index'] - $this->_sections['categoriaDet']['step'];
$this->_sections['categoriaDet']['index_next'] = $this->_sections['categoriaDet']['index'] + $this->_sections['categoriaDet']['step'];
$this->_sections['categoriaDet']['first']      = ($this->_sections['categoriaDet']['iteration'] == 1);
$this->_sections['categoriaDet']['last']       = ($this->_sections['categoriaDet']['iteration'] == $this->_sections['categoriaDet']['total']);
?>
		<p class="instrucciones_cursivas">Carrusel de promociones</p>
		<table>
			<tr class="label_izq">
				<td>Nombre:</td>
				<td><input type="text" class="text" name="nombre" id="nombre" value="<?php echo $this->_tpl_vars['catDetalle'][$this->_sections['categoriaDet']['index']]['nombreVc']; ?>
" /></td>
			</tr>
			<tr class="label_izq">
				<td>Descripción:</td>
				<td><textarea name="descripcion" id="descripcion" class="text"><?php echo $this->_tpl_vars['catDetalle'][$this->_sections['categoriaDet']['index']]['descripcionVc']; ?>
</textarea></td>				
			</tr>
		</table>
		<input type="hidden" name="idcategoria" id="idcategoria" value="<?php echo $this->_tpl_vars['catDetalle'][$this->_sections['categoriaDet']['index']]['id_categoriaSi']; ?>
" />
		<?php endfor; endif; ?>
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
							<?php unset($this->_sections['listPublicacionesCat']);
$this->_sections['listPublicacionesCat']['name'] = 'listPublicacionesCat';
$this->_sections['listPublicacionesCat']['loop'] = is_array($_loop=$this->_tpl_vars['lpublica']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['listPublicacionesCat']['show'] = true;
$this->_sections['listPublicacionesCat']['max'] = $this->_sections['listPublicacionesCat']['loop'];
$this->_sections['listPublicacionesCat']['step'] = 1;
$this->_sections['listPublicacionesCat']['start'] = $this->_sections['listPublicacionesCat']['step'] > 0 ? 0 : $this->_sections['listPublicacionesCat']['loop']-1;
if ($this->_sections['listPublicacionesCat']['show']) {
    $this->_sections['listPublicacionesCat']['total'] = $this->_sections['listPublicacionesCat']['loop'];
    if ($this->_sections['listPublicacionesCat']['total'] == 0)
        $this->_sections['listPublicacionesCat']['show'] = false;
} else
    $this->_sections['listPublicacionesCat']['total'] = 0;
if ($this->_sections['listPublicacionesCat']['show']):

            for ($this->_sections['listPublicacionesCat']['index'] = $this->_sections['listPublicacionesCat']['start'], $this->_sections['listPublicacionesCat']['iteration'] = 1;
                 $this->_sections['listPublicacionesCat']['iteration'] <= $this->_sections['listPublicacionesCat']['total'];
                 $this->_sections['listPublicacionesCat']['index'] += $this->_sections['listPublicacionesCat']['step'], $this->_sections['listPublicacionesCat']['iteration']++):
$this->_sections['listPublicacionesCat']['rownum'] = $this->_sections['listPublicacionesCat']['iteration'];
$this->_sections['listPublicacionesCat']['index_prev'] = $this->_sections['listPublicacionesCat']['index'] - $this->_sections['listPublicacionesCat']['step'];
$this->_sections['listPublicacionesCat']['index_next'] = $this->_sections['listPublicacionesCat']['index'] + $this->_sections['listPublicacionesCat']['step'];
$this->_sections['listPublicacionesCat']['first']      = ($this->_sections['listPublicacionesCat']['iteration'] == 1);
$this->_sections['listPublicacionesCat']['last']       = ($this->_sections['listPublicacionesCat']['iteration'] == $this->_sections['listPublicacionesCat']['total']);
?>
							<tr id="<?php echo $this->_tpl_vars['lpublica'][$this->_sections['listPublicacionesCat']['index']]['id_publicacionSi']; ?>
" class="label_izq">
								
								<td><?php echo $this->_tpl_vars['lpublica'][$this->_sections['listPublicacionesCat']['index']]['nombreVc']; ?>
</td>
								<td><a href="#" id="<?php echo $this->_tpl_vars['lpublica'][$this->_sections['listPublicacionesCat']['index']]['id_publicacionSi']; ?>
" class="cpl">Eliminar</a></td>
								<input type="hidden" name="pubid[]" id="pubid[]" value="<?php echo $this->_tpl_vars['lpublica'][$this->_sections['listPublicacionesCat']['index']]['id_publicacionSi']; ?>
" />
							</tr>
							<?php endfor; endif; ?>	
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
							<?php unset($this->_sections['ap']);
$this->_sections['ap']['name'] = 'ap';
$this->_sections['ap']['loop'] = is_array($_loop=$this->_tpl_vars['allPubli']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ap']['show'] = true;
$this->_sections['ap']['max'] = $this->_sections['ap']['loop'];
$this->_sections['ap']['step'] = 1;
$this->_sections['ap']['start'] = $this->_sections['ap']['step'] > 0 ? 0 : $this->_sections['ap']['loop']-1;
if ($this->_sections['ap']['show']) {
    $this->_sections['ap']['total'] = $this->_sections['ap']['loop'];
    if ($this->_sections['ap']['total'] == 0)
        $this->_sections['ap']['show'] = false;
} else
    $this->_sections['ap']['total'] = 0;
if ($this->_sections['ap']['show']):

            for ($this->_sections['ap']['index'] = $this->_sections['ap']['start'], $this->_sections['ap']['iteration'] = 1;
                 $this->_sections['ap']['iteration'] <= $this->_sections['ap']['total'];
                 $this->_sections['ap']['index'] += $this->_sections['ap']['step'], $this->_sections['ap']['iteration']++):
$this->_sections['ap']['rownum'] = $this->_sections['ap']['iteration'];
$this->_sections['ap']['index_prev'] = $this->_sections['ap']['index'] - $this->_sections['ap']['step'];
$this->_sections['ap']['index_next'] = $this->_sections['ap']['index'] + $this->_sections['ap']['step'];
$this->_sections['ap']['first']      = ($this->_sections['ap']['iteration'] == 1);
$this->_sections['ap']['last']       = ($this->_sections['ap']['iteration'] == $this->_sections['ap']['total']);
?>
							<tr id="<?php echo $this->_tpl_vars['allPubli'][$this->_sections['ap']['index']]['id_publicacionSi']; ?>
" class="label_izq"  style="cursor: move; ">
								<td><a href="javascript: fn_agregar_public(<?php echo $this->_tpl_vars['allPubli'][$this->_sections['ap']['index']]['id_publicacionSi']; ?>
);"><?php echo $this->_tpl_vars['allPubli'][$this->_sections['ap']['index']]['nombreVc']; ?>
</a>
									<input type="hidden" name="h<?php echo $this->_tpl_vars['allPubli'][$this->_sections['ap']['index']]['id_publicacionSi']; ?>
" id="h<?php echo $this->_tpl_vars['allPubli'][$this->_sections['ap']['index']]['id_publicacionSi']; ?>
" value="<?php echo $this->_tpl_vars['allPubli'][$this->_sections['ap']['index']]['nombreVc']; ?>
" />
								</td>
							</tr>
							<?php endfor; endif; ?>
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
				<tr class="label_izq" >
					<td><?php echo $this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['descripcionVc']; ?>
</td>
					<td>
						<?php if ($this->_tpl_vars['pDest'][$this->_sections['promoDesta']['index']]['publicadoBi'] == '1'): ?>
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
		<?php unset($this->_sections['categoriaDet']);
$this->_sections['categoriaDet']['name'] = 'categoriaDet';
$this->_sections['categoriaDet']['loop'] = is_array($_loop=$this->_tpl_vars['catDetalle']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['categoriaDet']['show'] = true;
$this->_sections['categoriaDet']['max'] = $this->_sections['categoriaDet']['loop'];
$this->_sections['categoriaDet']['step'] = 1;
$this->_sections['categoriaDet']['start'] = $this->_sections['categoriaDet']['step'] > 0 ? 0 : $this->_sections['categoriaDet']['loop']-1;
if ($this->_sections['categoriaDet']['show']) {
    $this->_sections['categoriaDet']['total'] = $this->_sections['categoriaDet']['loop'];
    if ($this->_sections['categoriaDet']['total'] == 0)
        $this->_sections['categoriaDet']['show'] = false;
} else
    $this->_sections['categoriaDet']['total'] = 0;
if ($this->_sections['categoriaDet']['show']):

            for ($this->_sections['categoriaDet']['index'] = $this->_sections['categoriaDet']['start'], $this->_sections['categoriaDet']['iteration'] = 1;
                 $this->_sections['categoriaDet']['iteration'] <= $this->_sections['categoriaDet']['total'];
                 $this->_sections['categoriaDet']['index'] += $this->_sections['categoriaDet']['step'], $this->_sections['categoriaDet']['iteration']++):
$this->_sections['categoriaDet']['rownum'] = $this->_sections['categoriaDet']['iteration'];
$this->_sections['categoriaDet']['index_prev'] = $this->_sections['categoriaDet']['index'] - $this->_sections['categoriaDet']['step'];
$this->_sections['categoriaDet']['index_next'] = $this->_sections['categoriaDet']['index'] + $this->_sections['categoriaDet']['step'];
$this->_sections['categoriaDet']['first']      = ($this->_sections['categoriaDet']['iteration'] == 1);
$this->_sections['categoriaDet']['last']       = ($this->_sections['categoriaDet']['iteration'] == $this->_sections['categoriaDet']['total']);
?>
		<textarea name="pclave" id="pclave"><?php echo $this->_tpl_vars['catDetalle'][$this->_sections['categoriaDet']['index']]['palabras_claveVc']; ?>
</textarea>
		<?php endfor; endif; ?>
	</div>
<!--***********************************************************************************************************************************-->	
	<input type="button" name="cancel"  value="" onclick="cancelacion()" class="boton-cancel-menu"  />
	<input type="submit" name="enviar"  value="" class="boton-agregar-categoria-menu" />
</form>