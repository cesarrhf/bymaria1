<div class="col-md-10 col-centered" style="margin-top: 25px;">
  <!-- SLIDER  -->



      @if(isset($clientes))
      @foreach($clientes as $item)
      <div class="col-xs-6 col-sm-6 col-md-2   text-center ">

      <a href="{{$item->cli_http}}"> <img class="imagenesLogos" src="imagenes/Logos Clientes/{{$item->cli_foto}}" alt=""> </a>

    </div>


      @endforeach
      @endif


        <!-- <?php $i=0; ?> -->
        <!-- Wrapper for slides -->
        <!-- <div class="carousel-inner2 " role="listbox2">
          <div class="item23">
             <div class="text-center ">
               @if(isset($clientes))
               @foreach($clientes as $item)
               <a href="{{$item->cli_http}}"> <img class="imagenesLogos" src="imagenes/Logos Clientes/{{$item->cli_foto}}" alt=""> </a>
                <?php $i++ ?>
                @if($i % 6 === 0)
                 </div>
               </div><div class='item23'>
                 <div class="text-center ">
                @endif
               @endforeach
               @endif
            </div>
          </div>

        </div> -->



</div>
