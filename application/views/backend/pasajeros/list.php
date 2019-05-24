
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Pasajeros
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
                        <a href="<?php echo base_url();?>mantenimiento/pasajeros/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Pasajero</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DNI</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Edad</th>
                                    <th>Telefono</th>
                                    <th>Sexo</th>
                                    <th>RUC</th>
                                    <th>Empresa</th>
                                    <th>Direccion</th>
                                    <th>Cant. Viajes</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($pasajeros)):?>
                                    <?php foreach($pasajeros as $pasajero):?>
                                        <tr>
                                            <td><?php echo $pasajero->id;?></td>
                                            <td><?php echo $pasajero->dni;?></td>
                                            <td><?php echo $pasajero->nombres;?></td>
                                            <td><?php echo $pasajero->apellidos;?></td>
                                            <td><?php echo $pasajero->edad;?></td>
                                            <td><?php echo $pasajero->telefono;?></td>
                                            <td><?php echo $pasajero->sexo;?></td>
                                            <td><?php echo $pasajero->ruc;?></td>
                                            <td><?php echo $pasajero->razon;?></td>
                                            <td><?php echo $pasajero->direccion;?></td>
                                            <?php if(!empty($pasajero->subs)): ?> 
                                                <td><?php echo $pasajero->subs->total;?></td>
                                            <?php endif;?>
                                            
                                            <td>
                                                <div class="btn-group">
                                                    
                                                    <a href="<?php echo base_url()?>mantenimiento/pasajeros/edit/<?php echo $pasajero->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    
                                                    <a href="<?php echo base_url();?>mantenimiento/pasajeros/delete/<?php echo $pasajero->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                                                    
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
