<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Colonia;
use App\Models\Cliente;
class cliente_controller extends Controller
{
    public function buscarCliente(Request $request) {
        $searchTerm = $request->query('searchTermCliente');
        $fkMunicipio = $request->query('fkMunicipio');
        $fkColonia = $request->input('fkColonia'); 
        $datosClientes = Cliente::join('colonia', 'cliente.fkColonia', '=', 'colonia.pkColonia')
        ->join('municipio', 'colonia.fkMunicipio', '=', 'municipio.pkMunicipio')
        ->where('cliente.estatus', 1)
        ->select('cliente.*', 'municipio.*', 'colonia.*')
        ->where(function($query) use ($searchTerm, $fkMunicipio, $fkColonia) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('cliente.nombreCliente', 'LIKE', '%' . $searchTerm . '%')
                ->where('cliente.estatus', 1); 
            });
    
            if ($fkMunicipio) {
                $query->where('colonia.fkMunicipio', '=', $fkMunicipio)
                ->where('cliente.estatus', 1); 
            }
            if ($fkColonia) {
                $query->where('cliente.fkColonia', '=', $fkColonia)
                ->where('cliente.estatus', 1); 
            }
          
        })
        ->orWhere(function($query) use ($searchTerm, $fkMunicipio, $fkColonia) {
            $query->where('municipio.nombreMunicipio', 'LIKE', '%' . $searchTerm . '%')
            ->where('cliente.estatus', 1); 
    
            if ($fkMunicipio) {
                $query->where('colonia.fkMunicipio', '=', $fkMunicipio)
                ->where('cliente.estatus', 1); 
            }
            if ($fkColonia) {
                $query->where('cliente.fkColonia', '=', $fkColonia)
                ->where('cliente.estatus', 1); 
            }
         
        })
        ->orWhere(function($query) use ($searchTerm, $fkMunicipio,$fkColonia) {
            $query->where('colonia.nombreColonia', 'LIKE', '%' . $searchTerm . '%')
            ->where('cliente.estatus', 1); 
    
            if ($fkMunicipio) {
                $query->where('colonia.fkMunicipio', '=', $fkMunicipio)
                ->where('cliente.estatus', 1); 
            }
            if ($fkColonia) {
                $query->where('cliente.fkColonia', '=', $fkColonia)
                ->where('cliente.estatus', 1); 
            }
          
        })
        ->orWhere(function($query) use ($searchTerm, $fkMunicipio,$fkColonia) {
            $query->where('cliente.calle', 'LIKE', '%' . $searchTerm . '%')
            ->where('cliente.estatus', 1); 
    
            if ($fkMunicipio) {
                $query->where('colonia.fkMunicipio', '=', $fkMunicipio)
                ->where('cliente.estatus', 1); 
            }
            if ($fkColonia) {
                $query->where('cliente.fkColonia', '=', $fkColonia)
                ->where('cliente.estatus', 1); 
            }
          
        })
        // Resto de tus joins y condiciones...
        ->get();
    
        
    
        return response()->json($datosClientes);
    }



    public function mostrarClientePorId($pkCliente)
    {

        $cliente = Cliente::join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
            ->select('cliente.*', 'colonia.*', 'municipio.*')
            ->where('cliente.pkCliente', '=', $pkCliente)
            ->first();
        $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
            ->where('cliente.pkCliente', '=', $pkCliente)
            ->select('cliente.*', 'comprascliente.*')
            ->get();
    
           return view('detalleCliente',compact('compras','cliente'));
    }



    public function mostrarClienteIndividual($pkCliente)
    {

        $cliente = Cliente::join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
            ->select('cliente.*', 'colonia.*', 'municipio.*')
            ->where('cliente.pkCliente', '=', $pkCliente)
            ->first();


    
           return view('editarCliente',compact('cliente'));
    }

   
    public function actualizar(Request $req,$pkCliente)
    {
        $cliente= Cliente::find($pkCliente);
        $cliente->nombreCliente = $req->nombreCliente;
        $cliente->telefono = $req->telefono;
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
        $cliente->save();
        if($cliente){
            return redirect(url('/clientesRegistrados'))->with('success', '¡Actualización de Cliente Completada!');
        } else {
            return redirect(url('/clientesRegistrados'))->with('error', 'Error en Actualizacion de Cliente');
    
        }
    
    }

    public function baja($pkCliente)
    {
        $cliente= Cliente::find($pkCliente);
        //nombre base de datos       //nombre formulario
        $cliente->estatus=0;
        $cliente->save();
        if($cliente){
            return redirect(url('/clientesRegistrados'))->with('success', '¡Baja de Cliente Completada!');
        } else {
            return redirect(url('/clientesRegistrados')->previous())->with('error', 'Error en Baja de Cliente');
    
        }

       
    }
 
     





}