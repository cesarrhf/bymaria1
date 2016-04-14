
$(document).ready(function(){



  //llamo la funcion que previzualiza la imagen que cargo.
    $("#pro_foto").change(function(){
        readURL(this);
    });

    $("#pro_foto_trasera").change(function(){
        readURL2(this);
    });

    function readURL2(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $("#pro_foto_tras").attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
// registro del producto -> en create store.
    $("#registro").click(function(e){

      e.preventDefault();
      $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse  "></i>');

      var formData = new FormData();
      formData.append('Foto_Principal', $('#pro_foto')[0].files[0]);
      formData.append('Foto_Trasera', $('#pro_foto_trasera')[0].files[0]);
      formData.append('Nombre', $( "input[name*='pro_nombre']" ).val());
      formData.append('Descripcion', $( "textarea[name*='pro_descripcion']" ).val());

      var route = " ../productos";
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

          msjes(result.mensaje);
          $("input[type=text],input[type=file], textarea").val("");
          $(".img-responsive").attr("src","http://placehold.it/250x250");
          $("#subMenuPro li:eq(0)").before('<li><a href="../productos/'+result.producto_id+'/edit"></i>'+result.producto_nombre+'</a></li>');
        //  $("#subMenuPro").append('<li><a href="http://localhost:8000/productos/'+result.producto_id+'/edit"></i>'+result.producto_nombre+'</a></li>');
      },
       error: function(result){
         $("#msj-fail").empty();
 
        //  $("#msj-fail").toggle();
         var response = JSON.parse(result.responseText);
         var heights=0;
         $.each(response, function (ind, elem) {
           heights = heights +40;
           $("#msj-fail").append('<p>'+elem+'</p>').fadeIn();
         });
         $("#msj-fail").fadeToggle(6000);

          // $("#msj-fail").css("height",heights);
       }
      });
      $(this).html('Registrar');


    });
});
