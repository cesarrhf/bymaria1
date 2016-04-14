confirmo= '0';
idglob = '';
$(document).ready(function(){

// $('#miTablaTable').width();
// $('.miIconoBorra').width();

  window.addEventListener('resize',doSomething,false);
        function doSomething() {
            var tamano_selec = ($('#miTablaTable').width()-$('.miIconoBorra').width()-45);
            $('.selectpicker').selectpicker({
                dropupAuto: false ,
               width: tamano_selec
            })
            $('.selectpicker').selectpicker('refresh');
        }
  cambioBotones();

  var totalResumen = 0;
  var cantidadTotal = 0;
 //suma();
 sumacarrito();
 pinta();
 var $dataRows2323 = $(".table-condensed tbody tr");
 if ($($dataRows2323).length!==0 ) {
   $('#miTablaTable').removeClass('hide');
   $('#miParrafo').addClass('hide');
   $('.btn-primaryVenta2').removeClass('hide');
 }

if ($('.selectpicker').length!==0) {
  $('.selectpicker').selectpicker({
     dropupAuto: false ,
     width:'100%'
  });
}
if ($('.selectpickeRegion').length!==0) {
  $('.selectpickeRegion').selectpicker({
   title: 'Seleccione región',
    dropupAuto: false ,
    width:'100%'
 });
}

if ($('.selectpickeComu').length!==0) {
  $('.selectpickeComu').selectpicker({
   title: 'Seleccione comuna',
    dropupAuto: false ,
    width:'100%'
 });
}


 var date = new Date();


//click en hacer pedido
$(document).on('click', '.btn-primaryVenta2', function(e) {
  e.preventDefault();
  var banddd=0;
  $(".selectpicker").each(function(){
    console.log($(this).val());
    if ($(this).val()=='') {
      banddd=1;
      return false;
    }
  });
  if (banddd!=1) {
     window.location.href = "http://www.bymaria.cl/bymaria/resumen";
  }else{
    $('#miTabla').append(' <div class="alert alert-danger"> <strong>!NO ESCOGIÓ TODOS LOS PRODUCTOS!</strong></div>');
      $('.alert-danger').fadeOut(6000);

  }

});
//cuando se cambia el producto seleccionado
 $(document).on('change', '.selectpicker', function(e) {
    e.preventDefault();
   var _token = $('#token').val();
   var val =  $(this).val();
   val = val.split(",");
   var idUnivta = $($(this).parent()).find('select').attr("data-idunivta");
   var route = "tienda/nuevaPres";
   $.ajax({
     url: route,
     type: 'POST',
     headers: {'X-CSRF-TOKEN': _token   },
     dataType: 'json',
     data: { idPresentacion: val[0], idUnidadVta:idUnivta  },
     success: function(result) {
     }
   });
 });

    var $divss = $(".listaProductos2 .precioss .text-center");
    $divss.each(function() {
      var idTr2 =  ($(this).html());
    //  console.log(idTr2);
      var num = '$' + idTr2.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
      $(this).html('Precio: '+num);
    });
       $(document).ajaxStart(function(){
         $('.espera').removeClass('hide');
       });
       $(document).ajaxStop(function(){
         $('.espera').parent().html('agregar');
       });
//agregar productos al carrito
  $(document).on('click','.btn-primaryVenta',function(e){
      e.preventDefault();
      if ($(this).attr('id')=='regaloCorp') {
        $('#contactoCorp').on('show.bs.modal', function () {
              var $inputs = $('.modal-body').find("input[type='text'],input[type='num'], select, button, textarea");
             $inputs.val("");
          })
         $('#contactoCorp').modal('show');

      }else{
        $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse fa-lg espera "></i>');
        var id           = parseInt($(this).attr("value"));
        var nombrePro    = $($(this).parent()).find('img').attr("name");
        var precio       = $($(this).parent()).find('img').attr("data-id");
        var nombreFoto   = $($(this).parent()).find('img').attr("src");
        var custom       = $($(this).parent()).find('.precioss').attr("data-custom");
        var cantidad     = $($(this).parent()).find('.precioss').attr("data-cant");
        var precioIni    = precio;
        precio = '$' + precio.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        var $dataRows = $(".table-condensed tbody tr");

        if ($($dataRows).length===0 && custom==0) {
          $('#miTablaTable').removeClass('hide');
          $('#miParrafo').addClass('hide');
          $('.btn-primaryVenta2').removeClass('hide');

          ajaxInsert(id,precioIni,nombrePro);
          $('.table-condensed > tbody:first').append('<tr class="miUnidadItem" data-id='+id+'><td>'+nombrePro+'</td><td class="cantCol text-right">'+
          '<input class="inputCantidad" value="1" type="number" name="quantity" min="1" max="20"></td><td data-id='+precioIni+'  class="precioUni text-right" >'+precio+'</td>'+
          '<td data-valor='+precioIni+' class="valor text-right">'+precio+'</td>'+
          '<td><a href= "#!" class="btn-xs btn-link btnDelete"><i class="fa fa-times"></i></a></td></tr>');
        }else if(custom==1){
          if ($($dataRows).length!==0 ) {
            $('#miTablaTable').removeClass('hide');
            $('#miParrafo').addClass('hide');
            $('.btn-primaryVenta2').removeClass('hide');
          }
          ajaxNuevoUni(id,precioIni,nombrePro,precio,id,cantidad,nombreFoto);
        //  ajaxInsert(id_nuevoUNi,precioIni,nombrePro);
          //$('.table-condensed > tbody:first').append('<tr data-id='+id_nuevoUNi+'><td>'+nombrePro+'</td><td class="cantCol"><input value="1" type="number" name="quantity" min="1" max="20"></td><td data-id='+precioIni+'  class="precioUni" >'+precio+'</td><td   class="valor">'+precio+'</td><td><a href= "#!" class="btn btn-xs btn-link btnDelete"><i class="fa fa-times"></i></a></td></tr>');
        }
        else{
          var band = false;
          var i    = 0;
          $dataRows.each(function() {
               var idTr = parseInt($(this).attr('data-id'));
              //console.log(idTr,id );
              if (idTr==id) {
                band  =false;
                return false;
              }else{
                band= true;
              }
           });
           if (band===true) {
             ajaxInsert(id,precioIni,nombrePro);
             $('.table-condensed > tbody:first').append('<tr class="miUnidadItem" data-id='+id+'><td>'+nombrePro+'</td>'+
             '<td class="cantCol text-right"><input class="inputCantidad" value="1" type="number" name="quantity" min="1" max="20"></td>'+
             '<td data-id='+precioIni+'  class="precioUni  text-right" >'+precio+'</td>'+
             '<td   data-valor='+precioIni+' class="valor text-right">'+precio+'</td><td>'+
             '<a href= "#!" class="btn-xs btn-link btnDelete"><i class="fa fa-times"></i></a></td></tr>');
           }
        }
         suma();
        $("#miTablaTable").removeClass("hide");
        $('#miParrafo').addClass('hide');
        $('.btn-primaryVenta2').removeClass('hide');

      cambioBotones();

      }


 });
//cambiar la cantidad del producto
 $(document).on('change', '.inputCantidad', function(e) {
    var row           = $($(this).parents('tr'));
   var id            = row.data('id');
   var precioInicial = parseInt(($($(this).parents('tr')).find('.precioUni').attr("data-id")));
   var cantidad      = parseInt(($($(this).parents('tr')).find('input').val()));
   ajaxUpdate(cantidad,id);

   var valor = cantidad *precioInicial;
   valor = valor.toString();
   $(row).find('.valor').attr("data-valor", valor);
   valor = '$' + valor.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
   $(row).find('.valor').html(valor);
   suma();
 });

//al clicar en el boton +
 $(document).on('click', '.btn-primaryAdd', function(e) {
   console.log('asda');
   e.preventDefault();
   var id1 = $(this).attr("data-id");
   $('.inputCantidad').each(function(){
       var id2 = $(this).parents('tr').attr("data-id");
       if (id1===id2) {
        var canti  =$(this).val();
        canti = parseInt(canti)+1;
        $(this).val(canti);
        var row           = $($(this).parents('tr'));
        var id            = row.data('id');
        var precioInicial = parseInt(($($(this).parents('tr')).find('.precioUni').attr("data-id")));
        var cantidad      = parseInt(($($(this).parents('tr')).find('input').val()));
        ajaxUpdate(cantidad,id);

        var valor = cantidad *precioInicial;
        valor = valor.toString();
        $(row).find('.valor').attr("data-valor", valor);
        valor = '$' + valor.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        $(row).find('.valor').html(valor);
        suma();
       }
       });

});


 //clicar el boton de eliminar
 $(document).on("click", '.btnDelete', function(e) {
   e.preventDefault();
   var _token = $('#token').val();
   var row = $(this).parents('tr');
   var id = row.data('id');
   var route = "tienda/borro";
   $.ajax({
     url: route,
     type: 'post',
     data: {
      id: id,
     },
     headers: {
       'X-CSRF-TOKEN': _token
     },
     dataType: 'json',
     success: function(result) {
       console.log('gunciona');
     }
   });
   //modifico lo

     $('.btn-primaryAdd').each(function(){
        //  var id_padre = $(this).attr("data-padre");
         var id2 = $(this).attr("data-id");

         if (id ==id2) {
           console.log('entro'+id2+id);
           $(this).removeClass('btn-primaryAdd');
           $(this).addClass('btn-primaryVenta');
           $(this).html('agregar');
         }
         });

   $(this).parents('tr').remove();
   $('.btn-primaryVenta').each(function(){
     var band=0;
     var id2 = $(this).attr("data-id");
     var padre = $(this).attr("data-padre");

     $('.miUnidadItem').each(function(){
       var id3= $(this).attr("data-padre");
      if (id3 !='0' && id2 ==id3 ) {
       band=1;
     }else if(id3 !='0' && id2 !=id3 ){
       band=0;
     }
  });
  if (band==0 && padre==1 ) {
    console.log('cambio');
    $(this).css('background-color','white');
    $(this).css('color','red');
    $(this).html('agregar');
  }
});

   var $dataRows = $(".table-condensed tbody tr");

   if ($($dataRows).length===0) {
     $('#miTablaTable').addClass('hide');
     $('#miParrafo').removeClass('hide');
     $('.btn-primaryVenta2').addClass('hide');

   }
   suma();
 });


 $(document).on('change', '.selectpickeRegion', function(e) {
   $('#txtComu').empty();
   e.preventDefault();
   var _token = $('#token').val();
   var id =  $( ".selectpickeRegion" ).val();
   var route = "comunasreg/" + id;
   console.log(id);
   $.ajax({
     url: route,
     type: 'GET',
     headers: {'X-CSRF-TOKEN': _token   },
     dataType: 'json',
     data: { id: id  },
     success: function(result) {
    //   console.log(result);
       $.each(result, function(i, item) {
           $('#txtComu')
                .append($("<option></option>")
                .attr("value",item.COMUNA_NOMBRE)
                .text(item.COMUNA_NOMBRE));
       });
       $('#txtComu').selectpicker('refresh');
     }
   });
 });

//agregar item a la bd
 function ajaxInsert(iduni,precio,nombrePro){

   var _token = $('#token').val();
   var route = "tienda/agregar";
   $.ajax({
     url: route,
     type: 'POST',
    // async: false,
     data: {
      iduni: iduni,
      precio: precio,
      nombrePro:nombrePro,
     },
     headers: {
       'X-CSRF-TOKEN': _token
     },
     dataType: 'json',
     success: function(result) {
       console.log('gunciona');
     }
   });
 }

 //funcion NO ASINCRONA DE AJAX!!! PARA SACAR EL ID DE LA UNIDADVTAPRESS Y PONERLA EN EL SELECT
 function ajaxInsertUnidadPresentacion(iduni){
   var _token = $('#token').val();
   var route = "tienda/agregarPvt";
   var id;
   return $.ajax({
     url: route,
     type: 'POST',
       async: false,
     data: {
      iduni: iduni
     },
     headers: {
       'X-CSRF-TOKEN': _token
     },
     dataType: 'json',
     success: function(result) {
      return;
       }
   });
 }


//agrego unidade de vta nueva.
 function ajaxNuevoUni(id,precioIni,nombrePro,precio,idUniPres,cantidad,nombreFoto){
   var _token = $('#token').val();
   var route = "tienda/nuevo";
   var nombreFoto = nombreFoto.split('/');

    $.ajax({
     url: route,
     type: 'POST',
    // async: false,
     data:  {cantidad:cantidad, idUni:idUniPres, nombreFoto:nombreFoto[2],id:id},
     headers: {'X-CSRF-TOKEN': _token},
     dataType: 'json',
     success: function(result) {
        //agrego el item.
      ajaxInsert(result.uni_id,precioIni,nombrePro);
      var cadenaText='';
      var id_univta_nueva = result.uni_id;
      var j= 0;
      //cantidade de select a agregar por la unidad de venta
      for (var i = 0; i < cantidad; i++) {
        //inserto en la pvt y devuelvo el id del pvt para insertarlo en el select.
          some= ajaxInsertUnidadPresentacion(id_univta_nueva);
          var obj = JSON.parse(some.responseText);
          //console.log(obj.id);
          j =j+1;
          if (i==0) {
            cadenaText +='<table class="selecTienda" style="margin-top: 10px;">'+
              '<tr>'+
              '<td >'+
              '<div style="margin-left:20px; class="">'+
                '<select   title="SELECCIONA PRODUCTO '+j+'" data-iduniVta="'+obj.id+'" class="selectpicker show-tick select'+id_univta_nueva+'" data-container="body">'+
                   '</select>'+
               '</div>'+
              '</td>'+
              '</tr>'+
              '</table>';
          }else{
            cadenaText +='<table class="selecTienda">'+
              '<tr>'+
              '<td >'+
              '<div style="margin-left:20px; class="">'+
                '<select   title="SELECCIONA PRODUCTO '+j+'" data-iduniVta="'+obj.id+'" class="selectpicker show-tick select'+id_univta_nueva+'" data-container="body">'+
                   '</select>'+
               '</div>'+
              '</td>'+
              '</tr>'+
              '</table>';
          }
    // );
     }
     //agrego los selected a la fila.
   $('.table-condensed > tbody:first')
       .append('<tr class="miUnidadItem" id='+result.uni_id+' data-padre='+id+' data-id='+result.uni_id+'><td>'+nombrePro+''+cadenaText+'</td><td  class="cantCol text-right"><input class="inputCantidad" value="1" type="number" name="quantity" min="1" max="20">'+
       '</td><td data-id='+precioIni+'  class="precioUni text-right" >'+precio+'</td><td data-valor='+precioIni+'  class="valor text-right" >'+precio+'</td><td><a href= "#!" class="btn-xs btn-link btnDelete"><i class="fa fa-times"></i></a></td>'+
       '</tr>');

    //insertar los option del select.
     var totalPresentaciones =0;
      $.each(result, function(i, item) {
          if (item.pres_id!= undefined) {
             $('.select'+id_univta_nueva).append('<option value='+item.pres_id+','+id_univta_nueva+' title='+item.pres_nombre+'  data-content="<img width=50px height=50px src=imagenes/presentaciones/'+item.pres_foto+' > <span style=margin-left:5px;>'+item.pres_nombre+'</span>"></option>');
            }
       });
       //configuro el selectpicker
      //  $('.selectpicker').selectpicker({
      //     title: 'Seleccione',
      //     dropupAuto: false ,
      //     width:'100%'
      //  });
    //$('.selectpicker').selectpicker('refresh');
    doSomething();
    sumacarrito();
    cambioBotones();

     },
     error: function(result) {
       console.log('NOfunciona');
     }
   });
 }

//update de la cantidad del producto en la tabla item.
 function ajaxUpdate(cantidad,id){
   var _token = $('#token').val();
   var route = "tienda/updateCant";
   $.ajax({
     url: route,
     type: 'post',
     data: {
      id: id,
      cantidad: cantidad,
      },
     headers: {
       'X-CSRF-TOKEN': _token
     },
     dataType: 'json',
     success: function(result) {
       console.log('gunciona');
     }
   });
 }
//consulto mi presentacion, ya no lo uso.
 function ajaxConsultaPresent(idUNivta,idrealuni,cantidad){
   var route = "consultPresent";
   var _token = $('#token').val();
   $.ajax({
     url: route,
     type: 'POST',
     data:  {idUNivta:idUNivta},
     headers: {
       'X-CSRF-TOKEN': _token
     },
     dataType: 'json',
     success: function(result) {
       var totalPresentaciones =0;
     //  msjes(result.mensaje);
     $.each(result, function(j, item2) {
       $.each(result, function(i, item) {
           $('#select'+idrealuni+j)
          .append('<option value='+item.pres_id+' title='+item.pres_nombre+'  data-content="<img width=50px height=50px src=imagenes/presentaciones/'+item.pres_foto+'>'+item.pres_nombre+'"></option>');

       });
          //  $('#select'+idrealuni+j).selectpicker('refresh');
     });
     //$('.selectpicker').selectpicker('refresh');
    doSomething();
     },
     error: function(result) {
       console.log('NOfunciona');
     }
   });
 }



//da formato peso a los valores. se puede mejorar el proceso.
function pinta(){
  var $dataRows2 = $(".table-condensed tbody tr");
  $dataRows2.each(function() {
      var valor = $(this).find('.valor').html();
      var precioUni = $(this).find('.precioUni').attr("data-id");
      if (precioUni != undefined) {
        precioUni = '$' + precioUni.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        valor = '$' + valor.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        $(this).find('.precioUni').html(precioUni);
        $(this).find('.valor').html(valor);
      }

  });
}
//funcion de suma de cantidad x precio inicial, tbn se puede mejorar.
 function suma(){
   var $dataRows2 = $(".table-condensed tbody tr td:not(:first-child)");
   var total = 0;
   $dataRows2.each(function() {
     var precioInicial2 = parseInt($(this).find('.precioUni').attr("data-id"));
     if (!isNaN(precioInicial2)) {
        // var some =$(this).find('input').val();
         if($(this).find('.inputCantidad').val()  ){
             var cantidad2      = parseInt($(this).find('.inputCantidad').val());
             console.log(cantidad2);
           }
         else if(!isNaN(parseInt($(this).find('.cantCol').html()))){
           var cantidad2      = parseInt($(this).find('.cantCol').html());
           cantidadTotal      += cantidad2;
           console.log('cantidad total ');
         }
           total += (precioInicial2*cantidad2);
           console.log(total);
   }
   });

   var totalPintado = '$' + total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
   $('.table-condensed').find('.sumSubTotal').html('<p>'+totalPintado+'</p>');
   $('.table-condensed').find('.sumSubTotal').attr('data-id',total);

   var $dataRows3 = $(".table-condensed tfoot tr");
   var subtotalFinal = 0;
   var envioo = 0;
   //suma mis precios finales
   sumacarrito();
  //  $dataRows3.each(function() {
  //    if (parseInt($(this).find('.sumSubTotal').attr("data-id"))) {
  //      subtotalFinal = parseInt($(this).find('.sumSubTotal').attr("data-id"));
  //    }
  //    if (parseInt($(this).find('.Envio').attr("data-id"))) {
  //      envioo        = parseInt($(this).find('.Envio').attr("data-id"));
  //    }
  //  });
  //  totalResumen  = (subtotalFinal+envioo);
   //
  //  var totalResumenPintado = '$' + totalResumen.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
   //
  //  $('.table-condensed').find('.sumTotal').html('<p>'+totalResumenPintado+'</p>');
  //  $('.table-condensed').find('.sumTotal').attr('data-id',totalResumen);

 }


//registro final! para crear el pedido
$(document).on('click','#registro' ,function(e) {
  e.preventDefault();

  //$('input:radio[name="uni_publica"]').prop("checked", true);
  var miRadio =$('input:radio[name="uni_publica"]:checked').val();

  var total  = $('#miTotalFinal').attr("data-id");
  var route  = "tienda";
  var _token = $('#token').val();

  var  apellido   = $("#nombreCompleto").attr("data-apellido");
  var  nombre     = $("#nombreCompleto").attr("data-nombre");
  var  calle      = $("#direccionCompleta").attr("data-calle");
  var  numero     = $("#direccionCompleta").attr("data-numero");
  var  dpto       = $("#direccionCompleta").attr("data-dpto");
  var  telefono   = $("#telefonoPed").attr("data-telefono");
  var  email      = $("#emailPed").attr("data-email");
  var  comuna     = $("#comunaPedido").attr("data-comuna");
  var  coordenadas= $("#comunaPedido").attr("data-coordenadas");
  var  hash       = $("#miTotalFinal").attr("data-hash");

  $.ajax({
    url: route,
    type: 'post',
    data: {apellido,nombre,calle,numero,dpto,telefono,email,comuna,total,coordenadas,miRadio,hash},
    headers: {
      'X-CSRF-TOKEN': _token
    },
    dataType: 'json',
    success: function(result) {
      //pregunto si es de webpay o no.
      console.log(result.TBK_ID_SESION);

      if (result.TBK_ID_SESION == undefined) {
        $('.idDiv').empty().append(result);
        $('.resumenCompra').removeClass('col-centered');
        $('.bordeResumen').removeClass('bordeResumen');
        $('.idDiv').addClass('bordeResumen');
        var textoInformacion = '<div class="col-sm-12"><p>Recuerda que luego de confirmar el pedido deberás hacer una transferencia bancaria. Debes enviar el comprobante de transferencia a pedidos@bymaria.cl indicando el número de pedido . Esto debe ser a más tardar a las 22:00 horas del día anterior al despacho.</p>'+
        '<p>BANCO: BCI (Banco Crédito e Inversiones)'+
         '<p> TIPO CUENTA: Cuenta Corriente</p>'+
          '<p>Nº CUENTA: 61465046</p>'+
          '<p>NOMBRE: ByMaria Limitada</p>'+
          '<p>RUT: 76.508.219-6</p>'+
          '<p>EMAIL: pedidos@bymaria.cl</p>'+
          '<p>Por favor ten presente también que debe haber alguien disponible para recibir el pedido el día 01-03-2016. El despacho podría ser entre las 11:00 y las 19:00 horas.'+
          ' Cualquier inquietud que tengas no dudes en escribirnos a pedidos@bymaria.cl	</p> </div>';
         $('.divInfo').append(textoInformacion);
      }else{
        // console.log('entro a la respuesta web');
        $('input[name="TBK_MONTO"]').val(result.TBK_MONTO);
        $('input[name="TBK_ORDEN_COMPRA"]').val(result.TBK_ORDEN_COMPRA);
        $('input[name="TBK_ID_SESION"]').val(result.TBK_ID_SESION);
        // console.log($('input[name="TBK_ID_SESION"]').val());
        // console.log($('input[name="TBK_ORDEN_COMPRA"]').val());
        // console.log($('input[name="TBK_MONTO"]').val());
        // console.log(result);
          $('#f_webpay').submit();
      }
    },
    error: function(result) {
      console.log('NOfunciona');
    }
  });

});

//submit del form del webpay
// $(document).on('submit','#f_webpay' ,function(e) {
//   e.preventDefault();
//   var $form = $(this);
//   var serializedData = $form.serialize();
//   var route = "../cgi-bin/tbk_bp_pago.cgi";
//   var _token = $('#token').val();
//   console.log(serializedData);
//   $.ajax({
//     url: route,
//     type: 'post',
//     data: serializedData,
//     headers: {
//       'X-CSRF-TOKEN': _token
//     },
//     dataType: 'json',
//     success: function(result) {
//       console.log('funciona');
//
//     },
//     error: function(result) {
//       console.log('NOfunciona');
//     }
//   });
// });



//form de datos del cliente,
 $(document).on('submit','#formTienda' ,function(e) {
   e.preventDefault();
   if (confirmo=='0') {
     $('.alert').removeClass('hide');
   }else{
     $('.btnConfirma').addClass('hide');
     var $form = $(this);
     var $inputs = $form.find("input,textarea");
     var sumSubTotal = 0;
     var sumTotal = 0;
     var sumCantidad = 0;
     $(".sumSubTotal").each(function(){
           sumSubTotal += parseInt($(this).attr("data-id"));
         });
         $(".sumTotal").each(function(){
               sumTotal += parseInt($(this).attr("data-total"));
             });
              $(".cantCol").each(function(){
                     sumCantidad += parseInt($(this).attr("data-cantidad"));
                   });

     $form.append('<input  class="hide" name="ped_total" type="text" value="'+sumTotal+'">');
     $form.append('<input  class="hide" name="ped_subtotal" type="text" value="'+sumSubTotal+'">');
     $form.append('<input  class="hide" name="ped_cantidad_item" type="text" value="'+sumCantidad+'">');
      $form.append('<input  class="hide" name="costo_envio" type="text" value="'+$('.Envio').attr("data-hash")+'">');

    var serializedData = $form.serialize();

    var route = "ultimoPasoTienda";
    var _token = $('#token').val();

    $.ajax({
      url: route,
      type: 'post',
      data: serializedData,
      headers: {
        'X-CSRF-TOKEN': _token
      },
      dataType: 'json',
      success: function(result) {

     $('.idDiv').empty().append(result);
      },
      error: function(result) {
        console.log('NOfunciona');
      }
    });
   }


 });
//revisar, no recuerdo.
 function ajaxMedioPago(serializedData2){
   var route = "medioPago";
   var _token = $('#token').val();
   $.ajax({
     url: route,
     type: 'POST',
     data:  serializedData2,
     headers: {
       'X-CSRF-TOKEN': _token
     },
     dataType: 'json',
     success: function(result) {
     //  msjes(result.mensaje);
     console.log('funciona');
     },
     error: function(result) {
       console.log('NOfunciona');
     }
   });
 }

 //busco   los items que ya estan, para poder cambiar la cantidad.
 function cambioBotones() {
   $('.miUnidadItem').each(function(){
     var id1= $(this).attr("data-id");
     var id3= $(this).attr("data-padre");
     $('.btn-primaryVenta').each(function(){
       var id2 = $(this).attr("data-id");

       if (id3 !='0' && id2 ==id3) {
        //  $(this).addClass('btn-primaryAdd');
        //  $(this).removeClass('btn-primaryVenta');
        $(this).css('background-color','red');
        $(this).css('color','white');
        $(this).html('agregar otro');
       }
         if (id1===id2) {
           $(this).addClass('btn-primaryAdd');
           $(this).removeClass('btn-primaryVenta');
           $(this).html('agregar otro');
         }
         });
    });
}
doSomething();
//sacaBorde();
function sacaBorde(){
  var bandbor = 0;
  $('.btn-default').each(function(){
        if (bandbor==0) {
          bandbor=1;
        }else{
          $(this).addClass('BordeSelect');
        }

      });
}


});

