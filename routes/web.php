<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Persona_controller;
use App\Http\Controllers\articulo_controller;
use App\Http\Controllers\categoriaArticulo_controller;
use App\Http\Controllers\comprasCliente_controller;
use App\Http\Controllers\comprasProveedor_controller;
use App\Http\Controllers\ubicaciones_controller;
use App\Http\Controllers\cliente_controller;
use App\Http\Controllers\empleado_controller;
use App\Http\Controllers\abono_controller;
use App\Http\Controllers\Municipio_controller;
use App\Http\Controllers\Colonia_controller;
use App\Http\Controllers\Unidad_controller;
use App\Http\Controllers\presupuestos_controller;
use App\Http\Controllers\Proveedores_controller;
use App\Models\Articulo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/logout', [empleado_controller::class, 'logout'])->name('logout');

Route::get('/compraNewClient', function () {
    return view('comprasClienteNuevo');
});
Route::get('/seleccionCompra', function () {
    return view('compras');
});


Route::get('/tuInicioCobrador', function () {
    return view('paginaInicioCobrador');
});

Route::get('/compraClient', function () {
    return view('comprasClienteExistente');
});

Route::get('/clientesRegistrados', function () {
    return view('listaClientes');
});





Route::get('/AggUsers', function () {
    return view('agregarEmpleado');
})->name('formEmpleado');

Route::get('/AggProvee', function () {
    return view('agregarProveedor');
})->name('formProveedor');

Route::get('/compraEspecifica', function () {
    return view('detalleCompra');
});
Route::get('/compraEspecifica', function () {
    return view('detalleCompra');
});
Route::get('/articuloAgregar', function () {
    return view('formularioArticulos');
})->name('articleAgg');
Route::get('/movimientosVision', [articulo_controller::class, 'todosmovimientosArticulos'])->name('movimientos.mostrar');

//MUNICIPIO CRUD
Route::get('/municipioVision', [Municipio_controller::class, 'mostrar'])->name('municipio.vista');
Route::post('/aggMunicipio', [Municipio_controller::class,"insertar"])->name('municipio.insertar');
Route::post('/bajaMunicipio/{pkMunicipio}', [Municipio_controller::class,"baja"])->name('municipio.baja');
Route::post('/UpdateMunicipio/{pkMunicipio}', [Municipio_controller::class,"editar"])->name('municipio.actualizar');
Route::get('/mostrarMunicipio/{pkMunicipio}', [Municipio_controller::class, 'mostrarPorId'])->name('municipio.mostrarPorId');



Route::get('/clienteEspecifico/{pkCliente}', [cliente_controller::class, 'mostrarClientePorId'])->name('cliente.comprasEspecificas');




//COLONIA CRUD
Route::get('/coloniaVision', [Colonia_controller::class, 'mostrar'])->name('colonia.vista');
Route::post('/aggColonia', [Colonia_controller::class,"insertar"])->name('colonia.insertar');
Route::post('/bajaColonia/{pkColonia}', [Colonia_controller::class,"baja"])->name('colonia.baja');
Route::post('/UpdateColonia/{pkColonia}', [Colonia_controller::class,"editar"])->name('colonia.actualizar');
Route::get('/mostrarColonia/{pkColonia}', [Colonia_controller::class, 'mostrarPorId'])->name('colonia.mostrarPorId');

//UNIDAD CRUD
Route::get('/unidadVision', [Unidad_controller::class, 'mostrar'])->name('unidad.vista');
Route::post('/aggUnidad', [Unidad_controller::class,"insertar"])->name('unidad.insertar');
Route::post('/bajaUnidad/{pkUnidad}', [Unidad_controller::class,"baja"])->name('unidad.baja');
Route::post('/UpdateUnidad/{pkUnidad}', [Unidad_controller::class,"editar"])->name('unidad.actualizar');
Route::get('/mostrarUnidad/{pkUnidad}', [Unidad_controller::class, 'mostrarPorId'])->name('unidad.mostrarPorId');



//CATEGORIA ARTICULO CRUD

Route::get('/categoriaArticuloVision', [categoriaArticulo_controller::class, 'mostrar'])->name('categoriaArticulo.vista');

Route::post('/aggCategoriaArticulo', [categoriaArticulo_controller::class,"insertar"])->name('categoriaArticulo.insertar');

Route::post('/bajaCategoriaArticulo/{pkArticulo}', [categoriaArticulo_controller::class,"baja"])->name('categoriaArticulo.baja');

