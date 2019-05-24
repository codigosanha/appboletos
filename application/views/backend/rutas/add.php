
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Rutas
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                
                             </div>
                        <?php endif;?>
                        <form action="<?php echo base_url();?>mantenimiento/rutas/store" method="POST">
                            <div class="form-group">
                                <label for="placa">Terminal de Origen:</label>
                                <select name="origen" id="origen" class="form-control">
                                    <?php foreach($terminales as $terminal):?>
                                        <option value="<?php echo $terminal->id; ?>"><?php echo $terminal->ciudad; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="modelo">Terminal de Destino:</label>
                                <select name="destino" id="destino" class="form-control">
                                    <?php foreach($terminales as $terminal):?>
                                        <option value="<?php echo $terminal->id; ?>"><?php echo $terminal->ciudad; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="text" class="form-control" id="precio" name="precio" required>
                            </div>
                            <div class="form-group">
                                <label for="precio">Color para el marcado de asientos:</label>
                                <input type="color" id="color" name="color" required>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
                            </div>
                            
                        </form>
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