//suma mis precios finales
function sumacarrito(){

  var suma = 0;
  var suma2 =0;
  $('.valor').each(function(){
        suma = suma + parseInt($(this).attr("data-valor"));
      });
   // if (parseInt($('.table-condensed').find('.Envio').attr("data-envio"))) {
  //      console.log('ASDASD');
  //
  //     envio         = parseInt($('.table-condensed').find('.Envio').attr("data-envio"));
  //     suma2 = suma+envio;
  //     var totalResumenPintado = '$' + suma2.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
  //     $('.table-condensed').find('.sumTotal').html('<p>'+totalResumenPintado+'</p>');
  //     $('.table-condensed').find('.sumTotal').attr('data-total',suma2);
  //
  //   }

  var envio = parseInt($('.Envio').attr("data-envio"));
  suma2 = suma+envio;
  var totalResumenPintado2323 = '$' + suma2.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
  $('.sumTotal').html('<p>'+totalResumenPintado2323+'</p>');
  $('.sumTotal').attr('data-total',suma2);

  var totalResumenPintado = '$' + suma.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");

  $('.table-condensed').find('.sumSubTotal').html('<p>'+totalResumenPintado+'</p>');
  $('.table-condensed').find('.sumSubTotal').attr('data-id',suma);

  }
// $(document).on('click','#btnContacModal' ,function(e) {
//   $('#formContact').submit();
//
// });


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
