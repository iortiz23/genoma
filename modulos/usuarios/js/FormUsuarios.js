/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    //charge selects
    if ($("#name").val() == '') {
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            data: ({
                'metodo': 'getProfile',
            }),
            type: "post",
            dataType: "xml",
            beforeSend: function () {

            },
            success: function (xml) {
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

            },
            success: function (xml) {
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

            },
            success: function (xml) {
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
    }

    // metodo para guardar los  datos 
    $("#guardar").click(function () {
        if ($("#message1") || $("#message2") || $("#message3") || $("#message4") || $("#message5") || $("#message6") || $("#message7") || $("#message8") || $("#message9") || $("#message10") || $("#message11")) {
            if ($("#message1")) {
                $("#message1").remove();
            }
            if ($("#message2")) {
                $("#message2").remove();
            }
            if ($("#message3")) {
                $("#message3").remove();
            }
            if ($("#message4")) {
                $("#message4").remove();
            }
            if ($("#message5")) {
                $("#message5").remove();
            }
            if ($("#message6")) {
                $("#message6").remove();
            }
            if ($("#message7")) {
                $("#message7").remove();
            }
            if ($("#message8")) {
                $("#message8").remove();
            }
            if ($("#message9")) {
                $("#message9").remove();
            }
            if ($("#message10")) {
                $("#message10").remove();
            }

            if ($("#message11")) {
                $("#message11").remove();
            }



        }
        if ($("#name").val() == "" || $("#document").val() == "" || $("#phone").val() == "" || $("#email").val() == "" || ($("#pass").val() == "" && $("#id").val() == "") || ($("#pass2").val() == "" && $("#id").val() == "") ||
            $("#idtypedocument").val() == "-1" || $("#idprofile").val() == "-1" || $("#idclient").val() == "-1") {

            if ($("#name").val() == "") {
                $("#name").attr('class', 'form-control is-invalid');
                $('input[name=name]').after('<div id="message1"><p>El campo Nombre es obligatorio</p></div>');
            }
            if ($("#document").val() == "") {
                $("#document").attr('class', 'form-control is-invalid');
                $('input[name=document]').after('<div id="message2"><p>El campo Documento nombre es obligatorio</p></div>');
            }
            if ($("#phone").val() == "") {
                $("#phone").attr('class', 'form-control is-invalid');
                $('input[name=phone]').after('<div id="message3"><p>El campo Telefono es obligatorio</p></div>');
            }

            if ($("#email").val() == "") {
                $("#email").attr('class', 'form-control is-invalid');
                $('input[name=email]').after('<div id="message4"><p>El campo Correo es obligatorio</p></div>');
            }
            if ($("#pass").val() == "") {
                $("#pass").attr('class', 'form-control is-invalid');
                $('input[name=pass]').after('<div id="message5"><p>El campo contraseña es obligatorio</p></div>');
            }
            if ($("#pass2").val() == "") {
                $("#pass2").attr('class', 'form-control is-invalid');
                $('input[name=pass2]').after('<div id="message6"><p>El campo validacion de contraseña es obligatorio</p></div>');
            }
            if ($("#idtypedocument").val() == "-1") {
                $("#idtypedocument").attr('class', 'form-control is-invalid');
                $('input[name=idtypedocument]').after('<div id="message7"><p>El campo validacion de contraseña es obligatorio</p></div>');
            }
            if ($("#idprofile").val() == "-1") {
                $("#idprofile").attr('class', 'form-control is-invalid');
                $('input[name=idprofile]').after('<div id="message8"><p>El campo validacion de contraseña es obligatorio</p></div>');
            }
            if ($("#idclient").val() == "-1") {
                $("#idclient").attr('class', 'form-control is-invalid');
                $('input[name=idclient]').after('<div id="message9"><p>El campo validacion de contraseña es obligatorio</p></div>');
            }

            if ($("#pass").val() == "" && $("#id").val() == "") {
                $("#pass").attr('class', 'form-control is-invalid');
                $('input[name=pass]').after('<div id="message5"><p>El campo contraseña es obligatorio</p></div>');
            }
            if ($("#pass2").val() == "" && $("#id").val() == "") {
                $("#pass2").attr('class', 'form-control is-invalid');
                $('input[name=pass2]').after('<div id="message6"><p>El campo validacion de contraseña es obligatorio</p></div>');
            }
        } else {
            if (isEmail($("#email").val())) {
                if ($("#id").val() == "") {
                    if ($("#pass").val() != $("#pass2").val()) {
                        $("#pass2").attr('class', 'form-control is-invalid');
                        $('input[name=pass2]').after('<div id="message10"><p>Las claves no coinciden </p></div>');
                    } else {
                        if (isPass($("#pass").val()) !== true) {

                            $("#pass2").attr('class', 'form-control is-invalid');
                            $('input[name=pass2]').after('<div id="message11"><p>La clave debe ser de minimo 8 caracteres con letras y numeros </p></div>');
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
                                    'Status': ($('#status').prop('checked')) ? 1 : 0,
                                    'idTypeDocument': $("#idtypedocument").val(),
                                    'idProfile': $("#idprofile").val(),
                                    'idClient': $("#idclient").val(),
                                }),
                                type: "post",
                                dataType: "xml",
                                beforeSend: function () {
                                },
                                success: function (xml) {
                                    $(xml).find("response").each(function () {
                                        $(this).find("registro").each(function () {
                                            if ($(this).text() != 'NOEXITOSO') {
                                                bootbox.alert({
                                                    message: 'Proceso de guardado  exitoso',
                                                    title: "Correcto",
                                                    callback: function () {
                                                        window.location = './usuario.php';
                                                    },
                                                    buttons: {
                                                        "ok": {
                                                            label: "Ok",
                                                            className: "card-color",
                                                            callback: function () { }
                                                        }
                                                    }
                                                });
                                                return true;
                                            } else {
                                                bootbox.alert({
                                                    message: 'No se  genero envio de forma correcta',
                                                    title: "Alerta",
                                                    callback: function () {
                                                        window.location = './usuario.php';
                                                    },
                                                    buttons: {
                                                        "ok": {
                                                            label: "Ok",
                                                            className: "card-color",
                                                            callback: function () { }
                                                        }
                                                    }
                                                });
                                                return false;
                                            }
                                        });
                                    });
                                }
                            });
                        }

                    }
                } else {
                    if ($("#pass").val() != "") {
                        if ($("#pass").val() == "" && $("#pass2").val() == "") {
                            if ($("#pass").val() == "") {
                                $("#pass").attr('class', 'form-control is-invalid');
                                $('input[name=pass]').after('<div id="message5"><p>El campo contraseña es obligatorio</p></div>');
                            }
                            if ($("#pass2").val() == "") {
                                $("#pass2").attr('class', 'form-control is-invalid');
                                $('input[name=pass2]').after('<div id="message6"><p>El campo validacion de contraseña es obligatorio</p></div>');
                            }
                        } else {
                            if ($("#pass").val() != $("#pass2").val()) {
                                $("#pass2").attr('class', 'form-control is-invalid');
                                $('input[name=pass2]').after('<div id="message10"><p>Las claves no coinciden </p></div>');
                            } else {
                                if (isPass($("#pass").val()) !== true) {

                                    $("#pass2").attr('class', 'form-control is-invalid');
                                    $('input[name=pass2]').after('<div id="message11"><p>La clave debe ser de minimo 8 caracteres con letras y numeros </p></div>');
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
                                            'Status': ($('#status').prop('checked')) ? 1 : 0,
                                            'idTypeDocument': $("#idtypedocument").val(),
                                            'idProfile': $("#idprofile").val(),
                                            'idClient': $("#idclient").val(),
                                        }),
                                        type: "post",
                                        dataType: "xml",
                                        beforeSend: function () {
                                        },
                                        success: function (xml) {
                                            $(xml).find("response").each(function () {
                                                $(this).find("registro").each(function () {
                                                    if ($(this).text() != 'NOEXITOSO') {
                                                        bootbox.alert({
                                                            message: 'Proceso de guardado  exitoso',
                                                            title: "Correcto",
                                                            callback: function () {
                                                                window.location = './usuario.php';
                                                            },
                                                            buttons: {
                                                                "ok": {
                                                                    label: "Ok",
                                                                    className: "card-color",
                                                                    callback: function () { }
                                                                }
                                                            }
                                                        });
                                                        return true;
                                                    } else {
                                                        bootbox.alert({
                                                            message: 'No se  genero envio de forma correcta',
                                                            title: "Alerta",
                                                            callback: function () {
                                                                window.location = './usuario.php';
                                                            },
                                                            buttons: {
                                                                "ok": {
                                                                    label: "Ok",
                                                                    className: "card-color",
                                                                    callback: function () { }
                                                                }
                                                            }
                                                        });
                                                        return false;
                                                    }
                                                });
                                            });
                                        }
                                    });
                                }

                            }
                        }
                    } else {
                        $.ajax({
                            url: "../../controller/CapturaInformacionController.php",
                            data: ({
                                'metodo': 'setUser',
                                'Nombre': $("#name").val(),
                                'Documento': $("#document").val(),
                                'Telefono': $("#phone").val(),
                                'Email': $("#email").val(),
                                'Contraseña': '',
                                'Status': ($('#status').prop('checked')) ? 1 : 0,
                                'idTypeDocument': $("#idtypedocument").val(),
                                'idProfile': $("#idprofile").val(),
                                'idClient': $("#idclient").val(),
                            }),
                            type: "post",
                            dataType: "xml",
                            beforeSend: function () {
                            },
                            success: function (xml) {
                                $(xml).find("response").each(function () {
                                    $(this).find("registro").each(function () {
                                        if ($(this).text() != 'NOEXITOSO') {
                                            bootbox.alert({
                                                message: 'Proceso de guardado  exitoso',
                                                title: "Correcto",
                                                callback: function () {
                                                    window.location = './usuario.php';
                                                },
                                                buttons: {
                                                    "ok": {
                                                        label: "Ok",
                                                        className: "card-color",
                                                        callback: function () { }
                                                    }
                                                }
                                            });
                                            return true;
                                        } else {
                                            bootbox.alert({
                                                message: 'No se  genero envio de forma correcta',
                                                title: "Alerta",
                                                callback: function () {
                                                    window.location = './usuario.php';
                                                },
                                                buttons: {
                                                    "ok": {
                                                        label: "Ok",
                                                        className: "card-color",
                                                        callback: function () { }
                                                    }
                                                }
                                            });
                                            return false;
                                        }
                                    });
                                });
                            }
                        });

                    }
                }

            } else {
                $("#email").attr('class', 'form-control is-invalid');
                $('input[name=email]').after('<div id="message"><p>El valor de correo no es correcto </p></div>');
            }
        }

    });
});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function isPass(pass) {
    var reg = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    return reg.test(pass);
}