<?php /* Smarty version 2.6.20, created on 2012-08-17 12:14:47
         compiled from beta.html.tpl */ ?>
<html>
	<head>
	<?php echo '
	<style>
	
		.connected, .sortable, .exclude, .handles {
			margin: auto;
			padding: 0;
			width: 310px;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		
		.connected li, .sortable li, .exclude li, .handles li {
			list-style: none;
			border: 1px solid #CCC;
			background: #F6F6F6;
			font-family: "Tahoma";
			color: #1C94C4;
			margin: 5px;
			padding: 5px;
			height: 22px;
		}
		.handles span {
			cursor: move;
		}
		li.disabled {
			opacity: 0.5;
		}
		.sortable.grid li {
			line-height: 80px;
			float: left;
			width: 80px;
			height: 80px;
			text-align: center;
		}
	
		#connected {
			width: 440px;
			overflow: hidden;
			margin: auto;
		}
		.connected {
			float: left;
			width: 200px;
		}
		.connected.no2 {
			float: right;
		}

	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/jquery.sortable.js"></script>
	<script>
		$(function() {
			$(\'.sortable\').sortable();
			$(\'.handles\').sortable({
				handle: \'span\'
			});
			$(\'.connected\').sortable({
				connectWith: \'.connected\'
			});
			$(\'.exclude\').sortable({
				items: \':not(.disabled)\'
			});
			
			/*PARA ELIMINAR EL ELEMENTO DE LA TABLA*/
			//$("div#footer").remove();
			$(\'li.cpl\').click(function () {
			var avalor = this.id;
			alert(avalor);
			$("li#"+avalor).remove();
			});
			
		});
		
		function eliminali(){
			
		}
	</script>
	'; ?>

	</head>
<body>
<section id="connected">
		
		<ul class="connected list">
			<p class="instrucciones_cursivas">Publicaciones</p>
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
			<li id="<?php echo $this->_tpl_vars['lpublica'][$this->_sections['listPublicacionesCat']['index']]['id_publicacionSi']; ?>
"><a href="" id="<?php echo $this->_tpl_vars['lpublica'][$this->_sections['listPublicacionesCat']['index']]['id_publicacionSi']; ?>
" class="cpl"><?php echo $this->_tpl_vars['lpublica'][$this->_sections['listPublicacionesCat']['index']]['nombreVc']; ?>
</a></li>
			<?php endfor; endif; ?>	
		</ul>
		<ul class="connected list no2">
			<p class="instrucciones_cursivas">Publicaciones</p>
			<?php unset($this->_sections['allPubli']);
$this->_sections['allPubli']['name'] = 'allPubli';
$this->_sections['allPubli']['loop'] = is_array($_loop=$this->_tpl_vars['allPubli']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['allPubli']['show'] = true;
$this->_sections['allPubli']['max'] = $this->_sections['allPubli']['loop'];
$this->_sections['allPubli']['step'] = 1;
$this->_sections['allPubli']['start'] = $this->_sections['allPubli']['step'] > 0 ? 0 : $this->_sections['allPubli']['loop']-1;
if ($this->_sections['allPubli']['show']) {
    $this->_sections['allPubli']['total'] = $this->_sections['allPubli']['loop'];
    if ($this->_sections['allPubli']['total'] == 0)
        $this->_sections['allPubli']['show'] = false;
} else
    $this->_sections['allPubli']['total'] = 0;
if ($this->_sections['allPubli']['show']):

            for ($this->_sections['allPubli']['index'] = $this->_sections['allPubli']['start'], $this->_sections['allPubli']['iteration'] = 1;
                 $this->_sections['allPubli']['iteration'] <= $this->_sections['allPubli']['total'];
                 $this->_sections['allPubli']['index'] += $this->_sections['allPubli']['step'], $this->_sections['allPubli']['iteration']++):
$this->_sections['allPubli']['rownum'] = $this->_sections['allPubli']['iteration'];
$this->_sections['allPubli']['index_prev'] = $this->_sections['allPubli']['index'] - $this->_sections['allPubli']['step'];
$this->_sections['allPubli']['index_next'] = $this->_sections['allPubli']['index'] + $this->_sections['allPubli']['step'];
$this->_sections['allPubli']['first']      = ($this->_sections['allPubli']['iteration'] == 1);
$this->_sections['allPubli']['last']       = ($this->_sections['allPubli']['iteration'] == $this->_sections['allPubli']['total']);
?>
			<li><a href="" id="<?php echo $this->_tpl_vars['allPubli'][$this->_sections['allPubli']['index']]['id_publicacionSi']; ?>
" class="cpl"><?php echo $this->_tpl_vars['allPubli'][$this->_sections['allPubli']['index']]['nombreVc']; ?>
</a></li>
			<?php endfor; endif; ?>	
		</ul>
	</section>
</body>
</html>