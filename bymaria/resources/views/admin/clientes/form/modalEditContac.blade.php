
<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		 <h4 class="modal-title">Editar Contacto de Clientes </h4>
		 <div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none"> </div>
	 	<div id="msj-fail" class="alert alert-danger alert-dismissible" role="alert" style="display:none"> </div>
</div>
<div class="modal-body">
	<div class="row row-centered">



  	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
		<div class="form-group">
		@include('admin.clientes.form.partials.cliForm')
		</div>
		<div class="col-md-12 myMapa hide">
			<input type="text" name="coordenadas" value="" class="hide">
					<div class="text-center" id="resultado"></div>
					<div class="msjeConfirma text-center hide">
						<p>  CONFIRME SU DIRECCION  </p>
					</div>
					<div class="col-md-12 form-group">
						<div style="height:300px;" class="mapaDire" id="mapa"></div>
					</div>
					<div class="confirmar form-group  text-center hide">
						{!!link_to('', $title='CONFIRMAR', $attributes = ['id'=>'btnConfirma', 'class'=>'btn btn-warning'], $secure = null)!!}
						<a href="#"   class="btn btn-primaryContac no-activo hide btnConfi" style="pointer-events: none;cursor: default;">CONFIRMADO</a>
					</div>
					<div class="alert alert-danger hide">
						 <p>!NO CONFIRMÓ DIRECCIÓN!  Debe confirmar direccion para continuar.</p>
					</div>
		</div>
		<div class="form-group col-sm-12">
		@include('admin.clientes.form.partials.contacFormTable')
		</div>


</div>
</div>

<div class="modal-footer ">
	{!!link_to('#', $title='Borrar Cliente', $attributes = ['id'=>'BorraCli', 'class'=>'btn btn-danger'], $secure = null)!!}

</div>
<script type="text/javascript">
	$('.selectpicker').selectpicker({
	 title: 'Seleccione Comuna',
		dropupAuto: false ,
		width:'100%'
	});
</script>
