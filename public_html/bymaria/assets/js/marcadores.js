function stgo(data){

/*
    var test_coor1 = new google.maps.LatLng(-33.494351, -70.727948);
    var test_coor2 = new google.maps.LatLng(-33.469159, -70.678134);

*/
	var latitudes = new Array();
	var iconos	= new Array();

	var i = 1;
	var j=1;
	var myOptions2 = {
      zoom: 11,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    };
    var map2 = new google.maps.Map(document.getElementById("map-container"),
        myOptions2);
/*
   marker3= new google.maps.Marker({
					map:map2,
					animation: google.maps.Animation.DROP,
					position:  test_coor1
	 });
   marker4= new google.maps.Marker({
					map:map2,
					animation: google.maps.Animation.DROP,
					position:  test_coor2
	 });

   		   var bounds2 = new google.maps.LatLngBounds();
 	 	bounds2.extend(marker3.position);
         bounds2.extend(marker4.position);
         console.log(bounds2);
         map2.fitBounds(bounds2);

*/
var longitud;
var latitud;
	$.each(data , function( index, obj ) {
	    $.each(obj, function( key, value ) {
	       // console.log(i);

	         if (key=="longitud") {
	        	//console.log(value);

	        	 longitud = value;
	        	//latitudes[i] = new google.maps.LatLng(res[0],res[1]);

	        }
	        else{
	       		 latitud = value;
	        	//iconos[j] = "imagenes/mapas/"+value+"a.png";


	        };
	     });
	    console.log(longitud,latitud);
	    latitudes[i] = new google.maps.LatLng(latitud,longitud);
	});

 console.log(latitudes.length);
	for (var i = latitudes.length - 1; i >= 0; i--) {
		new google.maps.Marker({
					map:map2,
					animation: google.maps.Animation.DROP,
					//icon: iconos[i],
					position: latitudes[i]
				 });
	};


}
