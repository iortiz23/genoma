<?php
session_start();

if (!isset($_SESSION['Email'])) {
    session_destroy();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <title>Duponte</title>
        <link rel="icon" href="../dist/img/duponte-icono.png">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">

        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Theme javascript -->
        <script src="js/recover-password.js" type="text/javascript"></script>
    </head>
    <input type="hidden" id="hEmail" value="<?php echo trim($_SESSION['Email']) ?>">
    <body class="hold-transition login-page">

        <div class="login-box">
            <div class="login-logo">
                <img src="../dist/img/duponte-icono.png" class="w-75 h-75"/>
            </div> 
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Est&aacute;s a un paso de tu nueva contrase&ntilde;a.</p>

                    <form>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="txtPassOld" name="txtPassOld" placeholder="Antigua Contrase&ntilde;a">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="txtPassNew" name="txtPassNew" placeholder="Nueva Contrase&ntilde;a">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="txtPassConNew" name="txtPassConNew" placeholder="Confirmar Contrase&ntilde;a">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="btnChangePassword" class="btn btn-primary btn-block">Cambiar Contrase&ntilde;a</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p id="p_validaPassword" class="login-box-msg" style="color: #E50850; display: none;">Las contrase&ntilde;as no coinciden.</p>
                    <p id="p_valPassCriterios1" class="login-box-msg" style="color: #E50850; display: none;">Entre 8 y 16 caracteres.(Sin espacios).</p>
                    <p id="p_valPassCriterios2" class="login-box-msg" style="color: #E50850; display: none;">Debe contener al menos un n&uacute;mero y una letra.</p>                    
                    <p class="mt-3 mb-1">
                        <a href="login.php">Login</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

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
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <script>
            $(document).ready(function () {

                $("#modal-sm").on('hidden.bs.modal', function () {
                    location.href = "http://localhost/genoma/login/login.php";
                });
            });
        </script>
    </body>
</html>
