<div id="categoria_compra" >
  <div class="col-xs-12  col-sm-12 col-lg-10 col-centered">
    <div class="col-xs-12 col-sm-5 col-md-4      col-centered">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

          <div   class="panel-heading actives" role="tab" id="headingOne">
            <h4 class="panel-title">
              DÓNDE COMPRAR BY MARIA
            </h4>
          </div>
        </a>

          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            @include('publica.donde.partials.panelComprar')
          </div>
        </div>
        <div class="panel panel-default">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <div   class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                DÓNDE COCINAN CON BYMARÍA
            </h4>
          </div>
        </a>

          <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            @include('publica.donde.partials.panelComer')
          </div>
        </div>
      </div>
    </div>
     <div class="col-xs-12 col-sm-7 col-md-8     ">
       <div id="map-container_pro"></div>
     </div>
  </div>
</div>
