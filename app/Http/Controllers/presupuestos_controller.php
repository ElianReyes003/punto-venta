<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presupuesto;
use App\Models\Articulo;
use App\Models\detallePresupuesto;

use App\Models\Cliente;
class presupuestos_controller extends Controller
{
    public function agregarClientPresupuesto(Request $req)
    {   
        date_default_timezone_set('America/Mazatlan');
        $cliente = $req->input('cliente')[0];
        $productoIds = $req->input('producto_id');
        $cantidades = $req->input('cantidadotas');
        $total = $req->input('total');
        if($req){
            $comprasCliente = new Presupuesto();
            $comprasCliente->fkCliente = $cliente;
            $comprasCliente->folioPresupuesto=uniqid();
            $comprasCliente->fecha = now();
        
            $comprasCliente->total = $total;
            $comprasCliente->estatus = 0;
            $comprasCliente->fkEmpleado= session('id');
            $comprasCliente->save();
            // Imprime
            for ($i = 0; $i < count($productoIds); $i++) {
                $productoId = $productoIds[$i];
                $cantidad = $cantidades[$i];


                $articulo= Articulo::find($productoId);
                
               
                
                $detalleCompra= new detallePresupuesto();
          
                $detalleCompra->fkPresupuesto=  $comprasCliente->pkPresupuesto;
                $detalleCompra->fkArticulo=$productoId;
                $detalleCompra->cantidad=$cantidad;
                $detalleCompra->totalSubCompra=($cantidad*$articulo->precio);
                $detalleCompra->save();
                
                
                // Aquí puedes realizar las operaciones que necesites con cada conjunto de datos
            }
                
          return redirect(route('cliente.presupuesto', ['pkPresupuesto' => $comprasCliente->pkPresupuesto]))->with('success', '¡Presupuesto Completado!');
        } else {
            return redirect(url('/tuInicio'))->previous()->with('error', 'Error en Proceso de Compra');
        }  
   
    }
 
            public function agregarNewClientPresupuesto(Request $req)
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

            $comprasCliente = new Presupuesto();
            $comprasCliente->fkCliente = $cliente->pkCliente;
            $comprasCliente->folioPresupuesto=uniqid();
            $comprasCliente->fecha = now();
        
            $comprasCliente->total = $total;
            $comprasCliente->estatus = 0;
            $comprasCliente->fkEmpleado= session('id');
            $comprasCliente->save();
          
            // Imprime
            for ($i = 0; $i < count($productoIds); $i++) {
                $productoId = $productoIds[$i];
                $cantidad = $cantidades[$i];

                $articulo= Articulo::find($productoId);
            
                $detalleCompra= new detallePresupuesto();
          
                $detalleCompra->fkPresupuesto=  $comprasCliente->pkPresupuesto;
                $detalleCompra->fkArticulo=$productoId;
                $detalleCompra->cantidad=$cantidad;
               
                $detalleCompra->totalSubCompra=($cantidad*$articulo->precio);
                $detalleCompra->save();
                
                
                // Aquí puedes realizar las operaciones que necesites con cada conjunto de datos
            }
          
            return redirect(route('cliente.presupuesto', ['pkPresupuesto' => $comprasCliente->pkPresupuesto]))->with('success', '¡Presupuesto Completado!');
            } else {
                return redirect(url('/tuInicio'))->previous()->with('error', 'Error en Proceso de Compra');
            }

        }
        public function presupuestosGenerales()
        {
                
        $compras = Cliente::join('presupuesto', 'presupuesto.fkCliente', '=', 'cliente.pkCliente')
        ->select('cliente.*', 'presupuesto.*')
        ->get();

            return view('historialPresupuestos',compact('compras'));
        }


        function mostrarDetallesPorIdPresupuesto($pkPresupuesto, $vista = "detallePresupuesto"){
            $compra = Cliente::join('presupuesto', 'presupuesto.fkCliente', '=', 'cliente.pkCliente')
            ->join('empleado', 'empleado.pkEmpleado', '=', 'presupuesto.fkEmpleado')
            ->join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
            ->select(
                'cliente.*',
                'cliente.telefono',
                'presupuesto.*',
                'presupuesto.pkPresupuesto',
                'presupuesto.estatus as ESTATUSPRESUPUESTO',
                'colonia.*', 'municipio.*','empleado.*'
            )    
            ->where('presupuesto.pkPresupuesto', '=', $pkPresupuesto)
            ->first();
            $articulos=detallePresupuesto::join('presupuesto', 'presupuesto.fkCliente', '=', 'detallePresupuesto.fkPresupuesto')
            ->join('articulo', 'articulo.pkArticulo', '=', 'detallepresupuesto.fkArticulo')
            ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
            ->join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
            ->select('articulo.*', 'detallepresupuesto.*','categoriaarticulo.*','presupuesto.*','unidad.*')->where('presupuesto.pkPresupuesto', '=', $pkPresupuesto)->get();
            return view($vista,compact("articulos","compra"));
          }

}
