<div class='titulo-descripcion'>
	Configuración de cuenta
</div>	
<div class='pleca-titulo'></div>
<div class="form-container">
<form name='actualizar_cliente' action='' method='GET'>
	<input type='hidden' id='log_data' name='log_data' value='<?php echo $_SESSION['datos_login']; ?>' />	
	<div class='form-label'>Nombre</div><input type='text' id='nombre' name='nombre' value='<?php echo $cliente['nombre'];?>' class='input-tex' />
	<div class='space-label'>
	<div class='form-label'>Apellido paterno</div><input type='text' id='apellido_paterno' name='apellido_paterno' value='<?php echo $cliente['apellido_paterno'];?>' class='input-tex' />
	<div class='space-label'>
    <div class='form-label'>Apellido Materno</div><input type='text' id='apellido_materno' name='apellido_materno' value='<?php echo $cliente['apellido_materno'];?>' class='input-tex' />
    <div class='space-label'>
    <div class='form-label'>Correo electrónico</div><input type='text' id='email' name='email' value='<?php echo $cliente['email'];?>' class='input-tex' />
    <div class='space-label'>
    <a id='view_pass_link' href='#' onclick="view_pass()">Cambiar contraseña</a>		
    <div class='space-label'></div>
    <div class='space-label'></div>
    <div id='cambiar_password' style='display: none'>
    	<div class='form-label'>Contraseña actual</div><input type='text' id='password_actual' name='password_actual' value='' class='input-tex' />
    	<div class='space-label'></div>
    	<div class='form-label'>Nueva contraseña</div><input type='text' id='nuevo_password' name='nuevo_password' value='' class='input-tex' />
    	<div class='space-label'></div>
    	<div class='form-label'>Confirmar contraseña</div><input type='text' id='nuevo_password2' name='nuevo_password2' value='' class='input-tex' />	
    </div>
    <div class='space-label'></div>
    <div class="form-label">&nbsp;</div><input type='button' id='boton_actualizar' name='boton_actualizar' value='Guardar cambios' class='boton-guardar' onclick="actualizar()"/>
</form>
</div>