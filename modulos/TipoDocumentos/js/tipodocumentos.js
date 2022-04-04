/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('#tbTypeDocument').dataTable({
        "aaSorting": []
    });
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'getTypeDocuments'
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
                        $('#tbTypeDocument').dataTable().fnAddData([
                            $(this).attr('Id'),
                            $(this).attr('Description'),
                            ($(this).attr('State') == 1) ? 'Activo' : 'Inactivo',
                            '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTiposdocumentos.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteTypeDocument(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                        ]);
                    } else {
                        bootbox.alert({
                            message: 'No se encuentran registros',
                            title: "Alerta",
                            callback: function () {
                                window.location = './tipodocumentos.php';
                            }
                        });
                        return false;
                    }
                });
            });
        }
    });
});

function deleteTypeDocument(id) {
    var valor = 0;
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'validateTypeDocument',
            'id': id
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
                        if ($(this).attr('Flag') == '1') {
                            bootbox.alert({
                                message: 'Uno o mas usuario(s) tiene el tipo de documento a eliminar ',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipodocumentos.php';
                            }
                            });
                            valor = 1;
                        }

                    } else {
                        bootbox.alert({
                            message: 'Tipo de documento no eliminado',
                            title: "Alerta",
                            callback: function () {
                                window.location = './tipodocumentos.php';
                            }
                        });
                        return false;
                    }
                });
            });
        }
    });
    if (valor != 1) {
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            data: ({
                'metodo': 'deleteTypeDocument',
                'id': id
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
                                message: 'Tipo de documento Eliminado Correctamente',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipodocumentos.php';
                            }
                            });
                        } else {
                            bootbox.alert({
                                message: 'Tipo de documento no eliminado',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipodocumentos.php';
                            }
                            });
                            return false;
                        }
                    });
                });
            }
        });
        $('#tbTypeDocument').dataTable({
            "aaSorting": []
        });
        var table = $('#tbTypeDocument').DataTable();

        table
                .clear()
                .draw();
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            data: ({
                'metodo': 'getTypeDocuments'
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
                            $('#tbTypeDocument').dataTable().fnAddData([
                                $(this).attr('Id'),
                                $(this).attr('Description'),
                                ($(this).attr('State') == 1) ? 'Activo' : 'Inactivo',
                                '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTiposdocumentos.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteTypeDocument(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                            ]);
                        } else {
                            bootbox.alert({
                                message: 'No se encuentran registros',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipodocumentos.php';
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
