<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\TipoVenta;
use App\Models\ArticuloTipoVenta;
use App\Models\MovimientosArticulos;
use App\Models\Cliente;
use App\Models\detalleCompra;
use Carbon\Carbon;

class articulo_controller extends Controller
{
    public function todosLosArticulos(Request $request) {
 
        $datosArticulos = Articulo::join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
            ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
            ->select('categoriaarticulo.*', 'articulo.*', 'unidad.*','articulo.estatus as ESTATUSARTICULO')
            ->where('articulo.estatus', '!=', 3)
            ->get();
            
        return view('comprasClienteNuevo',compact('datosArticulos'));
    }
    public function todosLosArticulos2(Request $request) {
 
        $datosArticulos = Articulo::join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
        ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
        ->select('categoriaarticulo.*', 'articulo.*', 'unidad.*','articulo.estatus as ESTATUSARTICULO')
        ->where('articulo.estatus', '!=', 3)
            ->get();
            
        return view('comprasClienteExistente',compact('datosArticulos'));
    }
    public function todosLosArticulos3(Request $request) {
 
        $datosArticulos = Articulo::join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
        ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
        ->select('categoriaarticulo.*', 'articulo.*', 'unidad.*','articulo.estatus as ESTATUSARTICULO')
        ->where('articulo.estatus', '!=', 3)
        ->get();
    
        return view('listaArticulos',compact('datosArticulos'));
    }
    public function todosLosArticulos4(Request $request) {
 
        $datosArticulos = Articulo::join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
        ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
        ->select('categoriaarticulo.*', 'articulo.*', 'unidad.*','articulo.estatus as ESTATUSARTICULO')
        ->where('articulo.estatus', '!=', 3)
            ->get();
            
        return view('presupuestoClienteExistente',compact('datosArticulos'));
    }
    public function todosLosArticulos5(Request $request) {
 
        $datosArticulos = Articulo::join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
            ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
            ->select('categoriaarticulo.*', 'articulo.*', 'unidad.*','articulo.estatus as ESTATUSARTICULO')
            ->where('articulo.estatus', '!=', 3)
            ->get();
            
        return view('presupuestoClienteNuevo',compact('datosArticulos'));
    }

