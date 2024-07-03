<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\ComprasClientes;
use App\Models\MovimientosArticulos;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ArticuloTipoVenta;
use App\Models\detalleCompra;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class comprasCliente_controller extends Controller
{
 

    public function agregarClientBuy(Request $req)
    {   
        date_default_timezone_set('America/Mazatlan');
        $cliente = $req->input('cliente')[0];
        $productoIds = $req->input('producto_id');
        $cantidades = $req->input('cantidadotas');
        $total = $req->input('total');
        if($req){
            $comprasCliente = new ComprasClientes();
        $comprasCliente->fkCliente = $cliente;
        // Suponiendo que ya tienes el valor de $pkCompra
        $pkCompra = $this-> obtenerPKCompraConsecutiva(); // Esta función debería obtener el valor consecutivo del pkCompra
        $cantidadDigitos = 6; // Cantidad de dígitos que deseas tener en total (incluyendo el pkCompra)
        $folioCompra = str_pad($pkCompra, $cantidadDigitos, '0', STR_PAD_LEFT);
        
        $comprasCliente->folioCompra = $folioCompra;
        $comprasCliente->fecha = now();
        $comprasCliente->total = $total;
        $comprasCliente->estatus = 0;
        $comprasCliente->fkEmpleado = session('id');
        $comprasCliente->save();
            // Imprime
            for ($i = 0; $i < count($productoIds); $i++) {
                $productoId = $productoIds[$i];
                $cantidad = $cantidades[$i];

           
                $movimientosArticulos= new MovimientosArticulos();
                $movimientosArticulos->fkArticulo=$productoId;
                $movimientosArticulos->fkTipoMovimiento=2;
                $movimientosArticulos->cantidad=$cantidad;
                $movimientosArticulos->fecha=now();
                $movimientosArticulos->fkEmpleado=session('id');
                $movimientosArticulos->save();

                $articulo= Articulo::find($productoId);
                
                $cantidadPresente=$articulo->cantidadActual;//nombre base de datos       //nombre formulario
                $articulo->cantidadActual=$cantidadPresente-$cantidad;
                if($articulo->cantidadActual<=$articulo->cantidadMinima){
                    $articulo->estatus=2;
                }
                if($articulo->cantidadActual<=0){
                    $articulo->estatus=0;
                }
                $articulo->save();
                
                $detalleCompra= new detalleCompra();
          
                $detalleCompra->fkComprasCliente=  $comprasCliente->pkcomprasCliente;
                $detalleCompra->fkArticulo=$productoId;
                $detalleCompra->cantidad=$cantidad;
                $detalleCompra->totalSubCompra=($cantidad*$articulo->precio);
                $detalleCompra->save();
                
                
                // Aquí puedes realizar las operaciones que necesites con cada conjunto de datos
            }
                
            return redirect(route('cliente.compra', ['pkCompra' => $comprasCliente->pkcomprasCliente]))->with('success', '¡Compra Completada!');
        } else {
            return redirect(url('/tuInicio'))->previous()->with('error', 'Error en Proceso de Compra');
        }  
   
    }
 
            public function agregarNewClientBuy(Request $req)
        {   
            date_default_timezone_set('America/Mazatlan');
            if($req){
            $productoIds = $req->input('producto_id');
            $cantidades = $req->input('cantidadotas');
            $total = $req->input('total');
            
            $cliente = new Cliente();
   
            $cliente->nombreCliente = $req->nombreCliente;
            $cliente->telefono = $req->telefono;
            $cliente->fkColonia = $req->input('fkColonia');
            $cliente->calle = $req->calle;
            $cliente->numCasa = $req->numCasa;
            $cliente->rfc = $req->rfc;
            $cliente->cp = $req->cp;
            $cliente->descripcionDomicilio = $req->descripcionDomicilio;
            if ($req->hasFile('imagenDomicilio')) {
            $imagen = $req->file('imagenDomicilio');
            $rutaImagen = $imagen->store('public/images');
            $cliente->imagenDomicilio = str_replace('public/', '', $rutaImagen);
            }
            $cliente->estatus = 1;
            $cliente->save();
    

            $comprasCliente = new ComprasClientes();
                $comprasCliente->fkCliente = $cliente->pkCliente;
                // Suponiendo que ya tienes el valor de $pkCompra
                $pkCompra = $this->obtenerPKCompraConsecutiva(); // Esta función debería obtener el valor consecutivo del pkCompra
                $cantidadDigitos = 6; // Cantidad de dígitos que deseas tener en total (incluyendo el pkCompra)
                $folioCompra = str_pad($pkCompra, $cantidadDigitos, '0', STR_PAD_LEFT);
                
                $comprasCliente->folioCompra = $folioCompra;
                $comprasCliente->fecha = now();
                $comprasCliente->total = $total;
                $comprasCliente->estatus = 0;
                $comprasCliente->fkEmpleado = session('id');
        $comprasCliente->save();
          
            // Imprime
            for ($i = 0; $i < count($productoIds); $i++) {
                $productoId = $productoIds[$i];
                $cantidad = $cantidades[$i];

               
                $movimientosArticulos= new MovimientosArticulos();
                $movimientosArticulos->fkArticulo=$productoId;
                $movimientosArticulos->fkTipoMovimiento=2;
                $movimientosArticulos->cantidad=$cantidad;
                $movimientosArticulos->fecha=now();
                $movimientosArticulos->fkEmpleado=session('id');
                $movimientosArticulos->save();

                $articulo= Articulo::find($productoId);
              
                $cantidadPresente=$articulo->cantidadActual;//nombre base de datos       //nombre formulario
                $articulo->cantidadActual=$cantidadPresente- $cantidad;
                if($articulo->cantidadActual<=$articulo->cantidadMinima){
                    $articulo->estatus=2;
                }
                if($articulo->cantidadActual<=0){
                    $articulo->estatus=0;
                }
                $articulo->save();
             
                $detalleCompra= new detalleCompra();
          
                $detalleCompra->fkComprasCliente=  $comprasCliente->pkcomprasCliente;
                $detalleCompra->fkArticulo=$productoId;
                $detalleCompra->cantidad=$cantidad;
               
                $detalleCompra->totalSubCompra=($cantidad*$articulo->precio);
                $detalleCompra->save();
                
                
                // Aquí puedes realizar las operaciones que necesites con cada conjunto de datos
            }
                      
            return redirect(route('cliente.compra', ['pkCompra' => $comprasCliente->pkcomprasCliente]))->with('success', '¡Compra Completada!');
            } else {
                return redirect(url('/tuInicio'))->previous()->with('error', 'Error en Proceso de Compra');
            }

        }
 public  function obtenerPKCompraConsecutiva() {
    // Obtener el último registro de comprasCliente ordenado por pkcomprasCliente de forma descendente
    $ultimoRegistro = ComprasClientes::orderBy('pkcomprasCliente', 'desc')->first();

    // Si no hay registros, empezar desde 1
    if (!$ultimoRegistro) {
        return 1;
    }

    // Obtener el pkcomprasCliente del último registro y sumarle 1
    $siguientePK = $ultimoRegistro->pkcomprasCliente + 1;

    return $siguientePK;
}
        public function detalleCompra($pkCompra)
        {

        
        
        $abonos= ComprasClientes::join('abonoarticulo', 'abonoarticulo.fkComprasCliente', '=', 'comprascliente.pkComprasCliente')
        ->select('abonoarticulo.*')     
        ->where('compracliente.pkCompra', '=', $pkCompra)
                ->first();
                
        $compra = Cliente::join('comprasCliente', 'comprasCliente.fkCliente', '=', 'cliente.pkCliente')
        ->join('articulotipoventa', 'articulotipoventa.pkArticuloTipoVenta', '=', 'comprasCliente.fkArticuloTipoVenta')
        ->join('articulo', 'articulo.pkArticulo', '=', 'articulotipoventa.fkArticulo')

        ->select('cliente.*','comprasCliente.*', 'articulotipoventa.*', 'articulo.*', 'tipoventa.*')
        ->where('compraCliente.pkCompra', '=', $pkCompra)
        ->get();
        dd($compra->nombreCliente);
            return view('detalleCompra',compact('abonos','compra'));
        }

        public function articulosVendidos()
        {
            date_default_timezone_set('America/Mazatlan');
            $detalleCompras = detallecompra::join('comprasCliente', 'comprasCliente.pkComprasCliente', '=', 'detalleCompra.fkComprasCliente')
                ->whereDate('comprasCliente.fecha', now()->toDateString())
                ->get();
            
            $datosArticulos = Articulo::join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
                ->join('categoriaArticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
                ->select('categoriaArticulo.*', 'articulo.*', 'unidad.*','articulo.estatus as ESTATUSARTICULO')
                ->where('articulo.estatus', '!=', 3)
                ->get();
        
            $arregloArticulos = [];
            $arregloSumas = [];
        
            foreach ($datosArticulos as $articulo) {
                $sumador = 0;
        
                foreach ($detalleCompras as $detalleCompra) {
                    if ($articulo->pkArticulo == $detalleCompra->fkArticulo) {
                        $sumador += $detalleCompra->cantidad;
                    }
                }
                if($sumador>0){
                $arregloArticulos[] = $articulo;
                $arregloSumas[] = $sumador;
                }
            }
            
        
            return view('paginaInicio', compact('arregloArticulos', 'arregloSumas'));
        }
        

        public function comprasGenerales()
        {
                
        $compras = Cliente::join('comprasCliente', 'comprasCliente.fkCliente', '=', 'cliente.pkCliente')
        ->select('cliente.*', 'comprasCliente.*')
        ->get();

            return view('historialCompras',compact('compras'));
        }
        public function actualizarComprasDespuesDeOneYear()
        {
             // Obtén las compras que cumplen con los criterios
                // Obtén las compras que cumplen con los criterios
            $compras = Cliente::join('comprasCliente', 'comprasCliente.fkCliente', '=', 'cliente.pkCliente');
            // ... (tu código actual)

            // Filtra solo las compras que tengan un año de antigüedad
            $fechaUnAnioAtras = now()->subYear(); // Obtiene la fecha actual y resta un año
            $compras = $compras->where('comprasCliente.fecha', '=', $fechaUnAnioAtras);

            // Actualiza las compras estableciendo el estatus a 2
            $compras->update(['estatus' => 2]);
           
        }



        }



        
