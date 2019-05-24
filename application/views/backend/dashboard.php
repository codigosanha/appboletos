
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Dashboard
        <small>Panel Control </small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-android-bus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Buses en servicios</span>
                        <span class="info-box-number"><?php echo $cantBuses;?></span>
                    </div>
                
                </div>
              
            </div> -->
            <!-- /.col -->
            <!--<div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-android-people"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total de conductores</span>
                        <span class="info-box-number"><?php echo $cantConductores;?></span>
                    </div>
                    
                </div>
                
            </div>-->
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-android-home"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Oficinas en Servicio</span>
                        <span class="info-box-number"><?php echo $cantTerminales;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Usuarios registrados</span>
                        <span class="info-box-number"><?php echo $cantUsuarios;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!--
		<div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Grafico estadistico</h3>

                        <div class="box-tools pull-right">
                            <select name="year" id="year" class="form-control">
                                <?php foreach($years as $year):?>
                                    <option value="<?php echo $year->year;?>"><?php echo $year->year;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div id="grafico" style="min-width: 310px; height: 400px;margin: 0 auto"></div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
		-->
        <!-- /.row -->
		<!--
        <div class="row">
            <div class="col-md-6">
               
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ultimas Ventas</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                   
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Comprobante</th>
                                        <th>Nro. de Comprobante</th>
                                        <th>Fecha</th>
                                        <th>Importe</th>
                                        <th>Operacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($ventas)): ?>
                                        <?php foreach($ventas as $venta):?>
                                            <tr>
                                                <td><?php echo $venta->nombre;?></td>
                                                <td><?php echo $venta->numero;?></td>
                                                <td><?php echo date("d-m-Y", strtotime($venta->fecha_venta));?></td>
                                                <td><?php echo $venta->importe;?></td>
                                                <td><?php echo $venta->operacion=="C" ? "Venta de Boleto":"Reserva de Boleto";?></td>
                                                
                                                
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
              
                    </div>
              
                    <div class="box-footer clearfix">
                        
                        <a href="<?php echo base_url();?>reportes/ventas" class="btn btn-sm btn-default btn-flat pull-right">Ver Ventas</a>
                    </div>
              
                </div>
              
            </div>
            <div class="col-md-6">
                
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cantidad de salidas de los buses por ruta</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Bus</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Total de Salidas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($salidas)): ?>
                                        <?php foreach($salidas as $salida):?>
                                            <tr>
                                                <td><?php echo $salida->placa;?></td>
                                                <td><?php echo $salida->origen;?></td>
                                                <td><?php echo $salida->destino;?></td>
                                                <td><?php echo $salida->total;?></td>
                                                
                                                
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    
                    </div>
                    
                    
                
                </div>
              
            </div>
        </div>
		-->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la venta</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> </span>Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
