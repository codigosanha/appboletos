
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                      <!-- Custom Tabs -->
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_1" data-toggle="tab">Venta/Reservacion</a></li>
                          <li><a href="#tab_2" >Postergaciones</a></li>
                          </li>
                          <li><a href="#tab_4" data-toggle="tab">Ventas Remotas</a></li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-3">
                                    <form action="#" method="POST" id="venta-boleto">
                                        <div class="form-group">
                                            <input type="hidden" name="boleto-idpasajero" class="infopasajero">
                                            <input type="hidden" name="boleto-idviaje">
                                            <input type="hidden" name="venta">
                                            <div class="form-group text-center">
                                                <label class="radio-inline"><input type="radio" name="operacion" value="activo" checked>Venta</label>
                                                <label class="radio-inline"><input type="radio" name="operacion" value="reservado">Reservacion</label>
                                            </div>
                                            <div class="form-group">
                                                <select name="boleto-comprobante" id="boleto-comprobante" class="form-control" required>
                                                <?php foreach ($comprobantes as $comprobante): ?>
                                                    
                                                    <option value="<?php echo $comprobante->id;?>"><?php echo $comprobante->nombre;?></option>
                                                <?php endforeach ?>
                                            </select>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-dni" id="boleto-dni" minlength="8" maxlength="8" required="required" placeholder="DNI">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-nombres" required="required" placeholder="Nombres">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-apellidos" required="required" placeholder="Apellidos">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-edad"  placeholder="Edad">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-telefono" placeholder="Telefono">
                                            </div>
                                         </div>
                                         <div class="form-group">
                                            <label class="radio-inline"><input type="radio" name="sexo" id="radio_m" value="M" checked required>Masculino</label>
                                            <label class="radio-inline"><input type="radio" name="sexo" id="radio_f" value="F">Femenino</label>
                                        </div>
                                         <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-ruc" id="boleto-ruc" placeholder="RUC" minlength="11" maxlength="11">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-razon" placeholder="Razon Social">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-direccion" placeholder="Direccion de Empresa">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-telefono-emp" placeholder="Telefono de Empresa">

                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control infopasajero" name="boleto-viajes" placeholder="Cantidad de Viajes" disabled>
                                                
                                            </div>
                                            
                                         </div>
                                         <div class="form-group">
                                            <div class="row">
                                             <div class="col-md-6">
                                                 <input type="text" class="form-control infopasajero" name="asiento" placeholder="Nro. Asiento" id="num_asiento" readonly>
                                             </div>
                                             <div class="col-md-6">
                                                 <input type="text" class="form-control precio" name="precio" placeholder="Precio">
                                             </div>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                            
                                            <input type="text" class="form-control" name="origen" placeholder="Origen" disabled>
                                            <input type="text" class="form-control" name="destino" placeholder="Destino" disabled>
                                            <input type="text" class="form-control" name="fecha" placeholder="Fecha" disabled>
                                            <input type="text" class="form-control" name="hora" placeholder="Hora" disabled>
                                            
                                            <input type="hidden" name="importe_parcial" id="importe_parcial">
                                            
                                            
                                            <input type="hidden" name="igv" id="igv" value="0" class="infopasajero">
                                            <input type="hidden" name="costo_servicio" id="costo_servicio" class="infopasajero">
                                         </div>
                                        <div class="form-group">
                                            <select name="subida" id="subida" class="form-control" required>
                                                <option value="">Seleccione subida</option>
                                                <?php foreach($terminales as $terminal):?>
                                                    <option value="<?php echo $terminal->id; ?>"><?php echo $terminal->ciudad; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <select name="bajada" id="bajada" class="form-control" required>
                                                <option value="">Seleccione bajada</option>
                                                <?php foreach($terminales as $terminal):?>
                                                    <option value="<?php echo $terminal->id; ?>"><?php echo $terminal->ciudad; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="time" placeholder="Hora de Pago" name="hora-pago" style="display:none;" class="form-control infopasajero">
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="submit" id="btn-guardar" class="btn btn-success btn-flat" disabled="disabled">Guardar</button>
                                            <button type="button" id="btn-cancelar" class="btn btn-danger btn-flat">Cancelar</button>
                                            <button type="button" class="btn btn-primary btn-flat btn-info-viaje" data-toggle="modal" data-target="#modal-default" disabled="disabled">Info. de Viaje</button>                              
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-9">
                                    <form action="#" method="POST" id="form-consultar-viaje">
                                        <div class="row">
                                            <div class="form-group">
                                                <?php $dias = array("domingo","lunes","martes","miercoles","jueves","viernes","sabado");?>
                                                <div class="col-md-2">
                                                    <input type="text" id="dia-letras" value="<?php echo strtoupper($dias[date("w")]);?>" disabled class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" class="form-control" name="fecha_horario" id="fecha_horario"  value="<?php echo date('Y-m-d');?>" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="ruta" id="ruta" class="form-control" required>
                                                        <option value="">Ruta..</option>
                                                        <?php foreach ($rutas as $ruta):?>
                                                            <option value="<?php echo $ruta->id;?>"><?php echo $ruta->origen." - ".$ruta->destino;?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                
                                                
                                                
                                                <div class="col-md-2">
                                                    <select name="horas" id="horas" class="form-control" required>
                                                        <option value="">Horarios..</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                                </div>
                                            </div>
                                            
                                        
                                        </div>
                                    </form>
                                    <br>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-ver-manifiesto" data-toggle="modal" data-target="#modal-default2" disabled="disabled">Ver Manifiesto</button>
                                    </div>
                                    
                                    
                                    <div class="bus">
                                    </div>
                                    <br>
                                    <div id="ticket">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table id="tbticket" class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                           <td colspan="2" class="text-center">
                                                                <b>ET Delgado Rodriguez - Tciekts Web - Ventas</b><br>
                                                                Av.Jorge Chavez 1355 - Urb.Campodonico CHICLAYO<br>
                                                                Tel. (074) 491131 / 979100687 / 978374401 <br>
                                                                Email:ventas@transportesdelgado.pe
                                                                </td>
                                                                <td class="text-center">
                                                                RUC : 20524458501<br>
                                                                <b></b> <br>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <b>Pasajero:</b><br>
                                                                
                                                            </td>
                                                            <td>
                                                                <b>DNI:</b> <br>
                                                                
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <b>Razon Social:</b><br>
                                                                 
                                                            </td>
                                                            <td>
                                                                <b>RUC:</b> <br>
                                                                
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <b>Destino:</b> <br>
                                                                
                                                            </td>
                                                            <td>
                                                                <b>Origen:</b> <br>
                                                                
                                                            </td>
                                                            <td>
                                                                <b>Fecha de Viaje:</b> <br>
                                                                
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <b>Importe:</b> <br>
                                                                
                                                            </td>
                                                            <td>
                                                                <b>Vendedor:</b> <br>
                                                                
                                                            </td>
                                                            <td>
                                                                <b>Hora de viaje:</b> <br>
                                                                
                                                            </td>
                                                        </tr>           
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="boton-imprimir">
                                        
                                    </div>
                                </div>
                            </div>
                          </div>
                          <!-- /.tab-pane -->
                          <div class="tab-pane" id="tab_2">
                            <div class="row">
                                <!-- <form action="#" method="POST" id="comprobar-numero-comprobante">
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <select name="comprobante-postergar"  class="form-control" required>
                                            <?php foreach ($comprobantes as $comprobante): ?>
                                                
                                                <option value="<?php echo $comprobante->id;?>"><?php echo $comprobante->nombre;?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="serie-postergar" placeholder="Introduzca Serie">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="doc_numero" placeholder="Introduzca numero comprobante">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-danger">Buscar</button>
                                    </div>
                                </div>
                                </form> -->
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <h4>Indique ruta, fecha y hora </h4>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <form action="#" method="POST" id="form-consultar-infoviaje">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <input type="date" class="form-control input-postergar" name="fecha-postergar" id="fecha-postergar" value="<?php echo date('Y-m-d');?>" required >
                                    </div>
                                    <div class="col-md-3">
                                        <select name="ruta-postergar" id="ruta-postergar" class="form-control input-postergar" required >
                                            <option value="">Ruta..</option>
                                            <?php foreach ($rutas as $ruta):?>
                                                <option value="<?php echo $ruta->id;?>"><?php echo $ruta->origen." - ".$ruta->destino;?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="horas-postergar" id="horas-postergar" class="form-control input-postergar" required >
                                            <option value="">Horarios..</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary input-postergar" >Buscar</button>
                                    </div>
                                </div>
                                
                            
                            </div>
                            </form>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <form action="#" method="POST" id="form-update-asiento">
                                        <input type="hidden" name="idventa">
                                        <input type="hidden" name="idviaje_postergar">
                                        <div class="form-group">
                                            <input type="text" id="nombres_postergar" disabled placeholder="Nombres y Apellidos" class="form-control">
                                            <input type="text" id="dni_postergar" disabled placeholder="DNI" class="form-control">
                                            <input type="text" id="fecha_postergar" disabled placeholder="Fecha de venta" class="form-control">
                                            <input type="text" id="numero_postergar" disabled placeholder="Numero de Comprobante" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="asiento-postergar" id="num_asiento_postergar" readonly placeholder="Nro de asiento" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success input-postergar">Guardar</button>
                                            <button type="button" class="btn btn-danger btn-cancelar-postergacion">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-9">
                                    <div class="bus-postergar">
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            
                          </div>
                          <!-- /.tab-pane -->
                          <div class="tab-pane" id="tab_3">
                            <div class="row">
                                <form action="#" method="POST" id="form-anular">
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <select name="comprobante-postergar"  class="form-control" required>
                                            <?php foreach ($comprobantes as $comprobante): ?>
                                                
                                                <option value="<?php echo $comprobante->id;?>"><?php echo $comprobante->nombre;?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="serie-postergar" placeholder="Introduzca Serie">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="doc_numero" placeholder="Introduzca numero comprobante">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-danger">Buscar</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                          </div>
                          <!-- /.tab-pane -->
                          <div class="tab-pane" id="tab_4">
                            <div class="row">
                                <form action="#" method="POST" id="form-remoto">
                                <div class="form-group">
                                    
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="dni-remoto" name="dni-remoto" minlength="8" maxlength="8" placeholder="Introduzca DNI">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" class="form-control" name="fecha-remoto" placeholder="Introduzca fecha" value="<?php echo date("Y-m-d");?>">
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-danger">Buscar</button>
                                    </div>
                                </div>
                                </form>

                                <div class="tbremoto">
                                    
                                </div>
                            </div>
                          </div>
                          <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                      </div>
                      <!-- nav-tabs-custom -->
                    </div>
                    <!-- /.col -->

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
        <h4 class="modal-title">Informacion</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-default2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de Manifiesto</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success btn-print-manifiesto">Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->