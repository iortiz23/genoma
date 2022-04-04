/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {




    // metodo para guardar los  datos 
    $("#guardar").click(function () {
        if ($("#message1")) {
            if ($("#message1")) {
                $("#message1").remove();
            }
        }
        if ($("#description").val() == "") {
            if ($("#description").val() == "") {
                $("#description").attr('class', 'form-control is-invalid');
                $('input[name=description]').after('<div id="message1"><p>El campo Nombre es obligatorio</p></div>');
            }
        } else {

            $.ajax({
                url: "../../controller/CapturaInformacionController.php",
                data: ({
                    'metodo': 'setPerfil',
                    'Description': $("#description").val(),
                    'Status': ($('#status').prop('checked'))?1:0,
                    'Id':$("#id").val(),
                }),
                type: "post",
                dataType: "xml",
                beforeSend: function () {
                    bootbox.alert({
                        message: 'Cargando ....',
                        title: "Cargando"
                    });
                },
                success: function (xml) {
                    bootbox.hideAll();
                    $(xml).find("response").each(function () {
                        $(this).find("registro").each(function () {
                            if ($(this).text() != 'NOEXITOSO') {
                                bootbox.alert({
                                    message: 'Proceso de guardado  exitoso',
                                    title: "Correcto",
                            callback: function () {
                                window.location = './perfil.php';
                            }
                                });
                                return true;
                            } else {
                                bootbox.alert({
                                    message: 'No se  genero envio de forma correcta',
                                    title: "Alerta",
                            callback: function () {
                                window.location = './perfil.php';
                            }
                                });
                                return false;
                            }
                        });
                    });
                }
            });
        }

    });
});



