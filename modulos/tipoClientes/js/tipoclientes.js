/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('#tbTypeClients').dataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $(".paginate_page").text("Página");
    $(".paginate_of").text($(".paginate_of").text().replace("of","de"));
    
    
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'getTypeClients'
        }),
        type: "post",
        dataType: "xml",
        beforeSend: function () {
        },
        success: function (xml) {
            $(xml).find("response").each(function () {
                $(this).find("registro").each(function () {
                    if ($(this).text() != 'NOEXITOSO') {
                        $('#tbTypeClients').dataTable().fnAddData([
                            $(this).attr('Id'),
                            decodeURIComponent(escape($(this).attr('Description'))),
                            ($(this).attr('State') == 1) ? 'Activo' : 'Inactivo',
                            '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTipoClientes.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteTypeClient(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                        ]);
                    } else {
                        bootbox.alert({
                            message: 'No se encuentran registros',
                            title: "Alerta",
                            callback: function () {
                                window.location = './tipoclientes.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoclientes.php';s
                                   }
                                }
                            }
                        });
                        return false;
                    }
                });
            });
        }
    });
});

function deleteTypeClient(id) {
    var valor = 0;
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'validateTypeClient',
            'id': id
        }),
        type: "post",
        dataType: "xml",
        beforeSend: function () {
        },
        success: function (xml) {
            $(xml).find("response").each(function () {
                $(this).find("registro").each(function () {
                    if ($(this).text() != 'NOEXITOSO') {
                        if ($(this).attr('Flag') == '1') {
                            bootbox.alert({
                                message: 'Uno o mas usuario(s) tiene el tipo de cliente a eliminar ',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipoclientes.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoclientes.php';
                                   }
                                }
                            }
                            });
                            valor = 1;
                        }

                    } else {
                        bootbox.alert({
                            message: 'Tipo de cliente no eliminado',
                            title: "Alerta",
                            callback: function () {
                                window.location = './tipoclientes.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoclientes.php';
                                   }
                                }
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
                'metodo': 'deleteTypeClient',
                'id': id
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
                                message: 'Tipo de cliente Eliminado Correctamente',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipoclientes.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoclientes.php';
                                   }
                                }
                            }
                            });
                        } else {
                            bootbox.alert({
                                message: 'Tipo de cliente no eliminado',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipoclientes.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoclientes.php';
                                   }
                                }
                            }
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
            },
            success: function (xml) {
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
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipoclientes.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoclientes.php';
                                   }
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


