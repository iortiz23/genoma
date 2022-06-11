/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function (){
    $('#tbDocumentos').dataTable({
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
            
        },
        success: function(xml){
            $(xml).find("response").each(function(){
                $(this).find("registro").each(function(){
                 if($(this).text() != 'NOEXITOSO'){
                     $('#tbDocumentos').dataTable().fnAddData([
                         $(this).attr('Id'),
                         $(this).attr('Name'),
                         $(this).attr('Document'),
                         $(this).attr('State'),
                         '<a type="button" class="btn bg-gradient-warning btn-sm-1" href="./FormUsuarios.php?id='+$(this).attr('Id')+'" ><i class="nav-icon fas fa-edit"></i></a>\n\
                          <button type="button" class="btn  bg-gradient-danger btn-sm-1" onclick="deleteUser('+$(this).attr('Id')+')"><i class="nav-icon fas fa-trash" ></i></button>',
                     ]);
                 }else{
                     bootbox.alert({
                         message:'',
                         title:"Alerta",
                            callback: function () {
                                window.location = './usuario.php';
                            },
                            buttons: {
                                "success": {
                                   label: "Ok",
                                   className: "card-color",
                                   callback: function () {}
                                }
                            }
                     });
                     return false;
                 }   
                });
            });
        }
    });
});



