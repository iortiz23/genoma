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
                formData.append("metodo", "loadFile");
                formData.append("inputName", inputName);
                formData.append("inputObservation", inputObservation);
                alert('das4');
                $.ajax({
                    type: "POST",
                    dataType: 'xml',
                    async: false,
                    url: '../../controller/CapturaInformacionController.php',
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    success: function (xml) {
                        $(xml).find('response').each(function () {
                            $(xml).find('registro').each(function () {
                                switch ($(this).text()) {
                                    case 'EXITOSO':
                                        $('#txtResult').html('Todo salio muy bien, el cargue se realizó correctamente.');
                                        $('#txtResult').css('color', '#201C42');
                                        break;
                                    case 'NOCREATEFILE':
                                        $('#txtResult').html('Upps!!!, parece que tenemos un problema, valida la información de tu documento e intentalo más tarde.');
                                        $('#txtResult').css('color', '#E50850');
                                        break;
                                    case 'YAEXISTE':
                                        $('#txtResult').html('Upps!!!, Ya existe un cargue con el nombre <b><i>"' + inputName + '"</i></b>, intenta con uno diferente.');
                                        $('#txtResult').css('color', '#E50850');
                                        break;
                                    case 'NOEXITOSO':
                                        $('#txtResult').html('Upps!!!, parece que tenemos un problema,no pudimos realizar el cargue, intentalo más tarde o comunicate con tu administrador.');
                                        $('#txtResult').css('color', '#E50850');
                                        break;
                                    default:
                                        $('#txtResult').html('Upps!!!, parece que tenemos un problema,no pudimos realizar el cargue, intentalo más tarde o comunicate con tu administrador.');
                                        $('#txtResult').css('color', '#E50850');
                                        break;
                                }

                                $('#btnModal-sm').trigger('click');
                            });
                        });
                    }
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