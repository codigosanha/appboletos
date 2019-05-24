
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Reportes
        <small>Ventas</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <input type="hidden" id="title" value="Listado de Ventas">
                    <form action="<?php echo current_url();?>" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-1 control-label">Desde:</label>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="fechainicio" value="<?php echo !empty($fechainicio) ? $fechainicio: date('Y-m-d');?>" max="<?php echo date("Y-m-d");?>">
                            </div>
                            <label for="" class="col-md-1 control-label">Hasta:</label>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="fechafin" value="<?php  echo !empty($fechafin) ? $fechafin:date('Y-m-d');?>" max="<?php echo date("Y-m-d");?>">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
                                <a href="<?php echo base_url(); ?>reportes/ventas" class="btn btn-danger">Restablecer</a>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Comprobante</th>
                                    <th>Nro. Comprobante</th>
                                    <th>Fecha</th>
                                    <th>Importe</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0;?>
                                <?php if (!empty($ventas)): ?>
                                    <?php 
                                    $i = 1;
                                    
                                    foreach($ventas as $venta):?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $venta->nombre;?></td>
                                            <td><?php echo $venta->numero;?></td>
                                            <td><?php echo date("d-m-Y", strtotime($venta->fecha_venta));?></td>
                                            
                                            <?php if ($venta->ventas_estadoreg == "anulado"): ?>
                                                <td style="color:red;">
                                                 - <?php echo $venta->importe;?> 
                                                 </td>
                                            <?php else: ?>
                                                <?php $total = $total + $venta->importe; ?>
                                                <td style="color:green;">
                                                 <?php echo $venta->importe;?> 
                                                 </td>
                                            <?php endif ?>
                                            <td><?php echo $venta->ventas_estadoreg;?></td>
                                           
                                            
                                            
                                        </tr>

                                        <?php $i++; ?>
                                    <?php endforeach;?>
                                <?php endif ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <th>Total:</th>
                                    <td><?php echo $total?></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
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
