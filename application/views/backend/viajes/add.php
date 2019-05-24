
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Horario
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
                        
                        <div class="row">
                            <div class="form-group">
                                <form id="form-horario" method="POST">
                                <div class="col-md-2">
                                    <label for="ruta">Ruta:</label>
                                    <select name="ruta" id="ruta" class="form-control" required>
                                        <?php foreach($rutas as $ruta):?>
                                            <option value="<?php echo $ruta->id; ?>"><?php echo $ruta->origen." - ".$ruta->destino; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="year">Año:</label>
                                    <?php $yearArray = range(date("Y"), date("Y") + 10 );?>
                                    <select name="year" id="year" class="form-control" required>
                                        <?php foreach ($yearArray as $year) {
                                            // if you want to select a particular year
                                            $selected = ($year == date("Y")) ? 'selected' : '';
                                            echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                                        }?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="mes">Mes:</label>
                                    <select name="mes" id="mes" class="form-control" required>
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Setiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="hora">Hora de Salida:</label>
                                    <input type="time" name="hora" id="hora" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button type="submit" id="btn-consultar-configurar" class="btn btn-success btn-block">Gestionar</button>
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <a href="<?php echo base_url();?>gestionar/horarios" class="btn btn-danger btn-block">Volver</a>
                                </div>
                            </div>
                            </form>

                 
                        </div>
                        <br>
                        <div class="error"></div>
                        <div class="tabla"></div>
                    </div>
                </div>
            <!-- /.box-body -->
            </div>
        </div>
        <!-- /.box -->
        </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
