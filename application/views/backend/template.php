<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>App Boleta Web | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.css">
      <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/Ionicons/css/ionicons.min.css">
     <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- DataTables Export-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/datatables-export/css/buttons.dataTables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/alertify/themes/alertify.core.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/alertify/themes/alertify.default.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="<?php echo base_url();?>assets/template/dist/css/skins/_all-skins.min.css"> 
	<!--<link rel="stylesheet" href="<?php echo base_url();?>assets/template/dist/css/skins/skin-green.min.css">-->

    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/css/style.css">


    <style>
        #modal-default2 .modal-dialog {
          width: 890px;
          margin: auto;
        }
        .contenedor-total{
            height: 213px;
        }
        .contenedor-total table>tbody>tr>td{
            padding: 6px;
        }
        .form-add-edit{
            padding: 0px 15px; 
        }
        .btn-asiento{
            padding: 6px 8px;
            height: 50px;
        }
        .btn-info{
            padding: 6px 8px;
            height: 50px;

        }

        .infopasajero:focus {
             border-color: rgba(249, 164, 7, 0.8);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(249, 164, 7, 0.6);
          outline: 0 none;
        }

        .badge-error {
        background-color: #b94a48 !important;
        color: #FFF !important;
        }

        .badge-warning {
        background-color: #f89406 !important;
        color: #FFF !important;
        }

        .badge-success {
        background-color: #468847 !important;
        color: #FFF !important;
        }

        .badge-info {
        background-color: #3a87ad !important;
        color: #FFF !important;
        }

        #dia-letras{
            color:red;
            font-weight: bold;
            font-size: 16px !important;
        }

        .precio {
            color: red;
            font-weight: bold;
            font-size: 16px !important;
        }


    </style>

    <script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
    <!-- Highcharts -->
<script src="<?php echo base_url();?>assets/template/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/template/highcharts/exporting.js"></script>
    
</head>


<!-- <body class="skin-blue sidebar-mini sidebar-collapse"> -->
<body class="skin-green-light sidebar-mini sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="../../index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>B</b>w</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>BOLETAweb</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url()?>assets/template/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata("nombre")?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <a href="<?php echo base_url(); ?>auth/logout"> Cerrar Sesión</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
                <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">      
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    
                    <?php echo $this->backend_lib->getMenu();?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        
        <?php echo $contenido; ?>


        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2017-2018 <a href="https://opencloudconsulting.com">Open C</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->


<script src="<?php echo base_url();?>assets/template/jquery-print/jquery.print.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/template/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables Export -->
<script src="<?php echo base_url();?>assets/template/datatables-export/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.print.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url();?>assets/template/alertify/lib/alertify.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/template/dist/js/demo.js"></script>

<script src="<?php echo base_url();?>assets/template/printThis/printThis.js"></script>
<script>
var base_url= "<?php echo base_url();?>";
</script>
<script src="<?php echo base_url();?>assets/template/backend.js"></script>
</body>
</html>
