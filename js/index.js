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
    $("#v-pills-home-tab").hover(
        function() {
            $("#v-pills-home").hide();
            $(".comment-1").css("display", "block");
        },
        function() {
            $(".comment-1").css("display", "none");
        }
    );
    $("#v-pills-profile-tab").hover(
        function() {
            $("#v-pills-profile").hide();
            $(".comment-2").css("display", "block");
        },
        function() {
            $(".comment-2").css("display", "none");
        }
    );
    $("#v-pills-messages-tab").hover(
        function() {
            $("#v-pills-messages").hide();
            $(".comment-3").css("display", "block");
        },
        function() {
            $(".comment-3").css("display", "none");
        }
    );
    $("#v-pills-settings-tab").hover(
        function() {
            $("#v-pills-settings").hide();
            $(".comment-4").css("display", "block");
        },
        function() {
            $(".comment-4").css("display", "none");
        }
    );
    $("#v-pills-search-tab").hover(
        function() {
            $("#v-pills-search").hide();
            $(".comment-5").css("display", "block");
        },
        function() {
            $(".comment-5").css("display", "none");
        }
    );

    $("#v-pills-home-tab,#v-pills-profile-tab,#v-pills-messages-tab,#v-pills-settings-tab,#v-pills-search-tab").click(function() {
        $("#v-pills-home,#v-pills-profile,#v-pills-messages,#v-pills-messages,#v-pills-settings,#v-pills-search").show();
        $(".comment-1,.comment-2,.comment-3,.comment-4,.comment-5").css("display", "none");
    });


});

function permisos(idProfile) {
    switch (idProfile) {
        case "1":
            $("#li-permisos-adminUsu").show();
            $("#li-permisos-cargue").show();
            $("#li-permisos-busqueda").show();

            break;
        case "2":
            $("#li-permisos-adminUsu").hide();
            $("#li-permisos-cargue").show();
            $("#li-permisos-busqueda").show();
            break;
        case "3":
            $("#li-permisos-adminUsu").hide();
            $("#li-permisos-cargue").hide();
            $("#li-permisos-busqueda").show();
            break;

        default:
            $("#li-permisos-adminUsu").hide();
            $("#li-permisos-cargue").hide();
            $("#li-permisos-busqueda").hide();
            break;
    }
}