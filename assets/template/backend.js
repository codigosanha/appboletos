$(document).ready(function () {
    setInterval(actualizarBus,10000);
    alertaCaducidad();

    $("#fecha_horario").on("change",function(){
        fecha = $(this).val();
        let date = new Date(fecha);

        let dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado","Domingo"];
        $("#dia-letras").val((dias[date.getDay()]).toUpperCase());
    });
   
    $("input[name=fechainicio]").on("change", function(){
        $("input[name=fechafin]").attr("min",$(this).val());
    });
    $("#boleto-dni, #boleto-ruc, #dni,#ruc, #telefono, #dni-remoto").keypress(function(tecla) {
        if (tecla.charCode < 48 || tecla.charCode > 57) {
            return false;
        }
    });
    /*$("#brevete").keypress(function(tecla){
        var re = new RegExp('^[a-zA-Z][0-9]{7}$');
        //re.test('CC8A8');
        if (!re.test(tecla)) {
            return false;
        }
    });*/
    $(".btn-ver-manifiesto").on("click",function(){
        idviaje = $("input[name=boleto-idviaje]").val();
        $.ajax({
            url: base_url + "gestionar/ventas/manifiesto",
            type: "POST",
            data:{id:idviaje},
            success:function(resp){
                $("#modal-default2 .modal-body").html(resp);
            }
        });
    });
    $("input[name=operacion]").click(function() {
        operacion = $(this).val();
        if (operacion == "reservado") {
            $("input[name=hora-pago]").css("display","block").attr("required","required");
        }else{
            $("input[name=hora-pago]").css("display","none");
        }
    });
    $(document).on("click","#change-password",function(){

        $("input[name=idusuario]").val($(this).val());

    });

    $(document).on("submit","#form-change-password",function(e){
        e.preventDefault();
        info = $(this).serialize();
        newpassword = $("input[name=newpassword]").val();
        repeatpassword = $("input[name=repeatpassword]").val();
        if (newpassword != repeatpassword) {
            error = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> La contraseñas ingresadas no coindicen</div>';
            $(".error").html(error);
        }else{
            $.ajax({
                url: base_url + "administrador/usuarios/changepassword",
                type: "POST",
                data: info,
                success: function(resp){
                    window.location.href = base_url + resp;
                }
            });
        }
    })
    $("#form-horario").submit(function(e){
       e.preventDefault();
       info = $(this).serialize();

       $.ajax({
            url: base_url + "gestionar/horarios/getdata",
            type:"POST",
            data: info,
            //dataType:"json",
            success:function(resp) {
                $(".tabla").html(resp);
                
            }
        });
    });

    $("#form-horario-edit").submit(function(e){
       e.preventDefault();
       info = $(this).serialize();

       $.ajax({
            url: base_url + "gestionar/horarios/update",
            type:"POST",
            data: info,
            dataType:"json",
            success:function(resp) {

                if (resp=="1") {
                    window.location.href = base_url + "gestionar/horarios";
                }else{
                    message = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>';
                    $.each(resp, function(key, value){
                        message += '<li>'+value+'</li>';
                    });
                    message += '</ul></div>';
                    $(".error").html(message);
                }
                
            }
        });
    });

    $(document).on("click",".btn-cancelar-postergacion",function(){
        $('.nav-tabs a[href="#tab_1"]').tab('show');
    });
    $(document).on("click",".btn-postergar",function(){
        $("#modal-default").modal('hide');
        $('.nav-tabs a[href="#tab_2"]').tab('show');
    });
    $(document).on("click",".btn-pagar",function(){
        idventa = $(this).val();

        $.ajax({
            url: base_url + "gestionar/ventas/pagar",
            type:"POST",
            data: {id:idventa},
            //dataType:"json",
            success:function(resp) {
                if (resp == "0") {
                    alertify.error("No se existe informacion del numero ingresado");
                }else{
                    alertify.success("El Boleto fue pagado");
                    $("#modal-default").modal('hide');
                }
                
            }
        });


    });
    $(document).on("click",".btn-anular",function(){
        idventa = $(this).val();

        alertify.confirm("Deseas Eliminar este registro?", function(e){
            if (e) 
            {
                $.ajax({
                    url: base_url + "gestionar/ventas/anular",
                    type:"POST",
                    data: {id:idventa},
                    //dataType:"json",
                    success:function(resp) {
                        if (resp == "0") {
                            alertify.error("No se existe informacion del numero ingresado");
                        }else{
                            alertify.success("El Boleto fue anulado");
                            asientosVendidos($("input[name=boleto-idviaje]").val());
                            $("#modal-default").modal('hide');
                        }
                        
                    }
                });

            }
        });
    });
    $(document).on("click",".btn-info",function(){
        $("#modal-default").modal('show');
        idventa = $(this).val();
        $.ajax({
            url:base_url + "gestionar/ventas/getinfoboleto",
            type: "POST",
            data: {id:idventa},
            dataType: "json",
            success:function(resp){
                html = "<p><b>Tipo de Comprobante: </b>"+resp.venta.nombre+"</p>";
                html += "<p><b>Serie y Numero: </b>"+resp.venta.serie+" - "+resp.venta.numero+"</p>";
                html += "<p><b>Pasajero: </b>"+resp.venta.nombres+" "+resp.venta.apellidos+"</p>";
                html += "<p><b>Origen: </b>"+resp.venta.origen+"</p>";
                html += "<p><b>Destino: </b>"+resp.venta.destino+"</p>";
                html += "<p><b>Fecha de Viaje: </b>"+resp.venta.fecha+"</p>";
                html += "<p><b>Hora de Viaje: </b>"+resp.venta.hora+"</p>";
                html += "<p><b>Subida: </b>"+resp.venta.subidap+"</p>";
                html += "<p><b>Bajada: </b>"+resp.venta.bajadap+"</p>";
                html += "<p><b>Costo de Boleto: </b>"+resp.venta.importe+"</p>";
                html += "<p><b>Viajes Hechos: </b>"+resp.cantidadviajes.total+"</p>";
                if (resp.venta.ventas_estadoreg == "reservado") {
                    html += "<p><b>Hora de Pago: </b>"+resp.venta.horapago+"</p>";
                }
                html += "<button type='button' class='btn btn-warning btn-postergar' value='"+resp.venta.id+"'>Postergar</button> ";
                html += "<button type='button' class='btn btn-danger btn-anular' value='"+resp.venta.id+"'>Anular</button> ";
                if (resp.venta.ventas_estadoreg == "reservado") {
                    html += "<button type='button' class='btn btn-success btn-pagar' value='"+resp.venta.id+"'>Pagar Boleto</button>";
                }
                $("#nombres_postergar").val(resp.venta.nombres+" "+resp.venta.apellidos);
                $("#dni_postergar").val(resp.venta.dni);
                $("#fecha_postergar").val(resp.venta.fecha_venta);
                $("input[name=idviaje_postergar]").val(resp.venta.viaje_id);
                $("input[name=idventa]").val(resp.venta.id);
                $("#numero_postergar").val(resp.venta.serie +" - "+resp.venta.numero);
                $("#modal-default .modal-body").html(html);

            }
        });
    });
    
    $("#form-remoto").submit(function(e){
        e.preventDefault();
        info = $(this).serialize();
        $.ajax({
            url: base_url + "gestionar/ventas/remota",
            type:"POST",
            data: info,
            //dataType: "json",
            success:function(resp){
                if (resp==0) {
                    alertify.error("No se encontro ninguna venta remota con el DNI ingresado");
                }else{
                    $('#modal-default').modal('show');
                    $("#modal-default .modal-body").html(resp);
                }
                
              
            }
        });

    });
    $(document).on("click", ".btn-prueba", function(){
        $.ajax({
            url: base_url + "gestionar/ventas/print",
            type:"POST",
            data:{},
            success:function(resp){
                alert(resp);
              
            }
        });
    });
    $("#iddep").on("change", function(){
        iddep = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/terminales/getProvincias",
            type:"POST",
            data: {id:iddep},
            dataType:"json",
            success:function(resp){
                optionsProv = "<option value=''>Seleccione provincia...</option>";
                $.each(resp, function(key, value){
                    optionsProv += "<option value='"+value.idProv+"'>"+value.provincia+"</option>"
                });
                $("#idprov").html(optionsProv);
              
            }
        });
    });

    $("#idprov").on("change", function(){
        idprov = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/terminales/getDistritos",
            type:"POST",
            data: {id:idprov},
            dataType:"json",
            success:function(resp){
                optionsDist = "<option value=''>Seleccione distrito...</option>";
                $.each(resp, function(key, value){
                    optionsDist += "<option value='"+value.idDist+"'>"+value.distrito+"</option>"
                });
                $("#iddist").html(optionsDist);
              
            }
        });
    });

   $(document).on("click",".btn-save",function(e){
        valbutton = $(this).val();
        rutah = $(this).closest("tr").find("td:eq(1)").children("input").val();
        fechah = $(this).closest("tr").find("td:eq(2)").children("input").val();
        horah = $(this).closest("tr").find("td:eq(3)").children("input").val();
        bush = $(this).closest("tr").find("td:eq(4)").children("select").val();
        choferh = $(this).closest("tr").find("td:eq(5)").children("select").val();
        copilotoh = $(this).closest("tr").find("td:eq(6)").children("select").val();
        $.ajax({
            url: base_url+ "gestionar/horarios/store",
            type:"POST",
            data: {rutah:rutah,fechah:fechah,horah:horah,bush:bush,choferh:choferh,copilotoh:copilotoh},
            dataType:"json",
            success:function(resp){
                if (resp=="1") {
                    alertify.success("Se guardo correctamente");
                    $("#btn-"+valbutton).attr("disabled","disabled");
                }else{
                    message = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>';
                    $.each(resp, function(key, value){
                        message += '<li>'+value+'</li>';
                    });
                    message += '</ul></div>';
                    $(".error").html(message);
                }
                
              
            }
        });
    });
    $(".btn-info-viaje").on("click", function(){
         idviaje  = $("input[name=boleto-idviaje]").val();
         $.ajax({
            url: base_url + "gestionar/ventas/detalleviaje",
            type:"POST",
            data: {id:idviaje},
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
            }
        });
    });

    var year = (new Date).getFullYear();
    datagrafico(base_url,year);
    $("#year").on("change",function(){
        yearselect = $(this).val();
        datagrafico(base_url,yearselect);
    });
    //limpiar formulario de ventas
    $("#btn-cancelar").on("click", function(){
        if ($("input[name=venta]").val() != "") {
            ventaID = $("input[name=venta]").val();
             $.ajax({
                url:base_url+ "gestionar/ventas/delete",
                type: "POST",
                data: { id:ventaID},
                success:function(resp){
                    if (resp == "1") {
                        $("input[name=venta]").val(null);
                        asientosVendidos($("input[name=boleto-idviaje]").val());
                    }
                    
                }
            });
        }
       
        $(".infopasajero").val(null);
        $("#radio_m").attr('checked', false);
        $("#radio_f").attr('checked', false);
        $("#btn-guardar").attr("disabled","disabled");

    });
    //sumar al importe
    $(document).on("click",".bus .btn-asiento",function(){
        value = $(this).val();
        if ($("#num_asiento").val() == "") {

            info = value.split("*");
            $("#num_asiento").val(info[0]);
            $("#costo_servicio").val(info[1]);
            calcular();

            $("#btn-guardar").removeAttr("disabled");
            $("#boleto-dni").focus();
            idviaje = $("input[name=boleto-idviaje]").val();
            ventaID = $("input[name=venta]").val();
            num_asiento = info[0];
            $.ajax({
                url:base_url  + "gestionar/ventas/marcar",
                type:"POST",
                data:{asiento:num_asiento,idviaje:idviaje,venta:ventaID},
                success:function(resp){
                    //alert(resp);
                    $("input[name=venta]").val(resp);
                    //actualizarBus();
                    
                }
            });
        }
        else{
            alertify.error("Ud. ya selecciono un asiento, haga click Cancelar para seleccionar otro asiento");
        }
        
        /*valor = Number($(this).val());
        importe_parcial = Number($("input[name=importe_parcial]").val());
        $("input[name=precio]").val((importe_parcial + valor).toFixed(2));*/
    });

    $(document).on("click",".bus-postergar .btn-asiento",function(){
        value = $(this).val();
        info = value.split("*");
        //alert(info[0]);
        $("#num_asiento_postergar").val(info[0]);
    });
    //Bloquear los asientos del bus
    deshabilitar_bus();
    //habilitar / Deshabilitar precio del servicio
    $("#tipo").on("change", function(){
        tipo = $(this).val();
        if (tipo == "2") {
            $("input[name=inicial]").removeAttr("disabled");
            $("input[name=final]").removeAttr("disabled");
            $("input[name=servicio]").removeAttr("disabled");
        }
        else{
            $("input[name=inicial]").val(null);
            $("input[name=final]").val(null);
            $("input[name=servicio]").val(null);
            $("input[name=inicial]").attr("disabled","disabled");
            $("input[name=final]").attr("disabled","disabled");
            $("input[name=servicio]").attr("disabled","disabled");
        }
    });
    //servicios
    $("#ruta").on("change", function(){
        ruta = $(this).val();
        fecha = $("#fecha_horario").val();

        $.ajax({
            url: base_url + "gestionar/ventas/gethoras",
            type: "POST",
            data: {idruta:ruta, fechaviaje:fecha},
            dataType: "json",
            success:function(resp){
                html = "<option value=''>Horarios...</option>";

                $.each(resp, function(key, value){
                    infohora = value.hora.split(":");
                    hora = formatAMPM(Number(infohora[0]),Number(infohora[1]));
                    html += "<option value='"+value.hora+"'>"+hora+"</option>";
                });
                $("#horas").html(html);
            }
        });
    });
    $("#ruta-postergar").on("change", function(){
        ruta = $(this).val();
        fecha = $("#fecha-postergar").val();

        $.ajax({
            url: base_url + "gestionar/ventas/gethoras",
            type: "POST",
            data: {idruta:ruta, fechaviaje:fecha},
            dataType: "json",
            success:function(resp){
                html = "<option value=''>Horarios...</option>";

                $.each(resp, function(key, value){
                    infohora = value.hora.split(":");
                    hora = formatAMPM(Number(infohora[0]),Number(infohora[1]));
                    html += "<option value='"+value.hora+"'>"+hora+"</option>";
                });
                $("#horas-postergar").html(html);
            }
        });
    });


    //Consultar informacion de viaje
    $("#form-consultar-viaje").submit(function(e){
        e.preventDefault();

        info = $(this).serialize();
        $.ajax({
            url: base_url + "gestionar/ventas/infoviaje",
            type:"POST",
            data: info,
            dataType:"json",
            success:function(resp){
                if (resp == "0") {
                    $(".btn-info-viaje").attr("disabled","disabled");
                    alertify.error("No se encontro informacion de algun viaje para esa ruta en la hora y fecha ingresada");
                    
                }else {
                    deshabilitar_bus();
                    $(".btn-ver-manifiesto").removeAttr("disabled");
                    $("#subida").val(resp.subida);
                    $("#bajada").val(resp.bajada);
                    $("#radio_m").attr('checked', false);
                    $("#radio_f").attr('checked', false);
                    $(".infopasajero").val(null);
                    $(".btn-info-viaje").removeAttr("disabled");
                    printBusVenta(resp.id);
                    $("input[name=boleto-idviaje]").val(resp.id);
                    $("input[name=origen]").val(resp.origen);
                    $("input[name=destino]").val(resp.destino);
                    $("input[name=fecha]").val(toDate(resp.fecha));
                    infohora = resp.hora.split(":");
                    hora = formatAMPM(Number(infohora[0]),Number(infohora[1]));
                    $("input[name=hora]").val(hora);
                    precio = Number(resp.precio);
                     $("input[name=importe_parcial]").val(resp.precio);
                    $("input[name=precio]").val(precio.toFixed(2));


                }
            }
        });
        
    });
    $("#form-consultar-infoviaje").submit(function(e){
        e.preventDefault();

        info = $(this).serialize();
        $.ajax({
            url: base_url + "gestionar/ventas/infoviajepostergar",
            type:"POST",
            data: info,
            dataType:"json",
            success:function(resp){
                if (resp == "0") {
                    alertify.error("No se encontro informacion de algun viaje para esa ruta en la hora y fecha ingresada");
                    
                }else {
                    
                    printBusPostergar(resp.id);
                    $("input[name=idviaje_postergar]").val(resp.id);

                }
            }
        });
        
    });
    $("#boleto-comprobante").on("change",function(){
        id = $(this).val();
       
        $.ajax({
            url: base_url + "gestionar/ventas/infocomprobante",
            type:"POST",
            data: {id:id},
            dataType:"json",
            success:function(resp){
                $("#igv").val(resp.igv)
                calcular();
            }
        });
        

    })

    //consultar datos de pasajero
    $(document).on("keyup click change","#boleto-dni", function(){
        dni = $(this).val();
        $.ajax({
            url: base_url+"gestionar/ventas/getPasajero",
            type: "POST",
            data: {dni:dni},
            dataType:"json",
            success:function(resp){
                if (resp == '0') {
                    $("input[name=boleto-idpasajero]").val(null);
                }else {
                    $("input[name=boleto-idpasajero]").val(resp.pasajero.id);
                    $("input[name=boleto-nombres]").val(resp.pasajero.nombres);
                    $("input[name=boleto-apellidos]").val(resp.pasajero.apellidos);
                    $("input[name=boleto-edad]").val(resp.pasajero.edad);
                    $("input[name=boleto-telefono]").val(resp.pasajero.telefono);
                    $("input[name=boleto-ruc]").val(resp.pasajero.ruc);
                    $("input[name=boleto-razon]").val(resp.pasajero.razon);
                    $("input[name=boleto-direccion]").val(resp.pasajero.direccion);
                    $("input[name=boleto-telefono-emp]").val(resp.pasajero.tel_empresa);
                    if (resp.pasajero.sexo == "M") {
                        $("#radio_m").attr('checked', true);
                    }else{
                        $("#radio_f").attr('checked', true);
                    }
                    $("input[name=boleto-viajes]").val(resp.viajes.total);
                }
                
            }
        });
    });


    //Guardando la informacion de la venta del boleto
    $(document).on("submit","form#venta-boleto",function(e){
        e.preventDefault();
        if ($("#num_asiento").val() == "") {
            alert("Seleccione un Asiento del Bus");
            return false;
        } else {
            info = $(this).serialize();
            $.ajax({
                url: base_url + "gestionar/ventas/store",
                type:"POST",
                data: info,
                //dataType:"json",
                success:function(resp){
                    if (resp == "0") {
                        alert("Ocurrio un error en la venta del boleto");
                        
                    } else if(resp == "1")
                    {
                        alert("El numero de asiento ha sido ocupado");
                    }
                    else{
                        $("#btn-guardar").attr("disabled","disabled");

                        if (resp!="R") {
                            alertify.success("La venta del boleto fue exitosa");
                            $("#ticket").html(resp);
                        }else{
                            alertify.success("Reservación Exitosa");
                        }
                        setearfecha();
                        botonimprimir = '<button type="button" class="btn btn-primary btn-print">Imprimir</button>';
                        botonimprimir += '<button type="button" onclick="limpiarboleto();" class="btn btn-danger">Limpiar Ticket</button>';
                        $(".boton-imprimir").html(botonimprimir);
                        //ticket(resp);
                        asientosVendidos($("input[name=boleto-idviaje]").val());
                        $(".infopasajero").val(null);
                        $("input[name=venta]").val(null);
                        $("#radio_m").attr('checked', false);
                        $("#radio_f").attr('checked', false);
                        $("input[name=precio]").val($("input[name=importe_parcial]").val());
                        //limpiar_formulario();
                        actualizarBus();

                    }
                }
            });
        }
        
    });


    //Accion del boton eliminar
    $(document).on("click", ".btn-remove", function(e){
        e.preventDefault();
        var ruta = $(this).attr("href");

        alertify.confirm("Deseas Eliminar este registro?", function(e){
            if (e) 
            {
                $.ajax({
                    url: ruta,
                    type:"POST",
                    success:function(resp){
                        //http://localhost/ventas_ci/mantenimiento/productos
                        window.location.href = base_url + resp;
                    }
                });

            }
        });
        //alert(ruta);
    });
    $(document).on("click",".btn-print-manifiesto",function(){
       $("#modal-default2 .modal-body").print();
    });
    $(document).on("click",".btn-print-rm",function(){
       $(".manifiesto-reporte").print();
    });
    $(document).on("click",".btn-print",function(){
       $("#ticket").print();
    });
    $(document).on("click",".btn-print-remoto",function(){
       $("#modal-default .modal-body").print();
    });

    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: $("#title").val(),
                footer: true 
            },
            {
                extend: 'pdfHtml5',
                title: $("#title").val(),
                footer: true 
                
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
 
    $('#example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    $('.example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('.sidebar-menu').tree();

    $("#comprobar-numero-comprobante").submit(function(e){
        e.preventDefault();
        info = $(this).serialize();
        $.ajax({
            url: base_url + "gestionar/ventas/infoboleto",
            type:"POST",
            data: info,
            dataType:"json",
            success:function(resp) {
                if (resp == "0") {
                    alertify.error("No se existe informacion del numero ingresado");
                }else{
                    $(".input-postergar").removeAttr("disabled");
                    $("input[name=idventa]").val(resp.id);
                    $("#nombres_postergar").val(resp.nombres+" "+resp.apellidos);
                    $("#dni_postergar").val(resp.dni);
                    $("#fecha_postergar").val(toDate(resp.fecha_venta));
                    $("#numero_postergar").val(resp.numero);
                }
                
            }
        });
    });

    $("#form-update-asiento").submit(function(e){
        e.preventDefault();
        info = $(this).serialize();
        $.ajax({
            url: base_url + "gestionar/ventas/updateinfoboleto",
            type:"POST",
            data: info,
            success:function(resp) {
                if (resp == "1") {

                    alertify.success("La postergacion se realizo correctamente");
                    asientosVendidos($("input[name=boleto-idviaje]").val());
                    $('.nav-tabs a[href="#tab_1"]').tab('show');
                    $("#form-consultar-infoviaje")[0].reset();
                    $("#comprobar-numero-comprobante")[0].reset();
                    $("#form-update-asiento")[0].reset();
                    $(".input-postergar").attr("disabled","disabled");
                    $(".bus-postergar").html("");

                    
                }
                else{
                    alertify.error("Seleccione otro asiento");
                }
            }
        });
    });

    $("#form-anular").submit(function(e){
        e.preventDefault();
        info = $(this).serialize();
        $.ajax({
            url: base_url + "gestionar/ventas/anular",
            type:"POST",
            data: info,
            dataType:"json",
            success:function(resp) {
                if (resp == "0") {
                    alertify.error("No se existe informacion del numero ingresado");
                }else{
                    alertify.success("El Boleto fue anulado");
                }
                
            }
        });
    });

});
//retornar el formato de la hora, por ejemplo : 2:00 p.m
function formatAMPM(hours, minutes) {
      
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}



