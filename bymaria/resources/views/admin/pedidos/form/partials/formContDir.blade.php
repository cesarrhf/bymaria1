
          <div class="form-group">
            <div class="col-md-3">
                 {{ Form::label('Direcciones del cliente','Direcciones del cliente') }}
            </div>
            <div id="Diress" class="">
              @section('Diress')
                          <div class="col-md-9 col-lg-5">
                            <select id="txtCliDir" class="selectpicker" data-width="100%" data-live-search="true" title="  " >
                              @if(isset($diressas))
                              @foreach($diressas as $item)
                              <option value="{{$item->dire_id}}"  >{{$item->dire_calle}} {{$item->dire_num}} </option>
                              @endforeach
                              @endif

                            </select>
                              @show
                          </div>

                          <!-- <input type="text" list="datosCliDirec" id="txtCliDir" class="form-control input-sm" >
                          <datalist id="datosCliDirec" >
                            @if(isset($cliDir))
                              @foreach($cliDir as $item)
                              <option data-id="{{$item->dire_id}} " value="{{$item->dire_calle}} {{$item->dire_num}} ">
                              @endforeach
                            @endif
                        </datalist> -->
                        </div>

            </div>

                <div class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Calle','Calle') }}
                  </div>
                        <div class="col-md-9 col-lg-5">
                            {{ Form::text('Calle', '', array('required','class'=>'form-control input-sm', 'placeholder'=>'')) }}

                         </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Numero','Numero') }}
                  </div>
                  <div class="col-md-9 col-lg-5">
                      {{ Form::text('numero','', array('required','class'=>'form-control input-sm', 'placeholder'=>'')) }}

                   </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Depto','Depto') }}
                  </div>
                  <div class="col-md-9 col-lg-5">
                      {{ Form::text('ped_cli_dpto','', array('required','class'=>'form-control input-sm', 'placeholder'=>'')) }}
                   </div>
                </div>


                <div class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Comuna','Comuna') }}
                  </div>
                  <div class="col-md-9 col-lg-5">
                      {{ Form::text('comuna','', array('required','class'=>'form-control input-sm', 'placeholder'=>'')) }}
                      <input type="text" id="ped_coordenadas" class="hide" name="ped_coordenadas" value="">

                   </div>
                </div>