Route::post('/UpdateCategoriaArticulo/{pkCategoriaArticulo}', [categoriaArticulo_controller::class,"editar"])->name('categoriaArticulo.actualizar');


Route::get('/mostrarCategoriaArticuloPorId/{pkCategoriaArticulo}', [categoriaArticulo_controller::class, 'mostrarPorId'])->name('categoriaArticulo.mostrarPorId');


/// COMPRAS A PROVEEDOR/////
Route::post('/aggCompraProveedor', [comprasProveedor_controller::class,"agregarProveedorBuy"])->name('compraProveedor.insertar');
Route::get('/provDetalleCompra/{pkCompraProveedor}/{vista?}', [comprasProveedor_controller::class,"mostrarDetallesPorIdCompraProveedor"])->name('compraProveedor.detalle');
Route::get('/generalBuysProveedores', [comprasProveedor_controller::class,"comprasGenerales"])->name('compraProveedor.general');
Route::get('/proveedorEspecifico', [comprasProveedor_controller::class,"mostrarproveedorPorId"])->name('compraProveedor.ver');

Route::get('/compraProveedor', [comprasProveedor_controller::class,"todosLosArticulosYProveedores"])->name('compraProveedor.realizar');


///////////////////////////          /////////////////////////////////////



Route::post('/aggArticulo', [articulo_controller::class,"agregarArticulo"])->name('articulo.insertar');
Route::post('/updateArticulo', [articulo_controller::class,"actualizarArticulo"])->name('articulo.actualizar');
Route::post('/bajaArticulo/{pkArticulo}', [articulo_controller::class,"baja"])->name('articulo.baja');

Route::get('/articuloDetails/{pkArticulo}/{vista?}', [articulo_controller::class, 'articuloDetalle'])->name('articulo.detalle');
Route::post('/articuloMovement/{pkArticulo}', [articulo_controller::class, 'movimientosArticulo'])->name('articulo.Movimiento');



Route::get('/tuInicio', [comprasCliente_controller::class,"articulosVendidos"])->name('paginaInicio');


Route::post('/aggCompraNewClient', [comprasCliente_controller::class,"agregarNewClientBuy"])->name('compra.insertar');

Route::post('/aggCompraClient', [comprasCliente_controller::class,"agregarClientBuy"])->name('compraCExistente.insertar');

Route::get('/opcionesColoniasId', [ubicaciones_controller::class, 'obtenerColoniasId'])->name('Ubicaciones.coloniasId');

Route::get('/opcionesColoniasString', [ubicaciones_controller::class, 'obtenerColoniasString'])->name('Ubicaciones.coloniasString');
Route::get('/opcionesCallesId', [ubicaciones_controller::class, 'obtenerCallesId'])->name('Ubicaciones.callesId');
Route::get('/opcionesCallesString', [ubicaciones_controller::class, 'obtenerCallesString'])->name('Ubicaciones.callesString');

Route::get('/compraNewClient', [articulo_controller::class, 'todosLosArticulos'])->name('buscarArticulo');
Route::get('/compraClient', [articulo_controller::class, 'todosLosArticulos2'])->name('buscarArticulo2');
Route::get('/articulesList', [articulo_controller::class, 'todosLosArticulos3'])->name('buscarArticulo3');


////CLIENTE CRUD///////////////////////////7
Route::get('/ClienteBusqueda', [cliente_controller::class, 'buscarCliente'])->name('buscarCliente');

Route::get('/ComprasBusqueda/{pkCliente}', [cliente_controller::class, 'mostrarClientePorId'])->name('cliente.compras');

Route::get('/edicionCliente/{pkCliente}', [cliente_controller::class, 'mostrarClienteIndividual'])->name('cliente.mostrarEdicion');
Route::post('/actualizarCliente/{pkCliente}', [cliente_controller::class, 'actualizar'])->name('cliente.actualizar');
Route::post('/bajaCliente/{pkCliente}', [cliente_controller::class, 'baja'])->name('cliente.baja');


Route::get('/obtener-detalle-articulo/{id}/{tipoVenta}', [articulo_controller::class,"obtenerDetalleArticulo"])->name('articulo.Articulo');
Route::get('/obtener-cantidad-tipo-venta/{id}/{tipoVenta}', [articulo_controller::class,"obtenerCantidadTipoVenta"])->name('articulo.cantidadVenta');


