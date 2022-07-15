/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    const valores = window.location.search;
    //Creamos la instancia
    const urlParams = new URLSearchParams(valores);

    //Accedemos a los valores
    const index = urlParams.get("index");
    const id = urlParams.get("id");
    const name = urlParams.get("name");
    const value = urlParams.get("value");
    $("#btnRegresarDashboard").click(function() {
        window.location = "../dashboardbusqueda.php?id=" + id;
    });
    $("#tbDocumentos").dataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
        },
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print"],
    });
    $(".paginate_page").text("Página");
    $(".paginate_of").text($(".paginate_of").text().replace("of", "de"));
    $.ajax({
        url: "../../../controller/CapturaInformacionController.php",
        data: {
            metodo: "getBusquedaDetalle",
            id: id,
            index: index,
            name: name,
            value: value,
        },
        type: "post",
        dataType: "xml",
        async: true,
        beforeSend: function() {},
        success: function(xml) {
            $(xml)
                .find("response")
                .each(function() {
                    $(this)
                        .find("registro")
                        .each(function() {
                            $("#divloading").hide();
                            if ($(this).text() != "NOEXITOSO") {
                                $("#tbDocumentos")
                                    .dataTable()
                                    .fnAddData([
                                        $(this).attr("Muestra"),
                                        $(this).attr("CrPosicion"),
                                        $(this).attr("Gen"),
                                        $(this).attr("ACMG"),
                                        $(this).attr("Cigosidad"),
                                        $(this).attr("IDdbSNP"),
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                    ]);
                            } else {
                                bootbox.alert({
                                    message: "",
                                    title: "Alerta",
                                    callback: function() {
                                        window.location = "./busqueda.php";
                                    },
                                    buttons: {
                                        success: {
                                            label: "Ok",
                                            className: "card-color",
                                            callback: function() {},
                                        },
                                    },
                                });
                                return false;
                            }
                        });
                });
        },
    });
});