//limpia el formulario de la venta del boleto y de los selectores
function limpiar_formulario(){
    $("form#venta-boleto")[0].reset();
    $("input[name=boleto-idpasajero]").val(null);

}

function printBusVenta(idviaje){
    $.ajax({
        url: base_url + "gestionar/ventas/asientos/"+idviaje,
        type:"POST",
        success:function(resp){
            //http://localhost/ventas_ci/mantenimiento/productos
            $(".bus").html(resp);
            asientosVendidos(idviaje);
        }
    });
}

function printBusPostergar(idviaje){
    $.ajax({
        url: base_url + "gestionar/ventas/asientos/"+idviaje,
        type:"POST",
        success:function(resp){
            //http://localhost/ventas_ci/mantenimiento/productos
            $(".bus-postergar").html(resp);

            asientosVendidosPostergar(idviaje);
        }
    });
}

function asientosVendidos(idviaje){
    $.ajax({
        url: base_url + "gestionar/ventas/asientosvendidos/"+idviaje,
        type:"POST",
        data:{},
        dataType:"json",
        cache:false,
        success:function(resp){
            //http://localhost/ventas_ci/mantenimiento/productos
            for (var i = resp.cantidadasientos; i >= 1; i--) {
                value = i + "*" + 0;
                if (resp.costo != null) {
                    if(i>= 47 && i<=58){
                        value = i+"*"+resp.costo;
                    }
                }

                $(".bus #asiento-"+i).val(value);

            }
                           
            $(".bus .btn").removeAttr("style");
            $.each(resp.asientos, function(key, value){
                if (value.ventas_estadoreg == "activo") {
                    bagde = '<span class="badge badge-success">N</span>';
                }
                if (value.ventas_estadoreg == "postergado") {
                    bagde = '<span class="badge badge-warning">P</span>';
                }
                if (value.ventas_estadoreg == "reservado") {
                    bagde = '<span class="badge badge-info">R</span>';
                }

                if (value.sexo !=null) {
                    if (value.sexo == "Femenino") {
                        contenido = '<i class="fa fa-female" aria-hidden="true"></i> '+bagde+'<br>';
                    }else{
                        contenido = '<i class="fa fa-male" aria-hidden="true"></i> '+bagde+'<br>';
                    }
                }
                $(".bus #asiento-"+ value.num_asiento).removeClass("btn-default btn-asiento").addClass("btn-info").css({"background":resp.color,"color":"#FFF"});
                $(".bus #asiento-"+ value.num_asiento).val(value.id);
                $(".bus #asiento-"+ value.num_asiento+ " .iconos").html(contenido);
                
            });
        }
    });
}


