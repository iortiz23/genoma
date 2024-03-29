<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../../class/CapturaInformacion.class.php';
session_start();
$result = null;
$modulo = new CapturaInformacion();
if (isset($_REQUEST['id'])) {
    $result = $modulo->getProfileById($_REQUEST['id']);
} else {
    $result = null;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Perfiles</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
        <link rel="stylesheet" href="./css/perfiles.css">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="./js/FormPerfil.js"></script>
    </head>
    <body class="container" style="background-color: #f4f6f9;padding-top: 17px;">
        <div class="col-md-12"> 
            <!-- general form elements disabled -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Perfil</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- <form>--> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="hidden" name="id" id="id" value="<?php echo isset($result[0]['IdProfile'])?$result[0]['IdProfile']:''; ?>"/>
                                <input type="text" id="description" name="description"  maxlength="64" class="form-control" data-req="requerido" placeholder="Ej. Pedro" value="<?php echo isset($result[0]['Description']) ? $result[0]['Description'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- checkbox -->
                            <div class="form-group" style="margin-top: 8%;">
                                <div class="form-check">
                                    <input name="status" id="status" lass="form-check-input" type="checkbox" data-req="requerido" <?php echo isset($result[0]['State']) ? 'Checked' : ''; ?>>
                                    <label   class="form-check-label" >Status</label>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button id="guardar" class="btn bg-gradient-success btn-sm-1">
                                Guardar
                            </button>
                        </div>
                    </div>
                    <div class="row">

                    </div>


                    <!-- </form>-->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.content-wrapper -->
        

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- ./wrapper -->

        <!-- Bootstrap 4 -->
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

