var existPoly = false;
 function msjes(mensaje){
  $("#msj-success").html(mensaje).fadeIn();
  $("#msj-success").fadeToggle(2500);
}


$(document).ready(function(){

//listener de los poligonos.
  addListenersOnPolygon = function(polygon) {
  google.maps.event.addListener(polygon, 'click', function (event) {

    if (existPoly == false) {
      $('#myform').removeClass('hide');
      $('#nuevaZona').addClass('hide');
      $('#registro').addClass('hide');
      $('#actualizar').removeClass('hide');
      $('#borrar').removeClass('hide');

      // $('#nuevaZona').attr('disabled', true);
      polygon.setOptions({strokeColor: 'yellow', fillColor: 'yellow',  editable: true,draggable: true});
      $.each(jsonObj, function(i, item) {
         if (item.hash == polygon.indexID) {
           jsonObj[i].edito ='true';
              $('#zoneNombre').val(item.nombre);
             $('#zonePrecio').val(item.precio);

         }else{
           jsonObj[i].edito ='false';
           item.id.setOptions({strokeColor: 'grey', fillColor: 'grey',  editable: false,draggable: false});
         }
      });
      console.log(jsonObj);
    }

   });
}

  initMap();
  nueva_funcion();

//creo una nueva zona.
  $(document).on('click','#nuevaZona', function(e){
    $('#nuevaZona').addClass('hide');
    $('#actualizar').addClass('hide');
    $('#borrar').addClass('hide');

    $('#registro').removeClass('hide');
    $('#myform').removeClass('hide');
     $('input[name="Nombre"]').val('');
    $('input[name="Precio"]').val('');

 if (existPoly == false) {
     redCoords = [
    {lat: -33.43631,   lng: -70.61967},
    {lat: -33.46187,   lng: -70.68932},
    {lat: -33.46303,   lng: -70.68932},
    {lat: -33.49433,   lng: -70.60285},
    {lat: -33.451,     lng: -70.57143}
   ];

       rectangle = new google.maps.Polygon({
        paths: redCoords,
        strokeColor: '#31B404',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#31B404',
        fillOpacity: 0.15,
        editable: true,
        draggable: true

     });
      rectangle.setMap(map);
      existPoly = true;
 }else{

 }

  });

//guardo la zona en la bd
  $(document).on('click','#registro', function(e){
    var len = rectangle.getPath().getLength();
    jsonObj_temp = [];
    poligGMCoords_temp = [];

    for (var i = 0; i < len; i++) {
      jsonObj_temp.push(rectangle.getPath().getAt(i).toUrlValue(5));
      var res2 = rectangle.getPath().getAt(i).toUrlValue(5).split(',');
      var latlong = new google.maps.LatLng(parseFloat(res2[0]), parseFloat(res2[1]));
      poligGMCoords_temp.push(latlong);
     }
    var _token = $('input[name="_token"]').val();
    var nombre = $('input[name="Nombre"]').val();
    var precio = $('input[name="Precio"]').val();
    var route  = "storeZone";

    $.ajax({
      url: route,
      type: 'POST',
      headers: {'X-CSRF-TOKEN': _token   },
      dataType: 'json',
      data: {jsonObj_temp,nombre,precio },
      success: function(result) {
        existPoly = false;

        msjes(result.mensaje);
        $('#nuevaZona').removeClass('hide');
        $('#registro').addClass('hide');
        $('#myform').addClass('hide');
        $('input[name="Nombre"]').val('');
       $('input[name="Precio"]').val('');

       temp_regis = new google.maps.Polygon({
          paths: poligGMCoords_temp,
          strokeColor: 'grey',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: 'grey',
          fillOpacity: 0.15,
          indexID: result.id

         });
       rectangle.setMap(null);
       temp_regis.setMap(map);
        addListenersOnPolygon(temp_regis);

        temporal['id']     = temp_regis;
        temporal['precio'] = precio;
        temporal['hash']   = result.id;
        temporal['nombre'] = nombre;
         // aux = item.zona_precio;
        jsonObj.push(temporal);
      }
    });
  });
});
//cancelar accion
$(document).on('click','#cancelar', function(e){
console.log(existPoly);
  if (existPoly==true) {
    rectangle.setMap(null);
    existPoly = false;
    $('#myform').addClass('hide');
    $('#nuevaZona').removeClass('hide');
    $('#nuevaZona').attr('disabled', false);
  }else{
    $.each(jsonObj, function(i, item) {
    if (item.edito =='true') {
      jsonObj[i].edito ='false';
      item.id.setOptions({strokeColor: 'grey', fillColor: 'grey',  editable: false,draggable: false});
      $('#myform').addClass('hide');
      $('#nuevaZona').removeClass('hide');

      $('#nuevaZona').attr('disabled', false);
      return false;
    }
    });
  }

});


