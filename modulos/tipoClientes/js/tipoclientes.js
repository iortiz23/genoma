/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('#tbTypeClients').dataTable({
        "aaSorting": []
    });
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'getTypeClients'
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
                        $('#tbTypeClients').dataTable().fnAddData([
                            $(this).attr('Id'),
                            $(this).attr('Description'),
                            ($(this).attr('State') == 1) ? 'Activo' : 'Inactivo',
                            '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTipoClientes.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteTypeClient(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                        ]);
                    } else {
                        bootbox.alert({
                            message: 'No se encuentran registros',
                            title: "Alerta"
                        });
                        return false;
                    }
                });
            });
        }
    });
});

function deleteTypeClient(id) {
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'deleteTypeClient',
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
                            message: 'Tipo de cliente Eliminado Correctamente',
                            title: "Alerta"
                        });
                    } else {
                        bootbox.alert({
                            message: 'Tipo de cliente no eliminado',
                            title: "Alerta"
                        });
                        return false;
                    }
                });
            });
        }
    });
    $('#tbTypeClients').dataTable({
        "aaSorting": []
    });
    var table = $('#tbTypeClients').DataTable();

    table
            .clear()
            .draw();
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'getTypeClients'
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
                        $('#tbTypeClients').dataTable().fnAddData([
                            $(this).attr('Id'),
                            $(this).attr('Description'),
                            ($(this).attr('State') == 1) ? 'Activo' : 'Inactivo',
                            '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTipoClientes.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteTypeClient(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                        ]);
                    } else {
                        bootbox.alert({
                            message: 'No se encuentran registros',
                            title: "Alerta"
                        });
                        return false;
                    }
                });
            });
        }
    });
}


