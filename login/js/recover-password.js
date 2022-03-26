$(document).ready(function () {
    $('#btnChangePassword').hide();
    $('#p_validaPassword').hide();
    var txtPassNew = document.getElementById("txtPassNew");
    txtPassNew.disabled = true;
    var txtPassConNew = document.getElementById("txtPassConNew");
    txtPassConNew.disabled = true;
    $('#txtPassOld').keyup(function () {
        if ($('#txtPassOld').val().trim() === '') {
            $('#btnChangePassword').hide();
            $('#txtPassConNew').val('');
            $('#txtPassNew').val('');
            txtPassNew.disabled = true;
            txtPassConNew.disabled = true;
        } else {
            txtPassNew.disabled = false;
            txtPassConNew.disabled = false;
        }
    });

    $('#txtPassNew').keyup(function () {
        var reg = /^(?=\w*\d)(?=\w*[a-zA-Z])\S{8,16}$/;

        if ($('#txtPassNew').val().trim().length >= 8 && ($('#txtPassConNew').val() === $('#txtPassNew').val()) && reg.test($('#txtPassNew').val())) {
            $('#p_validaPassword').hide();
            $('#p_valPassCriterios1').hide();
            $('#p_valPassCriterios2').hide();
            $('#btnChangePassword').show();
        } else {
            $('#p_valPassCriterios1').show();
            $('#p_valPassCriterios2').show();
            $('#p_validaPassword').show();
            $('#btnChangePassword').hide();
        }

    });
    $('#txtPassConNew').keyup(function () {
        var reg = /^(?=\w*\d)(?=\w*[a-zA-Z])\S{8,16}$/;

        if ($('#txtPassConNew').val().trim().length >= 8 && ($('#txtPassConNew').val() === $('#txtPassNew').val()) && reg.test($('#txtPassNew').val())) {
            $('#p_validaPassword').hide();
            $('#p_valPassCriterios1').hide();
            $('#p_valPassCriterios2').hide();
            $('#btnChangePassword').show();
        } else {
            $('#p_valPassCriterios1').show();
            $('#p_valPassCriterios2').show();
            $('#p_validaPassword').show();
            $('#btnChangePassword').hide();
        }

    });
    $('#btnVale').click(function () {
        $('#modal-sm').trigger('click');
    });
//    $('#btnModal-sm').on('hidden.bs.modal', function (e) {
//        
//    })



    $('#btnChangePassword').click(function () {
        if ($('#txtPassConNew').val().trim().length >= 5 && ($('#txtPassConNew').val() === $('#txtPassNew').val())) {
            $.ajax({
                type: "POST",
                dataType: 'xml',
                async: false,
                url: '../controller/CapturaInformacionController.php',
                data: ({
                    'metodo': 'setPassword',
                    'email': $('#hEmail').val(),
                    'password_old': $('#txtPassOld').val(),
                    'password_new': $('#txtPassConNew').val()
                }),
                success: function (xml) {
                    $(xml).find('response').each(function () {
                        $(xml).find('registro').each(function () {
                            if ($(this).text() === 'NOEXITOSO') {
                                $('#txtResult').html('Upps!!!, parece que tenemos un problema,valida tus datos e intentalo de nuevo más tarde.');
                                $('#txtResult').css('color', '#E50850');
                            } else {
                                $('#txtResult').html('Todo salio muy bien, tu nueva contraseña fue asignada correctamente.');
                                $('#txtResult').css('color', '#201C42');
                            }
                            $('#btnModal-sm').trigger('click');
                        });
                    });
                }
            });
        }
    });
});
$('#btnModal-sm').on('hide.bs.modal.prevent', closeModalEvent);
function closeModalEvent(e) {
    alert('das');
    e.preventDefault();
    if ($('#block').is(':checked')) {
        $('#myModal').off('hide.bs.modal.prevent');
        $("#myModal").modal('hide');
        return true;
    }
    return false;
}