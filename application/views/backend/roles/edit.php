
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Roles
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo base_url();?>administrador/roles/update" method="POST" class="form-horizontal form-add-edit" >
                    <div class="row">
                        
                            <?php if($this->session->flashdata("error")):?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                    
                                 </div>
                            <?php endif;?>
                            <input type="hidden" name="idrol" value="<?php echo $rol->id;?>">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $rol->nombre;?>" required>
                                </div>
                                
                            </div>
                    
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="descripcion">Descripcion:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $rol->descripcion;?>" required>
                                </div>

                            </div>

                    
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
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
