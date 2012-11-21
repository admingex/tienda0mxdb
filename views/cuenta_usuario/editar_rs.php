<div class='titulo-descripcion'>
	Datos de envío y facturación
</div>	
<div class='pleca-titulo'></div>
<div class='encabezado-descripcion'>Editar Razón Social</div>

<div class="form-container">		
	<form id="form_agregar_rs" action="" method="POST">
		<div class='form-label'>Nombre o Raz&oacute;n Social</div>		
		<input type="text" name="txt_razon_social" id="txt_razon_social" size="30" value="<?php if(isset($_POST['txt_razon_social'])) echo htmlspecialchars($_POST['txt_razon_social']); else echo $datos_direccion[0]['company']; ?>" class="input-tex"/>
		<?php if(isset($reg_errores['txt_razon_social'])) echo ($reg_errores['txt_razon_social']);?>	
		<div class='space-label'></div>
		<div class="form-label">RFC</div>
		<input type="text" name="txt_rfc" id="txt_rfc" size="30" value="<?php if(isset($_POST['txt_rfc'])) echo htmlspecialchars($_POST['txt_rfc']); else echo  $datos_direccion[0]['tax_id_number'];?>" class="input-tex"/>
		<?php if(isset($reg_errores['txt_rfc'])) echo ($reg_errores['txt_rfc']);?>		
		<div class='space-label'></div>	
		<div class="form-label">Correo Electr&oacute;nico de Env&iacute;o</div>
		<input type="text" name="txt_email" id="txt_email" value="<?php if(isset($_POST['txt_email'])) echo htmlspecialchars($_POST['txt_email']); else echo  $datos_direccion[0]['email'];?>" size="30" class="input-tex"/>
		<?php if(isset($reg_errores['txt_email'])) echo ($reg_errores['txt_email']);?>				
		<div class="check-label"><input type="checkbox" id="chk_default" name="chk_default" <?php if($datos_direccion[0]['id_estatusSi'] == 3) echo "checked='TRUE'"?>/>&nbsp;Usar como raz&oacute;n social para pago express</div>						
		<input type="button" " name="actualizar_rs" id="actualizar_rs" value="Actualizar" onclick="enviar_rs('<?php echo $consecutivo ?>')" class='boton-guardar' /> 
		<input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="$('#boton_datos').click();	" class="boton-guardar"/>																	
	</form>
</div>
