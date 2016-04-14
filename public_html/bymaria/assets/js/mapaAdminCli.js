
$(document).ready(function(){
  var id =0;
  $(document).on('change','#tableDirec tr', function(evt, newValue) {
    console.log('asdasd');
    var selectedText = $(this).find("option:selected").text();
     var calle  =  $('.mapa_calle', this ).text();
    var numero  =   $('.mapa_num', this ).text();
    if (numero !='' && calle !='' && selectedText!='') {
      $("#resultado").html();
        id = $(this).data('id');
        $('.myMapa').removeClass('hide');
       inicia(selectedText,calle,numero);
    }
   });
//guardo en la bd las coordenadas de la direccion escrita
  $(document).on('click', '#btnConfirma', function(e) {
    e.preventDefault();
    marker.setAnimation(null);
    confirmo = '1';
    var _token = $('#token').val();

    var coorden = $("input[name='coordenadas']").val();
    //formateo las coordenadas
       coorden = coorden.replace(')', '');
        coorden = coorden.replace('(', '');
       coorden = coorden.split(',');
     var route =   "cliente/Coor";
    $.ajax({
      global: false,
     url: route,
     headers: {'X-CSRF-TOKEN': _token},
     type: 'post',
     dataType: 'json',
     data: {id:id, latitud:coorden[0], longitud:coorden[1]},
     success: function(result){
        // msjes2(result.mensaje);
     }
   });
    $('.myMapa').addClass('hide');
    $('#btnConfirma').addClass('hide');
    $('.alert').addClass('hide');
    $('.no-activo').removeClass('hide');
  });

});
function inicia(comuna,calle,numero) {
  map = new google.maps.Map(document.getElementById('mapa'), {
    zoom: 15,
  });
   geocoder = new google.maps.Geocoder();
   marker = new google.maps.Marker({
   map: map,
   draggable: true
   });

google.maps.event.addListener(marker, 'dragend', function(){
  var markerLatLng = marker.getPosition();
     $("input[name='coordenadas']").val(markerLatLng.lat()+','+markerLatLng.lng() );
  });
  $('#btnConfirma').removeClass('hide');
  $('.btnConfi').addClass('hide');

  $('.mapaDire').removeClass('hide');
  $('.confirmar').removeClass('hide');
  $('.msjeConfirma').removeClass('hide');
  geocodeAddress(geocoder, map,comuna,calle,numero);
}

function geocodeAddress(geocoder, resultsMap,comuna,calle,numero) {

	var address	  = calle + "+" + numero + "+" + comuna + "+"+ "Chile";
  	geocoder.geocode({'address': address}, function(results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
      $("#resultado").html();
			var cordenadas = results[0].geometry.location;
			resultsMap.setCenter(cordenadas);
			resultsMap.setZoom(16);
	   	$("input[name='coordenadas']").val(cordenadas);
			marker.setPosition( cordenadas  );
			marker.setAnimation(google.maps.Animation.BOUNCE);

		} else {
			$("#resultado").html('Geocodificacion fallo por el siguiente motivo: ' + status);
		}
	});
}
