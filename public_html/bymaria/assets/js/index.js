$(document).ready(function(){


  $(".some").on("click", function(e) {
     e.preventDefault();      // $('.trasera', this).removeClass('hide');
     $('#imagepreview').attr('src', $('.trasera', this).attr('src'));
     $('#imagemodal').modal('show');
  });
  $(".linkks").on("click", function(e) {
     e.preventDefault();      // $('.trasera', this).removeClass('hide');
    //  console.log($(this).parents());
     $('#imagepreview').attr('src', $(this).parent().parent().find('.some .trasera').attr('src'));
     $('#imagemodal').modal('show');
  });

  // $(".some").on("click", function(e) {
  //    e.preventDefault();
  //    $('#imagepreview').attr('src', $('.trasera', this).attr('src'));
  //    $('#imagemodal').modal('show');
  // });

  // $("#pop").on("click", function() {
  //    $('#imagepreview').attr('src', $('#imageresource').attr('src'));
  //    $('#imagemodal').modal('show');
  //
  // });

  // $(document).on('click', '.some', function(e) {
  //   if ($('.trasera', this).hasClass('hide')==true) {
  //       $('.trasera', this).removeClass('hide');
  //       $('.delantera',this).addClass('hide');
  //   } else if ($('.delantera', this).hasClass("hide")==true) {
  //         $('.trasera', this).addClass('hide');
  //         $('.delantera',this).removeClass('hide');
  //     }
  // });
});
