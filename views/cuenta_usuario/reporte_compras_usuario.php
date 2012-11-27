<div class='pleca-titulo'></div>
<?php

	if($compras){
		/*
		echo "<pre>";
			print_r($compras);
		echo "</pre>";
		*/	
		//echo md5('spin_vero@hotmail.com|A86aleman');
	
		echo "	<table width='100%' cellpadding='0' cellspacing='0'>
					<thead>					
						<th>Fecha
						</th>
						<th>No. de Orden
						</th>
						<th>Productos
						</th>
						<th>Total
						</th>
						<th>&nbsp;
						</th>					
					</thead>";	      	
											
		foreach($compras as $indice => $detalle_compra){
			if($detalle_compra['respuesta_banco'] == "approved"){								
				
				echo "	<tr>
							<td>".$detalle_compra['compra']['fecha_compraDt']."
							</td>
							<td>".$detalle_compra['compra']['id_compraIn']."
							</td>
							<td>";							
							foreach($detalle_compra['articulos'] as $articulo){
								
								//revisar si la descripcion de la promocion tiene slash's quitarlos
								if(stristr($detalle_compra['promocion']['descripcionVc'], "|")){
									$mp=explode('|',$detalle_compra['promocion']['descripcionVc']);
									$nmp=count($mp);
									if($nmp==2){
										$desc_promo = $mp[0];		
									}	
									else if($nmp==3){
										$desc_promo = $mp[1];
									}								
								}
								else{
									$desc_promo = $detalle_compra['promocion']['descripcionVc'];	
								}
								//revisar si la descripcion del articulo tiene slash's quitarlos	
								if(stristr($articulo['tipo_productoVc'], "|")){
									$ma=explode('|',$articulo['tipo_productoVc']);
									$nma=count($ma);
									if($nma==2){
										$desc_art = $ma[0];		
									}	
									else if($nma==3){
										$desc_art = $ma[1];
									}								
								}
								else{
									$desc_art = $articulo['tipo_productoVc'];	
								}
								// mostrar la descripcion de promocion y articulo sin slash's
								echo $desc_promo."<br />".
									 $desc_art."<br />";							
							}						
				echo "		</td>
							<td align='right'>$&nbsp;".number_format($detalle_compra['monto'], 2, '.', ',')."
							</td>
							<td align='right'><a href=\"javascript: detalle_compra(".$detalle_compra['compra']['id_compraIn'].", ".$id_cliente.")\" >Ver detalle</a>
							</td>  
						</tr>";	
			} 			
		}
		echo "</table>";
	 
	}
	else{
		echo "<p class='info-rojo'>Aún no tienes ninguna compra</p>";
	}

?>