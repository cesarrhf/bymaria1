
<div class="panel panel-default">
  <div class="panel-heading">Despacho </div>
  <div class="panel-body">
    <div class="form-group">
      <div class="col-md-3">
           {{ Form::label('Costo de despacho','Costo de despacho') }}
      </div>
        <div class="col-md-9 col-lg-5">
          <input step="0" max="25000000" value="0" min="0" id="costo_despacho" required="required" class="form-control input-sm" placeholder="" name="ped_despacho" type="number">
       </div>
    </div>
              <div class="form-group">
                <div class="col-md-3">
                     {{ Form::label('Fecha despacho','Fecha despacho') }}
                </div>
                <div class="col-md-9 col-lg-5">
                  {{ Form::input('date', 'fecha_despacho',null, ['class' => 'form-control input-sm']) }}
               </div>
              </div>

              <div class="form-group">
                <div class="col-md-3">
                     {{ Form::label('Observacion de despacho','Observacion de despacho') }}
                </div>
                <div class="col-md-9 col-lg-5">
                       {{ Form::textarea('ped_obs_despacho','', array('required','class'=>'form-control input-sm' ,'rows'=>'3')) }}
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-3">
                     {{ Form::label('Orden de despacho','Orden de despacho') }}
                </div>
                <div class="col-md-9 col-lg-5">
                  {{ Form::text('ped_orden_despacho','', array('required','class'=>'form-control input-sm')) }}
                </div>
              </div>
            </div>
            </div>
