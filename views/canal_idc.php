<style type="text/css">
	#contenedor_idc{
		width: 700px; 
		margin-left: 20px;
	}	
	
	#selector_pdf{		
		top: 247px; 
		margin-left: 258px; 		
	}
	
	#selector_asisprint{		 
		top: 288px; 
		margin-left: 360px; 			
	}
	
	#selector_contenido{
		top: 387px; 
		margin-left: 305px;
	}
	
	#selector_asistel{
		top: 415px; 
		margin-left: 375px; 
	}
	
	#selector_video{
		top: 373px; 
		margin-left: 410px; 
	}
	
	#selector_sempersona{
		top: 287px; 
		margin-left: 515px;
	}
	
	#selector_semonline{
		top: 322px; 
		margin-left: 448px;
	}
	
	#selector_carpeta{
		top: 210px;
		margin-left: 318px
	}
	
	.selector{
		height: 40px; 
		width: 40px; 
		position: absolute; 		 
		cursor: pointer; 
		background-color: #FFF; 
		filter: alpha(opacity=0); 
		opacity: 0;	
	}	
	
	#contenedor_formato_idc{
		width: 277px; 
		position: absolute; 
		margin-top: -333px; 
		margin-left: 700px; 
		height: 250px; 
		padding: 3px;	
	}
	
	#titulo_formato{
		height: 50px; 
		width: 255px; 		 
		background-image:url('<?php echo TIENDA  ?>images/kisco_contenido_pleca.png');
		background-position: 0px 0px; 
		background-repeat: repeat-x;
		font-size: 24px; 
		color: #FFF; 
		font-weight: lighter; 
		padding: 5px 5px; 
		text-align: center	
	}
	
	#pleca_formato{
		background-color: #808080; height: 1px
	}
	
	#imagen_formato{
		height: 190px; 
		overflow: hidden;
	}
</style>


<div id='contenedor_idc'>
<?php 
	echo "<form id='form_filtro_formatos' method='post' action='".TIENDA."publicacion/ofertas/".$id_publicacion."'>";				
?>	
	<img src="<?php echo TIENDA?>images/kiosco_arbol_idc.png" alt='contenido_idc' />
		
	<div id='selector_asisprint' class='selector' onmouseover="cambia_img(this.id)"  onclick="activa_check(1)">		
	</div>
	<div id='selector_carpeta' class='selector' onmouseover="cambia_img(this.id)" onclick="activa_check(2)">	
	</div>
	<div id='selector_pdf' class='selector' onmouseover="cambia_img(this.id)" onclick="activa_check(4)">		
	</div>		
	<div id='selector_semonline' class='selector' onmouseover="cambia_img(this.id)" onclick="activa_check(33)">		
	</div>
	<div id='selector_sempersona' class='selector' onmouseover="cambia_img(this.id)" onclick="activa_check(34)">		
	</div>
	<div id='selector_asistel' class='selector' onmouseover="cambia_img(this.id)" onclick="activa_check(35)">		
	</div>		
	<div id='selector_contenido' class='selector' onmouseover="cambia_img(this.id)" onclick="activa_check(36)" >		
	</div>
<?php

	echo "<input type='checkbox' id='chk_formato1' name='chk_formato1' value='1' style='display: none'/>";
	echo "<input type='checkbox' id='chk_formato2' name='chk_formato2' value='2' style='display: none'/>";	
	echo "<input type='checkbox' id='chk_formato4' name='chk_formato4' value='4' style='display: none'/>";
	echo "<input type='checkbox' id='chk_formato33' name='chk_formato33' value='33' style='display: none'/>";
	echo "<input type='checkbox' id='chk_formato34' name='chk_formato34' value='34' style='display: none'/>";
	echo "<input type='checkbox' id='chk_formato35' name='chk_formato35' value='35' style='display: none'/>";
	echo "<input type='checkbox' id='chk_formato36' name='chk_formato36' value='36' style='display: none'/>";
	echo "</form>"; 
?>
</div>
<div id='contenedor_formato_idc'>
	<div id='titulo_formato'>		
		seminarios online			
	</div>
	<div id='imagen_formato'>
		<img id='imagen_thumb' src="<?php echo TIENDA  ?>images/kiosco_idc_semonline.png" />
	</div>
	<div id='pleca_formato'></div>
</div>

<script type="text/javascript">
	function cambia_img(id){		
		var matimg = id.split("_");
		if(matimg[1]){
			$('#imagen_thumb').attr('src', '<?php echo TIENDA  ?>images/kiosco_idc_'+ matimg[1] +'.png')
			
			switch(matimg[1]){
				case "pdf": 		$('#titulo_formato').text('Venta de Contenido')
									break;
								
				case "asisprint": 	$('#titulo_formato').text('Paquete Integral IDC')
				    				break;
				    				
				case "contenido": 	$('#titulo_formato').html('IDC Online')
				    				break;
				
				case "sempersona": 	$('#titulo_formato').text('Seminario Presencial')
				    				break;
				    				
				case "asistel": 	$('#titulo_formato').text('Consultoría Telefónica')
				    				break;    				    				 					    								
				
				case "semonline": 	$('#titulo_formato').text('Seminario en Línea')
				    				break;
				    				
				case "carpeta": 	$('#titulo_formato').text('Productos')
				    				break;    				    										    				 					    
			}	
		} 		
			
	}

	function activa_check(id){			
		$('#chk_formato'+id).attr('checked', true)	
		$('#chk_formato'+id).click();
	}
</script>