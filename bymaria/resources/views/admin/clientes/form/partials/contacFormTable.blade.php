<div class="form-group">
      @if(isset($contactosCli))
      <div class="form-group">
        <a id="btnCliContEdit" href= "#!" class="btn btn-success"><i class="fa fa-plus"></i> Agregar Contacto</a>
      </div>

      @else

      @endif
  <h4 class="text-center">Contacto</h4>
<div class="table-responsive">
            <table id="tableContact" class="table table-striped table-condensed table-bordered">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Telefono</th>
                  <th>Correo</th>
                  @if(isset($contactosCli))
                    <th>Accion</th>
                  @else
                  @endif
              </tr>
              </thead>
              <tbody>
                @if(isset($contactosCli))
                  @foreach($contactosCli as $item)
                  <tr data-id="{{$item->cont_id}}">
                      <td class="edit-enabled">{{ $item->cont_nombre }}</td>
                      <td class="edit-enabled">{{ $item->cont_apellido }}</td>
                      <td class="edit-enabled">{{ $item->cont_telefono }}</td>
                      <td class="edit-enabled">{{ $item->cont_email }}</td>
                      <td class="edit-disabled">
                        <a href= "#!" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                      </td>
                  </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          @if(isset($direcCli))
            <a id="btnCliDirEdit" href= "#!" class="btn btn-success"><i class="fa fa-plus"></i> Agregar Direciones</a>
            @endif
            <h4 class="text-center">Direcciones</h4>

          <div class="table-responsive">
                      <table id="tableDirec" class="table table-striped table-condensed table-bordered">
                        <thead>
                          <tr>
                            <th>Comuna</th>
                            <th>Calle</th>
                            <th>Numero</th>
                            <th>Departamento</th>
                            @if(isset($direcCli))
                              <th>Accion</th>
                            @else
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                          @if(isset($direcCli))

                            @foreach($direcCli as $item)
                            <tr data-id="{{$item->dire_id}}">
                                <td class="edit-disabled">
                                     <select class="selectpicker" data-live-search="true" title=" " data-container="body" >
                                      @foreach($comuna as $item2)
                                          @if($item2->COMUNA_ID == $item->dire_id_comu)
                                            <option value="{{ $item2->COMUNA_ID}}" selected >{{ $item2->COMUNA_NOMBRE}} </option>
                                          @else
                                            <option value="{{ $item2->COMUNA_ID}}"  >{{ $item2->COMUNA_NOMBRE}} </option>
                                          @endif
                                      @endforeach
                                    </select>
                                </td>
                                <td class="edit-enabled mapa_calle">{{ $item->dire_calle }}</td>
                                <td class="edit-enabled mapa_num">{{ $item->dire_num }}</td>
                                <td class="edit-enabled">{{ $item->dire_dpto }}</td>
                                <td class="edit-disabled">
                                  <a href= "#!" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>

        </div>
