$(document).ready(function() {
  var id_cli_global;
  var Subtotal_global = 0;
  var total_global = 0;
  var neto_global = 0;
  var iva_global = 0;
  var cantAjax = 0;
  var jid= 0;
  var id_direccion = '';

  //funcion que logra hacer aparecer la barrita de carga
  // $(document).ajaxStart(function() {
  //   //   alert("asd");
  //   $("#cargando").show();
  //
  // }).ajaxStop(function() {
  //   $("#cargando").hide();
  // });

  function msjes(mensaje) {
    $("#msj-success").html(mensaje).fadeIn();
    $("#msj-success").fadeToggle(5000);
  }
  function msjesFail(mensaje) {
    $("#msj-fail").html(mensaje).fadeIn();
    $("#msj-fail").fadeToggle(5000);
  }




  /*==================== PAGINACION CON AJAX =========================*/
  /*
  $(window).on('hashchange',function(){
    page = window.location.hash.replace('#','');
    getProducts(page);
  });

  $(document).on('click','.pagination a', function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    // getProducts(page);
    location.hash = page;
  });

  function getProducts(page){
    $.ajax({
      url: '/unidadesventas/create?page=' + page
    }).done(function(data){
      $('.table-responsive').html(data);
    });
  }
  */
  /*==================== FIN =========================*/

  $("#registro").click(function(e) {
    e.preventDefault();

    $("#formPed").submit();
  });


  $('#selectTipoPago').on('change', function() {
  //  alert( this.value ); // or $(this).val()
  });


  $("#formPed").on('submit', function(e) {
    e.preventDefault();
    $("#msj-fail").empty();

    $('#registro').html('<i style="width:'+$('#registro').width()+'px;" class="fa fa-spinner fa-pulse fa-lg"></i>');
    console.log($('.cantCol').length);
    if ($('.cantCol').length==0) {
      $("#msj-fail").append('<p>Debe Agregar Productos</p>').fadeIn();
      $('#registro').html('Agregar');

    }else{
      $("#msj-fail").hide();
      var $form = $(this);

      var $inputs = $form.find("input[type='text'],input[type='num'], select, button, textarea");

      $form.append('<input class="hide  temp" name="ped_id_cliente" type="text" value='+id_cli_global+'>');
      $form.append('<input class="hide  temp" name="ped_neto" type="text" value='+neto_global+'>');
      $form.append('<input class="hide  temp" name="ped_iva" type="text" value='+iva_global+'>');
      $form.append('<input class="hide  temp" name="ped_total" type="text" value='+total_global+'>');
      $form.append('<input class="hide  temp" name="ped_subtotal" type="text" value='+Subtotal_global+'>');
      $form.append('<input class="hide  temp" name="ped_cantidad_item" type="text" value='+cantAjax+'>');
      $form.append('<input class="hide  temp" name="id_direccion" type="text" value='+id_direccion+'>');

      var serializedData = $form.serialize();

      // $inputs.prop("disabled", true);
      var route = "../pedidos";
      var _token = $('#token').val();

      $.ajax({
        url: route,
        type: 'POST',
        global: false,
        data: serializedData,
        headers: {
          'X-CSRF-TOKEN': _token
        },
        dataType: 'json',
        success: function(result) {
           msjes(result.mensaje);
          //SEGUNDO PASO, INSERTAR EN ITEMS
          RecorroTable(result.id);

          //AjaxDespa();

          $inputs.prop("disabled", false);
          $('#registro').html('Agregar');

          $('.temp').remove();
          $inputs.val("");
          $('#ped_cantidad_item').val(1);
          $('#costo_dscto').val(0);
          $('#costo_despacho').val(0);
          $('#selectTipoPago').val('factura');
          $('#selectFormaPago').val('webpay');
          $('#selectEstadoPago').val('pagado');


          $('#txtCli').val('');
          $('#datosCliCont').val('');
          $('#txtCliDir').val('');
          $('#txtUniVta').val('');
          $('.selectpicker').selectpicker('render');
         $('.selectpicker').selectpicker('refresh');

         $('.table tbody').empty();
         $(".table tfoot").addClass("hide");


        },
        error: function(result) {
          var response = JSON.parse(result.responseText);
          $('#registro').html('Agregar');

          $.each(response, function (ind, elem) {
            console.log(ind);
            if (ind=='Correo') {
              $("#msj-fail").append('<p style="margin-top: -11px;">'+elem+'</p>').fadeIn();
            }else{
              $("#msj-fail").append('<p>'+elem+'</p>').fadeIn();
              }
            return false;
           });
        }
      });
    }
  });

  //clicar el boton de eliminar
  $(document).on("click", '.btn-danger', function(e) {
    e.preventDefault();
    var row = $(this).parents('tr');
    var id = row.data('id');
    $(this).parents('tr').remove();
    SumarColumna();
  });



  //al clicar el drop de tipo factura
  $(".dropdown-menu").on('click', 'li a', function() {
    $(".btn:first-child").text($(this).text());
    $(".btn:first-child").val($(this).text());
  });


  //cuando se cambia de texto PARA REGIONES CON SECTION
  $(document).on('change', '#txtRegiones', function(e) {
    e.preventDefault();
    var _token = $('#token').val();
    var id = ($("#txtRegiones").val());
    var route = "comunas/" + id;
    $.ajax({
      url: route,
      type: 'GET',
      headers: {
        'X-CSRF-TOKEN': _token
      },
      dataType: 'json',
      data: {
        id: id
      },
      success: function(result) {
        $('#comunasAjax').empty().append(result);
      }
    });
  });



  //cuando se cambia de texto PARA CLIENTES CON SECTION
  $(document).on('change', '#txtCli', function(e) {
    e.preventDefault();

    $( "input[name*='Apellido_Paterno']" ).val('');
    $( "input[name*='ped_cli_materno']" ).val('');
    $( "input[name*='Nombre_Cliente']" ).val('');
    $( "input[name*='Telefono']" ).val('');
    $( "input[name*='Correo']" ).val('');

    $('#txtCliDir').val('');
    $('#txtCliDir').selectpicker('render');
    $('#txtCliDir').selectpicker('refresh');

    $('#txtCliDir').empty();
    $('#datosCliDirec').empty();
    var id = $('#txtCli').val();

    id_cli_global = id;
    var _token = $('#token').val();
    var route = "../contactos/" + id + "/edit";
    $.ajax({
      url: route,
      type: 'get',
      headers: {
        'X-CSRF-TOKEN': _token
      },
      dataType: 'json',
      data: {
        id: id
      },
      success: function(result) {

        $('#contaCli').empty().append(result);
        $('#datosCliCont').selectpicker('refresh');
        //OTRO AJAX PARA LAS DIRECCIONES
        var route2 = "../direcciones/" + id;
        $.ajax({
          url: route2,
          type: 'GET',
          headers: {
            'X-CSRF-TOKEN': _token
          },
          dataType: 'json',
          data: {
            id: id
          },
          success: function(result2) {
            //$('#Diress').empty().append(result2);
            // $('.selectpickerDir').selectpicker('refresh');
            if (result2.length == 1) {
              $.each(result2, function(i, item) {
                  $('#txtCliDir')
                       .append($("<option selected></option>")
                       .attr("value",item.dire_id)
                       .text(item.COMUNA_NOMBRE+' '+item.dire_calle+' '+item.dire_num));
              });
              //  $('#datosCliDirec option:eq(0)');
               $.each(result2, function(i, item) {
                 $("input[name*='Calle']").val(item.dire_calle);
                $("input[name*='numero']").val(item.dire_num);
                $("input[name*='ped_cli_dpto']").val(item.dire_dpto);
                $("input[name*='comuna']").val(item.COMUNA_NOMBRE);
                $("#ped_coordenadas").val(item.dire_latitud+','+item.dire_longitud);
                id_direccion = item.dire_id;
                
              });

            } else {
              $.each(result2, function(i, item) {
                  $('#txtCliDir')
                       .append($("<option></option>")
                       .attr("value",item.dire_id)
                       .text(item.COMUNA_NOMBRE+' '+item.dire_calle+' '+item.dire_num));
              });
              $("input[name*='Calle']").val('');
              $("input[name*='numero']").val('');
              $("input[name*='ped_cli_dpto']").val('');
              $("input[name*='comuna']").val('');
            }
            $('#txtCliDir').selectpicker('refresh');

            //  $( "input[name*='Apellido_Paterno']" ).val(result.cont_apellido);
            //  $( "input[name*='Nombre_Cliente']" ).val(result.cont_nombre);
            //  $( "input[name*='numero']" ).val(result.cont_telefono);
            //  $( "input[name*='Correo']" ).val(result.cont_email);

          }
        });
      }
    });
  });

  //cuando se cambia de texto direcciones!!
  $(document).on('change', '#txtCliDir', function(e) {
    e.preventDefault();
    var id = $('#txtCliDir').val();
    id_direccion = id;

    var _token = $('#token').val();
    var route = "../direcciones/" + id + "/edit";
    $.ajax({
      url: route,
      type: 'GET',
      headers: {
        'X-CSRF-TOKEN': _token
      },
      dataType: 'json',
      data: {
        id: id
      },
      success: function(result) {
        $("input[name*='Calle']").val(result.dire_calle);
        $("input[name*='comuna']").val(result.COMUNA_NOMBRE);
        $("input[name*='ped_cli_dpto']").val(result.dire_dpto);
        $("input[name*='numero']").val(result.dire_num);
        $("#ped_coordenadas").val(result.dire_latitud+','+result.dire_longitud);

      }
    });
  });

  //aqui va el del la PARA CONTACTO
  $(document).on('change', '#datosCliCont', function(e) {
    e.preventDefault();
    var id = $('#datosCliCont').val()

    var _token = $('#token').val();
    var route = "../contactos/getForm/" + id;
    $.ajax({
      url: route,
      type: 'GET',
      headers: {
        'X-CSRF-TOKEN': _token
      },
      dataType: 'json',
      data: {
        id: id
      },
      success: function(result) {
        console.log(result.cont_apellido);
        $("input[name*='Apellido_Paterno']").val(result.cont_apellido);
        $("input[name*='Nombre_Cliente']").val(result.cont_nombre);
        $("input[name*='Telefono']").val(result.cont_telefono);
        $("input[name*='Correo']").val(result.cont_email);
        // $('#contaCli').empty().append(result);
      }
    });
  });

  $(document).on('change', '#txtUniVta', function(e) {
    console.log($('#txtUniVta').val());
    var precios = $('#txtUniVta').val().split(",");
    // //busco si es pack o no.
    // if ( precios[3] ==1 ) {
    //
    //   var _token = $('#token').val();
    //   var route  = "../pedidos/NuevoPack/";
    //   $.ajax({
    //     url: route,
    //     type: 'post',
    //     headers: {
    //       'X-CSRF-TOKEN': _token
    //     },
    //     dataType: 'json',
    //     data: {
    //       id: precios[1]
    //     },
    //     success: function(result) {
    //     //  console.log(result.cont_apellido);
    //     }
    //   });
    // }else{
    //
    // }
    precio      = parseInt(precios[0]);
    $('#item_precio_vta').val(precio);
  });

  //aqui va el del la PARA PRODUCTOS
  $(document).on('click', '#addPro', function(e) {
    e.preventDefault();
    $(this).html('<i style="width:'+$(this).width()+'px;" class="fa fa-spinner fa-pulse fa-lg"></i>');
    if ($('#txtUniVta').val() =='') {
       msjesFail('debe seleccionar producto');
       $(this).html('Agregar');

    }else{
      $(".table-condensed tfoot").removeClass("hide");
      var val = $('#txtUniVta').val().split(",");
      var id    = val[1];
      var cant   = $('#ped_cantidad_item').val();
      var precio = $('#item_precio_vta').val();
      // var id = $('#datosUniVta option').filter(function() {
      //   return this.value == val;
      // }).data('id');

      // var precio = $('#datosUniVta option').filter(function() {
      //   return this.value == val;
      // }).data('value');

      cant = parseInt(cant);
      precio = parseInt(precio);
      var  valProd = (precio * cant);
      var valProdPinta =   '$' + valProd.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
      var valPrecPinta =   '$' + precio.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");

      //busco si es pack o no.
      if ( val[3] ==1 ) {
        var _token = $('#token').val();
        var route  = "../pedidos/NuevoPack";
        $.ajax({
           global: false,
          url: route,
          type: 'post',
          headers: {
            'X-CSRF-TOKEN': _token
          },
          dataType: 'json',
          data: {
            id: val[1]
          },
          success: function(result) {
            var cadenaText='';
            var cadenaOption='';
            var j= 0;
            //cantidade de select a agregar por la unidad de venta
            for (var i = 0; i < result[0].uni_cantidad_present; i++) {
              j =j+1;
              jid =jid+1;
              cadenaOption='';
              //insertar los option del select.
                 $.each(result, function(i, item) {
                    if (item.pres_id!= undefined) {
                      cadenaOption +='<option value='+item.pres_id+'   title='+item.pres_nombre+'  <span style=margin-left:5px;>'+item.pres_nombre+'</span></option>';
                      }
                 });

              if (i==0) {
                cadenaText +='<table class="selecTienda" style="margin-top: 10px;">'+
                  '<tr>'+
                  '<td >'+
                  '<div   class="">'+
                    '<select  data-width="auto" title="PRODUCTO '+j+'" data-iduniVta="'+id+'" class="selectpicker   select'+jid+'" data-container="body">'+cadenaOption+''+
                    '</select>'+
                   '</div>'+
                  '</td>'+
                  '</tr>'+
                  '</table>';
              }else{
                cadenaText +='<table class="selecTienda">'+
                  '<tr>'+
                  '<td >'+
                  '<div   class="">'+
                    '<select data-width="auto"  title="PRODUCTO '+j+'" data-iduniVta="'+id+'" class="selectpicker  select'+jid+'" data-container="body">'+cadenaOption+''+
                       '</select>'+
                   '</div>'+
                  '</td>'+
                  '</tr>'+
                  '</table>';
              }
            }
            $('.table-condensed > tbody:first').append('<tr data-custom=1 data-id=' + id + '><td class="nombreCol">' + val[2] + ''+cadenaText+'</td>'+
            '<td class="cantCol">' + cant + '</td>'+
            '<td class="precioCol" data-valor='+valProd+'>' + valPrecPinta + '</td>'+
            '<td class="text-right rowDataSd" data-valor='+valProd+'>' + valProdPinta + '</td>'+
            '<td><a href= "#!" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td></tr>');
            $('#txtUniVta').val('');
            $('#item_cantidad_pedida').val('');
            // $('#item_precio_vta').val('');
            SumarColumna();
            $('.selectpicker').selectpicker('refresh');
            // $('.selectpicker').selectpicker('render');

            $('#txtUniVta').selectpicker('render');
           $('#txtUniVta').selectpicker('refresh');
           $('#addPro').html('Agregar');

          //  console.log(result.cont_apellido);
          }
        });
      }else{
        $('.table-condensed > tbody:first').append('<tr data-id=' + id + '><td class="nombreCol">' + val[2] + '</td>'+
        '<td class="cantCol">' + cant + '</td>'+
        '<td class="precioCol" data-valor='+valProd+'>' + valPrecPinta + '</td>'+
        '<td class="text-right rowDataSd" data-valor='+valProd+'>' + valProdPinta + '</td>'+
        '<td><a href= "#!" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td></tr>');
        $('#txtUniVta').val('');
        $('#item_cantidad_pedida').val('');
        // $('#item_precio_vta').val('');
        SumarColumna();
        $('#txtUniVta').selectpicker('render');
       $('#txtUniVta').selectpicker('refresh');
       $('#addPro').html('Agregar');

      }

    }
  });

  $(document).on('change', '#costo_dscto', function(e) {
    $(".table-condensed .sumDscto").html($('#costo_dscto').val());
    var desval      = $('#costo_dscto').val();
    var desvalPinta =   '$' + desval.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    $(".table-condensed .sumDscto").html(desvalPinta);
    $(".table-condensed .sumDscto").attr('data-valor',desval);
    SumarColumna();

  });

  $(document).on('change', '#costo_despacho', function(e) {
    $(".table-condensed .sumDespa").html($('#costo_despacho').val());
    var desval      = $('#costo_despacho').val();
    var desvalPinta =   '$' + desval.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    $(".table-condensed .sumDespa").html(desvalPinta);
    $(".table-condensed .sumDespa").attr('data-valor',desval);
    SumarColumna();

  });

  // $(document).on('change','#selectTipoPago', function(e) {
  //   if ($( "#selectTipoPago option:selected" ).val()==2) {
  //     $("#tipoPagoSelec").removeClass("hide");
  //     $("#numBoleta").removeClass("hide");
  //     $("#numFactura").addClass("hide");
  //   }if($( "#selectTipoPago option:selected" ).val()==1){
  //     $("#tipoPagoSelec").removeClass("hide");
  //     $("#numBoleta").addClass("hide");
  //     $("#numFactura").removeClass("hide");
  //   }
  // });


  // function AjaxDespa(){
  //
  //        //ajax
  //       var _token = $('#token').val();
  //       var route = "/despachos";
  //       $.ajax({
  //         url: route,
  //         type: 'POST',
  //         data: {
  //           item_uni_id: uni_id,
  //           item_cantidad_pedida: cantidad,
  //           item_precio_vta: precio,
  //           item_nombre: nombre,
  //           item_ped_id: id,
  //         },
  //         headers: {
  //           'X-CSRF-TOKEN': _token
  //         },
  //         dataType: 'json',
  //         success: function(result) {
  //           console.log('gunciona');
  //         }
  //       });
  //
  // }

  function RecorroTable(id){

      var $dataRows = $(".table-condensed tbody tr");
      var cantidad;
      var precio;
      var uni_id;
      var nombre;
      var custom;
      $(".miTablaPed>tbody>tr").each(function(ie) {

        $(this).find('.cantCol').each(function(i) {
          var row = $(this).parents('tr');
          uni_id = row.data('id');
          custom = row.data('custom');
          cantidad=($(this).html());

        });
        $(this).find('.precioCol').each(function(i) {
            // precio=($(this).html())  ;
            precio = $(this).attr('data-valor');
        });
        $(this).find('.nombreCol').each(function(i) {
            nombre=($(this).html())  ;
        });
        var newUniVta = '';

        if (custom==1) {

          //inserto en unidad de vta para recoger el id de esa tabla.
          var _token = $('#token').val();
          var route = "../uniPack";
          $.ajax({
            url: route,
            type: 'POST',
            async:false,
            data: {
              uni_id: uni_id,
              cantidad: cantidad,
              precio: precio,
              Pedid : id
            },
            headers: {
              'X-CSRF-TOKEN': _token
            },
            dataType: 'json',
            success: function(result) {
              newUniVta = result.id;

            }

          });

          //recorrer los selected
          $(this).find('.selectpicker').each(function(i) {

               var pres_escogida =$("option:selected", this).val();
              //ajax
              var _token = $('#token').val();
              var route = "../InsertPack";
              $.ajax({
                url: route,
                type: 'POST',
                data: {
                  item_uni_id: newUniVta,
                  pres_escogida : pres_escogida,
                },
                headers: {
                  'X-CSRF-TOKEN': _token
                },
                dataType: 'json',
                success: function(result) {
                  console.log('gunciona');
                }
              });
          });

        }else{
          //ajax
          var _token = $('#token').val();
          var route = "../items";
          $.ajax({
            url: route,
            type: 'POST',
            data: {
              item_uni_id: uni_id,
              item_cantidad_pedida: cantidad,
              item_precio_vta: precio,
              item_nombre: nombre,
              item_ped_id: id,
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


     });
  }

  function SumarColumna() {

    var tbody = $(".table-condensed tbody");
    if (tbody.children().length == 0) {
      $(".table-condensed .sumNeto").html('0');
      $(".table-condensed .sumSubTotal").html('0');
      $(".table-condensed .sumIva").html('0');
      $(".table-condensed .sumTotal").html('0');
      $(".table-condensed tfoot").addClass("hide");

    } else {
      var $dataRows = $(".table-condensed tr:not('thead, tfooter')");
      var Subtotal  = 0;
      var total     = 0;
      var neto      = 0;
      var cantAjaxLocal = 0;
      $dataRows.each(function() {
        $(this).find('.rowDataSd').each(function(i) {
          Subtotal += parseInt($(this).attr('data-valor'));
        });
        $(this).find('.cantCol').each(function(i) {
          cantAjaxLocal += parseInt($(this).html());
        });
      });
      // $(".table-condensed .sumSubTotal").each(function(i) {
      //   $(this).html(Subtotal);
      // });

      var totalResumenPintado2323 = '$' + Subtotal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
      $('.table-condensed .sumSubTotal').html(totalResumenPintado2323);
      $('.table-condensed .sumSubTotal').attr('data-valor',Subtotal);

      neto = (Subtotal + parseInt($('#costo_despacho').val()) - parseInt($('#costo_dscto').val()));
      totalResumenPintado2323 = '$' + neto.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");

      $(".table-condensed .sumNeto").html(totalResumenPintado2323);
      $('.table-condensed .sumNeto').attr('data-valor',neto);

      var sumIvaass =   '$' + parseInt(0.19 * neto).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");

      $(".table-condensed .sumIva").html(sumIvaass);
      $(".table-condensed .sumIva").attr('data-valor',parseInt(0.19 * neto));

      var sumTOTTTAL =   '$' + parseInt(neto + (0.19 * neto)).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");

      $(".table-condensed .sumTotal").html(sumTOTTTAL);
      $(".table-condensed .sumTotal").attr('data-valor',parseInt(neto + (0.19 * neto)));

      Subtotal_global = Subtotal;
      total_global = parseInt(neto + (0.19 * neto));
      neto_global = neto;
      iva_global  = parseInt(0.19 * neto);
      cantAjax = cantAjaxLocal;
    }
        //RecorroTable();
  }

});
