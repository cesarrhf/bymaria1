// PROPIEDAD DE CEC SOLUCIONES - CHILE cespinoza@cecsoluciones.cl
	var lon;
  var lat;
  var googlePos;
var map;
var ruta_icono = "imagenes/mapas/";
var bounds = new google.maps.LatLngBounds();
$(document).ready(function(){
          var latlng = new google.maps.LatLng(-33.483157, -70.533709);
      //    var mark = new google.maps.LatLng(-33.427386, -70.666884);

          var infowindow = new google.maps.InfoWindow({
            content:'Dirección :Chile'
          });

         // var mark = new google.maps.LatLng(lon,lat);
            var myOptions = {
              zoom: 15,
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
              map = new google.maps.Map(document.getElementById("map-container"),
                  myOptions);
            marker = new google.maps.Marker({
              map:map,
              animation: google.maps.Animation.DROP,
              title: '',
              position: latlng
            });

						google.maps.event.addListener(marker, 'click', function() {

			         infowindow.open(map,marker);
		          });


});