//borrar el poligono
$(document).on('click','#borrar', function(e){
   $.each(jsonObj, function(i, item) {
   if (item.edito =='true') {
     var id_hash = item.hash;
     var route   = "BorraZone";
     var _token  = $('input[name="_token"]').val();
    $.ajax({
      url: route,
      type: 'POST',
      headers: {'X-CSRF-TOKEN': _token   },
      dataType: 'json',
      data: { id_hash  },
      success: function(result) {
        msjes(result.mensaje);
        item.id.setMap(null);
        $('#nuevaZona').attr('disabled', false);
        $('#myform').addClass('hide');
      }
    });
   }
 });
});

//actualiza el poligono
$(document).on('click','#actualizar', function(e){


   $.each(jsonObj, function(i, item) {
   if (item.edito =='true') {
     var len     = item.id.getPath().getLength();
     var id_hash = item.hash;
     jsonObj3    = [];
     for (var i = 0; i < len; i++) {
       jsonObj3.push(item.id.getPath().getAt(i).toUrlValue(5));
       console.log(item.id.getPath().getAt(i).toUrlValue(5) );
     }
     var route  = "UpdateZone";
     var _token = $('input[name="_token"]').val();
     var nombre = $('input[name="Nombre"]').val();
     var precio = $('input[name="Precio"]').val();

    $.ajax({
      url: route,
      type: 'POST',
      headers: {'X-CSRF-TOKEN': _token   },
      dataType: 'json',
      data: { jsonObj3, id_hash,nombre, precio },
      success: function(result) {
        item.nombre = nombre;
        item.precio = precio;
        item.id.setOptions({strokeColor: 'grey', fillColor: 'grey',  editable: false,draggable: false});
        msjes(result.mensaje);
        $('#nuevaZona').attr('disabled', false);
        $('#myform').addClass('hide');
        $('#nuevaZona').removeClass('hide');

      }
    });
   }
 });
});


//recogo de la bd las coordenadas de los poligonos.
function nueva_funcion(){

  var route = "../listarZonaDespa";
  var somees='asd';
  $.ajax({
   url: route,
   type: 'POST',
   headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()   },
   dataType: 'json',
   data: {somees} ,
   success: function(result) {
    jsonObj = [];
    poligGMCoords = [];
    temp          = result[0].zona_id;
    var aux;
    band=false;
    $.each(result, function(i, item) {
        temporal = {};
        var res =item.zc_coordenadas.split(',');
       if (temp==item.zona_id) {
          var latlong = new google.maps.LatLng(parseFloat(res[0]), parseFloat(res[1]));
          poligGMCoords.push(latlong);
           if (band==false) {
             aux = item.zona_precio;
             aux2= item.zona_id;
             aux3= item.zona_nombre;
            // jsonObj.push(temporal);
            band=true;
          }
       }else{
         temp = new google.maps.Polygon({
           paths: poligGMCoords,
           strokeColor: 'grey',
           strokeOpacity: 0.8,
           strokeWeight: 2,
           fillColor: 'grey',
           fillOpacity: 0.15,
           indexID: aux2
         });
         temp.setMap(map);
         addListenersOnPolygon(temp);

         temporal['id']     = temp;
         temporal['precio'] = aux;
         temporal['hash']   = aux2;
         temporal['nombre'] = aux3;
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
      strokeColor: 'grey',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: 'grey',
      fillOpacity: 0.15,
      indexID: aux2
    });
    temp.setMap(map);
    addListenersOnPolygon(temp);

    temporal['id']     = temp;
    temporal['precio'] = aux;
    temporal['hash']   = aux2;
    temporal['nombre'] = aux3;

    jsonObj.push(temporal);

    }
  });

}

function initMap() {
   map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -33.440965, lng: -70.647034},
    zoom: 11
  });
}
