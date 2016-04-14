

  {!! Form::open (['class'=>'form-horizontal', 'role'=>'form','id'=>'formCli']) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
      <div class="form-group">
      <div class="col-sm-12  col-md-12 col-centered">
        <div class="col-xs-12 col-md-4 text-center">
          <div class="form-group ">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                      <div class="image-upload">
                           <label for="cli_foto">
                             @if(isset($clienteRequest))
                             <img id="cli_foto_prin" class="img-responsive" src="imagenes/Logos Clientes/{{ $clienteRequest->cli_foto}}"/>                             
                             @else
                             <img id="cli_foto_prin" class="img-responsive" src="http://placehold.it/250x250"/>
                             @endif
                           </label>
                           <input id="cli_foto" type="file" name="Imagen_Cliente"/>
                       </div>
                </div>
              </div>
        </div>
        @if(isset($clienteRequest))
        <input type="hidden" name="id" value="{{ $clienteRequest->cli_id}}" id="id">

        <div class="has-feedback col-xs-12 col-md-8">
            <div class="form-group ">
              <div class="col-xs-2 col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  Rut  </p>
              </div>
              <div class="col-xs-9 col-md-8 col-sm-6  ">
                {{ Form::text('rut',$clienteRequest->cli_rut, array('required','class'=>'form-control input-sm', 'placeholder'=>'Rut')) }}
                <i class="form-control-feedback fa fa-apple"></i>
              </div>
          </div>
          <div class="form-group">
            <div class="col-xs-2 col-md-4 col-sm-4 text-right">
               <p>  Razon Social  </p>
            </div>
                        <div class="col-xs-9 col-md-8 col-sm-6  ">
                          {{ Form::text('Razon_social',$clienteRequest->cli_razon, array('required','class'=>'form-control input-sm', 'placeholder'=>'Razon')) }}
                          <i class="form-control-feedback fa fa-apple"></i>
                        </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  Clave  </p>
              </div>
                    <div class="col-xs-9 col-md-8 col-sm-6  ">
                     {{ Form::text('Clave',$clienteRequest->cli_clave, array('required','class'=>'form-control input-sm', 'placeholder'=>'Clave')) }}
                       <i class="form-control-feedback fa fa-align-justify"></i>
                     </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  Telefóno  </p>
              </div>
                    <div class="col-xs-9 col-md-8 col-sm-6  ">
                     {{ Form::text('Telefono',$clienteRequest->cli_telefono, array('required','class'=>'form-control input-sm', 'placeholder'=>'Telefono')) }}
                       <i class="form-control-feedback fa fa-align-justify"></i>
                     </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  Correo  </p>
              </div>
                    <div class="col-xs-9 col-md-8 col-sm-6  ">
                     {{ Form::text('Correo',$clienteRequest->cli_correo, array('required','class'=>'form-control input-sm', 'placeholder'=>'Correo')) }}
                       <i class="form-control-feedback fa fa-align-justify"></i>
                     </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  URL  </p>
              </div>
                    <div class="col-xs-9 col-md-8 col-sm-6  ">
                     {{ Form::text('cli_http',$clienteRequest->cli_http, array('required','class'=>'form-control input-sm', 'placeholder'=>'Dirección web')) }}
                       <i class="form-control-feedback fa fa-align-justify"></i>
                     </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-md-4 col-sm-4 text-right">

              </div>
                    <div class="col-xs-9 col-md-8 col-sm-6  ">
                      @if ($clienteRequest->cli_vende==0)
                      {{ Form::label('name', 'Distribuidor', array('class' => 'control-label')) }}  {{ Form::checkbox('cli_vende', 0, null, ['class' => 'field']) }}
                      @else
                      {{ Form::label('name', 'Distribuidor', array('class' => 'control-label')) }}  {{ Form::checkbox('cli_vende', 1, null, ['class' => 'field','checked' =>'checked']) }}

                      @endif
                   </div>
            </div>
          </div>
        @else

        <div class="has-feedback col-xs-12 col-md-8">


            <div class="form-group ">
              <div class="col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  Rut  </p>
              </div>
                        <div class="col-xs-9 col-md-8 col-sm-6  ">
                           {{ Form::text('rut','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Rut')) }}
                      <i class="form-control-feedback fa fa-apple"></i>
                    </div>
          </div>
          <div class="form-group">
            <div class="col-xs-2 col-xs-2 col-md-4 col-sm-4 text-right">
               <p>  Razon Social  </p>
            </div>
            <div class="col-xs-9 col-md-8 col-sm-6  ">
              {{ Form::text('cli_razon','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Razon')) }}
              <i class="form-control-feedback fa fa-apple"></i>
            </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  Clave  </p>
              </div>
              <div class="col-xs-9 col-md-8 col-sm-6  ">
               {{ Form::text('cli_clave','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Clave')) }}
                 <i class="form-control-feedback fa fa-align-justify"></i>
               </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  Telefono  </p>
              </div>
                    <div class="col-xs-9 col-md-8 col-sm-6  ">
                     {{ Form::text('cli_telefono','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Telefono')) }}
                       <i class="form-control-feedback fa fa-align-justify"></i>
                     </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  Correo  </p>
              </div>
                    <div class="col-xs-9 col-md-8 col-sm-6  ">
                     {{ Form::text('cli_correo','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Correo')) }}
                       <i class="form-control-feedback fa fa-align-justify"></i>
                     </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-md-4 col-sm-4 text-right">
                 <p>  URL  </p>
              </div>
                    <div class="col-xs-9 col-md-8 col-sm-6  ">
                     {{ Form::text('cli_http','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Dirección web')) }}
                       <i class="form-control-feedback fa fa-align-justify"></i>
                     </div>
            </div>
            <div class="form-group">
              <div class="col-xs-2 col-md-4 col-sm-4 text-right">

              </div>
                    <div class="col-xs-9 col-md-8 col-sm-6 col-lg ">
                      {{ Form::label('name', 'Distribuidor', array('class' => 'control-label')) }}  {{ Form::checkbox('cli_vende', 0, null, ['class' => 'field','checked' =>'checked']) }}
                   </div>
            </div>
          </div>
        @endif

              </div>

              </div>

               {!!   Form::close()   !!}
               @if(isset($contactosCli))
               {!!link_to('#', $title='Guardar Edicion', $attributes = ['id'=>'editCli', 'class'=>'btn btn-primary'], $secure = null)!!}
               @else
               <div class="col-sm-12 text-center">
                 {!!link_to('#', $title='Registrar', $attributes = ['id'=>'registroCli', 'class'=>'btn btn-primary'], $secure = null)!!}

                 <a id="btnCliEdit" href= "#!" class="btn  disabled btn-success"><i class="fa fa-plus"></i> Agregar Contacto </a>
                 <a id="btnDirEdit" href= "#!" class="btn  disabled btn-success"><i class="fa fa-plus"></i> Agregar Direccion </a>
               </div>

               @endif
