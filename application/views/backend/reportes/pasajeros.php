
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Pasajeros
        <small>Viajes</small>
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
                            <a href="<?php echo base_url(); ?>reportes/pasajeros" class="btn btn-danger">Restablecer</a>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Pasajero</th>
                                    <th>Ruta</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Nro. Asiento</th>
                                    <th>Lugar de Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pasajeros)): ?>
                                    <?php foreach($pasajeros as $pasajero):?>
                                        <tr>
                                            
                                            <td><?php echo $pasajero->nombres." ".$pasajero->apellidos;?></td>
                                            <td><?php echo $pasajero->origen." - ".$pasajero->destino;?></td>
                                            <td><?php echo date("d-m-Y", strtotime($pasajero->fecha));?></td>
                                            <td><?php echo date('h:i a', strtotime($pasajero->hora));?></td>
                                            <td><?php echo $pasajero->num_asiento;?></td>
                                            <td><?php echo $pasajero->lugar;?></td>
                                            
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
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
