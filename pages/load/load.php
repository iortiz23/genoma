<?php ?>



<?php
session_start();

if (!isset($_SESSION['IdPerson'])) {
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
    <link rel="icon" href="../../dist/img/duponte-icono.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.js"></script>
    <!-- Theme javascript -->
    <script src="js/load1.js" type="text/javascript"></script>
</head>
<input type="hidden" id="idPerson" value="<?php echo $IdPerson; ?>">

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="container mt-5">
        <div class="wrapper">
            <div class="row">
                <!-- left column -->
                <div class="col-md-1">

                </div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cargar Variantes</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Nombre del documento</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Nombre del documento">
                                    <!--<label id="p_validaName" style="color: #E50850; display: none;">Nombre del documento</label>-->
                                    <p for="inputName" id="p_validaName" style="color: #E50850; display: none;"></p>
                                </div>
                                <div class="form-group">
                                    <label for="inputObservation">Observaci&oacute;n</label>
                                    <input type="text" class="form-control" id="inputObservation" placeholder="Observaci&oacute;n">
                                </div>
                                <div class="form-group">
                                    <label for="inputFile">Entrada de archivo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputFile" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                            <label class="custom-file-label" for="inputFile">Seleccione un archivo</label>
                                        </div>
                                    </div>
                                    <p id="p_validaFile" style="color: #E50850; display: none;"></p>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" id="btnUpload" class="btn btn-primary">Cargar</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
        <!-- /.content -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- /.modal -->

    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Resultado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="txtResult"></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" id="btnVale">Vale</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-sm" id="btnModal-sm"></button>


    <script>
        $(document).ready(function() {

            $("#modal-sm").on('hidden.bs.modal', function() {

            });
        });
    </script>
</body>

</html>