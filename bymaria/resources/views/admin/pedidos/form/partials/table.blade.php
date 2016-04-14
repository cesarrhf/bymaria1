
<div class="panel panel-default">
  <div class="panel-heading">Productos </div>
  <div class="panel-body">
    <div class="form-group">
      <div class="col-md-3">
           {{ Form::label('Lista Productos','Lista Productos') }}
      </div>
          <div class="col-md-5">
            <select id="txtUniVta" name="txtUniVta" class="selectpicker" data-width="100%" data-live-search="true" title=" " >
              @if(isset($uniVta))
              @foreach($uniVta as $item)
              <option value="{{ $item->uni_precio}},{{$item->uni_id}},{{ $item->uni_nombre}},{{ $item->uni_custom}}">{{ $item->uni_nombre}} </option>
              @endforeach
              @endif
            </select>
        </div>
  </div>

  <div class="form-group packProd hide">
    <div class="col-md-3">
         {{ Form::label('Productos Pack','Productos Pack') }}
    </div>
        <div class="col-md-5">
          <!-- <select id="packPro" name="packPro" class="selectpicker" data-width="100%" title=" " ></select> -->
      </div>
</div>

  <div class="form-group">
    <div class="col-md-3">
         {{ Form::label('Cantidad','Cantidad') }}
    </div>
      <div class="col-md-5">
        <input step="1" max="25000000" value="1" min="1" id="ped_cantidad_item" required="required" class="form-control input-sm" placeholder="" name="ped_cantidad_item" type="number">
       </div>
  </div>

  <div class="form-group">
    <div class="col-md-3">
         {{ Form::label('Precio','Precio') }}
    </div>
      <div class="col-md-5">
        {{ Form::number('item_precio_vta', '', array('step'=>'0' ,'max'=>'25000000','value'=>'0','min'=>'0','id'=>'item_precio_vta','required','class'=>'form-control input-sm', 'placeholder'=>'')) }}
     </div>
  </div>
  <div class="form-group">
    <div class="col-md-3">
         {{ Form::label('Descuento','Descuento') }}
    </div>
      <div class="col-md-5">
        <input step="0" max="25000000" value="0" min="0" id="costo_dscto" required="required" class="form-control input-sm" placeholder="" name="ped_descuento" type="number">
       </div>
  </div>



  {!!link_to('#', $title='Agregar', $attributes = ['id'=>'addPro', 'class'=>'btn btn-primary'], $secure = null)!!}

</div>


  <div class="table-responsive">
        <table class="table table-striped table-condensed miTablaPed">
          <thead>
            <tr>
                <th>Productos</th>
                <th>Cantidad</th>
                <th>Precio Unidad</th>
                <th>Precio Final</th>
                <th></th>
            </tr>
          </thead>
          <tfoot class="hide">

              <tr style="font-weight: bold;">

                <td></td>
                <td></td>
                <td>Subtotal</td>
                <td  style="border-top: 1px solid #999;"class="text-right sumSubTotal" data-valor="0">0</td>
                <td></td>
              </tr>
              <tr >
                <td></td>
                <td></td>
                <td>Despacho</td>
                <td class="text-right sumDespa" data-valor="0">0</td>
                <td></td>
              </tr>
            <tr >
              <td></td>
              <td></td>
              <td>Descuento</td>
              <td class="text-right sumDscto" data-valor="0">0</td>
              <td></td>
            </tr>
            <tr style="font-weight: bold;">
              <td></td>
              <td></td>
              <td>Neto</td>
              <td  style="border-top: 1px solid #999;" class="text-right sumNeto" data-valor="0">0</td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td>Iva</td>
              <td class="text-right sumIva">0</td>
              <td></td>
            </tr>
            <tr style="font-weight: bold;">
              <td></td>
              <td></td>
              <td>Total</td>
              <td style="border-top: 1px solid #999;" class="text-right sumTotal" data-valor="0">0</td>
              <td></td>
            </tr>
          </tfoot>
          <tbody>
          </tbody>
        </table>
      </div>
   </div>
