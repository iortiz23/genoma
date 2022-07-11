/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    
    $('#tbTypeMedicine').dataTable( {
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
            'metodo': 'getTypeMedicine'
        }),
        type: "post",
        dataType: "xml",
        beforeSend: function () {
        },
        success: function (xml) {
            $(xml).find("response").each(function () {
                $(this).find("registro").each(function () {
                    if ($(this).text() != 'NOEXITOSO') {
                        $('#tbTypeMedicine').dataTable().fnAddData([
                            $(this).attr('Id'),
                            decodeURIComponent(escape($(this).attr('Description'))),
                            ($(this).attr('State') == 1) ? 'Activo' : 'Inactivo',
                            '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTiposmedicamento.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteMedicine(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                        ]);
                    } else {
                        bootbox.alert({
                            message: 'No se encuentran registros',
                            title: "Alerta",
                            callback: function () {
                                window.location = './tipomedicamento.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipomedicamento.php';
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

function deleteMedicine(id) {    
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            data: ({
                'metodo': 'deleteTypeMedicine',
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
                                message: 'Tipo de medicamento Eliminado Correctamente',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipomedicamento.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipomedicamento.php';
                                   }
                                }
                            }
                            });
                        } else {
                            bootbox.alert({
                                message: 'Tipo de medicamento no eliminado',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipomedicamento.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipomedicamento.php';
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
        $('#tbTypeMedicine').dataTable({
            "aaSorting": []
        });
        var table = $('#tbTypeMedicine').DataTable();

        table
                .clear()
                .draw();
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            data: ({
                'metodo': 'getTypeMedicine'
            }),
            type: "post",
            dataType: "xml",
            beforeSend: function () {
            },
            success: function (xml) {
                $(xml).find("response").each(function () {
                    $(this).find("registro").each(function () {
                        if ($(this).text() != 'NOEXITOSO') {
                            $('#tbTypeMedicine').dataTable().fnAddData([
                                $(this).attr('Id'),
                                $(this).attr('Description'),
                                ($(this).attr('State') == 1) ? 'Activo' : 'Inactivo',
                                '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTiposmedicamento.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteMedicine(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                            ]);
                        } else {
                            bootbox.alert({
                                message: 'No se encuentran registros',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipomedicamento.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipomedicamento.php';
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

