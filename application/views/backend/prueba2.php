<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/template/css/style.css">
	<style>
	.contenedor-total{
		height: 213px;
		border: 1px solid blue;
	}
		table>tbody>tr>td{
			padding: 6px;
		}
	</style>
</head>
<body>
	<div class="contenedor-total">
		<table style="width:100%">
			<tr>
				<td colspan="3">&nbsp;</td>
				<td class="customFont">25/01/2018</td>
			</tr>
			<tr>
				<td width="200px;"><p class="no-print"><b>Pasajero</b></p></td>
				<td class="customFont">Yony Brondy Mamani Fuentes</td>
				<td><p class="no-print">Documento</p></td>
				<td class="customFont">DNI - 04545452</td>
			</tr>
			<tr>
				<td><p class="no-print">Origen</p></td>
				<td class="customFont">Ilo</td>
				<td><p class="no-print">Destino</p></td>
				<td class="customFont">Moquegua</td>
			</tr>
			<tr>
				<td><p class="no-print">Fecha de Viaje</p></td>
				<td class="customFont">25/01/2018</td>
				<td><p class="no-print">Hora de Viaje</p></td>
				<td class="customFont">10:30 AM</td>
			</tr>
			<tr>
				<td><p class="no-print">asiento</p></td>
				<td class="customFont">51</td>
				<td><p class="no-print">Importe</p></td>
				<td class="customFont">40.00</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;" class="customFont">Cuarenta 00/100 Nuevos Soles</td>
				<td><p class="no-print">Vendedor</p></td>
				<td class="customFont">Matibel Parra</td>
			</tr>
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