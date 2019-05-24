
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Buses
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
                        <a href="<?php echo base_url();?>mantenimiento/buses/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Bus</a>
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
                                    <th>Placa</th>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Cant. de Asientos</th>
                                    <th>Tipo servicio</th>
                                    <th>SOAT</th>
                                    <th>Revision Tecnica</th>
                                    <th>Fecha Emision</th>
                                    <th>Fecha Caducidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($buses)):?>
                                    <?php foreach($buses as $bus):?>
                                        <tr>
                                            <td><?php echo $bus->id;?></td>
                                            <td><?php echo $bus->placa;?></td>
                                            <td><?php echo $bus->modelo;?></td>
                                            <td><?php echo $bus->marca;?></td>
                                            <td><?php echo $bus->asientos;?></td>
                                            <td><?php echo $bus->tipo == 1 ? "Normal":"Bus Cama";?></td>
                                            <td><?php echo $bus->soat;?></td>
                                            <td><?php echo $bus->revision;?></td>
                                            
                                            <td><?php echo !strtotime($bus->fecha_emision)?"": date("d-m-Y", strtotime($bus->fecha_emision));?></td>
                                            <td><?php echo !strtotime($bus->fecha_caducidad)?"":date("d-m-Y", strtotime($bus->fecha_caducidad));?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>mantenimiento/buses/edit/<?php echo $bus->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>mantenimiento/buses/delete/<?php echo $bus->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
