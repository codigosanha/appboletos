
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Oficinas
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
                        <form action="<?php echo base_url();?>mantenimiento/terminales/store" method="POST">
                            <div class="form-group">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Departamento:</label>
                                <select name="iddep" id="iddep" class="form-control">
                                    <option value="">Seleccione departamento</option>
                                    <?php foreach ($deps as $dep): ?>
                                        <option value="<?php echo $dep->idDepa;?>"><?php echo $dep->departamento;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Provincia:</label>
                                <select name="idprov" id="idprov" class="form-control">
                                    <option value="">Seleccione provincia</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Distrito:</label>
                                <select name="iddist" id="iddist" class="form-control">
                                    <option value="">Seleccione distrito</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono 1:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono1">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono 2:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono2">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono 3:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono3">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono 4:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono4">
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
