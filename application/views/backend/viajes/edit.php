
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Horario
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
                        <div class="error"></div>
                        <form action="<?php echo base_url();?>gestionar/horarios/update" method="POST" id="form-horario-edit">
                            <input type="hidden" name="idviaje" value="<?php echo $viaje->id;?>">
                            <div class="form-group">
                                <label for="placa">Ruta:</label>
                                <select name="ruta" id="ruta" class="form-control">
                                    <?php foreach($rutas as $ruta):?>
                                        <option value="<?php echo $ruta->id; ?>" <?php echo $ruta->id == $viaje->ruta_id ? "selected" : ""; ?>><?php echo $ruta->origen." - ".$ruta->destino; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="fecha">Fecha:</label>
                                <input type="date" class="form-control" id="fecha" name="fecha"  value="<?php echo $viaje->fecha?>" required>
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora:</label>
                                <input type="time" class="form-control" id="hora" name="hora" value="<?php echo $viaje->hora?>"  required>
                            </div>

                            <div class="form-group">
                                <label for="bus">Bus:</label>
                                <select name="bus" id="bus" class="form-control">
                                    <option value="">Seleccione bus...</option>

                                    <?php foreach($buses as $bus):?>
                                        <option value="<?php echo $bus->id; ?>" <?php echo $bus->id == $viaje->bus_id ? "selected" : ""; ?>><?php echo $bus->placa."(".$bus->asientos.") ", $bus->tipo == 1 ? "Normal":"Bus/Cama"; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="chofer">Conductor:</label>
                                <select name="chofer" id="chofer" class="form-control">
                                    <option value="">Seleccione conductor...</option>

                                    <?php foreach($choferes as $chofer):?>
                                        <option value="<?php echo $chofer->id; ?>" <?php echo $chofer->id == $viaje->chofer_id ? "selected" : ""; ?>><?php echo $chofer->nombres." ".$chofer->apellidos." - ".$chofer->brevete; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="copiloto">Copiloto:</label>
                                <select name="copiloto" id="copiloto" class="form-control">
                                    <option value="">Seleccione copiloto...</option>

                                    <?php foreach($copilotos as $copiloto):?>
                                        <option value="<?php echo $copiloto->id; ?>" <?php echo $copiloto->id == $viaje->copiloto_id ? "selected" : ""; ?>><?php echo $copiloto->nombres." ".$copiloto->apellidos." - ".$copiloto->brevete; ?></option>
                                    <?php endforeach; ?>
                                </select>
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
