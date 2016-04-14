
<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		 <h4 class="modal-title">Crear Clientes </h4>
		 <div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none" > </div>
		 <div id="msj-fail" class="alert alert-danger alert-dismissible" role="alert" style="display:none" > </div>
</div>

<div class="modal-body">
  	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
		<div class="form-group">
			 @include('admin.clientes.form.partials.cliForm')
		</div>
	<div id="contacPartials">
		@include('admin.clientes.form.partials.contacFormTable')
		</div>
</div>
<div class="modal-footer ">
{!!   Form::close()   !!}
</div>
