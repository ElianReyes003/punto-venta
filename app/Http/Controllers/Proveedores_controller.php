<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class Proveedores_controller extends Controller
{
       /*funcion agregar usuario en la base de datos*/
       public function agregar(Request $req)
       {
           $proveedor= new Proveedor();
           //nombre base de datos       //nombre formulario
           $proveedor->nombreProveedor=$req->nombreProveedor;
           $proveedor->calle=$req->calle;
           $proveedor->numCasa=$req->numCasa;
           $proveedor->fkColonia=$req->fkColonia;
           $proveedor->telefono=$req->telefono;
           $proveedor->rfc = $req->rfc;
           $proveedor->cp = $req->cp;
           $proveedor->descripcionDomicilio = $req->descripcionDomicilio;
           $proveedor->estatus=1;
           $proveedor->save();
           if ($proveedor->wasRecentlyCreated) {
            return redirect(url('/allProveedor'))->with('success', '¡Proveedor agregado exitosamente!');
        } else {
            return redirect(url('/allProveedor'))->with('error', 'Error al agregar proveedor');
        }
          
       }
           /*funcion actualizar usuario en la base de datos*/
       public function actualizar(Request $req)
       {
           $proveedor= Proveedor::find($req->pkProveedor);
           
            //nombre base de datos       //nombre formulario
           $proveedor->nombreProveedor=$req->nombreProveedor;
           $proveedor->calle=$req->calle;
           $proveedor->numCasa=$req->numCasa;
           $proveedor->fkColonia=$req->fkColonia;
           $proveedor->telefono=$req->telefono;
           $proveedor->rfc = $req->rfc;
           $proveedor->cp = $req->cp;
           $proveedor->descripcionDomicilio = $req->descripcionDomicilio;
     
           $proveedor->save();
           if($proveedor){
           return redirect(url('/allProveedor'))->with('success', '¡Actualizacion proveedor Completada!');
        } else {
            return redirect(url('/allProveedor'))->with('error', 'Error en Actualizacion de proveedor');
    }
          
       }
        /*funcion baja usuario en la base de datos*/
       public function baja(Request $req,$pkProveedor)
       {
        $proveedor= Proveedor ::find($pkProveedor);
           //nombre base de datos       //nombre formulario
           $proveedor->estatus=0;
           $proveedor->save();
           if($proveedor){
            return redirect(url('/allProveedor'))->with('success', '¡Baja de proveedor Completada!');
        } else {
            return redirect(url('/allProveedor'))->with('error', 'Error en Baja de proveedor');
          
       }
    }
            /*funcion mostrar todos los usuarios  en la base de datos*/
       function mostrarProveedoresGeneral(){
           $datosProveedores=Proveedor::join('colonia', 'colonia.pkColonia', '=', 'proveedor.fkColonia')
           ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                       ->select('proveedor.*','municipio.*','colonia.*')->where('proveedor.estatus', '=', '1')->get();
           return view("listaProveedores",compact("datosProveedores"));
         }
              /*funcion actualizar usuario especifico en la base de datos*/
         function mostrarProveedorPorId($pkProveedor, $vista = "detalleProveedor"){
           $proveedor=Proveedor::join('colonia', 'colonia.pkColonia', '=', 'Proveedor.fkColonia')
           ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                       ->select('Proveedor.*','municipio.*','colonia.*')->where('Proveedor.estatus', '=', '1')->where('Proveedor.pkProveedor', '=', $pkProveedor)->first();
                     
         $compras = Proveedor::join('compraProveedor', 'compraProveedor.fkproveedor', '=', 'proveedor.pkproveedor')
                       ->where('proveedor.pkproveedor', '=', $pkProveedor)
                       ->select('proveedor.*', 'compraProveedor.*')
                       ->get();
                      
                     
                       return view($vista,compact('compras','proveedor'));
         }
}
