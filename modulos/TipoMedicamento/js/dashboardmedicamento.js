/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $('#tbMedicamentoGenoma').dataTable({
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
            'metodo': 'getMedicinebyGen',
            'id': $("#id").val(),
        }),
        type: "post",
        dataType: "xml",
        beforeSend: function () {
        },
        success: function (xml) {
            $(xml).find("response").each(function () {
                $(this).find("registro").each(function () {
                    if ($(this).text() != 'NOEXITOSO') {
                        $('#tbMedicamentoGenoma').dataTable().fnAddData([
                            $(this).attr('Id'),
                            $(this).attr('Genoma'),
                            $(this).attr('Medicamento')]);
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