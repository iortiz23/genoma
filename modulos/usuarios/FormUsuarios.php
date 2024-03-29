<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../../class/CapturaInformacion.class.php';
session_start();


$result=null;
$html_typeclient=null;
$html_profile=null;
$html_typedocument=null;

$modulo = new CapturaInformacion();
if(isset($_REQUEST['id'])){
    $result = $modulo->getUserById($_REQUEST['id']);
    $html_typeclient = $modulo->getTipoClienteId($result[0]['IdTypeClient']);
    $html_typedocument = $modulo->getTipoDocumentoId($result[0]['IdTypeDocument']);
    $html_profile = $modulo->getPerfilId($result[0]['IdProfile']);
}else{
   $result = null;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Usuarios</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
        <link rel="stylesheet" href="./css/usuarios.css">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="./js/FormUsuarios.js"></script>
    </head>
    <body class="container" style="background-color: #f4f6f9;padding-top: 17px;">
        <div class="col-md-12"> 
            <!-- general form elements disabled -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Usuarios</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- <form>-->
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="hidden" name="id" id="id" value="<?php echo isset($result[0]['IdPerson'])?$result[0]['IdPerson']:''; ?>"/>
                                <input type="text" id="name" name="name"  maxlength="64" class="form-control" data-req="requerido" placeholder="Ej. Pedro" value="<?php echo isset($result[0]['Name'])?$result[0]['Name']:''; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Documento</label>
                                <input type="text" id="document" name="document"  class="form-control" max-length="12" data-req="requerido" placeholder="Ej. 10542462" value="<?php echo isset($result[0]['Document'])?$result[0]['Document']:''; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Telefono</label>                        
                                <input name="phone" type="numeric" id="phone" name="phone" max-length="15" class="form-control" data-req="requerido" placeholder="Ej. 2725814" value="<?php echo isset($result[0]['Phone'])?$result[0]['Phone']:''; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Correo</label>
                                <input name="email" type="email" id="email" max-length="24" class="form-control" data-req="requerido" placeholder="Ej. pruebas@pruebas.com" value="<?php echo isset($result[0]['Email'])?$result[0]['Email']:''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input name="pass" type="password" id="pass" min-length="8" max-length="16"data-req="requerido" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirma Contraseña</label>
                                <input name="pass2" type="password" id="pass2" min-length="8"  max-length="16" data-req="requerido" class="form-control"  >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Tipo de documento</label>
                                <select id="idtypedocument" name="idtypedocument" class="custom-select" data-req="requerido">
                                    <?php echo $html_typedocument ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Perfil</label>
                                <select id="idprofile" name="idprofile" class="custom-select" data-req="requerido">
                                <?php echo $html_profile ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo de cliente</label>
                                <select id="idclient" name="idclient"  class="custom-select" data-req="requerido">
                                <?php echo $html_typeclient ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- checkbox -->
                            <div class="form-group" style="margin-top: 8%;">
                                <div class="form-check">
                                    <input name="status" id="status" class="form-check-input" type="checkbox" data-req="requerido" <?php echo isset($result[0]['State'])?'Checked':''; ?>>
                                    <label   class="form-check-label" >Status</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input name="tratamiento" id="tratamiento" class="form-check-input" type="checkbox"  >
                                    <a   class="form-check-label" href="https://www.duponteadn.com/copia-de-aviso-legal" >politica de tratamiento datos </a>
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
