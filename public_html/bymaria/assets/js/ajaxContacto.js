$(document).ready(function(){


  $(document).on('submit','#formContact' ,function(e) {
    e.preventDefault();
    var $form = $(this);
    var $inputs = $form.find("input,textarea");
    var serializedData = $form.serialize();

    var route = "contacto";
    var _token = $('#token').val();

    $.ajax({
      url: route,
      type: 'POST',
      data: serializedData,
      headers: {
        'X-CSRF-TOKEN': _token
      },
      dataType: 'json',
      success: function(result) {
      //  msjes(result.mensaje);
      console.log('funciona');
      alert(result.mensaje);
      },
      error: function(result) {
        console.log('NOfunciona');

        // var response = JSON.parse(result.responseText);
        // $.each(response, function (ind, elem) {
        //   $("#msj-fail").append('<p>'+elem+'</p>').fadeIn();
        //  });
      }
    });

  });
});
