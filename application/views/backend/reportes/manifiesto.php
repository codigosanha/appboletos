
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Reporte
        <small>Manifiesto</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo current_url();?>" method="POST">
                    <div class="row">
                        <input type="hidden" id="title" value="Listado de Pasajeros">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="col-md-1 control-label">Fecha:</label>
                                <input type="date" class="form-control" name="fecha" id="fecha_horario" value="<?php  echo date('Y-m-d');?>">
                            </div>
                            <div class="col-md-3">
                                <label for="ruta" class="col-md-1 control-label">Ruta:</label>
                                <select name="ruta" id="ruta" class="form-control">
                                    <option value="">Seleccione..</option>
                                    <?php foreach ($rutas as $ruta): ?>
                                        <option value="<?php echo $ruta->id;?>"><?php echo $ruta->origen ." - ".$ruta->destino;?></option>
                                    <?php endforeach ?> 
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="hora" class="col-md-1 control-label">Hora:</label>
                                <select name="horas" id="horas" class="form-control" required>
                                    <option value="">Horarios..</option>
                                    
                                </select>
                            </div>
                        </div>
                    
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
                            <a href="<?php echo base_url(); ?>reportes/manifiesto" class="btn btn-danger">Restablecer</a>
                        </div>
                    </div>
                </form>
                <hr>
                
                <?php if ($viaje!==""): ?>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-success btn-print-rm">Imprimir Manifiesto</button>
                        </div>
                    </div>
                <div class="manifiesto-reporte">
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
                                        <th><?php echo $viaje->brevetec;?></th>
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
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la venta</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> </span>Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
