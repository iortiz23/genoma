/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function (){
    $('#tbPerfil').dataTable({
     "aaSorting":[]   
    });
    $.ajax({
        url:"../../controller/CapturaInformacionController.php",
        data:({
            'metodo':'getPerfil'
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
                     $('#tbPerfil').dataTable().fnAddData([
                         $(this).attr('Id'),
                         $(this).attr('Description'),
                         ($(this).attr('State')==1)?'Activo':'Inactivo',
                         '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormPerfil.php?id='+$(this).attr('Id')+'" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deletePerfil('+$(this).attr('Id')+')"><i class="nav-icon fas fa-trash" ></i></button>',
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

function deletePerfil(id){
    $.ajax({
        url:"../../controller/CapturaInformacionController.php",
        data:({
            'metodo':'deletePerfil',
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
                         message:'Perfil Eliminado Correctamente',
                         title:"Alerta"
                     });
                 }else{
                     bootbox.alert({
                         message:'Perfil no eliminado',
                         title:"Alerta"
                     });
                     return false;
                 }   
                });
            });
        }
    });
    $('#tbPerfil').dataTable({
     "aaSorting":[]   
    });
    var table = $('#tbPerfil').DataTable();
 
table
    .clear()
    .draw();
    $.ajax({
        url:"../../controller/CapturaInformacionController.php",
        data:({
            'metodo':'getPerfil'
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
                     $('#tbPerfil').dataTable().fnAddData([
                         $(this).attr('Id'),
                         $(this).attr('Description'),
                         $(this).attr('State'),
                         '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormUsuarios.php/'+$(this).attr('Id')+'" ><i class="nav-icon fas fa-edit"></i></a>\n\
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


