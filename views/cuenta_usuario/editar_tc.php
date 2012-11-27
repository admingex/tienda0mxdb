<div class="form-container">
	<form id="form_editar_tc" action="" method="POST">
	<div class="form-label">Banco Emisor</div>
	<div class="label_tarjeta"><?php echo $tarjeta_tc['descripcionVc']; ?></div>	
	<div class="space-label"></div>	
	
	<div class="form-label">N&uacute;mero de tarjeta</div>
	<div class="label_tarjeta">**** **** **** <?php echo substr($tarjeta_tc['terminacion_tarjetaVc'], strlen($tarjeta_tc['terminacion_tarjetaVc']) -4);?></div>
	<div class="space-label"></div>
	
	<div class="form-label">Nombre del Titular</div>
	<input type="text" name="txt_nombre" id="txt_nombre" value="<?php if(isset($_POST['txt_nombre'])) echo htmlspecialchars($_POST['txt_nombre']); else echo $tarjeta_tc['nombre_titularVc'];?>" class="input-tex"/>
	<span class="error_mensaje"><?php if(isset($reg_errores['txt_nombre'])) echo ($reg_errores['txt_nombre']);?></span>
	<div class="space-label"></div>
	
	<div class="form-label">Apellido Paterno</div>
	<div class="input-tex"><input type="text" name="txt_apellidoPaterno" id="txt_apellidoPaterno" value="<?php if(isset($_POST['txt_apellidoPaterno'])) echo htmlspecialchars($_POST['txt_apellidoPaterno']);	else echo $tarjeta_tc['apellidoP_titularVc'];?>" class="input-tex"/></div>
	<span class="error_mensaje"><?php if(isset($reg_errores['txt_apellidoPaterno'])) echo ($reg_errores['txt_apellidoPaterno']);?></span>
	<div class="space-label"></div>
	
	<div class="form-label">Apellido Materno</div>
	<input type="text" name="txt_apellidoMaterno" id="txt_apellidoMaterno" value="<?php if(isset($_POST['txt_apellidoMaterno'])) echo htmlspecialchars($_POST['txt_apellidoMaterno']); else echo $tarjeta_tc['apellidoM_titularVc'];?>" class='input-tex'/>
						<span class="error_mensaje"><?php if(isset($reg_errores['txt_apellidoMaterno'])) echo ($reg_errores['txt_apellidoMaterno']);?></span>
	<div class="space-label"></div>
	<?php 
		//La primera vez se tomará la fecha guardada, si el boton fue enviado...se toma del post
		//date_default_timezone_set("America/Mexico_City");
		$mes = isset($_POST['guardar_tarjeta']) ? $_POST['sel_mes_expira'] : $tarjeta_tc['mes_expiracionVc'];
		$anio = isset($_POST['guardar_tarjeta']) ? $_POST['sel_anio_expira'] : $tarjeta_tc['anio_expiracionVc'];
		//echo 'fecha exp. '.$mes.'/'.$anio;
	?>
	
	<div class="form-label">Fecha de Expiraci&oacute;n</div>
	<div class="label_tarjeta">
		<select id="sel_mes_expira" name="sel_mes_expira">
			<?php 
				for($i = 1; $i <= 12; $i++) {
					$zero = ($i < 10) ? "0" : "";
					if ($i == $mes)
						echo "<option value='$zero$i' selected='true'>$zero$i</option>";
					else 
						echo "<option value='$zero$i'>$zero$i</option>";
				} 
			?>
		</select>
		<select id="sel_anio_expira" name="sel_anio_expira">
			<?php 
				for($i = 2012; $i != 2019; $i++) {	/*ajustar el periodo de años con constantes/globales en el config.*/
					if ($i == $anio) 
						echo "<option value='".$i."' selected='true'>$i</option>";
					else 
						echo "<option value='".$i."'>$i</option>";
				} 
			?>
		</select>
	</div>	
	<span class="error_mensaje"><?php if(isset($reg_errores['fecha_error'])) echo ($reg_errores['fecha_error']);?></span>
	<div class="space-label"></div>				
	
	<div class="form-label">&nbsp;</div>
	<div class="check-label"><input type="checkbox" id="chk_default" name="chk_default"/> Usar para pago express</div>	
	<div class="space-label"></div>
	
	<div class="form-label">&nbsp;</div>
	<input type="button" id="actualizar_tarjeta" name="actualizar_tarjeta" value="Actualizar" onclick="enviar_tc(<?php echo "'".$tarjeta_tc['id_TCSi']."', '".$tarjeta_tc['id_tipo_tarjetaSi']."'"; ?>)" class='boton-guardar'/> &oacute;
	<input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="$('#boton_medios').click();" class="boton-guardar"/>			
	</form>
</div>	