function asientosVendidosPostergar(idviaje){
    $.ajax({
        url: base_url + "gestionar/ventas/asientosvendidospostergar/"+idviaje,
        type:"POST",
        data:{},
        dataType:"json",
        success:function(resp){
            //http://localhost/ventas_ci/mantenimiento/productos
            for (var i = resp.cantidadasientos; i >= 1; i--) {
                value = i + "*" + 0;
                if (resp.costo != null) {
                    if(i>= 47 && i<=58){
                        value = i+"*"+resp.costo;
                    }
                }

                $(".bus-postergar #asiento-"+i).val(value);

            }
            
            $.each(resp.asientos, function(key, value){
                if (value.ventas_estadoreg == "activo") {
                    bagde = '<span class="badge badge-success">N</span>';
                }
                if (value.ventas_estadoreg == "postegado") {
                    bagde = '<span class="badge badge-warning">P</span>';
                }
                if (value.ventas_estadoreg == "reservado") {
                    bagde = '<span class="badge badge-info">R</span>';
                }

                if (value.sexo !=null) {
                    if (value.sexo == "Femenino") {
                        contenido = '<i class="fa fa-female" aria-hidden="true"></i> '+bagde+'<br>';
                    }else{
                        contenido = '<i class="fa fa-male" aria-hidden="true"></i> '+bagde+'<br>';
                    }
                }
                $(".bus-postergar #asiento-"+ value.num_asiento).removeClass("btn-default btn-asiento").addClass("btn-info").css({"background":resp.color,"color":"#FFF"}).attr("disabled","disabled");
                $(".bus-postergar #asiento-"+ value.num_asiento+ " .iconos").html(contenido);
                
            });
        }
    });
}

