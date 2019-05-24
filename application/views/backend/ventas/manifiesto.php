<?php if ($viaje!==""): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>CABECERA</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Origen</th>
                                        <td><?php echo $viaje->origen;?></td>
                                        <th>Destino</th>
                                        <td><?php echo $viaje->destino;?></td>
                                        <th>Fecha</th>
                                        <td><?php echo $viaje->origen;?></td>
                                        <th>Hora</th>
                                        <td><?php echo $viaje->hora;?></td>
                                        <th>Nro de Asientos</th>
                                        <td><?php echo $viaje->asientos;?></td>
                                    </tr>
                                    <tr>
                                        <th>Conductor</th>
                                        <td><?php echo $viaje->nombres." ".$viaje->apellidos ;?></td>
                                        <th>Licencia</th>
                                        <td><?php echo $viaje->brevete;?></td>
                                        <th>Placa</th>
                                        <td><?php echo $viaje->placa;?></td>
                                        <th>Tarjeta de Circulacion</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>Copiloto</th>
                                        <td><?php echo $viaje->nombresc." ".$viaje->apellidosc ;?></td>
                                        <th>Licencia</th>
                                        <td><?php echo $viaje->brevetec;?></td>
                                        <th>Marca</th>
                                        <td><?php echo $viaje->marca;?></td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif ?>
                <?php if (!empty($pasajeros)): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>DETALLE</h4>
                            <table  class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>NOMBRES Y APELLIDOS</th>
                                        <th>DOC. IDENTI.</th>
                                        <th>EDAD</th>
                                        <th>ORIGEN</th>
                                        <th>Nro. COMPROBANTE</th>
                                        <th>MONTO</th>
                                        <th>DESTINO</th>
                                        <th>OBSERVACION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pasajeros)): ?>
                                        <?php
                                            $i=1;
                                             foreach($pasajeros as $pasajero):?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $pasajero->nombres." ".$pasajero->apellidos;?></td>
                                                <td><?php echo $pasajero->dni;?></td>
                                                <td><?php echo $pasajero->edad;?></td>
                                                <td><?php echo $pasajero->origen;?></td>
                                                <td><?php echo $pasajero->serie." - ".$pasajero->numero;?></td>
                                                <td><?php echo $pasajero->importe;?></td>
                                                <td><?php echo $pasajero->destino;?></td>
                                                <td></td>
                                                
                                            </tr>
                                            <?php $i++;?>
                                        <?php endforeach;?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif ?>