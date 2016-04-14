
$(document).ready(function(){

 mypass =  $('.Envio').attr("data-hash");

var existe =document.getElementById('mapa');
if (existe===null) {
}else{
  map = new google.maps.Map(document.getElementById('mapa'), {
    center: {lat: -33.440965, lng: -70.647034},
    zoom: 10
  });
  var route = "listarZona";
    var somees='asd';
  $.ajax({
   url: route,
   type: 'POST',
   headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()   },
   dataType: 'json',
   data: {somees} ,
   success: function(result) {
    //  console.log(result[0].zc_coordenadas);
    jsonObj = [];
    poligGMCoords = [];
    temp          = result[0].zona_id;
  var aux;
  band=false;
    $.each(result, function(i, item) {
      temporal = {};
      //  console.log(item.zc_coordenadas+'|'+item.zona_id );
       var res =item.zc_coordenadas.split(',');
       if (temp==item.zona_id) {
         var latlong = new google.maps.LatLng(parseFloat(res[0]), parseFloat(res[1]));
          poligGMCoords.push(latlong);
           if (band==false) {
             aux= item.zona_precio;
             aux2= item.zona_id;
            // jsonObj.push(temporal);
            band=true;
          }
       }else{
         temp = new google.maps.Polygon({
           paths: poligGMCoords,
           strokeColor: '#31B404',
           strokeOpacity: 0.8,
           strokeWeight: 2,
           fillColor: '#31B404',
           fillOpacity: 0.15
         });
         temp.setMap(map);
         temporal['id']     = temp;
         temporal['precio'] = aux;
         temporal['hash']   = aux2;
          // aux = item.zona_precio;
         jsonObj.push(temporal);
         band=false;

         temp          = item.zona_id;
         poligGMCoords = [];
         var latlong = new google.maps.LatLng(parseFloat(res[0]), parseFloat(res[1]));
         poligGMCoords.push(latlong);
       }
    });

     temp = new google.maps.Polygon({
      paths: poligGMCoords,
      strokeColor: '#31B404',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#31B404',
      fillOpacity: 0.15
    });
    temp.setMap(map);

    temporal['id']     = temp;
    temporal['precio'] = aux;
    temporal['hash']   = aux2;

    jsonObj.push(temporal);

    marker = new google.maps.Marker({
      map: map,
      draggable: true
    });
    // console.log(jsonObj);

    }
  });
}

$(document).on('change', '#ped_cli_num', function(e) {

	geocoder = new google.maps.Geocoder();
   google.maps.event.addListener(marker, 'dragend', function(){
    var markerLatLng = marker.getPosition();
       $("input[name='coordenadas']").val(markerLatLng.lat()+','+markerLatLng.lng() );
       $.each(jsonObj, function(i, item) {
            if(google.maps.geometry.poly.containsLocation(markerLatLng, item.id)){
             $("#resultado").html("Dirección disponible para despacho");
             $('.Envio').attr("data-envio", item.precio);
             $('.Envio').attr("data-hash", item.hash);
             valor = '$' + item.precio.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
             $('.Envio').html('<p>'+valor+'</p>');
             sumacarrito();
              return false;
           }else{
             $("#resultado").html("Dirección NO disponible para despacho");
             $('.Envio').attr("data-envio", 0);
             $('.Envio').attr("data-hash", mypass);
             $('.Envio').html('<p>$0</p>');
           }
       });
     });

    $('.mapaTienda').removeClass('hide');
    $('.confirmar').removeClass('hide');
    $('.msjeConfirma').removeClass('hide');
    geocodeAddress(geocoder, map);
  });

  $(document).on('click', '#btnConfirma', function(e) {
    e.preventDefault();
    marker.setAnimation(null);
    confirmo = '1';
    $('#btnConfirma').addClass('hide');
    $('.alert').addClass('hide');
    $('.no-activo').removeClass('hide');
  });

});

function geocodeAddress(geocoder, resultsMap) {
   var regionval =  $( ".selectpickeRegion" ).val();
   var comunaval =  $( "#txtComu" ).val();
   var region    =  $('.selectpickeRegion option[value='+regionval+']').text().replace(/ /g, "+");
//   var comuna =  $('#txtComu option[value='+comunaval+']').text();
	var calle	  	= $("input[name='ped_cli_calle']").val();
	var numero		= $("input[name='ped_cli_num']").val().replace(/ /g, "+");
	var address	  = calle + "+" + numero + "+" + comunaval + "+"+region + "Chile";
 //  console.log(address);
 	geocoder.geocode({'address': address}, function(results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
			var cordenadas = results[0].geometry.location;
			resultsMap.setCenter(cordenadas);
			resultsMap.setZoom(11);
	   	$("input[name='coordenadas']").val(cordenadas);
			marker.setPosition( cordenadas  );
			marker.setAnimation(google.maps.Animation.BOUNCE);

      $.each(jsonObj, function(i, item) {
          // console.log(item.precio);
          if(google.maps.geometry.poly.containsLocation(cordenadas, item.id)){
            $("#resultado").html("Dirección disponible para despacho");
            $('.Envio').attr("data-envio", item.precio);
            $('.Envio').attr("data-hash", item.hash);
            valor = '$' + item.precio.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
            $('.Envio').html('<p>'+valor+'</p>');
            sumacarrito();
             return false;
          }else{
            $("#resultado").html("Dirección NO disponible para despacho");
            $('.Envio').attr("data-envio", 0);
            $('.Envio').attr("data-hash", mypass);
            $('.Envio').html('<p>$0</p>');
          }
      });
		} else {
			$("#resultado").html('Geocode was not successful for the following reason: ' + status);
		}
	});
}