function actualizarBus(){
    idviaje  = $("input[name=boleto-idviaje]").val();
    $.ajax({
        url: base_url + "gestionar/ventas/asientosocupados/"+idviaje,
        type:"POST",
        dataType:"json",
        cache:false,
        success:function(resp){
            $(".bus button").removeClass("btn-danger btn-info").addClass("btn-default btn-asiento").removeAttr("disabled");
            $(".bus .iconos").html("");
            $.each(resp.asientos, function(key, value){
                if (value.ventas_estadoreg == "activo") {
                    bagde = '<span class="badge badge-success">N</span>';
                }
                if (value.ventas_estadoreg == "postergado") {
                    bagde = '<span class="badge badge-warning">P</span>';
                }
                if (value.ventas_estadoreg == "reservado") {
                    bagde = '<span class="badge badge-info">R</span>';
                }

                if (value.sexo !=null) {
                    if (value.sexo == "Femenino") {
                        contenido = '<i class="fa fa-female" aria-hidden="true"></i> '+bagde+'<br>';
                    }else{
                        contenido = '<i class="fa fa-male" aria-hidden="true"></i> '+bagde+'<br>';
                    }
                }
                $(".bus #asiento-"+ value.num_asiento).removeClass("btn-default btn-asiento").addClass("btn-info").css({"background":resp.color,"color":"#FFF"});
                $(".bus #asiento-"+ value.num_asiento).val(value.id);
                $(".bus #asiento-"+ value.num_asiento+ " .iconos").html(contenido);
                
            });

            $.each(resp.asientospendientes, function(key, value){
                $(".bus #asiento-"+ value.num_asiento).removeClass("btn-default").addClass("btn-danger").attr("disabled","disabled");
            });
        }
    });
}

