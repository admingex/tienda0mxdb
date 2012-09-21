		<form name="aph" id="aph" method="post" action="gCarruseldePromociones.php">			
			<div class="contenedor-gris-blanco">
				<p class="instrucciones_cursivas">Carrusel de promociones <input type="submit" name="ok" id="ok" value="" class="boton-guardar-home" />	</p>
				<table class="css3" cellspacing="0" >
					<thead>
						<tr class="label_izq">
							<td>Promoción</td>
							<td>Descripción</td>
							<td>Vigencia</td>
							<td>Mostrar en</td>
						</tr>
					</thead>
					<tbody>
						{section name=promoCarr loop=$promoCarrucel}					
						<tr class="label_izq">
							<td>{$promoCarrucel[promoCarr].nombre}</td>
							<td>{$promoCarrucel[promoCarr].descripcion}</td>
							<td>{$promoCarrucel[promoCarr].vigencia}</td>
							<td><select name="{$promoCarrucel[promoCarr].id_promo}" id="{$promoCarrucel[promoCarr].id_promo}">
									<option value="1"
									{if $promoCarrucel[promoCarr].bcarrusel=='1'}
									selected='selected'
									{/if}
									>Fija</option>									
									<option value="0"									
									{if $promoCarrucel[promoCarr].bcarrusel=='0'}
									selected='selected' value="0"
									{/if}
									>Variable</option>
									<option value="NULL"
									{if $promoCarrucel[promoCarr].bcarrusel==''}
									selected='selected' 
									{/if}
									>No Mostrar</option>
								</select>
								<input type="hidden" name="cp[]" id="cp[]" value="{$promoCarrucel[promoCarr].id_promo}">
							</td>
						</tr>
						{/section}
					</tbody>
				</table>
				<div id="AjaxResult0">
				</div>
			</div>
		</form>	
			<!--***************************************--->
		<form name="aph2" id="aph2" method="post" action="gListadoHome.php">	
			<div class="contenedor-gris-blanco" id="LH">
				<p class="instrucciones_cursivas">Listado Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					<input type="submit" name="ok1" id="ok1" value="" class="boton-guardar-home" /></p>
				<table cellspacing="0" cellpadding="2" class="css3">
					<thead>
						<tr id="0" class="label_izq">
							<td>Promoción</td>
							<td>Descripción</td>
							<td>Vigencia</td>
							<td>Mostrar</td>
						</tr>
					</thead>
					<tbody id="table-3">
						{section name=listPromo loop=$listaPromo}
						<tr id="{$listaPromo[listPromo].posicion}" class="label_izq">
						
							<td>{$listaPromo[listPromo].nombre}</td>
							<td>{$listaPromo[listPromo].descripcion}</td>
							<td>{$listaPromo[listPromo].vigencia}</td>
							<td>
								<input type="checkbox" name="c{$listaPromo[listPromo].id_promo}" id="c{$listaPromo[listPromo].id_promo}"
								{if $listaPromo[listPromo].hestado == '1'}
				                 checked
				                 {else}                
				                 {/if}
								/>
								<div id="d{$listaPromo[listPromo].id_promo}"
								{if $listaPromo[listPromo].hestado == '1'}
				                 class="checkbox_selected"
				                 {else}
				                 class="checkbox_no_selected"
				                 {/if} 
								>&nbsp;</div>
								<input type="hidden" name="lh[]" id="lh[]" value="{$listaPromo[listPromo].id_promo}">
							</td>
						</tr>
						{/section}
					</tbody>
				</table>
				<div id="AjaxResult">
				</div>
			</div>
		</form>
			
			<!--***************************************--->
		<form name="aph3" id="aph3" method="post" action="gPromoEspeciales.php">	
			<div class="contenedor-gris-blanco" id="PE">
				<p class="instrucciones_cursivas">Promociones Especiales <input type="submit" name="ok2" id="ok2" value="" class="boton-guardar-home" /></p>
				<table cellspacing="0" cellpadding="2" class="css3">
					<thead>
						<tr id="0" class="label_izq">
							<td>Promoción</td>
							<td>Descripción</td>
							<td>Vigencia</td>
							<td>Mostrar</td>
						</tr>
					</thead>
					<tbody id="table-4">
						{section name=listEspe loop=$listaEspe}
						<tr id="{$listaEspe[listEspe].posicion}" class="label_izq">
							<td>{$listaEspe[listEspe].nombre}</td>
							<td>{$listaEspe[listEspe].descripcion}</td>
							<td>{$listaEspe[listEspe].vigencia}</td>
							<td>
								<input type="checkbox" name="c{$listaEspe[listEspe].id_promo}" id="c{$listaEspe[listEspe].id_promo}" 
							 {if $listaEspe[listEspe].hestado == '1'}
                 checked
                 {else}                
                 {/if}
								/>
								<div id="d{$listaEspe[listEspe].id_promo}"
								{if $listaEspe[listEspe].hestado == '1'}
								 class="checkbox_selected"
								 {else}
								 class="checkbox_no_selected"
								 {/if}
								 >&nbsp;</div>
								 <input type="hidden" name="pe[]" id="pe[]" value="{$listaEspe[listEspe].id_promo}">
							</td>
						</tr>
						{/section}	
					</tbody>
				</table>

			</div>
		</form>