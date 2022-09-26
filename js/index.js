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
    $("#v-pills-home-tab").hover(function(){
        $(".comment-1").css( "display", "block" );
    },function(){
        $(".comment-1").css( "display", "none" ); 
    });

    $("#v-pills-profile-tab").hover(function(){
        $(".comment-2").css( "display", "block" );
    },function(){
        $(".comment-2").css( "display", "none" ); 
    });

    $("#v-pills-messages-tab").hover(function(){
        $(".comment-3").css( "display", "block" );
    },function(){
        $(".comment-3").css( "display", "none" ); 
    });

    $("#v-pills-settings-tab").hover(function(){
        $(".comment-4").css( "display", "block" );
    },function(){
        $(".comment-4").css( "display", "none" ); 
    });

    $("#v-pills-search-tab").hover(function(){
        $(".comment-5").css( "display", "block" );
    },function(){
        $(".comment-5").css( "display", "none" ); 
    });

});

function permisos(idProfile) {
    switch (idProfile) {
        case '1':
            $("#li-permisos-adminUsu").show();
            $("#li-permisos-cargue").show();
            $("#li-permisos-busqueda").show();
            
            
            break;
        case '2':
            $("#li-permisos-adminUsu").hide();
            $("#li-permisos-cargue").show();
            $("#li-permisos-busqueda").show();
            break;
        case '3':
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