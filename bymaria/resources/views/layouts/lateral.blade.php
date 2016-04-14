
<div class="container-fluid">
      <div class="row">
       <div class="navbar-default sidebar" role="navigation">
                   <div class="sidebar-nav navbar-collapse">
                       <ul class="nav" id="side-menu">
                           <li>
                               <a href="#"><i class="fa fa-users fa-fw"></i> Productos<span class="fa arrow"></span></a>
                               @inject('menu','App\Http\Controllers\MenuController')
                                 <ul id="subMenuPro" class="nav nav-second-level">
                                 @foreach($menu->MenuPro() as $link)
                                  <li><a href="{{ url('productos/'.$link['pro_id'].'/edit') }}"></i> {{ $link['pro_nombre'] }}</a></li>
                                 @endforeach
                                 <li>
                                     <a href="{{ url('productos/create') }}"><i class='fa fa-plus fa-fw'></i> Agregar Producto</a>
                                 </li>
                                 </ul>
                           </li>

                           <li>
                               <a href="#"><i class="fa fa-film fa-fw"></i> Unidades de Venta <span class="fa arrow"></span></a>
                               <ul class="nav nav-second-level">
                                   <li>
                                     <a href="{{ url('unidadesventas/create') }}"><i class='fa fa-plus fa-fw'></i> Agregar Unidades</a>
                                   </li>
                                   <li>
                                       <a href="{{ url('unidadesventas/') }}"><i class='fa fa-list-ol fa-fw'></i> listar</a>
                                   </li>
                               </ul>
                           </li>

                           <li>
                               <a href="#"><i class="fa fa-child fa-fw"></i> Clientes<span class="fa arrow"></span></a>
                               <ul class="nav nav-second-level">
                                   <li>
                                       <a href="{{ url('clientes') }}"><i class='fa fa-list-ol fa-fw'></i> Listar</a>
                                   </li>
                               </ul>
                           </li>

                           <li>
                               <a href="#"><i class="fa fa-child fa-fw"></i>Pedidos<span class="fa arrow"></span></a>
                               <ul class="nav nav-second-level">
                                   <li>
                                      <a href="{{ url('pedidos/create') }}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                   </li>
                                   <li>
                                       <a href="{{ url('pedidos') }}"><i class='fa fa-list-ol fa-fw'></i> listar</a>
                                   </li>
                               </ul>
                           </li>
                           <li>
                               <a href="#"><i class="fa fa-child fa-fw"></i>Despachos<span class="fa arrow"></span></a>
                               <ul class="nav nav-second-level">
                                   <li>
                                      <a href="{{ url('pedidos/create') }}"><i class='fa fa-plus fa-fw'></i> Agregar Zona</a>
                                   </li>
                                   <li>
                                       <a href="{{ url('pedidos') }}"><i class='fa fa-list-ol fa-fw'></i> listar Zonas</a>
                                   </li>
                               </ul>
                           </li>

                       </ul>
                   </div>
               </div>
