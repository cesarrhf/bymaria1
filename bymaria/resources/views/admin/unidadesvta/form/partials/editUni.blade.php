
<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		 <h4 class="modal-title">Editar Presentaciones </h4>
		 @include('layouts.msjes')
		 
</div>
<div class="modal-body">

	@include('admin.unidadesvta.form.partials.gridImg')

 		<input type="hidden" name="id" value="{{ $id }}" id="id">
		{!! Form::open (['class'=>'form-horizontal', 'role'=>'form']) !!}
		<div class="form-group">
			 @include('admin.unidadesvta.form.partials.table')
		</div>
	{!!   Form::close()   !!}

	<div class="form-group te"></div>
</div>
<div class="modal-footer ">
		{!!link_to('#', $title='Registrar', $attributes = ['id'=>'registroPres', 'class'=>'btn btn-primary'], $secure = null)!!}


</div>
