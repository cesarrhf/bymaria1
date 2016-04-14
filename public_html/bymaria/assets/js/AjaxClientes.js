$(document).ready(function(){
var id_newCliente;
var row_global;



//funcion que logra hacer aparecer la barrita de carga
  // $(document).ajaxStart(function() {
  // //   alert("asd");
  //   $("#cargando").show();
  //
  // }).ajaxStop(function() {
  //   $("#cargando").hide();
  // });

function msjes(mensaje){
  $("#msj-success").html(mensaje).fadeIn();
  $("#msj-success").fadeToggle(2500);
}
function msjes2(mensaje){
  $(".modal-header #msj-success").html(mensaje).fadeIn();
  $(".modal-header #msj-success").fadeToggle(2500);
}
function msjes3(mensaje){
  $(".modal-header #msj-fail").html(mensaje).fadeIn();
  $(".modal-header #msj-fail").fadeToggle(2500);
}
//funcion que limpia el modal cuando esta en modo hidden
$(document).on("hidden.bs.modal", function (e) {
    $(e.target).removeData("bs.modal").find(".modal-content").empty();
});



//MODAL DE AGREGAR CLI
// $(document).on('click','.btn-warning', function (e) {
//         //$('#myModal').removeData('bs.modal');
//         var row = $(this).parents('tr');
//         var id = row.data('id');
//           $('#myModal').modal({remote: 'clientes/' +id, backdrop:"static" });
//         $('#myModal').modal('show');
// });

// $(document).on('click','.btn-warning', function (e) {
//         //$('#myModal').removeData('bs.modal');
//         var _token = $('#token').val();
//         var routeContac = "clientesCrea";
//
//         $.ajax({
//           url: routeContac,
//           type: 'POST',
//           data: {id:id_newCliente },
//           headers: {'X-CSRF-TOKEN': _token},
//           dataType: 'json',
//           global: false,
//           success: function(result){
//             msjes2(result2.mensaje);
//           },
//          error: function(result){
//          }
//         });
//
// });


//MODAL CONTACTO EDITAR
$(document).on('click','.btn-info', function (e) {
      //  $('#myModal').removeData('bs.modal');
      $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');

        var row = $(this).parents('tr');
        row_global=row;
        var id = row.data('id');
        id_newCliente = row.data('id');
         $('#myModal').modal({remote: 'contactos/' +id, backdrop:"static" });
        $('#myModal').modal('show');
        //SE EJECUTA CUANDO SE CARGA!
        $('#myModal').on('loaded.bs.modal', function() {
          console.log('someasdasd');
          $('.btn-info').html('<i class="fa fa-pencil"></i>')
          $('.modal-content #tableContact').editableTableWidget({disableClass: "edit-disabled"});
          $('.modal-content #tableDirec').editableTableWidget({disableClass: "edit-disabled"});
          // $('#tableContact').editableTableWidget({disableClass: "edit-disabled"});
          // $('#tableDirec').editableTableWidget({disableClass: "edit-disabled"});
    })


});

//cuando se apreta el boton AGREGAR DEL   CLIENTE
$(document).on('click','#btnCliEdit', function(e){
  $('#btnCliEdit').html('<i style="width:'+$('#btnCliEdit').width()+'px;" class="fa fa-spinner fa-pulse fa-lg"></i>');

  var _token = $('#token').val();
  var routeContac = "contactos";
     $.ajax({
       url: routeContac,
       type: 'POST',
       data: {id:id_newCliente },
       headers: {'X-CSRF-TOKEN': _token},
       dataType: 'json',
       global: false,
       success: function(result2){
         msjes2(result2.mensaje);
         $('#btnCliEdit').html('<i class="fa fa-plus"></i> Agregar Contacto ');

         $('#tableContact > tbody:last').append('<tr data-id='+result2.id+'><td class="edit-enabled">"COMPLETE LOS CAMPOS"</td><td class="edit-enabled">  </td><td class="edit-enabled"></td><td class="edit-enabled"></td></tr>');
         $('#tableContact').editableTableWidget({disableClass: "edit-disabled"});
       },
      error: function(result){
         var response = JSON.parse(result.responseText);
        $.each(response, function (ind, elem) {
          $(".modal-body #msj-fail").append('<p>'+elem+'</p>').fadeIn();
        });
      }
     });
  $('#contacPartials').show();
});

//cuando se apreta el boton AGREGAR dire DEL   CLIENTE
$(document).on('click','#btnDirEdit', function(e){
  var _token = $('#token').val();
  console.log(id_newCliente);
  $('#btnDirEdit').html('<i style="width:'+$('#btnDirEdit').width()+'px;" class="fa fa-spinner fa-pulse fa-lg"></i>');

  var routeContac = "direcciones";
    $.ajax({
      global: false,
      url: routeContac,
      type: 'POST',
      data: {id:id_newCliente },
      headers: {'X-CSRF-TOKEN': _token},
      dataType: 'json',
      success: function(result3){
        msjes2(result3.mensaje);
        $('#tableDirec > tbody:last').append('<tr data-id='+result3.id+'><td class="edit-enabled"><select class="selectpicker selectpicker'+result3.id+'" data-live-search="true" title=" " data-container="body" >  </select></td><td class="edit-enabled mapa_calle"></td><td class="edit-enabled mapa_num"></td><td class="edit-enabled"></td></tr>');
        some    = ajaxComunas();
        var obj = JSON.parse(some.responseText);
         $.each(obj, function(i, item) {
         if (item.COMUNA_ID=='13101') {
           $('.selectpicker'+result3.id).append('<option selected value='+item.COMUNA_ID+' title='+item.COMUNA_NOMBRE+'>'+item.COMUNA_NOMBRE+'</option>');
         } else{
           $('.selectpicker'+result3.id).append('<option value='+item.COMUNA_ID+' title='+item.COMUNA_NOMBRE+'>'+item.COMUNA_NOMBRE+'</option>');
         }
       });
      $('.selectpicker'+result3.id).selectpicker({
         dropupAuto: false ,
         width: '100%'
      });
      $('.selectpicker'+result3.id).selectpicker('refresh');
      $('#tableDirec').editableTableWidget({disableClass: "edit-disabled"});
      $('#btnDirEdit').html('<i class="fa fa-plus"></i> Agregar Dirección');

    },
     error: function(result){
        var response = JSON.parse(result.responseText);
       $.each(response, function (ind, elem) {
         $(".modal-body #msj-fail").append('<p>'+elem+'</p>').fadeIn();
       });
     }
    });
  $('#contacPartials').show();
});


//cuando se apreta el boton mas del MODAL EDIT CONTACTO
$(document).on('click','#btnCliContEdit', function(e){
     var _token = $('#token').val();
  var routeContac = "contactos";
     $.ajax({
       global: false,
       url: routeContac,
       type: 'POST',
       data: {id:id_newCliente },
       headers: {'X-CSRF-TOKEN': _token},
       dataType: 'json',
       success: function(result){
         msjes2(result.mensaje);
          $('.modal-content #tableContact > tbody:last').append('<tr data-id='+result.id+'><td class="edit-enabled"></td><td class="edit-enabled"></td><td class="edit-enabled"></td><td class="edit-enabled"></td><td class="edit-disabled"><a href= "#!" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td></tr>');
         $('.modal-content #tableContact').editableTableWidget({disableClass: "edit-disabled"});
     },
      error: function(result){
         var response = JSON.parse(result.responseText);
        $.each(response, function (ind, elem) {
          $(".modal-body #msj-fail").append('<p>'+elem+'</p>').fadeIn();
        });
      }
     });
});
//cuando se apreta el boton mas del MODAL EDIT DIRE

$(document).on('click','#btnCliDirEdit', function(e){
     var _token = $('#token').val();
  var routeContac = "direcciones";
     $.ajax({
       global: false,
       url: routeContac,
       type: 'POST',
       data: {id:id_newCliente },
       headers: {'X-CSRF-TOKEN': _token},
       dataType: 'json',
       success: function(result2){
            msjes2(result2.mensaje);
           $('.modal-content #tableDirec > tbody:last').append('<tr data-id='+result2.id+'>'+
           '<td class="edit-enabled">'+
           ' <select class="selectpicker selectpicker'+result2.id+'" data-live-search="true" title=" " data-container="body" >  </select></td>'+
           '<td class="edit-enabled mapa_calle"></td><td class="edit-enabled mapa_num">'+
           '</td><td class="edit-enabled "></td><td class="edit-disabled"><a href= "#!" class="btn btn-xs btn-danger">'+
           '<i class="fa fa-times"></i></a></td></tr>');

            some    = ajaxComunas();
            var obj = JSON.parse(some.responseText);
        //   console.log(some);
            $.each(obj, function(i, item) {
             if (item.COMUNA_ID=='13101') {
               $('.selectpicker'+result2.id).append('<option selected value='+item.COMUNA_ID+' title='+item.COMUNA_NOMBRE+'>'+item.COMUNA_NOMBRE+'</option>');
             } else{
               $('.selectpicker'+result2.id).append('<option value='+item.COMUNA_ID+' title='+item.COMUNA_NOMBRE+'>'+item.COMUNA_NOMBRE+'</option>');
             }
           });
          $('.selectpicker'+result2.id).selectpicker({
              dropupAuto: false ,
             width: '100%'
          });
          $('.selectpicker'+result2.id).selectpicker('refresh');
          $('.modal-content #tableDirec').editableTableWidget({disableClass: "edit-disabled"});

     },
      error: function(result){
         var response = JSON.parse(result.responseText);
        $.each(response, function (ind, elem) {
          $(".modal-body #msj-fail").append('<p>'+elem+'</p>').fadeIn();
        });
      }
     });

});

function ajaxComunas(){
  var _token = $('#token').val();
  var route = "comunasSelect";
  var id;
  return $.ajax({
    url: route,
    type: 'POST',
      async: false,
    data: {
     id: id
    },
    headers: {
      'X-CSRF-TOKEN': _token
    },
    dataType: 'json',
    success: function(result) {
     return;
      }
  });
}



$(document).on('click','#editCli', function(e) {
  $("#formCli").submit();
});

//EVENTO DE EDICION DE CLIENTES modal editar
$(document).on('submit','#formCli' ,function(e) {
    e.preventDefault();
     $('#editCli').html('<i style="width:'+$('#editCli').width()+'px;" class="fa fa-spinner fa-pulse fa-lg"></i>');

    $(".modal-header #msj-fail").hide();
    $(".modal-header #msj-fail").empty();

    // var $form = $(this);
     // var $inputs = $form.find("input, select, button, textarea,#cli_foto");
    //  var serializedData = $form.serialize();
    var formData = new FormData();
    formData.append('Imagen_Cliente', $('input[type=file]')[0].files[0]);

    formData.append('rut',           $( "input[name*='rut']" ).val());
    formData.append('Razon_social',     $( "input[name*='Razon_social']" ).val());
    formData.append('Clave',     $( "input[name*='Clave']" ).val());
    formData.append('Telefono',  $( "input[name*='Telefono']" ).val());
    formData.append('Correo',    $( "input[name*='Correo']" ).val());
    formData.append('cli_http',      $( "input[name*='cli_http']" ).val());
    formData.append('cli_vende',     $( "input[name*='cli_vende']" ).prop('checked') );
    formData.append('id',     $( "input[name*='id']" ).val() );

    var id = $('#id').val();
    //$inputs.prop("disabled", true);
    var route =   "cliente/updatee";
    var _token = $('#token').val();

    $.ajax({
      global: false,
      cache:false,
      contentType: false,
      processData: false,
      url: route,
      type: 'POST',
      data: formData,
      headers: {
        'X-CSRF-TOKEN': _token
      },
      dataType: 'json',
      success: function(result) {
        $('#editCli').html('Guardar Edición');

        $('.idDiv').empty().append(result);

          msjes2('Guardado');
    },
      error: function(result) {
        var response = JSON.parse(result.responseText);
        $(".modal-content #msj-fail").empty();

       $.each(response, function (ind, elem) {
         $(".modal-content #msj-fail").append('<p style="margin-top: -10px;">'+elem+'</p>').fadeIn();
         return false;
       });

        $('#editCli').html('Guardar Edición');

      }
    });

});


//EVENTO DEL REGISTRO DE CLIENTES
$(document).on('click','#registroCli', function(e){
  e.preventDefault();
  $('#registroCli').html('<i style="width:'+$('#registroCli').width()+'px;" class="fa fa-spinner fa-pulse fa-lg"></i>');

  $("  #msj-fail").hide();
  $("  #msj-fail").empty();

   var formData = new FormData();
   formData.append('Imagen_Cliente', $('input[type=file]')[0].files[0]);

   formData.append('rut',           $( "input[name*='rut']" ).val());
   formData.append('Razon_social',     $( "input[name*='cli_razon']" ).val());
   formData.append('Clave',     $( "input[name*='cli_clave']" ).val());
   formData.append('Telefono',  $( "input[name*='cli_telefono']" ).val());
   formData.append('Correo',    $( "input[name*='cli_correo']" ).val());
   formData.append('cli_http',      $( "input[name*='cli_http']" ).val());
   formData.append('cli_vende',     $( "input[name*='cli_vende']" ).prop('checked') );

   var route  = "clientes";
   var _token = $('#token').val();

   $.ajax({
     global: false,
    url: route,
    type: 'POST',
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
     headers: {'X-CSRF-TOKEN': _token},
     dataType: 'json',
     success: function(result){
       $('#registroCli').html('Registrar');
       console.log(result.id);
       msjes(result.mensaje);
      //   $(".modal-header #msj-success").append('<p>'+result.mensaje+'</p>').fadeIn();
      //   $(".modal-header #msj-success").fadeToggle(2500);
       //
      //    $(".modal-content #msj-fail").hide();
      //    $(".modal-content #msj-fail").empty();
        $("input[type=text]").prop('disabled', true);
         $('#btnCliEdit').removeClass('disabled');
         $('#btnDirEdit').removeClass('disabled');
         $('#registroCli').addClass('disabled');
        id_newCliente = result.id;
      //    $('#tableClientes > tbody:last').append('<tr data-id='+result.id+'><td class="edit-enabled">'+result.rut+'</td><td class="edit-enabled">'+result.razon+'</td><td class="edit-enabled">'+result.clave+'</td><td class="edit-enabled">'+result.telefono+'</td><td class="edit-enabled">'+result.correo+'</td><td class="edit-disabled"><a href= "#!" class="hide btn btn-xs btn-danger"><i class="fa fa-times"></i></a> <a href= "#!" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a></td></tr>');
      //    //$('#tableClientes').editableTableWidget({disableClass: "edit-disabled"});
      //  //$("input[type=text]").val("");
      //  //ajax para crear altiro un nuevo contacto
   },
    error: function(result){
      $('#registroCli').html('Registrar');

       var response = JSON.parse(result.responseText);
      $.each(response, function (ind, elem) {
        $("#msj-fail").append('<p>'+elem+'</p>').show();
      });
    }
   });

 });


 //cuando se cambia de texto PARA CONTACTO
   $(document).on('change','#tableContact td', function(evt, newValue) {
     var row = $(this).parents('tr');
     var _token = $('#token').val();
     var id = row.data('id');
     var texto = $(this).html();
     var posi = $(this).index();
     var route =   "contactos/"+id;
     $.ajax({
       global: false,
   		url: route,
   		headers: {'X-CSRF-TOKEN': _token},
   		type: 'PUT',
     	dataType: 'json',
   		data: {id:id, texto:texto, posi:posi},
   		success: function(result){
           msjes2(result.mensaje);
   		}
   	});
 });

 //cuando se cambia de texto PARA DIRECCIONES
   $(document).on('change','#tableDirec td', function(evt, newValue) {
      var row = $(this).parents('tr');
     var _token = $('#token').val();
      var id = row.data('id');
     var texto = $(this).html();
     var posi = $(this).index();
     if (posi==0) {
       texto =  $('.selectpicker', this ).val();
     }
     var route =   "direcciones/"+id;
     $.ajax({
       global: false,
      url: route,
      headers: {'X-CSRF-TOKEN': _token},
      type: 'PUT',
      dataType: 'json',
      data: {id:id, texto:texto, posi:posi},
      success: function(result){
         msjes2(result.mensaje);
      }
    });
 });


 //evento que elimina CONTACTO
 $(document).on("click",'#tableContact .btn-danger', function(e) {
    e.preventDefault();
     var row = $(this).parents('tr');
    $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');

    var r = confirm("¿Seguro que desea eliminar el contacto?");
    if (r==true) {
      var id = row.data('id');
      var _token = $('#token').val();
      var route =   "contactos/"+id;
      row.fadeOut();
      $.ajax({
         global: false,
        url: route,
        type: 'DELETE',
        data: id,
        headers: {'X-CSRF-TOKEN': _token},
        dataType: 'json',
        success: function(result){
            msjes2(result.mensaje);
      },
       error: function(result){

       var response = JSON.parse(result.responseText);
       /*  $.each(response, function (ind, elem) {
           $("#msj-fail").append('<p>'+elem+'</p>').fadeIn();
         });*/
       }
      });
    }
    $(this).html('<i class="fa fa-times"></i>');

  });

   //evento que elimina DIRECIONES
   $(document).on("click",'#tableDirec .btn-danger', function(e) {
     console.log('q wea hermano')
      e.preventDefault();
      var row = $(this).parents('tr');
      $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');
      var r = confirm("¿Seguro que desea eliminar la dirección?");
      if (r==true) {
        var id = row.data('id');
        var _token = $('#token').val();
        var route =   "direcciones/"+id;
        row.fadeOut();
        $.ajax({
           global: false,
          url: route,
          type: 'DELETE',
          data: id,
          headers: {'X-CSRF-TOKEN': _token},
          dataType: 'json',
          success: function(result){
            $(this).html('<i class="fa fa-times"></i>');

             msjes2(result.mensaje);
             $('.modal-content #tableDirec').editableTableWidget({disableClass: "edit-disabled"});
        },
         error: function(result){
        //  var response = JSON.parse(result.responseText);

         /*  $.each(response, function (ind, elem) {
             $("#msj-fail").append('<p>'+elem+'</p>').fadeIn();
           });*/
         }
        });
      }
      $('.modal-content #tableDirec .btn-danger').html('<i class="fa fa-times"></i>');


     });


//======================> ANGTES DE QUE CAMABIARA EL CERATE CLIENTES


//funcion que hace editable la tabla, agregandole la clase que desabilita las tablas.
 //$('.table-bordered').editableTableWidget({disableClass: "edit-disabled"});


/*
//EVENTO DEL REGISTRO DE CLIENTES
$("#registroCli").click(function(e){
  e.preventDefault();
  $("#msj-fail").toggle();
  $("#msj-fail").empty();
   var formData = new FormData();
   formData.append('rut',       $( "input[name*='rut']" ).val());
   formData.append('cli_razon',  $( "input[name*='cli_razon']" ).val());
   formData.append('cli_clave',     $( "input[name*='cli_clave']" ).val());
   formData.append('cli_telefono',  $( "input[name*='cli_telefono']" ).val());
   formData.append('cli_correo',    $( "input[name*='cli_correo']" ).val());

   var route = "/clientes";
   var _token = $('#token').val();

   $.ajax({
   //   global: false,
     url: route,
     type: 'POST',
     data: formData,
     cache:false,
     contentType: false,
     processData: false,
     headers: {'X-CSRF-TOKEN': _token},
     dataType: 'json',
     success: function(result){
       msjes(result2.mensaje);
       $("input[type=text]").val("");
   },
    error: function(result){
       var response = JSON.parse(result.responseText);
      $.each(response, function (ind, elem) {
        $(".modal-body #msj-fail").append('<p>'+elem+'</p>').fadeIn();
      });
    }
   });
 });

*/
 //cuando se cambia de texto
   $(document).on('change','#tableClientes td', function(evt, newValue) {
     var row = $(this).parents('tr');
     var _token = $('#token').val();
     var id = row.data('id');
     var texto = $(this).html();
     var posi = $(this).index();
     var route =   "clientes/"+id;
     $.ajax({
       global: false,

   		url: route,
   		headers: {'X-CSRF-TOKEN': _token},
   		type: 'PUT',
     	dataType: 'json',
   		data: {id:id, texto:texto, posi:posi},
   		success: function(result){
           msjes2(result.mensaje);
   		}
   	});
 });


 //evento que elimina cli
 $(document).on("click",'#BorraCli', function(e) {
    e.preventDefault();
    $('#BorraCli').html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');

    var r = confirm("¿Seguro que desea eliminar el cliente?");
    if (r==true) {
      $('#myModal').modal('hide');

      //  var id = row.data('id');
      var id = $('#id').val();

      row_global.fadeOut();

       var _token = $('#token').val();
       var route =   "clientes/"+id;
       $.ajax({
       //   global: false,
         url: route,
         type: 'DELETE',
         data: id,
         headers: {'X-CSRF-TOKEN': _token},
         dataType: 'json',
         success: function(result){
            msjes(result.mensaje);
       },
        error: function(result){
        var response = JSON.parse(result.responseText);
        /*  $.each(response, function (ind, elem) {
            $("#msj-fail").append('<p>'+elem+'</p>').fadeIn();
          });*/
        }
       });
    }
    $('#BorraCli').html('Borrar Cliente');

   });

   //llamo la funcion que previzualiza la imagen que cargo.
     $("#cli_foto").change(function(){
          readURL3(this);
     });
     function readURL3(input,name) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               reader.onload = function (e) {
                   $("#cli_foto_prin").attr('src', e.target.result);
               }
               reader.readAsDataURL(input.files[0]);
           }
       }


       $(document).on("change",'.modal-content #cli_foto', function(e) {
            readURL2(this);
       });
       function readURL2(input,name) {
             if (input.files && input.files[0]) {
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $(".modal-content #cli_foto_prin").attr('src', e.target.result);
                 }
                 reader.readAsDataURL(input.files[0]);
             }
         }


});
