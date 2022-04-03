/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    //charge selects


    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'getProfile',
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
                        $('#idprofile').html($(this).text());
                    } else {
                        $('#idprofile').html('');
                    }
                });
            });

        }
    });

    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'getTypeDocument',
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
                        $('#idtypedocument').html($(this).text());
                    } else {
                        $('#idtypedocument').html('');
                    }
                });
            });

        }
    });

    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'getTypeClient',
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
                        $('#idclient').html($(this).text());
                    } else {
                        $('#idclient').html('');
                    }
                });
            });

        }
    });

   /* var url = window.location.pathname;
    var id = url.substring(url.lastIndexOf('/') + 1);
    console.log(id);
    if (id != "") {
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            data: ({
                'metodo': 'getUsers',
                'Id': id,
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
                            $('#id').val($(this).attr('Id'));
                            $('#name').val($(this).attr('Name'));
                            $('#document').val($(this).attr('Document'));
                            $('#phone').val($(this).attr('Phone'));
                            $('#email').val($(this).attr('Email'));
                            $('#pass').val($(this).attr('Passw'));
                            $('#pass2').val($(this).attr('Passw'));
                            $('#idtypedocument').val($(this).attr('idTypeDocument'));
                            $('#idprofile').val($(this).attr('idProfile'));
                            $('#idclient').val($(this).attr('idTypeClient'));
                            $('#status').val($(this).attr('Status'));
                        } else {
                            $('#id').val('');
                            $('#name').val('');
                            $('#document').val('');
                            $('#phone').val('');
                            $('#email').val('');
                            $('#pass').val('');
                            $('#pass2').val('');
                            $('#idtypedocument').val('-1');
                            $('#idprofile').val('-1');
                            $('#idclient').val('-1');
                            $('#status').val(1);
                        }
                    });
                });

            }
        });

    }*/
    // metodo para guardar los  datos 
    $("#guardar").click(function () {
        if ($("#name").val() == "" || $("#document").val() == "" || $("#phone").val() == "" || $("#email").val() == "" || $("#pass").val() == "" || $("#pass2").val() == "" ||
                $("#idtypedocument").val() == "-1" || $("#idprofile").val() == "-1" || $("#idclient").val() == "-1") {
            if ($("#name").val() == "") {
                $("#name").attr('class', 'form-control is-invalid');
                $('input[name=name]').after('<div id="message"><p>El campo Nombre es obligatorio</p></div>');
            }
            if ($("#document").val() == "") {
                $("#document").attr('class', 'form-control is-invalid');
                $('input[name=document]').after('<div id="message"><p>El campo Documento nombre es obligatorio</p></div>');
            }
            if ($("#phone").val() == "") {
                $("#phone").attr('class', 'form-control is-invalid');
                $('input[name=phone]').after('<div id="message"><p>El campo Telefono es obligatorio</p></div>');
            }

            if ($("#email").val() == "") {
                $("#email").attr('class', 'form-control is-invalid');
                $('input[name=email]').after('<div id="message"><p>El campo Correo es obligatorio</p></div>');
            }
            if ($("#pass").val() == "") {
                $("#pass").attr('class', 'form-control is-invalid');
                $('input[name=pass]').after('<div id="message"><p>El campo contraseña es obligatorio</p></div>');
            }
            if ($("#pass2").val() == "") {
                $("#pass2").attr('class', 'form-control is-invalid');
                $('input[name=pass2]').after('<div id="message"><p>El campo validacion de contraseña es obligatorio</p></div>');
            }
            if ($("#idtypedocument").val() == "-1") {
                $("#idtypedocument").attr('class', 'form-control is-invalid');
                $('input[name=idtypedocument]').after('<div id="message"><p>El campo validacion de contraseña es obligatorio</p></div>');
            }
            if ($("#idprofile").val() == "-1") {
                $("#idprofile").attr('class', 'form-control is-invalid');
                $('input[name=idprofile]').after('<div id="message"><p>El campo validacion de contraseña es obligatorio</p></div>');
            }
            if ($("#idclient").val() == "-1") {
                $("#idclient").attr('class', 'form-control is-invalid');
                $('input[name=idclient]').after('<div id="message"><p>El campo validacion de contraseña es obligatorio</p></div>');
            }


        } else {
            if (isEmail($("#email").val())) {
                if ($("#pass").val() != $("#pass2").val()) {
                    $("#pass2").attr('class', 'form-control is-invalid');
                    $('input[name=pass2]').after('<div id="message"><p>Las claves no coinciden </p></div>');
                } else {
                    $.ajax({
                        url: "../../controller/CapturaInformacionController.php",
                        data: ({
                            'metodo': 'setUser',
                            'Nombre': $("#name").val(),
                            'Documento': $("#document").val(),
                            'Telefono': $("#phone").val(),
                            'Email': $("#email").val(),
                            'Contraseña': $("#pass").val(),
                            'Status': $("#status").val(),
                            'idTypeDocument': $("#idtypedocument").val(),
                            'idProfile': $("#idprofile").val(),
                            'idClient': $("#idclient").val(),
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
                                            title: "Correcto"
                                        });
                                        return true;
                                    } else {
                                        bootbox.alert({
                                            message: 'No se  genero envio de forma correcta',
                                            title: "Alerta"
                                        });
                                        return false;
                                    }
                                });
                            });
                        }
                    });
                }
            } else {
                $("#email").attr('class', 'form-control is-invalid');
                $('input[name=email]').after('<div id="message"><p>El valor de correo no es correcto </p></div>');
            }
        }

    });
});
function isEmail(email) {
    var regex = '/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/';
    return regex.test(email);
}


