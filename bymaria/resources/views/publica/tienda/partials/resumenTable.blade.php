   <div class="col-xs-12 col-sm-7 col-lg-7 col-sm-push-5    resumenCompra ">
     <div class=" col-xs-12 col-sm-12 bordeResumen">
       <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

      <h6>RESUMEN DE COMPRAS BY MARÍA</h6>
      <div class="table-responsive">
            <table class="table table-condensed resumen">
              <thead >
                <tr >
                  <th class="text-left">ITEM</th>
                   <th></th>
                    <th class="text-right">Cantidad</th>
                    <th class="text-right" >Unidad</th>
                    <th class="text-right" >Valor</th>
                </tr>
              </thead>
              <tfoot class="text-right">
                  <tr rowspan="2">
                    <td></td>
                    <td></td>
                    <td></td>
                      <td><p>SUBTOTAL</p></td>
                    <td class="text-right sumSubTotal">
                      @if (isset($miTotalFinalfinal))
                      <p>$<?php echo(number_format($miTotalFinalfinal,0,",",".")); ?></p>
                      @else
                      <p>0</p>
                      @endif

                    </td>
                  </tr>
                  <tr >
                    <td></td>
                    <td></td>
                    <td></td>
                      <td><p>ENVIO</p></td>
                      <?php   $mypass = password_hash(0, PASSWORD_DEFAULT); ?>
                    <td class="text-right Envio" data-envio="0" data-hash="{{$mypass}}">
                      @if (isset($precio_despacho))
                      <p>$<?php echo(number_format($precio_despacho,0,",",".")); ?></p>
                      @else
                      <p>$0</p>
                      @endif
                    </td>
                  </tr>
                  <tr class="text-center comprarPed">
                      <td colspan="4"   >
                       <p> TOTAL COMPRA </p>
                     </td>
                    <td   class="text-right sumTotal  ">
                      @if (isset($miTotalFinalfinal))
                        @if (isset($precio_despacho))
                        <p>$<?php echo(number_format($miTotalFinalfinal+$precio_despacho,0,",",".")); ?></p>
                        @else                      
                        <p>$<?php echo(number_format($miTotalFinalfinal,0,",",".")); ?></p>
                        @endif
                      @else
                       <p>$0</p>
                      @endif
                    </td>
                  </tr>
              </tfoot>
              <tbody>
                @if(isset($micarro))
                @foreach($micarro as $item)

                <tr data-id="{{$item->item_uni_id}}">
                  <td colspan="2">
                    {{ $item->item_nombre }}
                    <img src="imagenes/univta/{{$item->uni_foto}}" alt="" class="img-responsive thumbnail img-NO-responsive hidden-xs"/>
                  </td>

                  <td class="cantCol text-right"  data-cantidad="{{(int)$item->item_cantidad_pedida}}">
                   {{(int)$item->item_cantidad_pedida}}
                  </td>
                  <td data-id="{{$item->item_precio_vta}}" class="precioUni text-right">
                    @if (isset($miTotalFinalfinal))
                     $<?php echo(number_format($item->item_precio_vta,0,",",".")); ?>
                    @else
                    $<?php echo(number_format($item->item_precio_vta,0,",",".")); ?>

                     <!-- {{$item->item_precio_vta}} -->
                    @endif
                  </td>
                  <td style="text-align: right;" data-valor="{{(int)$item->item_cantidad_pedida*(int)$item->item_precio_vta}}" class="valor">
                    @if (isset($miTotalFinalfinal))
                    $<?php echo number_format(((int)$item->item_cantidad_pedida*(int)$item->item_precio_vta),0,",","."); ?>
                    @else
                    $<?php echo number_format(((int)$item->item_cantidad_pedida*(int)$item->item_precio_vta),0,",","."); ?>

                    <!-- {{(int)$item->item_cantidad_pedida*(int)$item->item_precio_vta}} -->
                    @endif
                  </td>
                @endforeach
                @endif
              </tr>
              </tbody>
            </table>
          </div>
   </div>
</div>
