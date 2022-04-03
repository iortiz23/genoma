/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var data;

$(document).ready(function (){
    $('#tbTypeClients').dataTable({
     "aaSorting":[]   
    });
    $.ajax({
        url:"../../controller/CapturaInformacionController.php",
        data:({
            'metodo':'getTypeClients'
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
                     $('#tbTypeClients').dataTable().fnAddData([
                         $(this).attr('Id'),
                         $(this).attr('Description'),
                         $(this).attr('State'),
                         '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTipoClientes.php/'+$(this).attr('Id')+'/" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteClient('+$(this).attr('Id')+')"><i class="nav-icon fas fa-trash" ></i></button>',
                     ]);
                 }else{
                     bootbox.alert({
                         message:'No se encuentran registros',
                         title:"Alerta"
                     });
                     return false;
                 }   
                });
            });
        }
    });
});

function deleteClient(id){
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
                         message:'Tipo de cliente Eliminado Correctamente',
                         title:"Alerta"
                     });
                 }else{
                     bootbox.alert({
                         message:'Tipo de cliente no eliminado',
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
            'metodo':'getTypeClients'
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
                     $('#tbTypeClients').dataTable().fnAddData([
                         $(this).attr('Id'),
                         $(this).attr('Description'),
                         $(this).attr('State'),
                         '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormTipoClientes.php/'+$(this).attr('Id')+'" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1"><i class="nav-icon fas fa-trash" onclick="deleteClient('+$(this).attr('Id')+')"></i></button>',
                     ]);
                 }else{
                     bootbox.alert({
                         message:'registros no encontrados',
                         title:"Alerta"
                     });
                     return false;
                 }   
                });
            });
        }
    });
}


