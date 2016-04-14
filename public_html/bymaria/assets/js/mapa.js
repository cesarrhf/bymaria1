// PROPIEDAD DE CEC SOLUCIONES - CHILE cespinoza@cecsoluciones.cl
	var lon;
  var lat;
  var googlePos;
var map;
var ruta_icono = "imagenes/mapas/";

var bounds = new google.maps.LatLngBounds();


$(document).ready(function(){

 $("#ciudad_consumo").on('click','#stgo_pro',function(){
      $("#map-container").empty();
      stgo();
    });

  var latlng = new google.maps.LatLng(-33.395203, -70.678388);
  var mark = new google.maps.LatLng(-33.427386, -70.666884);

  var infowindow = new google.maps.InfoWindow({
    content:'Dirección :Chile'
  });

 // var mark = new google.maps.LatLng(lon,lat);
    var myOptions = {
      zoom: 12,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      panControl: true,
      zoomControl: true,
      mapTypeControl: true,
      scaleControl: true,
      streetViewControl: true,
      overviewMapControl: true,
      rotateControl: true,
      };
      map = new google.maps.Map(document.getElementById("map-container_pro"),
          myOptions);
    marker = new google.maps.Marker({
      map:map,
      animation: google.maps.Animation.DROP,
      title: '',
      position: mark
    });


//no se esta usando esto.
function geolocalizacion(){
  /* AQUI SE VE LA GEOLOCALIZACON*/
  if (navigator.geolocation)
        {
          navigator.geolocation.getCurrentPosition(function(objPosition)
          {
              //lon = objPosition.coords.longitude;
             //lat = objPosition.coords.latitude;
             googlePos = new google.maps.LatLng(objPosition.coords.latitude,objPosition.coords.longitude);

                marker2 = new google.maps.Marker({
                map:map,
                animation: google.maps.Animation.DROP,
                position: googlePos

              });
                /* FUNCION QUE CENTRA EL MAPA POR LOS MARCADORES*/
               var bounds = new google.maps.LatLngBounds();
               bounds.extend(marker.position);
               bounds.extend(marker2.position);
               map.fitBounds(bounds);
               console.log(bounds);

          }, function(objPositionError)
          {
            switch (objPositionError.code)
            {
              case objPositionError.PERMISSION_DENIED:
                alert("No se ha permitido el acceso a la posición del usuario.");
              break;
              case objPositionError.POSITION_UNAVAILABLE:
                alert("No se ha podido acceder a la información de su posición.");
              break;
              case objPositionError.TIMEOUT:
                alert("El servicio ha tardado demasiado tiempo en responder.");
              break;
              default:
                alert("Error desconocido.");
            }
          }, {
            maximumAge: 75000,
             TIMEOUT: 10000,
          });
        }
        else
        {
          alert("Su navegador no soporta la API de geolocalización.");
        }
        /* FIN GEO*/
}
});
