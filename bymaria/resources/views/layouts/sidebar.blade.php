<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <!-- <li class="header">MAIN NAVIGATION</li> -->
            @if (Request::is('productos/*'))
                <li class="active treeview">
            @else
                 <li class="treeview">
            @endif
                <a href="#">
                <i class="fa fa-dashboard"></i> <span>Productos</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  @inject('menu','App\Http\Controllers\MenuController')
                  @foreach($menu->MenuPro() as $link)
                   <li><a href="{{ url('productos/'.$link['pro_id'].'/edit') }}"><i class="fa fa-circle-o"></i> {{ $link['pro_nombre'] }}</a></li>
                  @endforeach
                    <!-- <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li> -->
                    <!-- <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li> -->
                    <li>
                        <a href="{{ url('productos/create') }}"><i class="fa fa-circle-o"></i> Agregar Producto</a>
                    </li>
              </ul>
             </li>
             @if (Request::is('unidadesventas') || Request::is('unidadesventas/*'))
                 <li class="active treeview">

             @else
                  <li class="treeview">
             @endif
                 <a href="#">
                 <i class="fa fa-dashboard"></i> <span>Unidades de Ventas</span> <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu">
                    <li><a href="{{ url('unidadesventas/create') }}"><i class="fa fa-circle-o"></i> Agregar Unidades</a>
                      <li>
                         <a href="{{ url('unidadesventas/') }}"><i class="fa fa-circle-o"></i> Listar</a>
                     </li>
               </ul>
              </li>
              @if (Request::is('clientes') || Request::is('createCli'))
                  <li class="active treeview">
              @else
                   <li class="treeview">
              @endif
                  <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="{{ url('clientes') }}"><i class="fa fa-circle-o"></i></i> Listar</a></li>

                </ul>
               </li>
               @if (Request::is('pedidos/*') || Request::is('pedidos'))
                   <li class="active treeview">
               @else
                    <li class="treeview">
               @endif
                   <a href="#">
                   <i class="fa fa-dashboard"></i> <span>Pedidos</span> <i class="fa fa-angle-left pull-right"></i>
                   </a>
                   <ul class="treeview-menu">
                      <li><a href="{{ url('pedidos/create') }}"><i class="fa fa-circle-o"></i></i> Agregar Pedido</a></li>
                  </ul>
                   <ul class="treeview-menu">
                      <li><a href="{{ url('pedidos') }}"><i class="fa fa-circle-o"></i></i> Listar</a></li>
                  </ul>
                </li>
                @if (Request::is('despachos/*') || Request::is('despachos'))
                    <li class="active treeview">
                @else
                     <li class="treeview">
                @endif
                    <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Despachos</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                       <li><a href="{{ url('despachos/create') }}"><i class="fa fa-circle-o"></i></i> Agregar zona</a></li>
                   </ul>
                   
                 </li>
           </ul>
    </section>
    <!-- /.sidebar -->
</aside>
