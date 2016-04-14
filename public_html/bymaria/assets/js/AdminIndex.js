
$(document).ready(function(){
  var startDate;
  var endDate;
  var area;
 // var json = ja();
 /* Morris.js Charts */
 // Sales chart


 $('input[name="daterange"]').daterangepicker({
  "locale": {
         "format": "MM/DD/YYYY",
         "separator": " - ",
         "applyLabel": "Apply",
         "cancelLabel": "Cancel",
         "fromLabel": "From",
         "toLabel": "To",
         "customRangeLabel": "Custom",
         "daysOfWeek": [
             "Su",
             "Mo",
             "Tu",
             "We",
             "Th",
             "Fr",
             "Sa"
         ],
         "monthNames": [
             "Enero",
             "Febrero",
             "Marzo",
             "Abril",
             "Mayo",
             "Junio",
             "Julio",
             "Agusto",
             "Septiembre",
             "Octubre",
             "Noviembre",
             "Diciembre"
         ],
         "firstDay": 1
     }
 });

 function cb(start, end) {
         $('#reportrange span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
         startDate = start.format('YYYY-MM-DD');
         endDate = end.format('YYYY-MM-DD');
         console.log(startDate + ' - ' + endDate);
         ja(startDate,endDate);
        //  jo(startDate,endDate);
     }
     cb(moment().subtract(29, 'days'), moment());

     $('#reportrange').daterangepicker({
        "showWeekNumbers" : true,
        "opens": 'left',
        locale: {
               "format": "MM/DD/YYYY",
              "separator": " - ",
              "applyLabel": "Aplicar",
              "cancelLabel": "Cancelar",
              "fromLabel": "Desde",
              "toLabel": "a",
              "customRangeLabel": "Personalizado",
              "daysOfWeek": [
                  "Do",
                  "Lu",
                  "Ma",
                  "Mi",
                  "Ju",
                  "Vi",
                  "Sa"
              ],
              "monthNames": [
                  "Enero",
                  "Febrero",
                  "Marzo",
                  "Abril",
                  "Mayo",
                  "Junio",
                  "Julio",
                  "Agusto",
                  "Septiembre",
                  "Octubre",
                  "Noviembre",
                  "Diciembre"
              ],
              "firstDay": 1
          },
         ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
         }

     }, cb);

// function jo(startDate,endDate){
//       var display = Array();
//       var _token = $('#token').val();
//       var route = "fechaProducto";
//       var fecha =0;
//       var id;
//       $.ajax({
//       url: route,
//       type: 'POST',
//       data: {  startDate: startDate, endDate: endDate  },
//       headers: {'X-CSRF-TOKEN': _token },
//       dataType: 'json',
//       success: function(result) {
//
//       }
//     });
//   });


  function ja(startDate,endDate){
    var display = Array();
    display[0] = "none";
    display[1] = "block";
    display[2] = "none";


    var display2 = {};
    display2["0"] = "none";
    display2["1"] = "block";
    display2["2"] = "none";

         var _token = $('#token').val();
    var route = "graficos";
    var fecha =0;
    var id;
     $.ajax({
      url: route,
      type: 'POST',
      data: {  startDate: startDate, endDate: endDate  },
      headers: {'X-CSRF-TOKEN': _token },
      dataType: 'json',
      success: function(result) {
        console.log(result);
        jsonObj = [];
        nombres = [];
        pro_ides = [];
        var temp ='';
        $.each(result, function(i, item) {
            item = {};
            var  val1 = result[i].split(":");
            if (temp == '') {
              temp = val1[0];
              item ["y"] = 'semana '+val1[0];
              $.each(result, function(j, item2) {
                  var  val2 = result[j].split(":");
                 if (val1[0]==val2[0]) {
                   item [val2[2]] = val2[1];
                  }
              })
                  jsonObj.push(item);
            }else if (temp!=val1[0]) {
              temp = val1[0];
              item ["y"] = 'semana '+val1[0];
              $.each(result, function(j, item2) {
                  var  val2 = result[j].split(":");
                 if (val1[0]==val2[0]) {
                   item [val2[2]] = val2[1];

                 }
              })
                  jsonObj.push(item);
            }
          })
          temp2='';
          band=0;
            $.each(result, function(i, item) {
              var  val2 = result[i].split(":");
               if (temp2=='') {
                nombres.push(val2[3]);
                temp2='1';
              }else{
                $.each(nombres, function(j, item2) {
                     if(item2 == val2[3]){
                      band=0;
                      return false;
                    }else{
                      band=1;
                    }
                 })
                if (band==1) {
                  nombres.push(val2[3]);
                  band=0;
                }
              }
            })
            temp2='';

            $.each(result, function(i, item) {
              var  val2 = result[i].split(":");
               if (temp2=='') {
                pro_ides.push(val2[2]);
                temp2='1';
              }else{
                $.each(pro_ides, function(j, item2) {
                     if(item2 == val2[2]){
                      band=0;
                      return false;
                    }else{
                      band=1;
                    }
                 })
                if (band==1) {
                  pro_ides.push(val2[2]);
                  band=0;
                }
              }
            })
           var myString2 = JSON.stringify(jsonObj);
           console.log(pro_ides);
           console.log(nombres);
            console.log(myString2);

            var response = $.parseJSON(myString2);
            $('#revenue-chart').empty();
            //  area.setData(response);
             //
            //  area.options.labels = nombres;
            //  area.options.xkeys = 'y';
             //
            //  area.options.ykeys = pro_ides;
            if (pro_ides=='' || nombres=='' || myString2=='' ) {
              console.log('esta vacio');
              $('#revenue-chart').html('No hay registros en esta fecha');

            }else{
                    area =Morris.Bar({
                     element: 'revenue-chart',
                     resize: true,
                     stacked: true,
                     data: response,
                     xkey: "y",
                     ykeys: pro_ides,
                      labels: nombres,
                     lineColors: ['#a0d0e0', '#3c8dbc'],
                     hideHover: 'auto'
               });
            }


            // area.setData(myString2);



        }
    });
  }





//Fix for charts under tabs
$('.box ul.nav a').on('shown.bs.tab', function (e) {
  area.redraw();
 });


// /* BOX REFRESH PLUGIN EXAMPLE (usage with morris charts) */
// $("#loading-example").boxRefresh({
//   source: "ajax/dashboard-boxrefresh-demo.php",
//   onLoadDone: function (box) {
//     bar = new Morris.Bar({
//       element: 'bar-chart',
//       resize: true,
//       data: [
//         {'y': '2006', 'a': 100, 'b': 90},
//         {'y': '2007', 'a': 75, b: 65},
//         {'y': '2008', 'a': 50, b: 40},
//         {'y': '2009', 'a': 75, b: 65},
//         {'y': '2010', 'a': 50, b: 40},
//         {'y': '2011', 'a': 75, b: 65},
//         {'y': '2012', 'a': 100, 'b': 90}
//       ],
//       barColors: ['#00a65a', '#f56954'],
//       xkey: 'y',
//       ykeys: ['a', 'b'],
//       labels: ['CPU', 'DISK'],
//       hideHover: 'auto'
//     });
//   }
// });
});
