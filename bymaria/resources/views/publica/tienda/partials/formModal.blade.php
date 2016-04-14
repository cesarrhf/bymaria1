<div class="col-xs-12 col-sm-12 col-md-12 col-centered ">
  <div class="panel panel-default ">

 <div class="panel-heading actives" style="    background-color: #777;"> <h4 class="panel-title"> contacto</h4></div>
 <div class="panel-body"><div class="col-sm-12 col-md-12 miFormContac  ">
      <!-- form.form-class>div.form-group*5>input.form-control  -->
     {!! Form::open([ 'id'=>'formContact', 'method' => 'post','class'=>'form-horizontal']) !!}
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
             <div class=" form-group  ">
                  {{ Form::text('contac_nombre','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Nombre')) }}
             </div>
            <div class="form-group">
                 {{ Form::text('contac_apellido','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Apellido')) }}
            </div>
            <div class="form-group">
              {{ Form::email('contac_correo','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Correo electronico')) }}
            </div>
            <div class="form-group">
              {{ Form::text('contac_asunto','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Asunto')) }}
              </div>
            <div class="form-group">
              {{ Form::textarea('contac_comentario','', array('required','class'=>'form-control input-sm' ,'rows'=>'3', 'placeholder'=>'Mensaje')) }}
            </div>
            <div class="col-md-12  text-center" style="padding-top: 20px">
            </div>

     <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-centered contactoStrong sinPadingRight sinPading ">
       <h6><strong>TIENDA/ SHOWROOM: </strong>Antupiren 9401, Local J, Peñalolén</h6>
       <h6><strong>HORARIO: </strong>Lunes a viernes de 10am a 6pm.</H6>
       <h6><strong>Teléfono: </strong>+56 9 6249 9192</H6>
       <h6><strong>MAIL: </strong>contacto@bymaria.cl</H6>
     </div> -->
 </div>
</div>

</div>
</div>
