/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var data;

$(document).ready(function (){
    $('#tbUsuarios').dataTable({
     "aaSorting":[]   
    });
    $.ajax({
        url:"../../controller/CapturaInformacionController.php",
        data:({
            'metodo':'getUser'
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
                     $('#tbUsuarios').dataTable().fnAddData([
                         $(this).attr('Id'),
                         $(this).attr('Name'),
                         $(this).attr('Document'),
                         $(this).attr('State'),
                         '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormUsuarios.php/'+$(this).attr('Id')+'/" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteUser('+$(this).attr('Id')+')"><i class="nav-icon fas fa-trash" ></i></button>',
                     ]);
                 }else{
                     bootbox.alert({
                         message:'',
                         title:"Alerta"
                     });
                     return false;
                 }   
                });
            });
        }
    });
});

function deleteUser(id){
    $.ajax({
        url:"../../controller/CapturaInformacionController.php",
        data:({
            'metodo':'deleteUser',
            'id':id
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
                     bootbox.alert({
                         message:'Usuario Eliminado Correctamente',
                         title:"Alerta"
                     });
                 }else{
                     bootbox.alert({
                         message:'Usuario no eliminado',
                         title:"Alerta"
                     });
                     return false;
                 }   
                });
            });
        }
    });
    $.ajax({
        url:"../../controller/CapturaInformacionController.php",
        data:({
            'metodo':'getUser'
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
                     $('#tbUsuarios').dataTable().fnAddData([
                         $(this).attr('Id'),
                         $(this).attr('Name'),
                         $(this).attr('Document'),
                         $(this).attr('State'),
                         '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="FormUsuarios.php/'+$(this).attr('Id')+'" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1"><i class="nav-icon fas fa-trash" onclick="deleteUser('+$(this).attr('Id')+')"></i></button>',
                     ]);
                 }else{
                     bootbox.alert({
                         message:'',
                         title:"Alerta"
                     });
                     return false;
                 }   
                });
            });
        }
    });
}


