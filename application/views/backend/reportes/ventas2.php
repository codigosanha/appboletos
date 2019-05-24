
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
                                <a href="<?php echo base_url(); ?>reportes/ventas2" class="btn btn-danger">Restablecer</a>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>COD_GROUP</th>
                                        <th>EMISION</th>
                                        <th>VENCIMIENTO</th>
                                        <th>TIPO_DOC</th>
                                        <th>COD_ANEXO</th>
                                        <th>SERIE</th>
                                        <th>RANGO</th>
                                        <th>DESDE</th>
                                        <th>HASTA</th>
                                        <th>MAQ_REGISTRADORA</th>
                                        <th>IMPORTE_TOTAL</th>
                                        <th>COD_GRUPO_COBRO</th>
                                        <th>TIPO_COD_COBRO</th>
                                        <th>NUMERO_DOC_COBRO</th>
                                        <th>FECHA_COBRO</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($ventas)): ?>
                                        <?php 
                                        $i = 147550;
                                        $total = 0;
                                        foreach($ventas as $venta):?>
                                            <tr>
                                                <td>BOLETO</td>
                                                <td><?php echo date("d-m-Y", strtotime($venta->fecha_venta));?></td>
                                                <td></td>
                                                <td><?php echo $venta->nombre == "boleta"? "BT":"FC";?></td>
                                                <td>002</td>
                                                <td><?php echo $venta->serie;?> </td>
                                                <td></td>
                                                <td>
                                                    <?php echo $i;?>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <?php if ($venta->ventas_estadoreg == "anulado"): ?>
                                                    <td>
                                                        - <?php echo $venta->importe;?> 
                                                    </td>
                                                <?php else: ?>
                                                    <td>
                                                        <?php echo $venta->importe;?> 
                                                    </td>
                                                <?php endif ?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                               
                                                
                                                
                                            </tr>

                                            <?php $i++; ?>
                                        <?php endforeach;?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
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
