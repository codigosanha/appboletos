
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Oficinas
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
                        <a href="<?php echo base_url();?>mantenimiento/terminales/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Oficina</a>
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
                                    <th>Ciudad</th>
                                    <th>Direccion</th>
                                    <th>Departamento</th>
                                    <th>Provincia</th>
                                    <th>Distrito</th>
                                    <th>Telefonos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($terminales)):?>
                                    <?php foreach($terminales as $terminal):?>
                                        <tr>
                                            <td><?php echo $terminal->id;?></td>
                                            <td><?php echo $terminal->ciudad;?></td>
                                            <td><?php echo $terminal->direccion;?></td>
                                            <td><?php echo $terminal->departamento;?></td>
                                            <td><?php echo $terminal->provincia;?></td>
                                            <td><?php echo $terminal->distrito;?></td>
                                            <td>
                                                <?php if (!empty($terminal->telefono1)) {
                                                    echo '<span class="label label-primary">'.$terminal->telefono1.'</span>';
                                                }?>
                                                <?php if (!empty($terminal->telefono2)) {
                                                    echo '<span class="label label-success">'.$terminal->telefono1.'</span>';
                                                }?>
                                                <?php if (!empty($terminal->telefono3)) {
                                                    echo '<span class="label label-warning">'.$terminal->telefono1.'</span>';
                                                }?>
                                                <?php if (!empty($terminal->telefono4)) {
                                                    echo '<span class="label label-danger">'.$terminal->telefono1.'</span>';
                                                }?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>mantenimiento/terminales/edit/<?php echo $terminal->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>mantenimiento/terminales/delete/<?php echo $terminal->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
