
<?php
session_start();
//session_destroy();
$_SESSION['paso']=$_POST['paso'];
if($_SESSION['paso']==1){
//recibimos datos metodo 1
$_SESSION['numbers'][]=$_POST['bulk']; //vandera para ver la informacion
$_SESSION['numbers'][]=$_POST['nombre'];
$_SESSION['numbers'][]=$_POST['paterno'];
$_SESSION['numbers'][]=$_POST['materno'];
$_SESSION['numbers'][]=$_POST['empresa'];
$_SESSION['numbers'][]=$_POST['puesto'];
$_SESSION['numbers'][]=$_POST['departamento'];
$_SESSION['numbers'][]=$_POST['direccion'];
$_SESSION['numbers'][]=$_POST['numero'];
$_SESSION['numbers'][]=$_POST['entre'];
$_SESSION['numbers'][]=$_POST['cp'];
$_SESSION['numbers'][]=$_POST['colonias'];
$_SESSION['numbers'][]=$_POST['ciudad'];
$_SESSION['numbers'][]=$_POST['estado'];
$_SESSION['numbers'][]=$_POST['lada'];
$_SESSION['numbers'][]=$_POST['telefono'];
$_SESSION['numbers'][]=$_POST['fax'];
$_SESSION['numbers'][]=$_POST['email'];
$emailenvio=$_POST['email'];
$_SESSION['numbers'][]=$_POST['b2bSourcecode'];

header('location:energia360_nuevo_paso2.php');
}

else{
	$ac=$_POST['actividad'];
		//insertamos en la base de datos de paso 1
		//redireccionamos a la pantalla de listo
		if($ac=='J'){
		$_SESSION['apell'][]=$_POST['actividadtxt'];
		}
		else{
		$_SESSION['apell'][]=$_POST['actividad'];
		//bandera
		$b1=$_POST['actividad'];
		}
		if($_POST['cargo']=='K'){
		$_SESSION['apell'][]=$_POST['cargotxt'];
		}
		else{
		$_SESSION['apell'][]=$_POST['cargo'];
		}
		if($_POST['ramo']=='Z'){
		$_SESSION['apell'][]=$_POST['ramotxt'];
		}
		else{
		$_SESSION['apell'][]=$_POST['ramo'];
		}
		$_SESSION['apell'][]=$_POST['decision'];//v
		$v2=$_POST['decision'];
		$_SESSION['apell'][]=$_POST['empleados'];
		$_SESSION['apell'][]=$_POST['mes'];
		
		
		//VALIDACION DE CANDIDATO 
		if($b1=='F	Analista' or $b1=='I  Operacion' or $b2=='F. No Se Involucra'){
		$mensaje="Agradecemos su inter�s por la revista  Energia 360, 
		para poder recibir de forma gratuita la revista, es 
		importante que cubra el perfil que nos requiere nuestra agencia auditora. 
		
		Lamentablemente no podemos incluirlo como suscriptor gratuito.<br><br>
		No obstante, nos interesa que usted forma parte de la comunidad de lectores de 
		Energia 360, por ello, podr� suscribirse a trav�s de un precio preferencial.";
		echo"no aplica";
		}
		else{
		 $mensaje="Hemos recibido su orden de suscripci�n gratuita para <b>"."Energia 360"."</b>.<br><br>";
		$mensaje.= "Nuestro objetivo es brindar el mejor servicio a nuestros lectores por lo que, nos permitimos ";
		 $mensaje.="informarle que para ser <i>suscriptor calificado</i>, deber� encontrarse dentro del perfil ";
		$mensaje.="predeterminado y la �nica forma de saberlo es a trav�s del cuestionario que amablemente contest�.<br><br>";
		$mensaje.="Debido a la gran demanda que tenemos, el proceso de calificaci�n de cuestionarios puede tomar ";
		
		$mensaje.="hasta 3 ediciones a partir de la fecha en que usted nos env�a su cuestionario. ";
		$mensaje.="De no calificar le enviaremos una notificaci�n.<br><br>";
		
		
		 $mensaje.="Agradecemos su paciencia para la realizaci�n de este proceso. ";
		 $mensaje.="Para cualquier duda o aclaraci�n estamos a sus ordenes en el mail ";
		$mensaje.="<a href='mailto:mercadotecnia@expansion.com.mx'>mercadotecnia@expansion.com.mx</a> ";
		$mensaje.= "o al tel�fono (55) 5093-2615.<br><br>";
		$mensaje.="Nota: Los editores se reservan el derecho de incluir s�lo a lectores calificados.<br><br>";
		//impresiones
		foreach($_SESSION['numbers'] as $valor){
		$mensaje.= $valor."<br>";
		}
		foreach($_SESSION['apell'] as $valor2){
		$mensaje.=$valor2."<br>";
		}
		//echo "insercion lista";
		//echo "aplica";
		}
		
	}		
		header('location:Sendmail.php');
		//mandamos el mail
		$headers="From: servicioaclientes@expansion.com.mx";
		mail($emailenvio.',mercadotecnia@expansion.com.mx', "=?UTF-8?B?".$asunto."?=", $mensaje, $headers)
		
		//mail
		//Para destruir una variable en espec�fico
		//unset($_SESSION['username']);
		 
		// Finalmente, destruye la sesi�n
		//session_destroy();

?>