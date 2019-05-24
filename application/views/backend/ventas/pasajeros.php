<dl class="dl-horizontal">
    <dt>Ruta:</dt>
    <dd><?php echo $horario->origen." - ".$horario->destino; ?></dd>
    <dt>Fecha y Hora:</dt>
    <?php $date = date('h:i:s a', strtotime($horario->hora));?>
    <dd><?php echo $horario->fecha." | ". $date; ?></dd>
    <dt>Cantidad de Pasajeros:</dt>
    <dd><?php echo count($pasajeros);?></dd>
</dl>

 <table id="example1" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>DNI</th>
            <th>Nombres</th>
            <th>Edad</th>
            <th>Nro. Asiento</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($pasajeros)):?>
            <?php foreach($pasajeros as $pasajero):?>
                <tr>
                    <td><?php echo $pasajero->id;?></td>
                    <td><?php echo $pasajero->dni;?></td>
                    <td><?php echo $pasajero->nombres;?></td>
                    <td><?php echo $pasajero->edad;?></td>
                    <td><?php echo $pasajero->num_asiento;?></td>

                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>