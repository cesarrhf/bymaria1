
<div class="panel panel-default">
  <div class="panel-heading">Administrativo </div>
  <div class="panel-body ">

                <div class="form-group">
                  <div class="col-md-3">
                    {{ Form::label('Tipo de Documento','Tipo de Documento') }}
                  </div>
                <div class="col-md-5">
                  <select name="selectTipoPago" id="selectTipoPago" class="form-control">
                    <option value="factura">Factura</option>
                    <option value="boleta">Boleta</option>
                  </select>
                </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                    {{ Form::label('Forma de Pago','Forma de Pago') }}
                  </div>
                <div class="col-md-5">
                  <select name="selectFormaPago" id="selectFormaPago" class="form-control">
                    <option value="webpay">Webpay</option>
                    <option value="transferencia">Transferencia</option>
                    <option value="cheque">Cheque</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="deposito">Deposito</option>
                    <option value="tarjeta">Tarjeta</option>
                  </select>
                </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                    {{ Form::label('Estado de Pago','Estado de Pago') }}
                  </div>
                <div class="col-md-5">
                  <select name="selectEstadoPago" id="selectEstadoPago" class="form-control">
                    <option value="pagado">Pagado</option>
                    <option value="no pagado">No Pagado</option>
                  </select>
                </div>
                </div>
                <div id="tipoPagoSelec" class="form-group">
                  <div class="col-md-3">
                       {{ Form::label('Numero de documento','Numero de documento') }}
                  </div>
                  <div class="col-md-5">
                    {{ Form::text('tipo_de_pago','', array('id'=>'numTipoPago','required','class'=>'form-control input-sm')) }}
                   </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                    {{ Form::label('Observacion de pedido','Observacion de pedido') }}
                  </div>
                  <div class="col-md-5">
                    {{ Form::textarea('ped_obs_pedido','', array('required','class'=>'form-control input-sm','rows'=>'3')) }}
                  </div>
                </div>

            </div>
           </div>
