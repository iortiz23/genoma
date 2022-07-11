/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    
    $('#tbTypeEnfermedad').dataTable( {
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
            'metodo': 'getTypeIllnes'
        }),
        type: "post",
        dataType: "xml",
        beforeSend: function () {
        },
        success: function (xml) {
            $(xml).find("response").each(function () {
                $(this).find("registro").each(function () {
                    if ($(this).text() != 'NOEXITOSO') {
                        $('#tbTypeEnfermedad').dataTable().fnAddData([
                            $(this).attr('Id'),
                            decodeURIComponent(escape($(this).attr('Description'))),
                            ($(this).attr('State') == 1) ? 'Activo' : 'Inactivo',
                            '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTipoenfermedad.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteTypeIllness(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                        ]);
                    } else {
                        bootbox.alert({
                            message: 'No se encuentran registros',
                            title: "Alerta",
                            callback: function () {
                                window.location = './tipoenfermedad.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoenfermedad.php';
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

function deleteTypeIllness(id) {
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            data: ({
                'metodo': 'deleteTypeIllnes',
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
                                message: 'Tipo de enfermedad Eliminado Correctamente',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipoenfermedad.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoenfermedad.php';
                                   }
                                }
                            }
                            });
                        } else {
                            bootbox.alert({
                                message: 'Tipo de enfermedad no eliminado',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipoenfermedad.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoenfermedad.php';
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
        $('#tbTypeEnfermedad').dataTable({
            "aaSorting": []
        });
        var table = $('#tbTypeEnfermedad').DataTable();

        table
                .clear()
                .draw();
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            data: ({
                'metodo': 'getTypeIllnes'
            }),
            type: "post",
            dataType: "xml",
            beforeSend: function () {
            },
            success: function (xml) {
                $(xml).find("response").each(function () {
                    $(this).find("registro").each(function () {
                        if ($(this).text() != 'NOEXITOSO') {
                            $('#tbTypeEnfermedad').dataTable().fnAddData([
                                $(this).attr('Id'),
                                $(this).attr('Description'),
                                ($(this).attr('State') == 1) ? 'Activo' : 'Inactivo',
                                '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTipoenfermedad.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteTypeIllenss(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                            ]);
                        } else {
                            bootbox.alert({
                                message: 'No se encuentran registros',
                                title: "Alerta",
                            callback: function () {
                                window.location = './tipoenfermedad.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {
                                    window.location = './tipoenfermedad.php';
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

