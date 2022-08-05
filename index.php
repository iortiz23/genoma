<?php
session_start();

if (!isset($_SESSION['IdPerson']) || !isset($_SESSION['Name']) || !isset($_SESSION['IdProfile'])) {
    header("Location: login\login.php");
}

$IdPerson = $_SESSION['IdPerson'];
$Name = $_SESSION['Name'];
$IdProfile = $_SESSION['IdProfile'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Duponte</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- index -->
    <link rel="stylesheet" href="css/index.css">
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="js/index.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <input type="hidden" id="idProfile" value="<?php echo $IdProfile; ?>">
    <div class="wrapper">
        
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <div class="container body-template">
        <div class="row header-page" >
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <img  class="logo-dashboard" src="./dist/img/MATCHGENICA_fondo.png"/>
            </div>
            <div class="col-md-4 ">
                <div class="row justify-content-end" style="margin: 0 !important;">
                            <div class="col-7"></div>
                            <div class="col-1">
                                <a class="nav-link notificaciones" data-widget="control-sidebars" role="button" data-toggle="modal" data-target="#modal-default">
                                    <div class="campana">
                                        <img style="width: 90%;" src="./dist/img/campana.png"/>
                                    </div>
                                </a>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-1">
                                <a class="nav-link usuario" data-widget="control-sidebars" role="button" data-toggle="modal" data-target="#modal-default">
                                <div class="user">
                                    <img style="width: 90%;"src="./dist/img/user.png"/>
                                </div>
                                </a>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-1">
                                <a class="nav-link logout" data-widget="control-sidebars" role="button" data-toggle="modal" data-target="#modal-default">
                                    <i class="fas fa-power-off"></i>
                                </a>
                            </div>
                </div>
            
        </div>

            
        </div>   
       

        <!-- Main Sidebar Container -->
        <div class="row home-page">
            <div class="col-sm-1">
                    <!-- Sidebar Menu -->
                    <nav class="row ">
                        <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" ><div class="op-menu-1" ><img  class="logo-menu-1" src="./dist/img/user.png"/></div></a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" ><div class="op-menu-2"><img class="logo-menu-2" src="./dist/img/flecha.png"/></div></a>
                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><div class="op-menu-3"><img class="logo-menu-3" src="./dist/img/gen.png"/></div></a>
                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><div class="op-menu-4"><img class="logo-menu-4" src="./dist/img/pildora.png"/></div></a>
                            <a class="nav-link" id="v-pills-search-tab" data-toggle="pill" href="#v-pills-search" role="tab" aria-controls="v-pills-search" aria-selected="false"><div class="op-menu-5"><img class="logo-menu-5" src="./dist/img/buscar.png"/></div></a>
                            </div>
                            <div class="tab-content " id="v-pills-tabContent">
                            <div class="tab-pane fade menu-content-1" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <ul class="menu-data-1">
                                    <li class="sub-menu"><a  href="modulos/usuarios/usuario.php" target="centerframe" class="nav-link submenu"><p class="text-submenu" >Usuarios</p></a></li>
                                    <li class="sub-menu"><a   href="modulos/perfiles/perfil.php" target="centerframe" class="nav-link submenu"><p class="text-submenu">Perfiles</p></a></li>
                                    <li class="sub-menu"><a   href="modulos/tipoClientes/tipoclientes.php" class="nav-link submenu" target="centerframe"><p class="text-submenu">Tipos de clientes</p></a></li>
                                </ul>
                            </div>
                            <div class="tab-pane fade menu-content-2" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">                           
                                <ul class="menu-data-2">
                                    <li class="sub-menu"><a  href="pages/load/load.php" class="nav-link submenu" target="centerframe"><p class="text-submenu">Cargar Variantes</p></a></li>
                                    <li class="sub-menu"><a  href="pages/load-medicine/load-medicine.php" class="nav-link submenu" target="centerframe"><p class="text-submenu">Cargar Medicinas</p></a></li>
                                    <li class="sub-menu"><a  href="pages/load-relation/load-relation.php" class="nav-link submenu" target="centerframe"><p class="text-submenu">Cargar Enfermedades</p></a></li>
                                </ul>
                            </div>
                            <div class="tab-pane fade menu-content-3" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <ul class="menu-data-3">
                                    <li class="sub-menu"><a href="modulos/TipoEnfermedad/tipoenfermedad.php" class="nav-link submenu" target="centerframe"><p class="text-submenu">Riesgo de enfermedad</p></a></li>
                                </ul>
                            </div>
                            <div class="tab-pane fade  menu-content-4" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <ul class="menu-data-4">
                                    <li class="sub-menu"><a href="modulos/TipoMedicamento/tipomedicamento.php" class="nav-link submenu" target="centerframe"><p class="text-submenu">Reacción farmacologica</p></a></li>
                                </ul>
                            </div>
                            <div class="tab-pane fade menu-content-5" id="v-pills-search" role="tabpanel" aria-labelledby="v-pills-search-tab">
                                <ul class="menu-data-5">
                                    <li class="sub-menu"><a href="modulos/Busqueda/busqueda.php" class="nav-link submenu" target="centerframe"><p class="text-submenu">Mis Informes</p></a></li>
                                    <li class="sub-menu"><a href="modulos/Busqueda/busqueda.php" class="nav-link submenu" target="centerframe"><p class="text-submenu">Crear Informe</p></a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            

            <!-- Content Wrapper. Contains page content -->
            <div class="col-sm-11" style="
    padding: 0px !important;
    width: 100%;
">

                    <!-- Main content -->
                    <div class="col-12 body-frame"style="margin-left:0px  !important;background: linear-gradient(to right, #D22F53, #82174A, #491845, #1F1C40);height: 410pt;">

                            <iframe src="dashboard.php" name="centerframe" class="pages" frameBorder=0 style="align-content: center;width: inherit;height: 405pt;" frameSpacing=0>
                            </iframe>
                        


                </div>
            </div>
        </div>
</div>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- /.modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cerrar Sessión</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Est&aacute; seguro que desea cerrar sessi&oacute;n?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="btnOffSession">S&iacute;, cerrar sesi&oacute;n</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>

</body>

</html>