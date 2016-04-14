$(document).ready(function(){

//funcion que logra hacer aparecer la barrita de carga
  $(document).ajaxStart(function() {
  //   alert("asd");
    $("#cargando").show();

  }).ajaxStop(function() {
    $("#cargando").hide();
  });

function msjes(mensaje){
  // $('#msj-fail').addClass('hide');
  $("#msj-success").html(mensaje).fadeIn();
  $("#msj-success").fadeToggle(5000);
}
function msjesFail(mensaje) {
  $("#msj-fail").html(mensaje).fadeIn();
  $("#msj-fail").fadeToggle(5000);
}

/*==================== PAGINACION CON AJAX =========================*/
/*
$(window).on('hashchange',function(){
  page = window.location.hash.replace('#','');
  getProducts(page);
});

$(document).on('click','.pagination a', function(e){
  e.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  // getProducts(page);
  location.hash = page;
});

function getProducts(page){
  $.ajax({
    url: '/unidadesventas/create?page=' + page
  }).done(function(data){
    $('.table-responsive').html(data);
  });
}
*/
/*==================== FIN =========================*/


$("#registro").click(function(e){
  e.preventDefault();
  $("#msj-fail").hide();

  $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');
  if ($('.rowPres').length) {
    var formData = new FormData();
    formData.append('Foto', $('input[type=file]')[0].files[0]);
    formData.append('Nombre', $( "input[name*='uni_nombre']" ).val());
    formData.append('Precio', $( "input[name*='uni_precio']" ).val());
    formData.append('Descripcion', $( "textarea[name*='uni_descripcion']" ).val());
    formData.append('uni_publica', $( "input[name*='uni_publica']" ).prop('checked') );
    formData.append('uni_custom', $( "input[name*='uni_custom']" ).prop('checked') );
    formData.append('uni_cantidad_present', $( "input[name*='uni_cantidad_present']" ).val());

    var route = "../unidadesventas";
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
        msjes(result.mensaje);
        $("input[type=text],input[type=file], textarea").val("");
        $("#uni_foto_prin").attr('src', "http://placehold.it/250x250");

        var id_preso= result.uni_id;
        //SEGUNDO PASO, INSERTAR EN PRESUNIVENTA
        $('.table-condensed tr').each(function () {
        //  var row = $(this).parents('tr');
          var id = $(this).data('id');
          if (typeof id !== 'undefined') {
             console.log(id_preso);
           var route = "../Puniventa";
           $.ajax({
               global: false,
             url: route,
             type: 'POST',
             data: {univ_pres_id:id , univ_un_id:id_preso },
             headers: {'X-CSRF-TOKEN': _token},
             dataType: 'json',
             success: function(result){
               $("#msj-fail").empty();

               msjes(result.mensaje);
                 $(".table-condensed tr").detach();
              }
             });
          }
        });
      },
     error: function(result){
       $("#msj-fail").empty();
       var response = JSON.parse(result.responseText);
       $.each(response, function (ind, elem) {
         $("#msj-fail").append('<p>'+elem+'</p>');
       });
       $("#msj-fail").show();
         // $("#msj-fail").fadeOut(5000);
     }
    });
  }else{
    $("#msj-fail").html('Debe Seleccionar al menos una presentacion');
    $("#msj-fail").show();
  }
  $(this).html('Registrar');


  });

//checkbox si es pack
// $('#uni_custom').change(function() {
//   if($(this).is(":checked")) {
//      $('#miPack').removeClass('hide');
//   }else{
//     $('#miPack').addClass('hide');
//     $('#uni_cantidad_present').val('');
//     }
// });

     //  al clicar la imagen en el modal
       $(document).on('click',".thumbnail",function(e){
           e.preventDefault();
        var id_img = $(this).attr('id');
        var  namewe = $(this).attr('name');
        var band = false;
       if ($('.rowPres').length) {
         $('.rowPres').each(function(){
           console.log($(this));
               if ($(this).attr("data-id") == id_img) {
                 band= false;
                 return false;
                }else{
                 band= true;
              }
             });
             if (band===true) {
               $('.table-condensed > tbody:first').append('<tr class="rowPres" data-id='+id_img+'><td>'+namewe+'</td><td><a href= "#!" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td></tr>');
            }
       }else{
         $('.table-condensed > tbody:first').append('<tr class="rowPres" data-id='+id_img+'><td>'+namewe+'</td><td><a href= "#!" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td></tr>');
       }
      });

       //clicar el boton de eliminar
      $(document).on("click",'.btn-danger', function(e) {
         e.preventDefault();
         var row = $(this).parents('tr');
         var id = row.data('id');
         $(this).parents('tr').remove();
     });

    //llamo la funcion que previzualiza la imagen que cargo.
      $("#uni_foto").change(function(){
          readURL2(this);
      });
      function readURL2(input,name) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#uni_foto_prin").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


});
