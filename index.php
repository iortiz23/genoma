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

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!--<li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebars" role="button" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">

                <img src="dist/img/duponte-icono.png" alt="Duponte Logo" class="brand-image  elevation-3" />
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $Name ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->

                        <li class="nav-item" id="li-permisos-adminUsu">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Admin Usuarios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="modulos/usuarios/usuario.php" target="centerframe" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modulos/perfiles/perfil.php" target="centerframe" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Perfiles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modulos/tipoClientes/tipoclientes.php" class="nav-link" target="centerframe">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tipos de Cliente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modulos/TipoDocumentos/tipodocumentos.php" target="centerframe" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tipos de Documentos</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item" id="li-permisos-cargue">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>
                                    Cargue
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/load/load.php" class="nav-link" target="centerframe">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cargue Variantes</p>
                                    </a>
                                </li>
                                <li class="nav-item"  id="li-permisos-cargue-relacion">
                                    <a href="pages/load-relation/load-relation.php" class="nav-link" target="centerframe">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cargue Relaci??n Enfermedades</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="li-permisos-cargue-medicine">
                                    <a href="pages/load-medicine/load-medicine.php" class="nav-link" target="centerframe">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cargue Relaci??n Medicina</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item" id="li-permisos-busqueda">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-search"></i>
                                <p>
                                    Busqueda
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="modulos/Busqueda/busqueda.php" class="nav-link" target="centerframe">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta Informes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modulos/TipoEnfermedad/tipoenfermedad.php" class="nav-link" target="centerframe">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Match de Enfermedades</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modulos/TipoMedicamento/tipomedicamento.php" class="nav-link" target="centerframe">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Match de Medicamentos</p>
                                    </a>
                                </li>

                            </ul>

                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 916px;background: linear-gradient(to right, #D22F53, #82174A, #491845, #1F1C40);">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!--<img src="dist/img/duponte-icono2.png" width="25%" />-->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <iframe src="dashboard.php" name="centerframe" class="pages" frameBorder=0 style="align-content: center; height: 85%; position: absolute; width: 80%;" frameSpacing=0>
                    </iframe>
                </div>


            </section>
            <!-- /.content -->
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- /.modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cerrar Sessi??n</h4>
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