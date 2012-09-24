<?php /* Smarty version 2.6.20, created on 2012-09-12 17:53:07
         compiled from inicio.html.tpl */ ?>
		<form name="aph" id="aph" method="post" action="gCarruseldePromociones.php">			
			<div class="contenedor-gris-blanco">
				<p class="instrucciones_cursivas">Carrusel de promociones <input type="submit" name="ok" id="ok" value="" class="boton-guardar-home" />	</p>
				<table class="css3" cellspacing="0" >
					<thead>
						<tr class="label_izq">
							<td>Promoción</td>
							<td>Descripción</td>
							<td>Vigencia</td>
							<td>Mostrar en</td>
						</tr>
					</thead>
					<tbody>
						<?php unset($this->_sections['promoCarr']);
$this->_sections['promoCarr']['name'] = 'promoCarr';
$this->_sections['promoCarr']['loop'] = is_array($_loop=$this->_tpl_vars['promoCarrucel']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['promoCarr']['show'] = true;
$this->_sections['promoCarr']['max'] = $this->_sections['promoCarr']['loop'];
$this->_sections['promoCarr']['step'] = 1;
$this->_sections['promoCarr']['start'] = $this->_sections['promoCarr']['step'] > 0 ? 0 : $this->_sections['promoCarr']['loop']-1;
if ($this->_sections['promoCarr']['show']) {
    $this->_sections['promoCarr']['total'] = $this->_sections['promoCarr']['loop'];
    if ($this->_sections['promoCarr']['total'] == 0)
        $this->_sections['promoCarr']['show'] = false;
} else
    $this->_sections['promoCarr']['total'] = 0;
if ($this->_sections['promoCarr']['show']):

            for ($this->_sections['promoCarr']['index'] = $this->_sections['promoCarr']['start'], $this->_sections['promoCarr']['iteration'] = 1;
                 $this->_sections['promoCarr']['iteration'] <= $this->_sections['promoCarr']['total'];
                 $this->_sections['promoCarr']['index'] += $this->_sections['promoCarr']['step'], $this->_sections['promoCarr']['iteration']++):
$this->_sections['promoCarr']['rownum'] = $this->_sections['promoCarr']['iteration'];
$this->_sections['promoCarr']['index_prev'] = $this->_sections['promoCarr']['index'] - $this->_sections['promoCarr']['step'];
$this->_sections['promoCarr']['index_next'] = $this->_sections['promoCarr']['index'] + $this->_sections['promoCarr']['step'];
$this->_sections['promoCarr']['first']      = ($this->_sections['promoCarr']['iteration'] == 1);
$this->_sections['promoCarr']['last']       = ($this->_sections['promoCarr']['iteration'] == $this->_sections['promoCarr']['total']);
?>					
						<tr class="label_izq">
							<td><?php echo $this->_tpl_vars['promoCarrucel'][$this->_sections['promoCarr']['index']]['nombre']; ?>
</td>
							<td><?php echo $this->_tpl_vars['promoCarrucel'][$this->_sections['promoCarr']['index']]['descripcion']; ?>
</td>
							<td><?php echo $this->_tpl_vars['promoCarrucel'][$this->_sections['promoCarr']['index']]['vigencia']; ?>
</td>
							<td><select name="<?php echo $this->_tpl_vars['promoCarrucel'][$this->_sections['promoCarr']['index']]['id_promo']; ?>
" id="<?php echo $this->_tpl_vars['promoCarrucel'][$this->_sections['promoCarr']['index']]['id_promo']; ?>
">
									<option value="1"
									<?php if ($this->_tpl_vars['promoCarrucel'][$this->_sections['promoCarr']['index']]['bcarrusel'] == '1'): ?>
									selected='selected'
									<?php endif; ?>
									>Fija</option>									
									<option value="0"									
									<?php if ($this->_tpl_vars['promoCarrucel'][$this->_sections['promoCarr']['index']]['bcarrusel'] == '0'): ?>
									selected='selected' value="0"
									<?php endif; ?>
									>Variable</option>
									<option value="NULL"
									<?php if ($this->_tpl_vars['promoCarrucel'][$this->_sections['promoCarr']['index']]['bcarrusel'] == ''): ?>
									selected='selected' 
									<?php endif; ?>
									>No Mostrar</option>
								</select>
								<input type="hidden" name="cp[]" id="cp[]" value="<?php echo $this->_tpl_vars['promoCarrucel'][$this->_sections['promoCarr']['index']]['id_promo']; ?>
">
							</td>
						</tr>
						<?php endfor; endif; ?>
					</tbody>
				</table>
				<div id="AjaxResult0">
				</div>
			</div>
		</form>	
			<!--***************************************--->
		<form name="aph2" id="aph2" method="post" action="gListadoHome.php">	
			<div class="contenedor-gris-blanco" id="LH">
				<p class="instrucciones_cursivas">Listado Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					<input type="submit" name="ok1" id="ok1" value="" class="boton-guardar-home" /></p>
				<table cellspacing="0" cellpadding="2" class="css3">
					<thead>
						<tr id="0" class="label_izq">
							<td>Promoción</td>
							<td>Descripción</td>
							<td>Vigencia</td>
							<td>Mostrar</td>
						</tr>
					</thead>
					<tbody id="table-3">
						<?php unset($this->_sections['listPromo']);
$this->_sections['listPromo']['name'] = 'listPromo';
$this->_sections['listPromo']['loop'] = is_array($_loop=$this->_tpl_vars['listaPromo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['listPromo']['show'] = true;
$this->_sections['listPromo']['max'] = $this->_sections['listPromo']['loop'];
$this->_sections['listPromo']['step'] = 1;
$this->_sections['listPromo']['start'] = $this->_sections['listPromo']['step'] > 0 ? 0 : $this->_sections['listPromo']['loop']-1;
if ($this->_sections['listPromo']['show']) {
    $this->_sections['listPromo']['total'] = $this->_sections['listPromo']['loop'];
    if ($this->_sections['listPromo']['total'] == 0)
        $this->_sections['listPromo']['show'] = false;
} else
    $this->_sections['listPromo']['total'] = 0;
if ($this->_sections['listPromo']['show']):

            for ($this->_sections['listPromo']['index'] = $this->_sections['listPromo']['start'], $this->_sections['listPromo']['iteration'] = 1;
                 $this->_sections['listPromo']['iteration'] <= $this->_sections['listPromo']['total'];
                 $this->_sections['listPromo']['index'] += $this->_sections['listPromo']['step'], $this->_sections['listPromo']['iteration']++):
$this->_sections['listPromo']['rownum'] = $this->_sections['listPromo']['iteration'];
$this->_sections['listPromo']['index_prev'] = $this->_sections['listPromo']['index'] - $this->_sections['listPromo']['step'];
$this->_sections['listPromo']['index_next'] = $this->_sections['listPromo']['index'] + $this->_sections['listPromo']['step'];
$this->_sections['listPromo']['first']      = ($this->_sections['listPromo']['iteration'] == 1);
$this->_sections['listPromo']['last']       = ($this->_sections['listPromo']['iteration'] == $this->_sections['listPromo']['total']);
?>
						<tr id="<?php echo $this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['posicion']; ?>
" class="label_izq">
						
							<td><?php echo $this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['nombre']; ?>
</td>
							<td><?php echo $this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['descripcion']; ?>
</td>
							<td><?php echo $this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['vigencia']; ?>
</td>
							<td>
								<input type="checkbox" name="c<?php echo $this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['id_promo']; ?>
" id="c<?php echo $this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['id_promo']; ?>
"
								<?php if ($this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['hestado'] == '1'): ?>
				                 checked
				                 <?php else: ?>                
				                 <?php endif; ?>
								/>
								<div id="d<?php echo $this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['id_promo']; ?>
"
								<?php if ($this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['hestado'] == '1'): ?>
				                 class="checkbox_selected"
				                 <?php else: ?>
				                 class="checkbox_no_selected"
				                 <?php endif; ?> 
								>&nbsp;</div>
								<input type="hidden" name="lh[]" id="lh[]" value="<?php echo $this->_tpl_vars['listaPromo'][$this->_sections['listPromo']['index']]['id_promo']; ?>
">
							</td>
						</tr>
						<?php endfor; endif; ?>
					</tbody>
				</table>
				<div id="AjaxResult">
				</div>
			</div>
		</form>
			
			<!--***************************************--->
		<form name="aph3" id="aph3" method="post" action="gPromoEspeciales.php">	
			<div class="contenedor-gris-blanco" id="PE">
				<p class="instrucciones_cursivas">Promociones Especiales <input type="submit" name="ok2" id="ok2" value="" class="boton-guardar-home" /></p>
				<table cellspacing="0" cellpadding="2" class="css3">
					<thead>
						<tr id="0" class="label_izq">
							<td>Promoción</td>
							<td>Descripción</td>
							<td>Vigencia</td>
							<td>Mostrar</td>
						</tr>
					</thead>
					<tbody id="table-4">
						<?php unset($this->_sections['listEspe']);
$this->_sections['listEspe']['name'] = 'listEspe';
$this->_sections['listEspe']['loop'] = is_array($_loop=$this->_tpl_vars['listaEspe']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['listEspe']['show'] = true;
$this->_sections['listEspe']['max'] = $this->_sections['listEspe']['loop'];
$this->_sections['listEspe']['step'] = 1;
$this->_sections['listEspe']['start'] = $this->_sections['listEspe']['step'] > 0 ? 0 : $this->_sections['listEspe']['loop']-1;
if ($this->_sections['listEspe']['show']) {
    $this->_sections['listEspe']['total'] = $this->_sections['listEspe']['loop'];
    if ($this->_sections['listEspe']['total'] == 0)
        $this->_sections['listEspe']['show'] = false;
} else
    $this->_sections['listEspe']['total'] = 0;
if ($this->_sections['listEspe']['show']):

            for ($this->_sections['listEspe']['index'] = $this->_sections['listEspe']['start'], $this->_sections['listEspe']['iteration'] = 1;
                 $this->_sections['listEspe']['iteration'] <= $this->_sections['listEspe']['total'];
                 $this->_sections['listEspe']['index'] += $this->_sections['listEspe']['step'], $this->_sections['listEspe']['iteration']++):
$this->_sections['listEspe']['rownum'] = $this->_sections['listEspe']['iteration'];
$this->_sections['listEspe']['index_prev'] = $this->_sections['listEspe']['index'] - $this->_sections['listEspe']['step'];
$this->_sections['listEspe']['index_next'] = $this->_sections['listEspe']['index'] + $this->_sections['listEspe']['step'];
$this->_sections['listEspe']['first']      = ($this->_sections['listEspe']['iteration'] == 1);
$this->_sections['listEspe']['last']       = ($this->_sections['listEspe']['iteration'] == $this->_sections['listEspe']['total']);
?>
						<tr id="<?php echo $this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['posicion']; ?>
" class="label_izq">
							<td><?php echo $this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['nombre']; ?>
</td>
							<td><?php echo $this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['descripcion']; ?>
</td>
							<td><?php echo $this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['vigencia']; ?>
</td>
							<td>
								<input type="checkbox" name="c<?php echo $this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['id_promo']; ?>
" id="c<?php echo $this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['id_promo']; ?>
" 
							 <?php if ($this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['hestado'] == '1'): ?>
                 checked
                 <?php else: ?>                
                 <?php endif; ?>
								/>
								<div id="d<?php echo $this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['id_promo']; ?>
"
								<?php if ($this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['hestado'] == '1'): ?>
								 class="checkbox_selected"
								 <?php else: ?>
								 class="checkbox_no_selected"
								 <?php endif; ?>
								 >&nbsp;</div>
								 <input type="hidden" name="pe[]" id="pe[]" value="<?php echo $this->_tpl_vars['listaEspe'][$this->_sections['listEspe']['index']]['id_promo']; ?>
">
							</td>
						</tr>
						<?php endfor; endif; ?>	
					</tbody>
				</table>

			</div>
		</form>