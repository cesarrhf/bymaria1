@extends('layouts.app')
@section('content')
<!-- Small boxes (Stat box) -->
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>150</h3>
                <p>Pedidos con pago pendiente</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Pedidos con WEBPAY</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>44</h3>
                <p>Pedidos con Transferencia</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>65</h3>
                <p>Despachos Pendientes</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
</div><!-- /.row -->



<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right ui-sortable-handle">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Grafico Pedidos</li>
          </ul>
            <!-- Tabs within a box -->

            <div class="tab-content no-padding">
              <div id="reportrange" style="margin: 0 auto; width: 200px; background: #fff; cursor: pointer;padding: 5px 10px;border: 1px solid #ccc;"  >
                 <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                 <span></span> <b class="caret"></b>
               </div>
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
             </div>
        </div><!-- /.nav-tabs-custom -->


    </section><!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">
      <!-- TO DO List -->
      <div class="box box-primary">
          <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title">Productos vendidos desde hoy a 30 dias</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <ul class="todo-list">
            @if(isset($list_productos))
             @foreach($list_productos as $item)
               @if(isset($ventas_mes))
                  @foreach($ventas_mes as $item2)
                    @if($item2->pro_id == $item->pro_id)
                    <li><span class="text">{{$item->pro_nombre}}</span> {{$item2->suma}}</li>
                    @endif
                  @endforeach
                 @endif
              @endforeach
            </ul>
           @endif
          </div><!-- /.box-body -->
          <div class="box-footer clearfix no-border"></div>
      </div><!-- /.box -->
</div>
  </section><!-- right col -->
</div><!-- /.row (main row) -->
@endsection
@section('scripts')
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('/dist/js/pages/dashboard.js') }}" type="text/javascript"></script> -->
<script src="{{ asset('/assets/js/AdminIndex.js') }}" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('/dist/js/demo.js') }}" type="text/javascript"></script> -->
@endsection