Route::post('/abonoInsertion', [abono_controller::class,"agregar"])->name('abono.insertar');


///////PROVEEDORES CRUD   /////////////
Route::post('/aggNewProveedor', [Proveedores_controller::class,"agregar"])->name('proveedor.insertar');
Route::get('/allProveedor', [Proveedores_controller::class,"mostrarProveedoresGeneral"])->name('proveedor.mostrar');
Route::get('/idProveedor/{pkProveedor}/{vista?}', [Proveedores_controller::class,"mostrarProveedorPorId"])->name('proveedor.mostrarPorId');
Route::post('/updateProveedor', [Proveedores_controller::class,"actualizar"])->name('proveedor.actualizar');
Route::post('/deleteProveedor/{pkProveedor}', [Proveedores_controller::class,"baja"])->name('proveedor.baja');



///////EMPLEADOS CRUD   /////////////
Route::post('/aggNewEmployee', [empleado_controller::class,"agregar"])->name('empleado.insertar');
Route::get('/allEmployees', [empleado_controller::class,"mostrarUsuariosGeneral"])->name('empleado.mostrar');
Route::get('/idEmployee/{pkEmpleado}/{vista?}', [empleado_controller::class,"mostrarUsuarioPorId"])->name('empleado.mostrarPorId');
Route::post('/updateEmployee', [empleado_controller::class,"actualizar"])->name('empleado.actualizar');
Route::post('/deleteEmployee', [empleado_controller::class,"baja"])->name('empleado.baja');

Route::post('/inicioSesion', [empleado_controller::class, 'login'])->name('inicioSesion');

Route::get('clienteEspecifico/{pkCliente}', [cliente_controller::class, 'mostrarClientePorId'])->name('cliente.detalle');



/// AREA DE PRESUPUESTOS //////////////////////////////////////////////////////////
Route::get('seleccionaPresupuesto/{pkPresupuesto}/{vista?}', [presupuestos_controller::class, 'mostrarDetallesPorIdPresupuesto'])->name('cliente.presupuesto');
Route::get('/historialPresupuesto', [presupuestos_controller::class,"presupuestosGenerales"])->name('presupuestos.ver');
Route::post('/aggPresupuestoClient', [presupuestos_controller::class,"agregarClientPresupuesto"])->name('presupuestoCExistente.insertar');
Route::post('/aggPresupuestoNewClient', [presupuestos_controller::class,"agregarNewClientPresupuesto"])->name('presupuesto.insertar');

Route::get('/seleccionPresupuesto', function () {
    return view('presupuestos');
});

Route::get('/presupuestoNewClient', [articulo_controller::class, 'todosLosArticulos5'])->name('buscarArticulo5');
Route::get('/presupuestoClient', [articulo_controller::class, 'todosLosArticulos4'])->name('buscarArticulo4');
///AREA ABONOS  ////////////////////////////////////////////////////////////


Route::get('/calcular-suma-abonos', [abono_controller::class, 'sumaAbonos']);

Route::get('/calculoCobroyeahh/{pkEmpleado}', [abono_controller::class,"envioCobro"])->name('empleado.cobrado');


Route::get('seleccionaCompra/{pkCompra}/{vista?}', [articulo_controller::class, 'mostrarDetallesPorIdCompra'])->name('cliente.compra');

Route::get('reparto/{pkEmpleado}/{vista?}', [abono_controller::class, 'infoParaAbono'])->name('cobrador.FormAbono');

Route::get('repartido/{pkEmpleado}/{vista?}', [abono_controller::class, 'infoParaAbonoIndividual'])->name('cobrador.Tarjetas');


Route::post('/insercionReparto', [abono_controller::class, 'agregarReparto'])->name('reparto.Insertar');

Route::post('/insercionOrden', [abono_controller::class, 'ordenarReparto'])->name('reparto.Ordenar');

Route::post('/deinsercionOrden', [abono_controller::class, 'desasignarReparto'])->name('reparto.desasignarReparto');


Route::get('/listaCobradores', [empleado_controller::class, 'mostrarSoloCobradores'])->name('cobradores.lista');


//Lista de compras
Route::get('/historialCompras', [comprasCliente_controller::class,"comprasGenerales"])->name('compras.ver');

Route::get('/historialAbonos', [abono_controller::class, 'mostrarAbonosPorGenerales'])->name('abonos.historial');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
