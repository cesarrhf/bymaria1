$(document).ready(function(){

  var row_click;
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

//funcion que hace editable la tabla, agregandole la clase que desabilita las tablas.
$('.table-bordered').editableTableWidget({disableClass: "edit-disabled"});


//  al clicar la imagen en el modal
  $(document).on('click',".modal-content .img-responsive",function(e){
      e.preventDefault();
   var id_img = $(this).attr('id');
   var  namewe = $(this).attr('name');
  console.log(namewe);
  var band = false;
  if ($('.rowPres').length) {
    $('.rowPres').each(function(){
          if ($(this).attr("data-id") == id_img) {
            band= false;
            return false;
           }else{
            band= true;
         }
        });
        if (band===true) {
         $('.modal-content .table-condensed > tbody:first').append('<tr class="rowPres" data-id='+id_img+'><td>'+namewe+'</td><td><a href= "#!"><i class="fa fa-times"></i></a></td></tr>');
       }
  }else{
    $('.modal-content .table-condensed > tbody:first').append('<tr class="rowPres" data-id='+id_img+'><td>'+namewe+'</td><td><a href= "#!"><i class="fa fa-times"></i></a></td></tr>');

  }

 });

//  al clicar boton borrar en el modal
 $(document).on("click",'.modal-content .fa-times', function(e) {
    e.preventDefault();
     var row = $(this).parents('tr');

    $(this).parent().html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');
    var r = confirm("¿Seguro que desea eliminar la unidad de venta?");
    if (r==true) {
      var idUni = $('#id').val();
      var _token = $('#token').val();
      var idPres = row.data('id');
      $(row).remove();
      var route = "Puniventa/"+{id};

      //AJAX DE UPDATE
     $.ajax({
         global: false,
       url: route,
       type: 'DELETE',
       data: {idUni:idUni ,idPres:idPres },
       headers: {'X-CSRF-TOKEN': _token},
       dataType: 'json',
       success: function(result){
         $(".modal-content #msj-success").html(result.mensaje).fadeIn();
         $(".modal-content #msj-success").fadeToggle(2500);

     },  error: function(result){

          }
       });
    }else{

    }
    $('.modal-content .fa-pulse').parent().html('<i class="fa fa-times "></i>');
   // row.toggle();

 });


    $(document).on("click",'#registroPres', function(e) {
       e.preventDefault();
      var arraysPres=[];
      $('.modal-content .table-condensed tr').each(function () {
      //  var row = $(this).parents('tr');
         var id = $(this).data('id');
          arraysPres.push(id);
        });
        var id = $('#id').val();
        var _token = $('#token').val();
         var route = "Puniventa/"+{id};
         //AJAX DE UPDATE
        $.ajax({
        //   global: false,
          url: route,
          type: 'PUT',
          data: {id:id , arraysPres:arraysPres },
          headers: {'X-CSRF-TOKEN': _token},
          dataType: 'json',
          success: function(result){
            msjes(result.mensaje);
            console.log(result);
          $('#myModal').modal('hide');
          //   $(".table-condensed tr").detach();
           }
          });
});

 //cuando se cambia de texto
   $(document).on('change','table td', function(evt, newValue) {

     var posi = $(this).index();
     var row = $(this).parents('tr');
     var _token = $('#token').val();
     var id = row.data('id');
    var texto = $(this).html();
     if (posi!==4) {
       if (posi==3) {
         if ($('input[type="checkbox"]', this).prop('checked')==true) {
           texto=1;
         }if ($('input[type="checkbox"]', this).prop('checked')==false) {
           texto=0;
         }
       }

         var route =   "unidadesventas/"+id;
         $.ajax({
       		url: route,
       		headers: {'X-CSRF-TOKEN': _token},
       		type: 'PUT',
         	dataType: 'json',
       		data: {id:id, texto:texto, posi:posi},
       		success: function(result){
              msjes(result.mensaje);
       		}
       	});
  }
 });


 //funcion que previsualiza la imagen
 function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();
           reader.onload = function (e) {
                row_click.find('.img-responsive').attr('src', e.target.result);
            //  row.find($(".img-responsive")).attr('src', e.target.result);
           }
           reader.readAsDataURL(input.files[0]);
       }
   }

     // funcion que previzualiza la imagen que cargo.
      $(document).on('click','table td .img-responsive', function(evt, newValue) {
        console.log("clickfoto");
           row_click = $(this).parents('tr');
       });
/*
       $("#uni_foto").on("change", function() {
               $(this).submit();
           });
           */
 //cuando se apreta cambia una imagenesç

 $("#uni_foto").on('change', function(e) {
    readURL(this);
   var _token = $('#token').val();
   var id = row_click.data('id');
   var formData = new FormData();

    formData.append('uni_foto', $(this)[0].files[0]);
    console.log(formData);
   var route =   "unidadesventas/cargaimg/"+id;
   $.ajax({
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

     }
   });

});
//abre modal
$(document).on('click','.btn-info', function (e) {
        $('#myModal').removeData('bs.modal');
        $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');

        var row = $(this).parents('tr');
        var id = row.data('id');
         $('#myModal').modal({remote: 'unidadesventas/' +id });
         $('#myModal').modal('show');

         //funcion de caundo se carga el modal.
         $('#myModal').on('shown.bs.modal', function () {
        //  alert('hola')
        $('.btn-info').html('<i class="fa fa-pencil"></i>');
        })

});


 //evento que elimina cli
 $(document).on("click",'.btn-danger', function(e) {
    e.preventDefault();
    $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');
    var r = confirm("¿Seguro que desea eliminar la unidad de venta?");
    if (r==true) {
      var row = $(this).parents('tr');
      var id = row.data('id');
      var _token = $('#token').val();
      var route =   "unidadesventas/"+id;
      row.fadeOut();
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
    }else{

    }
    $(this).html('<i class="fa fa-times"></i>');


   });

});
