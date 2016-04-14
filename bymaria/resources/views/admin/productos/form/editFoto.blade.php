
<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		 <h4 class="modal-title">Editar Foto</h4>

</div>
<div class="modal-body">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			{{ Form::open (['route'=>['present.upImgPres',':PRES_ID'],'method'=>'PUT','id'=>'form-upImgPres','file'=>true,'novalidate' => 'novalidate','class'=>'form']) }}

			<div class="form-group">

			<div class="image-upload">
					 <label for="pres_foto">
						  <img id="pres_foto_prinEdit" class="foto_principal" src="http://placehold.it/250x250"/>
						</label>
					 <input id="pres_foto" type="file" name="pres_foto"/>
			 </div>
 		 </div>
	<div class="te"></div>

</div>
<div class="modal-footer ">

	 	{{ Form::button('<i class="fa fa-check">Guardar</i>', array('type'=>'submit','class' => 'btn btn-primary pull-left')) }}
		{{ Form::close() }}
		{{-- link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'], $secure = null) --}}

</div>
