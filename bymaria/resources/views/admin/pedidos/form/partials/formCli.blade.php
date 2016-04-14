
<div class="panel panel-default">
  <div class="panel-heading">Clientes </div>
  <div class="panel-body ">


              <div class="form-group">
                <div class="col-md-3">
                     {{ Form::label('Cliente','Cliente') }}
                </div>
                      <div class="col-md-9 col-lg-5">
                        <select id="txtCli" name="txtCli" class="selectpicker" data-width="100%" data-live-search="true" title=" " >
                          @if(isset($clientes))
                          @foreach($clientes as $item)
                          <option value="{{ $item->cli_id}}"  >{{ $item->cli_razon}} </option>
                          @endforeach
                          @endif
                        </select>

                    </div>
                </div>

                <div id="contaCli" class="">
                  @section('contacCli')
                    <div class="form-group">
                      <div class="col-md-3">
                           {{ Form::label('Contacto de cliente','Contacto de cliente') }}
                      </div>
                          <div class="col-md-9 col-lg-5">
                          <!-- <input type="text" list="datosCliCont" id="txtCliCont" class="form-control input-sm" > -->
                          <select id="datosCliCont" class="selectpicker" data-width="100%" data-live-search="true" title=" " >
                            @if(isset($contactosCli))
                            @foreach($contactosCli as $item)
                            <option value="{{$item->cont_id}}"  >{{$item->cont_nombre}} </option>
                            @endforeach
                            @endif
                          </select>

                        </div>
                      </div>
                    @show
                </div>

                <div id="formContaCli" class="">
                    @section('FormcontacCli')
                     @include('admin.pedidos.form.partials.formContcCli')
                      @show
                </div>
                @section('FormcontacDire')
                 @include('admin.pedidos.form.partials.formContDir')
                @show
              </div>
           </div>
