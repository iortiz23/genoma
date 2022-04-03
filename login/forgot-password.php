<?php
include '../class/CapturaInformacion.class.php';
session_start();
$result = '';
if (!isset($_SESSION['Email'])) {
    header("Location: login.php");
}
if ($_POST) {
    $email = $_POST['txtEmail'];
    $modulo = new CapturaInformacion();
    $result = $modulo->setNewPassword($email);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="../dist/img/duponte-icono.png" class="w-75 h-75"/>
            </div>           
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">¿Olvidaste tu contraseña? Aquí puedes obtener fácilmente una nueva contraseña.</p>

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="txtEmail" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Nueva Contraseña</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="login-box-msg" style="color: #E50850;"><?php echo $result; ?></p>
                    <p class="mt-3 mb-1">
                        <a href="login.php">Login</a>
                    </p>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
    </body>
</html>
