@extends('layouts.cabad') 
@section('content')



<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Lista de Productos</h1>
<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($productos as $item)
                <tr>
                  <td>{{ $item->pro_id }}</td>
                  <td>{{ $item->pro_nombre }}</td>
          		    <td>{{ $item->pro_descripcion }}</td>
                  <td>
                    <a href="{{ url('admin.productos.edit', $item->id) }}" class="btn btn-info">
                      Editar
                    </a>
                    <a href="{{ url('admin.productos.delete', $item->id) }}" class="btn btn-danger">
                      Eliminar
                    </a>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {!! $productos->links() !!}
          </div>
        </div>
    @stop
