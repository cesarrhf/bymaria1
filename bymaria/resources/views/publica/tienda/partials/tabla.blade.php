


   <div class="col-xs-12 col-sm-6 col-md-5 "id="miTabla" >


       <!-- <h6>CARRO DE COMPRAS BY MARÍA</h6> -->
       <div class="col-xs-12 col-sm-12 col-md-12 text-center "id="miParrafo" >
         <div class="col-xs-12 col-sm-12 col-md-12 text-center " style="background-color: #777; color: white;">
          <h6  >CARRO DE COMPRAS BY MARÍA</h6>
         </div>
         <p> <small> “HAZ CLICK EN "AGREGAR" EN TU PRODUCTO FAVORITO"</small></p>
       </div>
       <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
       <div class="table-responsive hide "  id="miTablaTable"  >
        <!-- <div class="table-responsive"  data-spy="affix" data-offset-top="210"     > -->
            <table class="table table-condensed table-tienda   ">
              <thead>
                <tr>
                    <th colspan="5" bgcolor="grey" class="text-center thcab">
                        CARRO DE COMPRAS BY MARÍA
                     </th>
                </tr>
                <tr>
                    <th></th>
                    <th class="text-right"> Cantidad </th>
                    <th class="text-right">unidad</th>
                    <th class="text-right">precio</th>
                    <th class="miIconoBorra"></th>
                </tr>
              </thead>
              <tfoot >
                  <tr bgcolor="#777" >
                    <td colspan="3"> <p>TOTAL CARRO DE COMPRAS</p> </td>
                    <td class="text-right sumSubTotal">0</td>
                    <td></td>
                  </tr>
              </tfoot>
              <tbody>
                <!-- <tr>
                  <td></td>
                  <td colspan="4">
                    <select class="selectpicker form-control show-tick " data-container="body">
                        <optgroup label="Escoja un producto" >
                          <option value="1" title="Relish" data-content="<img width='50px' height='50px' src='imagenes/univta/ByMaria00.jpg'>Relish"></option>
                          <option value="1" title="Relish" data-content="<img width='50px' height='50px' src='imagenes/univta/ByMaria00.jpg'>Relish"></option>
                          <option value="1" title="Relish" data-content="<img width='50px' height='50px' src='imagenes/univta/ByMaria00.jpg'>Relish"></option>
                          <option value="1" title="Relish" data-content="<img width='50px' height='50px' src='imagenes/univta/ByMaria00.jpg'>Relish"></option>
                      </select>
                  </td>
                </tr> -->

                @if(isset($micarro))
                @foreach($micarro as $item)
                  @if( $item->uni_custom==2)
                  <tr class="miUnidadItem" data-padre="{{$item->uni_id_uni_root}}" data-id="{{$item->item_uni_id}}">

                  @else
                  <tr class="miUnidadItem"   data-id="{{$item->item_uni_id}}">

                  @endif
                  <td>
                    {{ $item->item_nombre }}
                    @if($item->uni_custom == 2 )
                    <?php $j=0; ?>

                    @foreach($mis_pack as $item3)

                    @if($item3->uni_id == $item->uni_id)
                    @if($j==0)
                    <table class="selecTienda" style="margin-top: 10px;">
                    @else
                    <table class="selecTienda">
                    @endif
                    <?php $j=$j+1; ?>
                       <tr>
                       <td>
                        <div style="margin-left:20px;">
                         <select title="SELECCIONA PRODUCTO {{$j}}" data-iduniVta="{{$item3->univ_id}}" class="selectpicker show-tick select  " data-container="body">

                              @foreach($misweas as $item2)

                                @if($item3->uni_id_uni_root  == $item2->uni_id)
                                  @if($item3->univ_pres_id == $item2->pres_id)
                                   <option   selected value="{{$item2->pres_id}}"  title="{{$item2->pres_nombre}}" data-content="<img width=50px height=50px src=imagenes/univta/{{$item2->pres_foto}}><span style=margin-left:5px;>{{$item2->pres_nombre}}</span>"></option>
                                   @else
                                    <option   value="{{$item2->pres_id}}"  title="{{$item2->pres_nombre}}" data-content="<img width=50px height=50px src=imagenes/univta/{{$item2->pres_foto}}><span style=margin-left:5px;>{{$item2->pres_nombre}}</span>"></option>
                                    @endif
                                @endif
                              @endforeach
                            </select>
                          </div>
                       </td>
                       </tr>
                      </table>
                      @endif
                    @endforeach
                @endif
                 </td>
                  <td class="cantCol text-right">
                    <input class="inputCantidad"  type="number" name="quantity" min="1" max="20" value="{{(int)$item->item_cantidad_pedida}}">
                  </td>
                  <td data-id="{{$item->item_precio_vta}}" class="precioUni text-right">{{$item->item_precio_vta}}</td>
                  <td class="valor text-right" data-valor="{{(int)$item->item_cantidad_pedida*(int)$item->item_precio_vta}}">{{(int)$item->item_cantidad_pedida*(int)$item->item_precio_vta}}</td>
                  <td><a href="#!" class="btn-xs btn-link btnDelete"><i class="fa fa-times"></i></a></td></tr>
                @endforeach
                @endif
              </tr>
              </tbody>
            </table>
          </div>
          <a style="width: 100%;height: 100%;padding: 15px;" href="#"  class="btn btn-primaryVenta2 hide " >HACER PEDIDO</a>
</div>
