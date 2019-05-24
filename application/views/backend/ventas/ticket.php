
<div class="contenedor-total">
		<table style="width:100%">
			<tr>
				<td colspan="3">&nbsp;</td>
				<td class="customFont">25/01/2018</td>
			</tr>
			<tr>
				<th width="200px;"><p class="no-print"><b>Pasajero</b></p></th>
				<td class="customFont"><?php echo $venta->nombres." ".$venta->apellidos;?> </td>
				<th><p class="no-print">Documento</p></th>
				<td class="customFont">DNI - <?php echo $venta->dni;?> </td>
			</tr>
			<tr>
				<th><p class="no-print">Origen</p></th>
				<td class="customFont"><?php echo $venta->origen;?></td>
				<th><p class="no-print">Destino</p></th>
				<td class="customFont"><?php echo $venta->destino;?></td>
			</tr>
			<tr>
				<th><p class="no-print">Fecha de Viaje</p></th>
				<td class="customFont"><?php echo date("d-m-Y", strtotime($venta->fecha));?></td>
				<th><p class="no-print">Hora de Viaje</p></th>
				<td class="customFont"><?php echo date('h:i a', strtotime($venta->hora));?></td>
			</tr>
			<tr>
				<th><p class="no-print">asiento</p></th>
				<td class="customFont">51</td>
				<th><p class="no-print">Importe</p></th>
				<td class="customFont"><?php echo $venta->importe;?> </td>
			</tr>
			<tr>
				<th colspan="2" style="text-align: center;" class="customFont"><?php 
					$valor = number_format($venta->importe, 2, '.', '');
					$porciones = explode(".", $valor);

					if ($porciones[0] < 10) {
						echo strtoupper(unidad($porciones[0]) . " y ".$porciones[1]."/100 soles");
					}
					else if($porciones[0] >= 10 && $porciones[0] < 100){
						echo strtoupper(decena($porciones[0]) . " y ".$porciones[1]."/100 soles");
					}
					else{
						echo strtoupper(centena($porciones[0]) . " y ".$porciones[1]."/100 soles");
					}
				?>
					
				</th>
				<th><p class="no-print">Vendedor</p></th>
				<td class="customFont"><?php echo $venta->usuario;?> </td>
			</tr>
		</table>
	</div>
	<br>