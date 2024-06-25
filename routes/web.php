<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Persona_controller;
use App\Http\Controllers\Articulo_controller;
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

Route::get('/AggUsers', function () {
    return view('agregarEmpleado');
})->name('formEmpleado');



//CATEGORIA ARTICULO CRUD
Route::get('/categoriaArticuloVision', [categoriaArticulo_controller::class, 'mostrar'])->name('categoriaArticulo.vista');
Route::post('/aggCategoriaArticulo', [categoriaArticulo_controller::class,"insertar"])->name('categoriaArticulo.insertar');
Route::post('/bajaCategoriaArticulo/{pkArticulo}', [categoriaArticulo_controller::class,"baja"])->name('categoriaArticulo.baja');
Route::post('/UpdateCategoriaArticulo/{pkCategoriaArticulo}', [categoriaArticulo_controller::class,"editar"])->name('categoriaArticulo.actualizar');
Route::get('/mostrarCategoriaArticuloPorId/{pkCategoriaArticulo}', [categoriaArticulo_controller::class, 'mostrarPorId'])->name('categoriaArticulo.mostrarPorId');
Route::get('/articuloAgregar', function () {
    return view('formularioArticulos');
})->name('articleAgg');




Route::get('/tuInicio', function () {
    return view('paginaInicio');
})->name('paginaInicio');




///////EMPLEADOS CRUD   /////////////
Route::post('/aggNewEmployee', [empleado_controller::class,"agregar"])->name('empleado.insertar');
Route::get('/allEmployees', [empleado_controller::class,"mostrarUsuariosGeneral"])->name('empleado.mostrar');
Route::get('/idEmployee/{pkEmpleado}/{vista?}', [empleado_controller::class,"mostrarUsuarioPorId"])->name('empleado.mostrarPorId');
Route::post('/updateEmployee', [empleado_controller::class,"actualizar"])->name('empleado.actualizar');
Route::post('/deleteEmployee', [empleado_controller::class,"baja"])->name('empleado.baja');

Route::post('/inicioSesion', [empleado_controller::class, 'login'])->name('inicioSesion');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
