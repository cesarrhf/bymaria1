function msjes(mensaje){
   $("#msj-success").html(mensaje).fadeIn();
  $("#msj-success").fadeToggle(8000);

}

function msjes_error(mensaje){
  $("#msj-success").html(mensaje).fadeIn();
  $("#msj-success").fadeToggle(2500);
}

//funcion que previsualiza la imagen
function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $("#pro_foto_prin").attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
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
