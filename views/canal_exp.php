<style type="text/css">
	#contenedor_exp{
		width: 680px; 
		margin-left: 20px;				
	}	
	
	#selector_pass{
		top: 282px; 
		margin-left: 453px;				 	
	}
	
	#selector_revista{		 
		top: 334px; 
		margin-left: 412px; 			
	}
		
	.selector{
		height: 42px; 
		width: 42px; 
		position: absolute; 		 
		cursor: pointer; 
		background-color: #FFF; 
		filter: alpha(opacity=0); 
		opacity: 0;	
	}	
	
	#contenedor_formato_exp{
		width: 277px; 
		position: absolute; 
		margin-top: -280px; 
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


<div id='contenedor_exp'>
<?php 
	echo "<form id='form_filtro_formatos' method='post' action='".TIENDA."publicacion/ofertas/".$id_publicacion."'>";				
?>	
	<img src="<?php echo TIENDA?>images/kiosco_arbol_exp.png" alt='contenido_idc' />
	<div id='selector_pass' class='selector' onmouseover="cambia_img(this.id)" onclick="activa_check(3)">		
	</div>	
	<div id='selector_revista' class='selector' onmouseover="cambia_img(this.id)" onclick="activa_check(1)">		
	</div>		
	
<?php

	echo "<input type='checkbox' id='chk_formato3' name='chk_formato3' value='3' style='display: none'/>";
	echo "<input type='checkbox' id='chk_formato1' name='chk_formato1' value='1' style='display: none'/>";
	echo "</form>"; 
?>
</div>
<div id='contenedor_formato_exp'>
	<div id='titulo_formato'>		
		seminarios online			
	</div>
	<div id='imagen_formato'>
		<img id='imagen_thumb' src="<?php echo TIENDA  ?>images/kiosco_exp_pass.png" />
	</div>
	<div id='pleca_formato'></div>
</div>

<script type="text/javascript">
	function cambia_img(id){
		var matimg = id.split("_");
		if(matimg[1]){
			$('#imagen_thumb').attr('src', '<?php echo TIENDA  ?>images/kiosco_exp_'+ matimg[1] +'.png')
			
			switch(matimg[1]){
				case "pdf": 		$('#titulo_formato').text('Venta de Contenido')
									break;
								
				case "asisprint": 	$('#titulo_formato').text('Suscripciones')
				    				break;				    								  				    										    				 					    
			}	
		} 		
			
	}

	function activa_check(id){			
		$('#chk_formato'+id).attr('checked', true)	
		$('#chk_formato'+id).click();
	}
</script>