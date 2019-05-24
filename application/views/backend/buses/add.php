
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Buses
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo base_url();?>mantenimiento/buses/store" method="POST" class="form-horizontal form-add-edit" >
                    <div class="row">
                        
                            <?php if($this->session->flashdata("error")):?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                    
                                 </div>
                            <?php endif;?>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="placa">Placa:</label>
                                    <input type="text" class="form-control" id="placa" name="placa" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="modelo">Modelo:</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="marca">Marca:</label>
                                    <input type="text" class="form-control" id="marca" name="marca" required>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                
                                <div class="col-md-3">
                                    <label for="marca">Cantidad de Asientos:</label>
                                    <select name="asientos" id="asientos" class="form-control">
                                        <option value="51">51</option>
                                        <option value="55">55</option>
                                        <option value="60">60</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="tipo">Tipo servicio:</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="1">Normal</option>
                                        <option value="2">Bus Cama</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="tipo">Costo servicio bus/cama:</label>
                                    <input type="text" name="servicio"  class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="soat">SOAT</label>
                                    <input type="text" class="form-control" id="soat" name="soat">
                                </div>
                                <div class="col-md-3">
                                    <label for="revision">Revision Tecnica</label>
                                    <input type="text" class="form-control" name="revision" id="revision">
                                </div>
                                <div class="col-md-3">
                                    <label for="emision">Fecha Emision</label>
                                    <input type="date" class="form-control" id="emision" name="emision" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="caducidad">Fecha Caducidad</label>
                                    <input type="date" class="form-control" id="caducidad" name="caducidad" value="<?php echo date("Y-m-d"); ?>">
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
