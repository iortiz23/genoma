/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    $.ajax({
        url:"../../controller/CapturaInformacionController.php",
        data:({
            'metodo':'getProfile',
        }),
        type:"post",
        dataType:"xml",
        beforeSend:function(){
            bootbox.alert({
                message:'Cargando ....',
                title:"Cargando"
            });
        },
        success: function(xml){
            bootbox.hideAll();
            $(xml).find("response").each(function(){
                $(this).find("registro").each(function(){
                 if($(this).text() != 'NOEXITOSO'){
                    $('#idprofile').html($(this).text());
                 }else{
                     $('#idprofile').html('');
                 }   
                });
            });
            
        }
    });
    
    $("#guardar").click(function () {
        console.log($("#name").val());
        if($("#name").val()=="" ){
           $("#name").attr('class','form-control is-invalid'); 
           $('input[name=name]').after('<div id="message"><p>El campo nombre es obligatorio</p></div>');
        }else{
         $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            data: ({
                'metodo': 'setUser',
                'Nombre':$("#name").val(),
                'Documento':$("#document").val(),
                'Telefono':$("#phone").val(),
                'Email':$("#email").val(),
                'Contraseña':$("#pass").val(),
                'Status':$("#status").val(),
                'idTypeDocument':$("#idtypedocument").val(),
                'idProfile':$("#idprofile").val(),
            }),
            type: "post",
            dataType: "xml",
            beforeSend: function () {
                bootbox.alert({
                    message: 'Cargando ....',
                    title: "Cargando"
                });
            },
            success: function (xml) {
                bootbox.hideAll();
                $(xml).find("response").each(function () {
                    $(this).find("registro").each(function () {
                        if ($(this).text() != 'NOEXITOSO') {
                             bootbox.alert({
                                message: 'Proceso de guardado  exitoso',
                                title: "Correcto"
                            });
                            return true;
                        } else {
                            bootbox.alert({
                                message: 'No se  genero envio de forma correcta',
                                title: "Alerta"
                            });
                            return false;
                        }
                    });
                });
            }
        });   
        }
        
    });
});


