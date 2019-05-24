
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Comprobantes
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
                        <form action="<?php echo base_url();?>administrador/comprobantes/store" method="POST">
                            
                            
                            <div class="form-group">
                                <label for="nombre">Terminal:</label>
                                <select name="terminal" id="terminal" class="form-control" required>
                                    <option value="">Seleccione Terminal</option>
                                    <?php foreach ($terminales as $terminal): ?>
                                        <option value="<?php echo $terminal->id;?>"><?php echo $terminal->ciudad;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Tipo de comprobante:</label>
                                <select name="tipocomprobante" id="tipocomprobante" class="form-control" required>
                                    <option value="">Seleccione Tipo de comprobante</option>
                                    <?php foreach ($tipocomprobantes as $tipocomprobante): ?>
                                        <option value="<?php echo $tipocomprobante->id;?>"><?php echo $tipocomprobante->nombre;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="serie">Serie:</label>
                                <input type="text" class="form-control" id="serie" name="serie" required>
                            </div>
                            <div class="form-group">
                                <label for="igv">IGV:</label>
                                <input type="text" class="form-control" id="igv" name="igv" required>
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
