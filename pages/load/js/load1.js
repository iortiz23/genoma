$(document).ready(function() {
    $("#btnUpload").click(function() {
        var inputFile = $("#inputFile");
        var inputName = $("#inputName").val().trim();
        var idPerson = $("#idPerson").val().trim();
        var inputObservation = $("#inputObservation").val().trim();
        if (inputName.length >= 8) {
            if (inputFile.get(0).files.length > 0) {
                $("#p_validaName").hide();
                $("#p_validaFile").hide();
                var formData = new FormData();

                formData.append("inputFile", inputFile.get(0).files[0]); // En la posición 0; es decir, el primer elemento
                formData.append("metodo", "loadFile");
                formData.append("inputName", inputName);
                formData.append("idPerson", idPerson);
                formData.append("inputObservation", inputObservation);
                $.ajax({
                    type: "POST",
                    dataType: "xml",
                    async: false,
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
                                                    "Todo salio muy bien, el cargue se realizó correctamente."
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
            }
        } else {
            // El usuario no ha seleccionado archivos
            $("#p_validaName").html(
                "El nombre del documento debe ser de al menos 8 caracteres."
            );
            $("#p_validaName").show();
        }
    });
});