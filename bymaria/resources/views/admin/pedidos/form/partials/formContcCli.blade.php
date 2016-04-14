
                <div class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Nombre','Nombre') }}
                  </div>
                        <div class="col-md-9 col-lg-5">
                            {{ Form::text('Nombre_Cliente', '', array('required','class'=>'form-control input-sm', 'placeholder'=>'')) }}

                         </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Apellido Materno','Apellido Materno') }}
                  </div>
                  <div class="col-md-9 col-lg-5">
                      {{ Form::text('ped_cli_materno','', array('required','class'=>'form-control input-sm', 'placeholder'=>'')) }}

                   </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Apellido Paterno','Apellido Paterno') }}
                  </div>
                  <div class="col-md-9 col-lg-5">
                      {{ Form::text('Apellido_Paterno','', array('required','class'=>'form-control input-sm', 'placeholder'=>'')) }}

                   </div>
                </div>


                <div class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Telefono','Telefono') }}
                  </div>
                  <div class="col-md-9 col-lg-5">
                      {{ Form::text('Telefono','', array('required','class'=>'form-control input-sm', 'placeholder'=>'')) }}
                   </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Email','Email') }}
                  </div>
                  <div class="col-md-9 col-lg-5">
                      {{ Form::text('Correo','', array('required','class'=>'form-control input-sm', 'placeholder'=>'')) }}

                   </div>
                </div>
