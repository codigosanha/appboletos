
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Conductor
        <small>Editar</small>
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
                        <form action="<?php echo base_url();?>mantenimiento/conductores/update" method="POST">
                            <input type="hidden" name="idchofer" value="<?php echo $chofer->id; ?>">
                            <div class="form-group">
                                <label for="dni">DNI:</label>
                                <input type="text" class="form-control" id="dni" name="dni" minlength="8" maxlength="8" value="<?php echo $chofer->dni; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nombres">Nombres:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $chofer->nombres; ?>">
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $chofer->apellidos; ?>">
                            </div>
                            <div class="form-group">
                                <label for="brevete">Brevete:</label>
                                <input type="text" class="form-control" id="brevete" name="brevete" value="<?php echo $chofer->brevete; ?>"  minlength="9" maxlength="9">
                            </div>
                            <div class="form-group">
                                <label for="edad">Edad:</label>
                                <input type="text" class="form-control" id="edad" name="edad" value="<?php echo $chofer->edad; ?>">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $chofer->telefono; ?>">
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
