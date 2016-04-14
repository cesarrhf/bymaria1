$(document).ready(function(){
var id_tabla;
var row_selec;
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


//funcion que hace editable la tabla, agregandole la clase que desabilita las tablas.
$('.table-striped').editableTableWidget({disableClass: "edit-disabled"});

//funcion que elimina
$(document).on("click",'.btn-danger', function(e) {
   e.preventDefault();
   $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');

   var r = confirm("¿Seguro que desea eliminar la presentación?");
    if (r == true) {
      var row = $(this).parents('tr');
      var id = row.data('id');
      console.log(id);
    //var id = btn.value
      var form = $('#form-delete');
      var url = form.attr('action').replace(':USER_ID',id);
      var data= form.serialize();
      row.fadeOut();
      $.post(url,data,function (result){
      //   alert(result.message);
      msjes(result.mensaje);
      }).fail(function(){
         alert('La Presentacion no fue eliminada');
         row.show();
      });
    }  
    $(this).html('<i class="fa fa-times"></i>');
  });

  $("#pro_foto").on("change", function() {
          $("#form-upImgPro").submit();
      });

  $("#pro_foto_trasera").on("change", function() {
          $("#form-upImgPro").submit();
      });

//cuidado con esto, ya que en el edit solo hay 2 form-control y son los 2 campos que se modificam de producto.
      $(".form-control").on("change", function() {
              $("#form-upImgPro").submit();
          });


//REALIZAR ACCION AL submit LA IMAGEN producto
  $("#form-upImgPro").on('submit',function(e){
    //NO OLVIDAR EL E.PREVEN, SI NO NOS MANDARA A OTRA PAGINA!
    e.preventDefault();
    var _token = $('#token').val();
    var form = $('#form-upImgPro');
    var formData = new FormData(this);
    var url = $(this).attr('action');
    //  $('#cargando').show();
    $.ajax({
    //   global: false,
      url: url,
      type: 'POST',
      data: formData,
      cache:false,
      contentType: false,
      processData: false,
      headers: {'X-CSRF-TOKEN': _token},
   	  dataType: 'json',
      success: function(result){
        //recorro el objeto devuelta.
        $.each(result, function (ind, elem) {
          console.log(ind);
          if (ind=='pro_foto' && elem!=0) {
            $("#pro_foto_prin").attr("src","../../imagenes/productos/"+elem);
          }
          if (ind=='pro_foto_trasera' && elem!=0) {
            $("#pro_foto_tras").attr("src","../../imagenes/productos/"+elem);
          }
          if (ind=='nombre') {
              $(".page-header").html("Producto "+elem);
        }
       });
       msjes(result.mensaje);
      }

    });

  });





// listener del cambio de imagen present que pasa el id al modal
//se ocupa document ya que al agregamos un nuevo DOM por ajax
  $(document).on("click",'.image-mini', function() {
    $("#pres_foto_prinEdit").attr('src', 'http://placehold.it/250x250');
      row_selec = $(this).parents('tr');
      id_tabla = row_selec.data('id');
});
//funcion que previsualiza la imagen
function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $("#pres_foto_prinEdit").attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }

//llamo la funcion que previzualiza la imagen que cargo.
  $("#pres_foto").change(function(){
      readURL(this);
  });


//cuando se cambia de imagen de presentacion
  $('#form-upImgPres').on('submit', function(e) {
    $('#myModal').modal('hide');
    e.preventDefault();
    var form = $('#form-upImgPres');
    var url = form.attr('action').replace(':PRES_ID',id_tabla);
  //  var url = $(this).attr('action');
    var _token = $('#token').val();
    var formData = new FormData(this);
    $.ajax({
      url: url,
      type: 'POST',
      data: formData,
      cache:false,
      contentType: false,
      processData: false,
      headers: {'X-CSRF-TOKEN': _token},
      dataType: 'json',
  		success: function(result){
        $.each(result, function (ind, elem) {
          if (ind=='nombre' ) {
             row_selec.find($(".foto_min_lista")).attr("src","../../imagenes/presentaciones/"+elem);
          }
       });
       msjes(result.mensaje);
  		}
  	});
});

//cuando se apreta el boton mas
$('#btnAgrePres').on('click', function(e){
  $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');

  var pres_i;
  var pres_id_pro=  $("#pro_secret").val();
  var route = "../../presentaciones";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'POST',
    dataType: 'json',
    global: false,
    data: {pres_id_pro:pres_id_pro},
    success: function(result){
      $('#btnAgrePres').html('  <i class="fa fa-plus fa-fw"></i>');


      console.log(result['id']);
      $('.table-striped > tbody:last').append('<tr data-id='+result['id']+'><td class="edit-enabled"></td><td class="edit-disabled image-mini"><img data-toggle="modal" data-target="#myModal" id="pres_foto_prin" class="foto_min_lista" src="http://placehold.it/50x50"/></td><td class="edit-disabled"><a href= "#!" class="btn btn-danger"><i class="fa fa-times"></i></a></td></tr>');
      $('.table-striped').editableTableWidget({disableClass: "edit-disabled"});
       msjes(result.mensaje);
    }
  });





});

//cuando se cambia de texto en presentacion
  $(document).on('change','table td', function(evt, newValue) {
    var row = $(this).parents('tr');
    var _token = $('#token').val();
    var id = row.data('id');
    var texto = $(this).html();
    var posi = $(this).index();
    var form = $('#form-update');
    var url = form.attr('action').replace(':USER_ID',id);
    $.ajax({
  		url: url,
  		headers: {'X-CSRF-TOKEN': _token},
  		type: 'PUT',
    	dataType: 'json',
  		data: {id:id, texto:texto, posi:posi},
  		success: function(result){
         msjes(result.mensaje);
  		}
  	});
});


//boton editar que no estoy ocupando.
  $('.btn-info').click(function(e){
      //  e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
    });







});
