
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Buses
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo base_url();?>mantenimiento/buses/update" method="POST" class="form-horizontal form-add-edit" >
                    <div class="row">
                        
                            <?php if($this->session->flashdata("error")):?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                    
                                 </div>
                            <?php endif;?>
                            <input type="hidden" name="idbus" value="<?php echo $bus->id;?>">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="placa">Placa:</label>
                                    <input type="text" class="form-control" id="placa" name="placa" value="<?php echo $bus->placa; ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="modelo">Modelo:</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $bus->modelo; ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="marca">Marca:</label>
                                    <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $bus->marca; ?>" required>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                
                                <div class="col-md-3">
                                    <label for="marca">Cantidad de Asientos:</label>
                                    <select name="asientos" id="asientos" class="form-control">
                                        <option value="51" <?php echo $bus->asientos == "51" ? "selected" : ""; ?>>51</option>
                                        <option value="55" <?php echo $bus->asientos == "55" ? "selected" : ""; ?>>55</option>
                                        <option value="60" <?php echo $bus->asientos == "60" ? "selected" : ""; ?>>60</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="tipo">Tipo servicio:</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                    <option value="1" <?php echo $bus->tipo == "1" ? "selected" : ""; ?>>Normal</option>
                                    <option value="2" <?php echo $bus->tipo == "2" ? "selected" : ""; ?>>Bus Cama</option>
                                </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="tipo">Costo servicio bus/cama:</label>
                                    <input type="text" name="servicio"  class="form-control"  <?php echo empty($bus->costo_cama) ? "disabled":""; ?> value="<?php echo $bus->costo_cama; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="soat">SOAT</label>
                                    <input type="text" class="form-control" id="soat" name="soat" value="<?php echo $bus->soat;?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="revision">Revision Tecnica</label>
                                    <input type="text" class="form-control" name="revision" id="revision" value="<?php echo $bus->revision;?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="emision">Fecha Emision</label>
                                    <input type="date" class="form-control" id="emision" name="emision" value="<?php echo $bus->fecha_emision; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="caducidad">Fecha Caducidad</label>
                                    <input type="date" class="form-control" id="caducidad" name="caducidad" value="<?php echo $bus->fecha_caducidad; ?>">
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
