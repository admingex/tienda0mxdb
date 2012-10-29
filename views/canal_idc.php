
<div style="width: 700px; margin-left: 20px;">
<?php 
	echo "<form id='form_filtro_formatos' method='post' action='/tienda/publicacion/ofertas/".$id_publicacion."'>";				
?>	
	<img src="<?php echo TIENDA?>images/Kiosco_canal_idc.jpg" />
	
	<!--<div style="border: solid 1px #800; height: 40px; width: 40px; position: absolute ; top: 166px; margin-left: 317px; cursor: pointer">		
	</div>-->
	<div style="height: 40px; width: 40px; position: absolute; top: 245px; margin-left: 250px; cursor: pointer; background-color: #FFF; filter: alpha(opacity=0); opacity: 0" onclick="activa_check(4)">		
	</div>
	<div style="height: 40px; width: 40px; position: absolute; top: 293px; margin-left: 203px; cursor: pointer; background-color: #FFF; filter: alpha(opacity=0); opacity: 0" onclick="activa_check(1)">		
	</div>
	<script>
		function activa_check(id){			
			$('#chk_formato'+id).attr('checked', true)	
			$('#chk_formato'+id).click();
		}
	</script>
<?php

	echo "<input type='checkbox' id='chk_formato4' name='chk_formato4' value='4' style='display: none'/>";
	echo "<input type='checkbox' id='chk_formato1' name='chk_formato1' value='1' style='display: none'/>";
	echo "</form>"; 
?>
</div>
