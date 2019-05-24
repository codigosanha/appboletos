
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Pasajero
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo base_url();?>mantenimiento/pasajeros/store" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if($this->session->flashdata("error")):?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                    
                                 </div>
                            <?php endif;?>
                            <div class="form-group">
                                <label for="dni">DNI:</label>
                                <input type="text" class="form-control" id="dni" name="dni" minlength="8" maxlength="8" required>
                            </div>
                            <div class="form-group">
                                <label for="nombres">Nombres:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="form-group">
                                <label for="edad">Edad:</label>
                                <input type="text" class="form-control" id="edad" name="edad">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                            <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
                                </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="ruc">RUC:</label>
                                <input type="text" class="form-control" id="ruc" name="ruc"  minlength="11" maxlength="11">
                            </div>
                            <div class="form-group">
                                <label for="razon">Empresa:</label>
                                <input type="text" class="form-control" id="razon" name="razon">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="form-group">
                                <label for="tel_empresa">Telefono Empresa:</label>
                                <input type="text" class="form-control" id="tel_empresa" name="tel_empresa">
                            </div>
                            <div class="form-group">
                                <label for="">Sexo:</label>
                                <label class="radio-inline"><input type="radio" name="sexo" value="M" required>Masculino</label>
                                <label class="radio-inline"><input type="radio" name="sexo" value="F">Femenino</label>
                            </div>
                        </div>
                    </div> 
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
