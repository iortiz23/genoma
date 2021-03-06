$(document).ready(function() {
    permisos($("#idProfile").val());
    $("#btnOffSession").click(function() {
        $.ajax({
            type: "POST",
            dataType: "xml",
            async: false,
            url: "controller/CapturaInformacionController.php",
            data: {
                metodo: "offSession",
            },
            success: function(xml) {
                $(xml)
                    .find("response")
                    .each(function() {
                        $(xml)
                            .find("registro")
                            .each(function() {
                                if ($(this).text() === "EXITOSO") {
                                    location.reload();
                                }
                            });
                    });
            },
        });
    });
});

function permisos(idProfile) {
    switch (idProfile) {
        case '1':
            $("#li-permisos-adminUsu").show();
            $("#li-permisos-cargue").show();
            $("#li-permisos-busqueda").show();
            $("#li-permisos-cargue-relacion").show();
            $("#li-permisos-cargue-medicine").show();
            
            
            break;
        case '2':
            $("#li-permisos-adminUsu").hide();
            $("#li-permisos-cargue").show();
            $("#li-permisos-busqueda").show();
            $("#li-permisos-cargue-relacion").hide();
            $("#li-permisos-cargue-medicine").hide();
            break;
        case '3':
            $("#li-permisos-adminUsu").hide();
            $("#li-permisos-cargue").hide();
            $("#li-permisos-busqueda").show();
            $("#li-permisos-cargue-relacion").hide();
            $("#li-permisos-cargue-medicine").hide();
            break;

        default:
            $("#li-permisos-adminUsu").hide();
            $("#li-permisos-cargue").hide();
            $("#li-permisos-busqueda").hide();
            $("#li-permisos-cargue-relacion").hide();
            $("#li-permisos-cargue-medicine").hide();
            break;
    }
}