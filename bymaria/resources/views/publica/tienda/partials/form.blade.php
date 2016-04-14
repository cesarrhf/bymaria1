
{!! Html::script('assets/js/bootstrap-select/dist/js/bootstrap-select.js') !!}
<link rel="stylesheet" href="{{ URL::asset('assets/js/bootstrap-select/dist/css/bootstrap-select.css') }}" />
{!! Html::script('assets/js/mapaTienda.js') !!}
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

<div class="col-xs-12 col-sm-5 col-lg-5 col-sm-pull-7   bordeResumen miFormContac   ">
<div class="col-xs-12 col-sm-12">
         <!-- form.form-class>div.form-group*5>input.form-control  -->
  {!! Form::open(['id'=>'formTienda', 'method' => 'post','class'=>'form-horizontal']) !!}
  <div class="form-group">
    <h6> CONTACTO Y DIRECCIÓN DE ENVÍO </h6>
    <p> Correo Electronico  </p>
    {{ Form::email('ped_cli_email','', array( 'type'=>'email','required','class'=>'form-control input-sm', 'placeholder'=>'Email')) }}
    <p>Recibo y comprobante será enviado a este correo. </p>
  </div>
           <div class="form-group">
             <h6> DIRECCIÓN DE ENVÍO </h6>
               <div class=" form-group  ">
                   <div class="col-md-6">
                     <div class="form-group2">
                       {{ Form::text('ped_cli_nombre','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Nombre')) }}
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group2">
                     {{ Form::text('ped_cli_paterno','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Apellido')) }}
                   </div>
                   </div>
                   <div class="col-md-12">
                    <div class="form-group2" >
                     <select  class="selectpickeRegion form-control" data-live-search="true"  >
                      @if(isset($region))
                      @foreach($region as $item)
                      <option style="font-size:1em;" value="{{  $item->REGION_ID}}"  >{{ $item->REGION_NOMBRE}} </option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                 </div>
                 <div class="col-md-12">
                   <div class="form-group2">
                     <select name="txtComu" id="txtComu"  class="selectpickeComu  form-control" data-live-search="true" >
                     </select>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class=" form-group2  ">
                   {{ Form::text('ped_cli_calle','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Dirección')) }}
                  </div>
                 </div>
                 <div class="col-md-3">
                   <div class=" form-group2  ">
                   {{ Form::text('ped_cli_num','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Número','id'=>'ped_cli_num')) }}
                  </div>
                 </div>
                 <div class="col-md-3">
                   <div class=" form-group2  ">
                    {{ Form::text('ped_cli_dpto','', array( 'required','class'=>'form-control input-sm', 'placeholder'=>'Depto/Of')) }}
                  </div>
                 </div>
                 <div class="col-md-12">
                       <div class="text-center" id="resultado"></div>
                       <div class="msjeConfirma text-center hide">
                         <p>  CONFIRME SU DIRECCION   </p>
                       </div>
                       <div class="col-md-12">
                         <div class="mapaTienda   " id="mapa"></div>
                       </div>
                       <div class="confirmar form-group  text-center hide">
                         {!!link_to('', $title='CONFIRMAR', $attributes = ['id'=>'btnConfirma', 'class'=>'btn btn-primaryContac'], $secure = null)!!}
                         <a href="#"   class="btn btn-primaryContac no-activo hide" style="pointer-events: none;cursor: default;">CONFIRMADO</a>
                       </div>
                       <div class="alert alert-danger hide">
                          <p>!NO CONFIRMÓ DIRECCIÓN!  Debe confirmar direccion para continuar.</p>
                      </div>
                 </div>
                 <div class="col-md-12">
                   <div class="form-group2">
                     {{ Form::tel('ped_cli_celular','', array('pattern'=> '[0-9]{9}', 'required','class'=>'form-control input-sm', 'placeholder'=>'Télefono de Contacto')) }}
                     <p> ejemplo: 973844043 </p>
                   </div>
                 </div>
               </div>
           </div>
           <div class="form-group ">
             <input class='' type="text" name="coordenadas"  id="coordenadas">
           </div>
           <div class="col-md-12  text-center" style="padding-top: 20px">
             {!! Form::submit('Enviar', ['class'=>'btn btn-primaryContac'] ) !!}
           </div>
          {!! Form::close() !!}
  </div>
</div>
