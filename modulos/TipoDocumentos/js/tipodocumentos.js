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
                         '<button type="button" class="btn bg-gradient-warning btn-sm-1"><i class="nav-icon fas fa-edit"></i></button>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1"><i class="nav-icon fas fa-trash"></i></button>',
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

