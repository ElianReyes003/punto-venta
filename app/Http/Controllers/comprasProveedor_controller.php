<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use App\Models\CompraProveedor;
use App\Models\MovimientosArticulos;
use App\Models\Articulo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ArticuloTipoVenta;
use App\Models\detalleCompraProveedor;

class comprasProveedor_controller extends Controller
{
    public function agregarProveedorBuy(Request $req)
    {   
        date_default_timezone_set('America/Mazatlan');
        $proveedor = $req->input('proveedor')[0];
        $productoIds = $req->input('producto_id');
        $cantidades = $req->input('cantidadotas');
        $total = $req->input('total');
        if($req){
            $comprasProveedor= new CompraProveedor();
            $comprasProveedor->fkProveedor= $proveedor;
            $comprasProveedor->folioCompraProveedor=uniqid();
            $comprasProveedor->fecha = now();
            $comprasProveedor->total = $total;
            $comprasProveedor->estatus = 0;
            $comprasProveedor->fkEmpleado= session('id');
            $comprasProveedor->save();
            // Imprime
            for ($i = 0; $i < count($productoIds); $i++) {
                $productoId = $productoIds[$i];
                $cantidad = $cantidades[$i];

           
                $movimientosArticulos= new MovimientosArticulos();
                $movimientosArticulos->fkArticulo=$productoId;
                $movimientosArticulos->fkTipoMovimiento=1;
                $movimientosArticulos->cantidad=$cantidad;
                $movimientosArticulos->fecha=now();
                $movimientosArticulos->fkEmpleado=session('id');
                $movimientosArticulos->save();

                $articulo= Articulo::find($productoId);
                $cantidadPresente=$articulo->cantidadActual;
                //nombre base de datos       //nombre formulario
                $articulo->cantidadActual=$cantidadPresente+$cantidad;
                if($articulo->cantidadActual<=$articulo->cantidadMinima){
                    $articulo->estatus=2;
                }
                if($articulo->cantidadActual<=0){
                    $articulo->estatus=0;
                }
                $articulo->save();
                
                $detalleCompra= new detalleCompraProveedor();
          
                $detalleCompra->fkCompraProveedor=$comprasProveedor->pkCompraProveedor;
                $detalleCompra->fkArticulo=$productoId;
                $detalleCompra->cantidad=$cantidad;
                $detalleCompra->totalSubCompra=($cantidad*$articulo->costo);
                $detalleCompra->save();
                
                
                // Aquí puedes realizar las operaciones que necesites con cada conjunto de datos
            }
                
            return redirect(route('compraProveedor.detalle', ['pkCompraProveedor' => $comprasProveedor->pkCompraProveedor]))->with('success', '¡Compra Completada!');
        } else {
            return redirect(url('/tuInicio'))->previous()->with('error', 'Error en Proceso de Compra');
        }  
   
    }
 

   
        function mostrarDetallesPorIdCompraProveedor($pkCompraProveedor, $vista = "detalleCompraProveedor"){
            $compra = Proveedor::join('compraproveedor', 'compraproveedor.fkProveedor', '=', 'proveedor.pkProveedor')
            ->join('empleado', 'empleado.pkEmpleado', '=', 'compraproveedor.fkEmpleado')
            ->join('colonia', 'colonia.pkColonia', '=', 'Proveedor.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
            ->select(
                'proveedor.*',
                'proveedor.telefono',
                'compraproveedor.*',
                'compraproveedor.pkCompraProveedor',
                'compraproveedor.estatus as ESTATUSCOMPRA',
                'colonia.*', 'municipio.*','empleado.*'
            )    
            ->where('compraProveedor.pkCompraProveedor', '=', $pkCompraProveedor)
            ->first();
           
            $articulos=detalleCompraProveedor::join('compraProveedor', 'compraProveedor.pkCompraProveedor', '=', 'detalleCompraproveedor.fkCompraProveedor')
            ->join('articulo', 'articulo.pkArticulo', '=', 'detallecompraproveedor.fkArticulo')
            ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
            ->join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
            ->select('articulo.*', 'detallecompraproveedor.*','categoriaarticulo.*','compraProveedor.*','unidad.*')->where('compraProveedor.pkCompraProveedor', '=', $pkCompraProveedor)->get();
            return view($vista,compact("articulos","compra"));
        }

        public function comprasGenerales()
        {
                
        $compras = Proveedor::join('compraProveedor', 'compraProveedor.fkproveedor', '=', 'proveedor.pkproveedor')
        ->select('proveedor.*', 'compraProveedor.*')
        ->get();

            return view('historialComprasProveedor',compact('compras'));
        }
        public function mostrarproveedorPorId($pkproveedor)
        {
    
            $proveedor = Proveedor::join('colonia', 'colonia.pkColonia', '=', 'proveedor.fkColonia')
                ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                ->select('proveedor.*', 'colonia.*', 'municipio.*')
                ->where('proveedor.pkproveedor', '=', $pkproveedor)
                ->first();
            $compras = Proveedor::join('compraProveedor', 'compraProveedor.fkproveedor', '=', 'proveedor.pkproveedor')
                ->where('proveedor.pkproveedor', '=', $pkproveedor)
                ->select('proveedor.*', 'compraProveedor.*')
                ->get();
        
               return view('detalleProveedor',compact('compras','proveedor'));
        }
    
        public function todosLosArticulosYProveedores(Request $request) {
 
            $datosArticulos = Articulo::join('unidad', 'unidad.pkUnidad', '=', 'articulo.fkUnidad')    
                ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
                ->select('categoriaarticulo.*', 'articulo.*', 'unidad.*','articulo.estatus as ESTATUSARTICULO')
                ->where('articulo.estatus', '!=', 3)
                ->get();

                $datoProveedor=Proveedor::join('colonia', 'colonia.pkColonia', '=', 'proveedor.fkColonia')
                ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                            ->select('proveedor.*','municipio.*','colonia.*')->where('proveedor.estatus', '=', '1')->get();
            return view('comprasProveedor',compact('datosArticulos','datoProveedor'));
        }
}