function Bus_postergar(idviaje){

    $.ajax({
        url: base_url + "gestionar/ventas/asientos/"+idviaje,
        type:"POST",
        success:function(resp){
            //http://localhost/ventas_ci/mantenimiento/productos
            $(".bus-postergar").html(resp);
        }
    });
}
//deshabilita el bus 
function deshabilitar_bus() {
    $(".btn-asiento").attr("disabled","disabled").removeClass("btn-danger").addClass("btn-default");
}

function calcular(){
    ip = Number($("#importe_parcial").val());
    cs = Number($("#costo_servicio").val());
    igv = Number($("#igv").val());
    mt = (ip + cs) + (ip + cs)*(igv/100);
    $("input[name=precio]").val(mt);

}

function datagrafico(base_url,year){
    namesMonth= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"];
    $.ajax({
        url: base_url + "grafico/getData",
        type:"POST",
        data:{year: year},
        dataType:"json",
        success:function(data){
            var meses = new Array();
            var montos = new Array();
            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes - 1]);
                valor = Number(value.monto);
                montos.push(valor);
            });
            graficar(meses,montos,year);
        }
    });
}

function graficar(meses,montos,year){
    Highcharts.chart('grafico', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monto acumulado por las ventas de los meses'
    },
    subtitle: {
        text: 'Año:' + year
    },
    xAxis: {
        categories: meses,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado (soles)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} soles</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }

            }
        }
    },
    series: [{
        name: 'Meses',
        data: montos

    }]
});
}
function toDate(dateStr) {
    var parts = dateStr.split("-");
    day = parts[2];
    month = parts[1];
    year = parts[0];
    return day+"-"+month+"-"+year;
}

