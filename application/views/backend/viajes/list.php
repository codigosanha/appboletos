
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Horarios
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($permisos->insert == 1):?>
                        <a href="<?php echo base_url();?>gestionar/horarios/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Programar Horario</a>
                        <?php endif;?>
                                            
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ruta</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Precio</th>
                                    <th>Bus</th>
                                    <th>Conductor</th>
                                    <th>Copiloto</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($viajes)):?>
                                    <?php foreach($viajes as $viaje):?>
                                        <tr>
                                            <td><?php echo $viaje->id;?></td>
                                            <td><?php echo $viaje->origen." - ".$viaje->destino;?></td>
                                            <td><?php echo date("d-m-Y", strtotime($viaje->fecha));?></td>
                                            <td><?php echo date('h:i a', strtotime($viaje->hora));?></td>
                                            <td><?php echo $viaje->precio;?></td>
                                            <td><?php echo $viaje->placa."(".$viaje->asientos.") ", $viaje->tipo == 1 ? "Normal":"Bus/Cama"; ?></td>
                                            <td><?php echo $viaje->nombres ." ".$viaje->apellidos ."(". $viaje->brevete.")";?></td>
                                            <td>
                                                <?php echo $viaje->nombresc ." ".$viaje->apellidosc ."(". $viaje->brevetec.")";?>
                                            <td>
                                                <div class="btn-group">
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>gestionar/horarios/edit/<?php echo $viaje->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>gestionar/horarios/delete/<?php echo $viaje->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                                                    <?php endif;?>                
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
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
        <h4 class="modal-title">Informacion de la Categoria</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
