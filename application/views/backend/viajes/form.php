<div class="row">
    <div class="col-md-12">
        <form action="<?php echo base_url();?>gestionar/horarios/registrar" method="POST" >

        <table class="table table-bordered" id="tbhorarios">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ruta</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Bus</th>
                    <th>Chofer</th>
                    <th>Copiloto</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $dias_del_mes = date("d", mktime(0,0,0,$mes+1, 0, $year));
                for( $i = 1; $i<= $dias_del_mes; $i++) :?>
                
                <tr>
                    
                    <td><?php echo $i;?></td>
                    <td><input type='hidden' name='rutah[]' value="<?php echo $ruta->id; ?>"><?php echo $ruta->origen." - ".$ruta->destino; ?> </td>
                    <td><input type='date' name='fechah[]' class="form-control" value="<?php echo date('Y-m-d',strtotime($year.'-'.$mes.'-'.$i));?>"></td>
                    <td><input type='time' name='horah[]' value="<?php echo $hora;?>" class="form-control"></td>
                    <td>
                        <select name="bush[]" id="bush" class="form-control">
                        <?php foreach ($buses as $bus): ?>
                            <option value="<?php echo $bus->id;?>"><?php echo $bus->placa."(".$bus->asientos.")";?></option>
                        <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <select name="choferh[]" id="chofer" class="form-control">
                        <?php foreach ($choferes as $chofer): ?>
                            <option value="<?php echo $chofer->id;?>"><?php echo $chofer->nombres." ".$chofer->apellidos;?></option>
                        <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <select name="copilotoh[]" id="copilotoh" class="form-control">
                        <?php foreach ($copilotos as $copiloto): ?>
                            <option value="<?php echo $copiloto->id;?>"><?php echo $copiloto->nombres." ".$copiloto->apellidos;?></option>
                        <?php endforeach ?>
                        </select>
                    </td>                    
                    
                </tr>

            <?php endfor;?>
        

            
            </tbody>
        </table>
        <br>
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>