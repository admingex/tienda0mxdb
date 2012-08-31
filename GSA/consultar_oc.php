
<?php
header ('Content-type: text/html; charset=utf-8');
$id_cliente = $_REQUEST['id'];
try {  
	$cliente = new SoapClient("http://10.177.73.45/TNDWebSvc/Service.asmx?WSDL");		
	$parameter = array(	'descriptionOc' => $id_cliente);	//debe ser null	
	$obj_result = $cliente->getOcThink ($parameter);
	$simple_result = $obj_result->getOcThinkResult ;		
	if(!empty($simple_result->informacion_oc)){ //valido si el objeto esta definido
		$arrayFinal =$simple_result->informacion_oc;
		echo "<table class='css3' cellspacing='0' style='font-size: 13px;' id='mdata'>
				<thead>
					<tr style='font-weight: bold;'>
						<td>OC ID</td>
						<td>Descripción</td>
						<td>&nbsp;</td>
					</tr>
				</thead>
				<tbody>		
		";
		foreach($arrayFinal as $indice => $valor) {
			echo"
				<tr>
						<td>".$arrayFinal[$indice] -> oc_id."</td>
						<td>".$arrayFinal[$indice] -> description."</td>
						<td><a class='on' id='".$arrayFinal[$indice] -> oc_id."'>
								<button class='mp' type='button'  id='".$arrayFinal[$indice] -> oc_id."'>Usar</button>
							</a>
						</td>
						<input type='hidden' name='indice' id='indice' value='".$indice."' />
				</tr>		
				";
		  		//echo "<br>". $arrayFinal[$indice] -> oc_id; 
			} 
		echo "</tbody>
			</table>";
	}
	else{
		echo "Sin datos";
	}
	/*
	echo "<pre>";
	print_r($simple_result);		//es un objeto;
	echo "</pre>";
	*/

} catch (SoapFault $exception) {
	echo $exception;  
	echo '<br/>error: <br/>'.$exception->getMessage();
	//exit();
}
?>