    public function articuloDetalle($pkArticulo, $vista = "articuloDetalle") {
 
        $datosArticulos = Articulo::join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
        ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
        ->select('categoriaarticulo.*', 'articulo.*', 'unidad.*','articulo.estatus as ESTATUSARTICULO')
        ->where('articulo.pkArticulo', '=', $pkArticulo)
        ->first();
            
        return view($vista,compact('datosArticulos'));
    }





public function obtenerDetalleArticulo(Request  $req,  $id, $tipoVentaSeleccionado)
{

    // Obtén el tipo de venta seleccionado del formulario
    $tipoVentaSeleccionado = $req->has('fkTipoVenta') ? $req->fkTipoVenta : 1;

    // Obtén el artículo con la cantidadTipoVenta correspondiente
    $articulo = Articulo::select(
            'articulo.*',
            'articuloTipoVenta.cantidadTipoVenta',
            'articuloTipoVenta.enganche',
            'categoriaarticulo.nombreCategoriaArticulo'
        )
        ->join('articuloTipoVenta', 'articuloTipoVenta.fkArticulo', '=', 'articulo.pkArticulo')
        ->join('categoriaarticulo', 'categoriaarticulo.pkCategoriaArticulo', '=', 'articulo.fkCategoriaArticulo')
        ->where('articuloTipoVenta.fkTipoVenta', '=', $tipoVentaSeleccionado)
        ->where('articulo.pkArticulo', '=', $id)
        ->where('articulo.estatus', '=', 1)
        ->first(); // Utilizamos first() para obtener solo un resultado
        
    // Verifica si se encontró el artículo
    if ($articulo) {
        return response()->json([
            'nombreArticulo' => $articulo->nombreArticulo,
            'categoriaArticulo' => $articulo->nombreCategoriaArticulo,
            'cantidadTipoVenta' => $articulo->cantidadTipoVenta,
            'enganche' => $articulo->enganche,
            // Agrega más detalles según sea necesario
        ]);
    } else {
        // Si no se encuentra el artículo, devuelve una respuesta de error
        return response()->json(['error' => 'Artículo no encontrado'], 404);
    }
}



public function obtenerCantidadTipoVenta(Request  $req,  $id, $tipoVentaSeleccionado)
{


    // Obtén el artículo con la cantidadTipoVenta correspondiente
    $articulo = Articulo::select(
        'articulo.*',
        'articuloTipoVenta.cantidadTipoVenta',
        'articuloTipoVenta.enganche'
    )
    ->join('articuloTipoVenta', 'articuloTipoVenta.fkArticulo', '=', 'articulo.pkArticulo')
    ->where('articuloTipoVenta.fkTipoVenta', '=', $tipoVentaSeleccionado)
    ->where('articulo.pkArticulo', '=', $id)
    ->where('articulo.estatus', '=', 1)
    ->first(); // Utilizamos first() para obtener solo un resultado

    // Verifica si se encontró el artículo
    if ($articulo) {
        return response()->json([
            'nombreArticulo' => $articulo->nombreArticulo,
            'categoriaArticulo' => $articulo->fkCategoriaArticulo,
            'cantidadTipoVenta' => $articulo->cantidadTipoVenta,
            'enganche' => $articulo->enganche,
        ]);
    } else {
        // Si no se encuentra el artículo, devuelve una respuesta de error
        return response()->json(['error' => 'Artículo no encontrado'], 404);
    }
}
  /*funcion agregar usuario en la base de datos*/
  public function agregarArticulo(Request $req)
  {
   
      $articulo= new Articulo();
      //nombre base de datos       //nombre formulario
      $articulo->nombreArticulo=$req->nombreArticulo;
      $articulo->fkCategoriaArticulo=$req->fkCategoriaArticulo;
      $articulo->cantidadMinima=$req->cantidadMinima;
      $articulo->cantidadActual=$req->cantidadActual;
      $articulo->costo=$req->costo;
      $articulo->precio=$req->precio;
      $articulo->fkUnidad=$req->fkUnidad;
     if ($req->hasFile('imagenArticulo')) {
      $imagen = $req->file('imagenArticulo');
      $rutaImagen = $imagen->store('public/images');
      $articulo->imagenArticulo = str_replace('public/', '', $rutaImagen);
     }
      $articulo->estatus=1;
    
      $articulo->save();
      if($articulo->pkArticulo){
    
        return redirect(url('/articulesList'))->with('success', '¡Articulo Agregado Existosamente!');
    } else {
        return redirect(url('/articulesList'))->with('error', 'Error en agregado de Articulo');
    }
  }
  public function actualizarArticulo(Request $req)
  {
    date_default_timezone_set('America/Mazatlan');
      $articulo= Articulo::find($req->pkArticulo);
      if($articulo){
      $movimientosArticulos= new MovimientosArticulos();
      $movimientosArticulos->fkArticulo=$req->pkArticulo;
      $movimientosArticulos->fkTipoMovimiento=3;
      $movimientosArticulos->cantidad=0;
      $movimientosArticulos->fecha=Carbon::now();
      $movimientosArticulos->fkEmpleado=session('id');
      $movimientosArticulos->save();
       //nombre base de datos       //nombre formulario
       $articulo->nombreArticulo=$req->nombreArticulo;
       $articulo->fkCategoriaArticulo=$req->fkCategoriaArticulo;
       $articulo->cantidadMinima=$req->cantidadMinima;
       $articulo->cantidadActual=$req->cantidadActual;
       $articulo->precio=$req->precio;
       $articulo->costo=$req->costo;
       $articulo->fkUnidad=$req->fkUnidad;
       if ($req->hasFile('imagenArticulo')) {
        $imagen = $req->file('imagenArticulo');
        $rutaImagen = $imagen->store('public/images');
        $articulo->imagenArticulo = str_replace('public/', '', $rutaImagen);
        }
       $articulo->estatus=1;
       $articulo->save();

    return redirect(url('/articulesList'))->with('success', '¡Actualizacion de Articulo Completada!');
    } else {
        return redirect(url('/articulesList'))->with('error', 'Error en Actualización de Articulo');
    } 
  }
  public function baja($pkArticulo)
  {
      $articulo= Articulo::find($pkArticulo);
      if($articulo){
      //nombre base de datos       //nombre formulario
      $articulo->estatus=3;
      $articulo->save();
     
        return redirect(url('/articulesList'))->with('success', '¡Baja de Producto Completada!');
    } else {
        return redirect(url('/articulesList'))->with('error', 'Error en Baja de Producto');
    } 
  }
  public function movimientosArticulo(Request $req)
  {
    date_default_timezone_set('America/Mazatlan');
      $articulo= Articulo::find($req->pkArticulo);
     
      $cantidadPresente=$articulo->cantidadActual;//nombre base de datos       //nombre formulario
      if($req->tipoMovimiento==1){
       
        $articulo->cantidadActual=$cantidadPresente+$req->cantidadSeleccionada;
      }
      if($req->tipoMovimiento==2){
       
        $articulo->cantidadActual=$cantidadPresente-$req->cantidadSeleccionada;
        if($articulo->cantidadActual<=$articulo->cantidadMinima){
            $articulo->estatus=2;
        }
        if($articulo->cantidadActual<=0){
            $articulo->estatus=0;
        }
      }
      $articulo->save();
      $movimientosArticulos= new MovimientosArticulos();
      $movimientosArticulos->fkArticulo=$req->pkArticulo;
      $movimientosArticulos->fkTipoMovimiento=$req->tipoMovimiento;
      $movimientosArticulos->cantidad=$req->cantidadSeleccionada;
      $movimientosArticulos->fecha= Carbon::now();
      $movimientosArticulos->fkEmpleado=session('id');
      $movimientosArticulos->save();
      if($articulo && $movimientosArticulos->pkMovimientosArticulos){
    
      return redirect(url()->previous())->with('success', '¡Movimiento de Producto Completado!');
    } else {
        return redirect(url()->previous())->with('error', 'Error en movimiento de producto');
    } 
     
  }
  public function todosmovimientosArticulos(Request $request) {
 
    $datosMovimientos = Articulo::join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
        ->join('movimientosarticulos', 'articulo.pkArticulo', '=', 'movimientosarticulos.fkArticulo')
        ->join('tipomovimiento', 'tipomovimiento.pktipoMovimiento', '=', 'movimientosarticulos.fkTipoMovimiento')
        ->join('empleado', 'empleado.pkEmpleado', '=', 'movimientosarticulos.fkEmpleado')
        ->select('categoriaarticulo.*', 'movimientosarticulos.*','tipomovimiento.*', 'empleado.*','articulo.*','articulo.estatus as ESTATUSARTICULO')
        ->get();
    
        
    return view('listaMovimientos',compact('datosMovimientos'));
}


function mostrarDetallesPorIdCompra($pkCompra, $vista = "detalleCompra"){
    $compra = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
    ->join('empleado', 'empleado.pkEmpleado', '=', 'comprascliente.fkEmpleado')
    ->join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
    ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
    ->select(
        'cliente.*',
        'cliente.telefono',
        'comprascliente.*',
        'comprascliente.pkComprasCliente',
        'comprascliente.estatus as ESTATUSCOMPRA',
        'colonia.*', 'municipio.*','empleado.*'
    )    
    ->where('comprascliente.pkComprasCliente', '=', $pkCompra)
    ->first();
    $articulos=detalleCompra::join('comprascliente', 'comprascliente.pkComprasCliente', '=', 'detalleCompra.fkComprasCliente')
    ->join('articulo', 'articulo.pkArticulo', '=', 'detallecompra.fkArticulo')
    ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
    ->join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
    ->select('articulo.*', 'detallecompra.*','categoriaarticulo.*','comprascliente.*','unidad.*')->where('comprasCliente.pkComprasCliente', '=', $pkCompra)->get();
    return view($vista,compact("articulos","compra"));
  }


}
