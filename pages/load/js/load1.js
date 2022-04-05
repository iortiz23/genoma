$(document).ready(function () {
    $('#btnUpload').click(function () {
        var inputFile = $("#inputFile");
        var inputName = $("#inputName").val().trim();
        var inputObservation = $("#inputObservation").val().trim();
        if (inputName.length >= 8) {
            if (inputFile.get(0).files.length > 0) {
                $('#p_validaName').hide();
                $('#p_validaFile').hide();
                var formData = new FormData();

                formData.append("inputFile", inputFile.get(0).files[0]); // En la posición 0; es decir, el primer elemento
                formData.append("inputName", inputName);
                formData.append("inputObservation", inputObservation);

                fetch("loadFile.php", {
                    method: 'POST',
                    body: formData,
                })
                        .then(respuesta => alert(respuesta.text()))
                        .then(decodificado => {
                            console.log(decodificado);
                        });
            } else {
                // El usuario no ha seleccionado archivos
                $('#p_validaFile').html('Aún no se ha seleccionado un documento.');
                $('#p_validaName').hide();
                $('#p_validaFile').show();
            }

        } else {
            // El usuario no ha seleccionado archivos
            $('#p_validaName').html('El nombre del documento debe ser de al menos 8 caracteres.');
            $('#p_validaName').show();
        }
    });
});