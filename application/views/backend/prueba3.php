<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/template/css/style.css">
	<style>
		.contenedor-total{
			width: 310px;
			border: 1px solid red;
			padding: 10px;
		}
		p.infoempresa{
			text-align: center;
		}
		table > thead > tr> td{
			border: 1px solid #000;
		}
	</style>
</head>
<body>
	<div class="contenedor-total">
		<p class="infoempresa">
			TRANSPORTES BRONDYS S.A.C
		</p>
		<p class="infoempresa">
			Calle Moquegua 420
		</p>
		<p class="infoempresa">
			Ilo - Moquegua
		</p>
		<p class="infoempresa">BOLETA DE VENTA</p>
		<p class="infoempresa">Nro. 001-000054</p>
		<p>FECHA DE EMISION: 24/01/2018</p>
		<p>DNI: 57575656</p>
		<p>CLIENTE: YONY BRONDY MAMANI FUENTES</p>

		<table cellspacing="0" cellpadding="0" >
			<thead>
				<tr>
					<td>#</td>
					<td style="text-align: center;">Detalle</td>
					<td>TOTAL</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>
						<p>
							SERVICIO DE TRANSPORTE <br>
							PASAJERO: YONY BRONDY MAMANI FUENTES <br>
							DNI: 57575656 <br>
							ORIGEN: ILO <br>
							DESTINO: ILO <br>	
							TIPO SERVICIO: BUS CAMA <br>
							FECHA DE VIAJE: 25/01/2018 <br>
							HORA DE VIAJE: 7:30 PM <br>	
							ASIENTO: 14 <br>			
						</p>
					</td>
					<td>50.00</td>
				</tr>
				
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2" style="text-align: right;"> TOTAL</td>
					<td>50.00</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<button type="button" class="btn btn-primary btn-print">
		Imprimir
	</button>

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-print/jquery.print.js"></script>
<script>
	$(document).on("click",".btn-print",function(){
        $(".contenedor-total").print({
            globalStyles: true,
        	mediaPrint: false,
        	stylesheet: null,
        	noPrintSelector: ".no-print",
        	iframe: true,
        	append: null,
        	prepend: null,
        	manuallyCopyFormValues: true,
        	deferred: $.Deferred(),
        	timeout: 750,
        	title: null,
        	doctype: '<!doctype html>'
        });
    });
</script>

</body>
</html>