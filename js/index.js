$(document).ready(function() {
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