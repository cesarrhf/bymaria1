<?php


Route::get('test', function () {
    return view('emails.resumen');
});

Route::get('/', 'IndexController@index');
Route::get('donde', 'IndexController@donde');
Route::get('contacto', 'IndexController@contacto');
Route::resource('resumen', 'TiendaController@resumen');
Route::post('consultPresent', 'TiendaController@consultPresent');
Route::post('medioPago', 'TiendaController@medioPago');
Route::post('exito', 'TiendaController@medioPago');
Route::post('ultimoPasoTienda', 'TiendaController@ultimoPasoTienda');
Route::any('webpayExito',   'TiendaController@webpayExito');
Route::any('webpayFracaso', 'TiendaController@webpayFracaso');
Route::any('webpayCierre', 'TiendaController@webpayCierre');
Route::resource('tienda', 'TiendaController');
Route::post('contacto', 'IndexController@email');
Route::POST('comunas/getMarcadores', 'IndexController@getMarcadores');
Route::post('indexcomunas', 'IndexController@showss');
Route::resource('comunasreg', 'ComunasController@comunasxRegion');
Route::post('tienda/agregar',  'TiendaController@agregoItems');
Route::post('tienda/nuevo',  'TiendaController@nuevoPublico');
Route::post('tienda/agregarPvt',  'TiendaController@agregarPvt');
Route::post('tienda/borro', 'TiendaController@borroItems');
Route::post('tienda/nuevaPres/', 'TiendaController@addPress');
Route::post('tienda/updateCant', 'TiendaController@updateCant');
Route::post('listarZona', 'TiendaController@listarZona');



Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/admin', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    /*============= ESTE ES EL MODO ========*/
    Route::resource('presentaciones', 'PresentacionesController');
    Route::resource('productos', 'ProductosController');
    Route::resource('clientes', 'ClientesController');
    Route::resource('unidadesventas', 'UnidadesVentasController');
    Route::resource('Puniventa', 'PresentUniVentaController');
    Route::resource('pedidos', 'PedidosController');
    Route::resource('contactos', 'ContactosController');
    Route::resource('direcciones', 'DireccionesController');
    Route::resource('items', 'ItemsController');
    Route::resource('despachos', 'DespachosController');
    Route::post('comunasSelect', 'ComunasController@comunasSelect');
    Route::post('pedidos/NuevoPack', 'PedidosController@NuevoPack');
    Route::post('InsertPack', 'PedidosController@InsertPack');
    Route::post('uniPack', 'PedidosController@uniPack');
    Route::post('cliente/Coor', 'ClientesController@coordDire');
    Route::post('cliente/updatee', 'ClientesController@updatee');
    Route::get('createCli', function () {
        return view('admin.clientes.form.create');
    });
    Route::get('/contactos/getForm/{id}', 'ContactosController@show2');
    Route::post('/unidadesventas/cargaimg/{id}', 'UnidadesVentasController@cargaimg');
    Route::get('/unidadesventas/{id}/editarrelacion', 'UnidadesVentasController@editarRelacion');

    Route::post('graficos', 'ItemsController@Grafico');
    Route::get('despachos/create', 'DespachosController@crearZona');
    Route::post('despachos/storeZone', 'DespachosController@guardarZona');
    Route::post('listarZonaDespa', 'DespachosController@listarZonaDespa');
    Route::post('despachos/UpdateZone', 'DespachosController@UpdateZone');
    Route::post('despachos/BorraZone', 'DespachosController@BorraZone');

    // Route::post('graficos', 'ItemsController@fechaProducto');

    /*============ FIN =====================*/

    /*============= TODA ESTA BASURA DE ABAJO SIRVE, PERO NO ES LO RECOMENDADO========*/

    Route::get('/layouts/edit/{id}',  'IndexController@edit');
    Route::get('/productos/{myplace}',     'IndexController@reciboPro');
    //ruta con un nombre
    Route::delete('/productos/edit/{present}',['as' => 'present.destroy'    , 'uses' =>'PresentacionesController@destroy']);
    Route::post('/productos/edit/{present}',['as' => 'productos.guardar'    , 'uses' =>'PresentacionesController@guardar']);
    Route::put('/productos/edit/{present}',   ['as' => 'present.edit'       , 'uses' =>'PresentacionesController@edit']);
    Route::put('/productos/edit/pro/{img}',  ['as' => 'productos.upImgPro'   , 'uses' =>'ProductosController@upImgPro']);
    Route::put('/productos/edit/pres/{img}',  ['as' => 'present.upImgPres'   , 'uses' =>'PresentacionesController@upImgPres']);
});
