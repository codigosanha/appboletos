<p><strong>Bus:</strong> <?php echo $viaje->placa; ?></p>
<p><strong>Conductor:</strong> <?php echo $viaje->nombres." ".$viaje->apellidos; ?></p>
<p><strong>Fecha de Salida:</strong> <?php echo $viaje->fecha; ?></p>
<p><strong>Hora de Salida:</strong> <?php echo $viaje->hora; ?></p>
<p><strong>Total de Asientos:</strong> <?php echo $viaje->asientos; ?></p>
<p><strong>Numero de Asientos Vendidos:</strong> <?php echo $vendidos; ?></p>
<p><strong>Numero de Asientos Disponibles:</strong> <?php echo $viaje->asientos - $vendidos; ?></p>
<p><strong>Oficina:</strong> <?php echo $terminal->ciudad; ?></p>