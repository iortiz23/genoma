$(document).ready(function() {
    getLoads();

    $("#btnVale").click(function() {
        $("#inputName").val("");
        $("#inputObservation").val("");
        $("#inputFile").val("");
        $("#fileLabel").html("Seleccione un archivo");
        $("#btnUpload").show();
        $("#modal-sm").trigger("click");
    });
    $("#btnUpload").click(function() {
        var inputFile = $("#inputFile");
        var inputName = $("#inputName").val().trim();
        var idPerson = $("#idPerson").val().trim();
        var inputObservation = $("#inputObservation").val().trim();
        if (inputName.length >= 8) {
            if (inputFile.get(0).files.length > 0) {
                $("#btnUpload").hide();
                $("#p_validaName").hide();
                $("#p_validaFile").hide();
                $("#divloading").show();
                var formData = new FormData();

                formData.append("inputFile", inputFile.get(0).files[0]); // En la posición 0; es decir, el primer elemento
                formData.append("metodo", "loadFile");
                formData.append("inputName", inputName);
                formData.append("idPerson", idPerson);
                formData.append("inputObservation", inputObservation);
                formData.append("idTypeLoad", 2);
                $.ajax({
                    type: "POST",
                    dataType: "xml",
                    async: true,
                    url: "../../controller/CapturaInformacionController.php",
                    data: formData,
                    enctype: "multipart/form-data",
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    success: function(xml) {
                        $(xml)
                            .find("response")
                            .each(function() {
                                $(xml)
                                    .find("registro")
                                    .each(function() {
                                        $("#divloading").hide();
                                        switch ($(this).attr("result")) {
                                            case "NOMBRE_YA_EXISTE":
                                                $("#txtResult").html(
                                                    'Upps!!!, Ya existe un cargue con el nombre <b><i>"' +
                                                    inputName +
                                                    '"</i></b>, intenta con uno diferente.'
                                                );
                                                $("#txtResult").css("color", "#E50850");
                                                break;
                                            case "ARCHIVO_NO_CARGADO":
                                                //archivo
                                                $("#txtResult").html(
                                                    "Upps!!!, parece que tenemos un problema, el archivo seleccionado no pudo ser cargado."
                                                );
                                                $("#txtResult").css("color", "#E50850");
                                                break;
                                            case "CARGUE_NO_CREADO":
                                                //load
                                                $("#txtResult").html(
                                                    "Upps!!!, parece que tenemos un problema, no se pudo crear el cargue."
                                                );
                                                $("#txtResult").css("color", "#E50850");
                                                break;
                                            case "ERROR_FORMATO_ENCABEZADOS":
                                                $("#txtResult").html(
                                                    "Upps!!!, los encabezados del archivo Excel seleccionado no son los correctos, valida la celda <strong>" +
                                                    $(this).attr("columna") +
                                                    $(this).attr("fila") +
                                                    "</strong>"
                                                );
                                                $("#txtResult").css("color", "#E50850");
                                                break;
                                            case "CARGUE_NO_COMPLETADO":
                                                $("#txtResult").html(
                                                    "Upps!!!, no se pudo completar el cargue. <br> " +
                                                    "Se presento un error en la fila <strong>" +
                                                    $(this).attr("fila") +
                                                    "</strong> <br>" +
                                                    "Valida los datos de esta fila he intenta un nuevo cargue."
                                                );
                                                $("#txtResult").css("color", "#E50850");
                                                break;
                                            case "EXITOSO":
                                                $("#txtResult").html(
                                                    "Todo salio muy bien, el cargue se realizó correctamente. " +
                                                    '<br><b><i> Se procesaron "' +
                                                    $(this).attr("fila") +
                                                    '" filas.</i></b>'
                                                );
                                                $("#txtResult").css("color", "#201C42");
                                                break;
                                            default:
                                                $("#txtResult").html(
                                                    "Upps!!!, parece que tenemos un problema,no pudimos realizar el cargue, intentalo más tarde o comunicate con tu administrador."
                                                );
                                                $("#txtResult").css("color", "#E50850");
                                                break;
                                        }

                                        $("#btnModal-sm").trigger("click");
                                    });
                            });
                    },
                });
            } else {
                // El usuario no ha seleccionado archivos
                $("#p_validaFile").html("Aún no se ha seleccionado un documento.");
                $("#p_validaName").hide();
                $("#p_validaFile").show();
                $("#btnUpload").show();
            }
        } else {
            // El usuario no ha seleccionado archivos
            $("#p_validaName").html(
                "El nombre del documento debe ser de al menos 8 caracteres."
            );
            $("#btnUpload").show();
            $("#p_validaName").show();
        }
    });
});

function getLoads() {
    $("#divLoadingLoads").show();
    $("#divCardTableLoads").hide();
    $.ajax({
        type: "POST",
        dataType: "xml",
        async: true,
        url: "../../controller/CapturaInformacionController.php",
        data: ({
            metodo: "getLoads",
            idTypeLoad: "2",
        }),
        success: function(xml) {
            $(xml)
                .find("response")
                .each(function() {
                    $(xml)
                        .find("registro")
                        .each(function() {
                            if ($(this).text() === "NOEXITOSO") {
                                $("#divLoadingLoads").hide();
                                $("#divNotdata").show();
                            } else {
                                $("#divNotdata").hide();
                                $("#divLoadingLoads").hide();
                                $("#divCardTableLoads").show();
                                $("#table_Loads")
                                    .dataTable()
                                    .fnAddData([
                                        $(this).attr("IdLoad"),
                                        $(this).attr("NameLoad"),
                                        $(this).attr("NameDocument"),
                                        $(this).attr("Description"),
                                        $(this).attr("DescriptionState"),
                                        $(this).attr("DateCreate"),
                                        $(this).attr("Processedrows"),
                                        $(this).attr("Name"),
                                    ]);
                            }
                        });
                });
        },
    });
}