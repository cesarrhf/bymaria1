<!DOCTYPE html>
<html>
  <head>
    <title>User-editable Shapes</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <!-- <script>
// This example adds a user-editable rectangle to the map.

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -33.440965, lng: -70.647034},
    zoom: 11
  });

// [START region_rectangle]

// var redCoords = [
//  {lat:  -33.436313,  lng: -70.623786},
//  {lat: -33.461867, lng:   -70.693438},
//  {lat: -33.494325,  lng: -70.617617}
// ];
var redCoords = [
 {lat: -33.43631,  lng: -70.61967},
 {lat: -33.46187,   lng: -70.68932},
 {lat: -33.46303,   lng: -70.68932},
 {lat: -33.49433,   lng: -70.60285},
 {lat: -33.451,   lng: -70.57143},
];
var redCoords2 = [
 {lat: -33.47631,  lng: -70.51967},
 {lat: -33.40187,   lng: -70.58932},
 {lat: -33.48303,   lng: -70.58932},
 {lat: -33.49433,   lng: -70.50285},
 {lat: -33.451,   lng: -70.57143}
];
// -33.43631,-70.61967<br>-33.46187,-70.68932<br>-33.46303,-70.68932<br>-33.49433,-70.60285<br>-33.451,-70.57143<br>
// -33.43631,-70.62379<br>-33.46187,-70.69344<br>-33.49433,-70.61762<br>-33.46303,-70.60697<br>
  var rectangle = new google.maps.Polygon({
     paths: redCoords,
     strokeColor: '#31B404',
     strokeOpacity: 0.8,
     strokeWeight: 2,
     fillColor: '#31B404',
     fillOpacity: 0.15,
    editable: true,
    draggable: true
  });

  var rectangle2 = new google.maps.Polygon({
     paths: redCoords2,
     strokeColor: '#31B404',
     strokeOpacity: 0.8,
     strokeWeight: 2,
     fillColor: '#31B404',
     fillOpacity: 0.15,
    editable: true,
    draggable: true
  });

// [END region_rectangle]
   rectangle.setMap(map);
  rectangle2.setMap(map);
  // var len = rectangle.getPath().getLength();
  // var htmlStr2 = "";
  // for (var i = 0; i < len; i++) {
  //     htmlStr2 += rectangle.getPath().getAt(i).toUrlValue(5) + "<br>";
  // }

  // console.log(htmlStr2);
  // rectangle.addListener('click', showArrays);
  google.maps.event.addListener(rectangle.getPath(), 'insert_at', getPolygonCoords);
    google.maps.event.addListener(rectangle.getPath(), 'set_at',getPolygonCoords) ;
    function getPolygonCoords() {
       var len = rectangle.getPath().getLength();
       var htmlStr = "";
       for (var i = 0; i < len; i++) {
           htmlStr += rectangle.getPath().getAt(i).toUrlValue(5) + "<br>";
       }
      // console.log(htmlStr);
    }
}


    </script> -->
    <script  type="text/javascript" src="{{ URL::asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('assets/js/mapaTienda.js') }}"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js"></script>


   </body>
</html>