function daysInMonth(humanMonth, year) {
    return new Date(year || new Date().getFullYear(), humanMonth, 0).getDate();
}

function limpiarboleto(){
    html = '<div class="row"><div class="col-xs-12"><table id="tbticket" class="table table-bordered"><tbody><tr><td colspan="2" class="text-center"><b>Empresa de Ventas</b><br>Calle Moquegua 430 <br>Tel. 481890 <br>Email:yonybrondy17@gmail.com</td><td class="text-center">RUC : 201010210 <br><b></b> <br></td></tr><tr><td colspan="2"><b>Pasajero:</b><br></td><td><b>DNI:</b> <br></td></tr><tr><td colspan="2"><b>Razon Social:</b><br></td><td><b>RUC:</b> <br></td></tr><tr><td><b>Destino:</b> <br></td><td><b>Origen:</b> <br></td><td><b>Fecha de Viaje:</b> <br></td></tr><tr><td><b>Importe:</b> <br></td><td><b>Vendedor:</b> <br></td><td><b>Hora de viaje:</b> <br></td></tr></tbody></table></div></div>';
    $("#ticket").html(html);
    $(".boton-imprimir").html("");
}

function alertaCaducidad(){
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
    $.ajax({
        url: base_url + "mantenimiento/buses/getBuses",
        type: "POST",
        data:{},
        dataType: "json",
        success:function(resp){
            $.each(resp, function(key, value){
                if (value.fecha_caducidad == output) {
                    alertify.error("La fecha de caducidad de la revision tecnica para el bus "+value.placa+" vence hoy.");
                }
            });
        }
    });
}


function setearfecha(){
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = d.getFullYear() + '-' +
        ((''+month).length<2 ? '0' : '') + month + '-' +
        ((''+day).length<2 ? '0' : '') + day;

    $("#fecha_horario").val(output);

    //fecha = $(this).val();
    let date = new Date(output);

    let dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado","Domingo"];
    $("#dia-letras").val((dias[date.getDay()]).toUpperCase());
}