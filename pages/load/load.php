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
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="./css/load.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.js"></script>
    <!-- Theme javascript -->
    <script src="js/load.js" type="text/javascript"></script>
</head>
<input type="hidden" id="idPerson" value="<?php echo $IdPerson; ?>">

<body class="hold-transition sidebar-mini layout-fixed" style="padding-top: 17px;background: linear-gradient(to right, #D22F53, #82174A, #491845, #1F1C40);">
    <section class="content">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="card ">
                    <div class="card-header card-color">
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
                                        <label class="custom-file-label" for="inputFile" id="fileLabel">Seleccione un archivo</label>
                                    </div>
                                </div>
                                <p id="p_validaFile" style="color: #E50850; display: none;"></p>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="input-group">
                                <button type="button" id="btnUpload" class="btn card-color">Cargar</button>
                                <div class="input-group" id="divloading" style="display: none;">
                                    <img src="../../dist/img/loader.gif" style="width: 30px;" />&nbsp&nbsp
                                    <label style="color: #201C42;">Cargando la informaci&oacute;n...</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Historial de cargues</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="input-group" id="divLoadingLoads" style="display: none;">
                            <img src="../../dist/img/loader.gif" style="width: 30px;" />&nbsp&nbsp
                            <label style="color: #201C42;">Cargando la informaci&oacute;n...</label>
                        </div>
                        <div class="input-group" id="divNotdata" style="display: none;">
                            <label style="color: #201C42;">No hay datos para cargar</label>
                        </div>
                        <div class="card" id="divCardTableLoads" style="display: none;">
                            <div class="card-header">
                                <h3 class="card-title">Esta es el historial de cargues actuales</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="table_Loads" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id Cargue</th>
                                            <th>Nombre del Cargue</th>
                                            <th>Documento Cargado</th>
                                            <th>Descripci&oacute;n</th>
                                            <th>Estado</th>
                                            <th>Fecha Cargue</th>
                                            <th>Filas Procesadas</th>
                                            <th>Usuario</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id Cargue</th>
                                            <th>Nombre del Cargue</th>
                                            <th>Documento Cargado</th>
                                            <th>Descripci&oacute;n</th>
                                            <th>Estado</th>
                                            <th>Fecha Cargue</th>
                                            <th>Filas Procesadas</th>
                                            <th>Usuario</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>

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
                    <button type="button" class="btn card-color" id="btnVale">Vale</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <button type="button" style="display: none; " class="btn btn-default" data-toggle="modal" data-target="#modal-sm" id="btnModal-sm"></button>
    <!-- /.modal -->

    <div class="modal fade" id="modal-sm-loading">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="../../dist/img/loader.gif" style="width: 30px;" />&nbsp&nbsp
                    <h4 class="modal-title" style="color: #201C42;">Cargando...</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="txtloading" style="color: #201C42;">Estamos cargando la información, espera un momento.</p>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <button type="button" style="display: none; " class="btn btn-default" data-toggle="modal" data-target="#modal-sm-loading" id="btnModal-sm-loading"></button>



    <!-- bs-custom-file-input -->
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
        $(document).ready(function() {

            $("#modal-sm").on('hidden.bs.modal', function() {
                $("#divloading").hide();
                $("#inputName").val("");
                $("#inputObservation").val("");
                $("#inputFile").val("");
                $("#fileLabel").html("Seleccione un archivo");
                $("#btnUpload").show();
                location.reload();
            });
            $("#modal-sm-loading").on('hidden.bs.modal', function() {

            });
        });
        $("#table_Loads").DataTable({
            "oLanguage": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sInfo": "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sPrevious": "Anterior",
                    "sNext": "Siguiente",
                    "sLast": "Ultimo"
                }
            },
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table_Loads_wrapper .col-md-6:eq(0)');
    </script>
</body>

</html>