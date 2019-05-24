
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Rutas
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
                        <a href="<?php echo base_url();?>mantenimiento/rutas/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Ruta</a>
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
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    <th>Precio</th>
                                    <th>Color para los asientos marcados</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($rutas)):?>
                                    <?php foreach($rutas as $ruta):?>
                                        <tr>
                                            <td><?php echo $ruta->id;?></td>
                                            <td><?php echo $ruta->origen;?></td>
                                            <td><?php echo $ruta->destino;?></td>
                                            <td><?php echo $ruta->precio;?></td>
                                            <td><?php echo $ruta->color;?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>mantenimiento/rutas/edit/<?php echo $ruta->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>mantenimiento/rutas/delete/<?php echo $ruta->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Configuracion de Horas</h4>
            </div>
            <form action="<?php echo base_url();?>mantenimiento/rutas/savehoras" id="form-configurar-horas" class="form-horizontal" method="POST">
            <div class="modal-body">
                    <input type="hidden" name="idruta" id="idruta">
                    <div class="form-group">
                        <label for="" class="control-label col-md-4">Ruta</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="ruta" id="ruta" disabled>
                        </div>
                        <button type="button" id="add-hora" class="btn btn-primary">Agregar Hora</button>
                    </div>
                    <hr>
                    <div class="horas">
                        
                    </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success btnsave">Guardar Cambios</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
