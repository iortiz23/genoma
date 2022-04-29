/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {

    $('#tbUsuarios').dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    $(".paginate_page").text("Página");
    $(".paginate_of").text($(".paginate_of").text().replace("of", "de"));
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'getUser'
        }),
        type: "post",
        dataType: "xml",
        beforeSend: function() {

        },
        success: function(xml) {
            bootbox.hideAll();
            $(xml).find("response").each(function() {
                $(this).find("registro").each(function() {
                    if ($(this).text() != 'NOEXITOSO') {
                        $('#tbUsuarios').dataTable().fnAddData([
                            $(this).attr('Id'),
                            decodeURIComponent(escape($(this).attr('Name'))),
                            $(this).attr('Document'),
                            $(this).attr('Type_client'),
                            '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormUsuarios.php?id=' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteUser(' + $(this).attr('Id') + ')"><i class="nav-icon fas fa-trash" ></i></button>',
                        ]);
                    }
                });
            });
        }
    });
});

function deleteUser(id) {
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'deleteUser',
            'id': id
        }),
        type: "post",
        dataType: "xml",
        beforeSend: function() {
            bootbox.alert({
                message: 'Cargando ....',
                title: "Cargando"
            });
        },
        success: function(xml) {
            bootbox.hideAll();
            $(xml).find("response").each(function() {
                $(this).find("registro").each(function() {
                    if ($(this).text() != 'NOEXITOSO') {
                        bootbox.alert({
                            message: 'Usuario Eliminado Correctamente',
                            title: "Alerta",
                            callback: function() {
                                window.location = './usuario.php';
                            }
                        });
                    } else {
                        bootbox.alert({
                            message: 'Usuario no eliminado',
                            title: "Alerta",
                            callback: function() {
                                window.location = './usuario.php';
                            }
                        });
                        return false;
                    }
                });
            });
        }
    });
    $('#tbUsuarios').dataTable({
        "aaSorting": []
    });
    var table = $('#tbUsuarios').DataTable();

    table
        .clear()
        .draw();
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            'metodo': 'getUser'
        }),
        type: "post",
        dataType: "xml",
        beforeSend: function() {
            bootbox.alert({
                message: 'Cargando ....',
                title: "Cargando"
            });
        },
        success: function(xml) {
            bootbox.hideAll();
            $(xml).find("response").each(function() {
                $(this).find("registro").each(function() {
                    if ($(this).text() != 'NOEXITOSO') {
                        $('#tbUsuarios').dataTable().fnAddData([
                            $(this).attr('Id'),
                            $(this).attr('Name'),
                            $(this).attr('Document'),
                            $(this).attr('State'),
                            '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormUsuarios.php/' + $(this).attr('Id') + '" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1"><i class="nav-icon fas fa-trash" onclick="deleteUser(' + $(this).attr('Id') + ')"></i></button>',
                        ]);
                    } else {
                        bootbox.alert({
                            message: '',
                            title: "Alerta",
                            callback: function() {
                                window.location = './usuario.php';
                            }
                        });
                        return false;
                    }
                });
            });
        }
    });
}