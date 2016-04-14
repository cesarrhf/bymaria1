$(document).ready(function() {

  $('.panel-heading').click(function() {
      $('.panel-heading').removeClass('actives');
      $(this).addClass('actives');
    //  $('.panel-title').removeClass('actives');
    //  $(this).parent().addClass('actives');

    });



  $('.selectpickerRegionComprar').selectpicker({

     dropupAuto: false,
     width : '100%'

  });
  $('.selectpickerRegionComprar2').selectpicker({

     dropupAuto: false,
     width : '100%'

  });

  $('.selectpickerComunaComprar').selectpicker({
      title: '',
       dropupAuto: false,
       width : '100%'

    });
    $('.selectpickerComunaComprar2').selectpicker({
       title: '',
        dropupAuto: false,
        width : '100%'

     });

  // document.getElementById('txtProvi').addEventListener('input'  ,function () {
  //    console.log('changed');
  // });
    //cuando se cambia cliquea PARA provincia

  $(document).on('change', '.selectpickerRegionComprar', function(e) {
    $('#txtComu').empty();
    e.preventDefault();
    var _token = $('#token').val();
    var id =  $( ".selectpickerRegionComprar" ).val();
    var route = "indexcomunas ";
    $.ajax({
      url: route,
      type: 'post',
      headers: {
        'X-CSRF-TOKEN': _token
      },
      dataType: 'json',
      data: {
        id: id
      },
      success: function(result) {
        $.each(result, function(i, item) {
            $('#txtComu')
                 .append($("<option></option>")
                 .attr("value",item.comuna_id)
                 .text(item.comuna_nombre));
        });
        $('#txtComu').selectpicker('refresh');
      }
    });
  });

  $(document).on('change', '.selectpickerRegionComprar2', function(e) {
    $('#txtComu2').empty();
    e.preventDefault();
    var _token = $('#token').val();
    var id =  $( ".selectpickerRegionComprar2" ).val();
    var route = "indexcomunas";
    console.log(id);
    $.ajax({
      url: route,
      type: 'POST',
      headers: {'X-CSRF-TOKEN': _token   },
      dataType: 'json',
      data: { id: id  },
      success: function(result) {
        $.each(result, function(i, item) {
            $('#txtComu2')
                 .append($("<option></option>")
                 .attr("value",item.comuna_id)
                 .text(item.comuna_nombre));
        });
        $('#txtComu2').selectpicker('refresh');
      }
    });
  });


  $(document).on('submit','#formDonde' ,function(e) {
    $('.rellenoCompra').empty();
    e.preventDefault();
    $('.miMensjeDonde2 .mensajes').addClass('hide');

    var $form = $(this);
    var $inputs = $form.find("input");
    var id = $("#txtComu").val();
    //console.log(id);
    $form.append('<input id="comu_id" name="comu_id" class="hide" type="text" value='+id+'>');
    $form.append('<input id="tipoBusqueda" name="tipoBusqueda" class="hide" type="text" value="1">');
    var tipo = $("#tipoBusqueda").val();

    var serializedData = $form.serialize();
    var route = "comunas/getMarcadores";
    var _token = $('#token').val();
     $.ajax({
      url: route,
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': _token
      },
      data: serializedData,
      dataType: 'json',
      success: function(result) {
        console.log(result);
        $('#comu_id').remove();
        $('#tipoBusqueda').remove();
      //  $('.rellenoCompra').append('<p>haz click en los marcadores para ver más detalles.</p>');
      if (jQuery.isEmptyObject(result)) {
          //  $('.miMensjeDonde2').append('<p class="mensajes">Pronto estaremos en este lugar</p>');
          // $('.miMensjeDonde2 .mensajes').fadeOut(8000);
          $('.miMensjeDonde2 .mensajes').removeClass('hide');

      }else{
        PINTA_MARCADORES(result,tipo);
       }
      },
      error: function(result) {
        $('#comu_id').remove();
        $('#tipoBusqueda').remove();

        console.log('NOfunciona');
      }
    });
  });


$(document).on('submit','#formComer' ,function(e) {
  $('.rellenoCompra2').empty();
  e.preventDefault();
  $('.miMensjeDonde .mensajes').addClass('hide');

  var $form = $(this);
  var $inputs = $form.find("input");
  var id = $("#txtComu2").val();

  //console.log(id);
  $form.append('<input id="comu_id" name="comu_id" class="hide" type="text" value='+id+'>');
  $form.append('<input id="tipoBusqueda" name="tipoBusqueda" class="hide" type="text" value="0">');
  var tipo = $("#tipoBusqueda").val();

  var serializedData = $form.serialize();
  var route = "comunas/getMarcadores";
  var _token = $('#token').val();

  $.ajax({
    url: route,
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN': _token
    },
    data: serializedData,
    dataType: 'json',
    success: function(result) {
      $('#comu_id').remove();
      $('#tipoBusqueda').remove();
    //  $('.rellenoCompra2').append('<p>haz click en los marcadores para ver más detalles.</p>');
    if (jQuery.isEmptyObject(result)) {
        // $('.miMensjeDonde').append('<p class="mensajes">Pronto estaremos en este lugar</p>');
        $('.miMensjeDonde .mensajes').removeClass('hide');
     }else {
      PINTA_MARCADORES(result,tipo);
    }
    },
    error: function(result) {
      $('#comu_id').remove();
      $('#tipoBusqueda').remove();

      console.log('NOfunciona');
    }
  });
});


  function PINTA_MARCADORES(data,tipo){
    console.log(tipo);
    var bounds2 = new google.maps.LatLngBounds();
  	var latitudes = new Array();
  	var iconos	= new Array();
  	var i = 1;
  	var j=1;
  	var myOptions2 = {
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
      };
      var map2 = new google.maps.Map(document.getElementById("map-container_pro"),
          myOptions2);
  var longitud;
  var latitud;
  var razon;
  var numeracion;
  var calle;
  var infowindow = new google.maps.InfoWindow({
    content: ''
  });
  	$.each(data , function( index, obj ) {
  	    $.each(obj, function( key, value ) {
  	       // console.log(i);
  	         if (key=="dire_latitud") {
  	        	 longitud = value;
  	        }
  	        if (key=="dire_longitud"){
              latitud = value;
  	        };
            if (key=="cli_razon"){
               razon = value;
            };
            if (key=="dire_calle"){
               calle = value;
            };
            if (key=="dire_num"){
               numeracion = value;
            };
  	     });
         razon = razon+','+calle+','+numeracion;
         var test_coor2 = new google.maps.LatLng(parseFloat(longitud),parseFloat(latitud));
          marker =  new google.maps.Marker({
              map:map2,
              animation: google.maps.Animation.DROP,
              //icon: iconos[i],
              position: test_coor2
             });
             bounds2.extend(marker.position);
             (function(marker, razon) {
                google.maps.event.addListener(marker, 'click', function() {
                  var osow = razon.split(",");
                  infowindow.setContent('<h6>'+osow[0]+'</h6><p>'+osow[1]+' '+osow[2]+'</p>');
                  infowindow.open(map2, marker);
                });
              })(marker, razon);
  	});
    map2.fitBounds(bounds2);
  }

});
